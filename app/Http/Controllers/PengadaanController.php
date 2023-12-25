<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Bidang;
use App\Models\Kategori;
use App\Models\Pengadaan;
use App\Models\ItemPengadaan;
use App\Models\RealisasiPengadaan;
use Illuminate\Support\Facades\DB;
use App\Models\RealisasiPengadaanList;
use App\Http\Requests\StorePengadaanRequest;
use App\Http\Requests\UpdatePengadaanRequest;
use Illuminate\Http\Request;

class PengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function approval()
    {
        $pengadaanLayanan = Pengadaan::where('bidang', '1')
            ->where('status_manager_bidang', true)
            ->where('status_manager_umum', null)
            ->count();
        $pengadaanKeuangan = Pengadaan::where('bidang', '2')
            ->where('status_manager_bidang', true)
            ->where('status_manager_umum', null)
            ->count();
        $pengadaanSDM = Pengadaan::where('bidang', '3')
            ->where('status_manager_bidang', true)
            ->where('status_manager_umum', null)
            ->count();
        $pengadaanTotal = Pengadaan::where('status_manager_umum', true)
            ->where('selesai', false)->count();

        return view('pengadaan.approval', compact('pengadaanLayanan', 'pengadaanKeuangan', 'pengadaanSDM', 'pengadaanTotal'));
    }

    public function buatPengadaan()
    {
        $user = auth()->user();
        $role = $user->Role->nama;
        $path = request()->path();

        $bidangs = DB::table('bidangs')->get();
        $kategoris = Kategori::all();
        $allItems = Item::all();

        // Group itemPengadaan by items.nama, then get the sum of each by grouping from bidangs.nama
        $itemPengadaan = ItemPengadaan::join('pengadaans', 'pengadaans.id', '=', 'item_pengadaans.id_pengadaan')
            ->join('items', 'items.id', '=', 'item_pengadaans.id_item')
            ->join('kategoris', 'kategoris.id', '=', 'items.kategori')
            ->join('bidangs', 'bidangs.id', '=', 'pengadaans.bidang')
            ->select('item_pengadaans.*', 'items.nama as nama_item', 'kategoris.nama as nama_kategori', 'bidangs.nama as nama_bidang')
            ->where('pengadaans.status_manager_bidang', true)
            ->where('pengadaans.status_manager_umum', true)
            ->where('pengadaans.selesai', false)
            ->get()
            ->groupBy('nama_item')
            ->map(function ($item) {
                return $item->groupBy('nama_bidang')->map(function ($item) {
                    return $item->sum('jumlah');
                });
            });

        $itemPengadaan = $itemPengadaan->map(function ($item) use ($bidangs) {
            $item = $item->map(function ($item) {
                return $item;
            });
            $bidangs->each(function ($bidang) use ($item) {
                if (!$item->has($bidang->nama)) {
                    $item->put($bidang->nama, 0);
                }
            });
            $item->put('total', $item->sum());
            return $item;
        });


        // Add the kategori of the item to the itemPengadaan array
        $itemPengadaan = $itemPengadaan->map(function ($item, $key) use ($allItems) {
            $item->put('kategori', $allItems->where('nama', $key)->first()->Kategori->nama);
            $item->put('nama_item', $key);
            $item->put('satuan', $allItems->where('nama', $key)->first()->Satuan->nama);
            return $item;
        });

        // Group by kategori
        $itemPengadaan = $itemPengadaan->groupBy('kategori');

        // Get the latest id on realisas_pengadaans table
        $realisasiPengadaan = RealisasiPengadaan::latest()->first();
        $realisasiPengadaanNewId = $realisasiPengadaan ? $realisasiPengadaan->id + 1 : 1;

        return view('pengadaan.buat', compact('itemPengadaan', 'realisasiPengadaanNewId'));
    }

    public function realisasiPengadaan()
    {
        $user = auth()->user();

        // Start a transaction
        DB::beginTransaction();

        // Create realisasi_pengadaan table
        $realisasi_pengadaan = RealisasiPengadaan::create([
            'penanggung_jawab' => $user->id,
        ]);

        // Get all pengadaan that has been approved by manager umum and selesai is false
        $pengadaan = Pengadaan::where('status_manager_umum', true)
            ->where('selesai', false)
            ->get();


        // get only pengadaan->id and turn it into array
        $pengadaanId = $pengadaan->pluck('id')->toArray();

        // get all item_pengadaan that has pengadaan_id in $pengadaanId
        $itemPengadaan = ItemPengadaan::whereIn('id_pengadaan', $pengadaanId)
            ->join('pengadaans', 'pengadaans.id', '=', 'item_pengadaans.id_pengadaan')
            ->get();

        // loop foreach itemPengadaan, calculate to items table where item.id = itemPengadaan.id_item
        // also if bidang = 1, add stok_bidang_layanan,
        // if bidang = 2, add stok_bidang_keuangan,
        // if bidang = 3, add stok_bidang_umum,

        foreach ($itemPengadaan as $item) {
            $updatedItem = Item::find($item->id_item);

            if ($item->Pengadaan->bidang === 1) {
                $updatedItem->stok_bidang_layanan += $item->jumlah;
            } elseif ($item->Pengadaan->bidang === 2) {
                $updatedItem->stok_bidang_keuangan += $item->jumlah;
            } elseif ($item->Pengadaan->bidang === 3) {
                $updatedItem->stok_bidang_umum += $item->jumlah;
            }

            $updatedItem->save();
        }

        // Insert realisasi_pengadaan_lists foreach pengadaanId with realisasi_pengadaan_id = $realisasi_pengadaan->id
        foreach ($pengadaanId as $id) {
            RealisasiPengadaanList::create([
                'realisasi_pengadaan_id' => $realisasi_pengadaan->id,
                'pengadaan_id' => $id,
            ]);
            $pengadaan = Pengadaan::find($id);
            $pengadaan->selesai = true;
            $pengadaan->aktor_selesai = $user->id;
            $pengadaan->waktu_selesai = now();
            $pengadaan->save();
        }

        // Commit the transaction
        DB::commit();

        return redirect()->route('dashboard.index');
    }


    /**
     * Display a history of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $user = auth()->user();
        $role = $user->Role->nama;
        $path = request()->path();

        if ($path === 'bidang/pengadaan/history' && $role === 'Sector Head') {
            $pengadaan = Pengadaan::where('bidang', $user->bidang)->orderBy('updated_at', 'desc')->get();
        } elseif ($path === 'umum/pengadaan/history' && $role === 'Manager') {
            $pengadaan = Pengadaan::orderBy('updated_at', 'desc')->get();
        } elseif ($path === 'umum/pengadaan/history/layanan' && $role === 'Manager') {
            $pengadaan = Pengadaan::where('bidang', 1)->orderBy('updated_at', 'desc')->get();
        } elseif ($path === 'umum/pengadaan/history/keuangan' && $role === 'Manager') {
            $pengadaan = Pengadaan::where('bidang', 2)->orderBy('updated_at', 'desc')->get();
        } elseif ($path === 'umum/pengadaan/history/sdm' && $role === 'Manager') {
            $pengadaan = Pengadaan::where('bidang', 3)->orderBy('updated_at', 'desc')->get();
        } else {
            $pengadaan = Pengadaan::where('pemohon', $user->id)->orderBy('updated_at', 'desc')->get();
        }

        return view('pengadaan.history', compact('pengadaan'));
    }

    public function histories()
    {
        // Get bidang
        $bidangs = Bidang::all();

        // Get pengadaan that selesai is true, groupby bidang
        // Count the pengadaan
        $pengadaan = Pengadaan::where('selesai', true)
            ->orderBy('updated_at', 'desc')
            ->get()
            ->groupBy('bidang');


        $pengadaanCount = [0, 0, 0];
        // foreach pengadaan, count the pengadaan
        foreach ($pengadaan as $key => $value) {
            $pengadaanCount[$key - 1] = $value->count();
        }

        // Count all realisasi_pengadaan
        $realisasiPengadaan = RealisasiPengadaan::all()->count();

        return view('pengadaan.histories', compact('pengadaanCount', 'realisasiPengadaan'));
    }

    public function approvedHistory()
    {
        // Get realisasi_pengadaan
        $realisasiPengadaan = RealisasiPengadaan::orderBy('updated_at', 'desc')->get();

        return view('pengadaan.approvedHistory', compact('realisasiPengadaan'));
    }

    public function approvedHistoryDetail(String $id)
    {
        $realisasi_pengadaan_detail = RealisasiPengadaanList::where('realisasi_pengadaan_id', $id)
            ->join('pengadaans', 'pengadaans.id', '=', 'realisasi_pengadaan_lists.pengadaan_id')
            ->join('item_pengadaans', 'item_pengadaans.id_pengadaan', '=', 'pengadaans.id')
            ->join('items', 'items.id', '=', 'item_pengadaans.id_item')
            ->join('kategoris', 'kategoris.id', '=', 'items.kategori')
            ->join('satuans', 'satuans.id', '=', 'items.satuan')
            ->select(
                'items.id as id_item',
                'items.nama as nama_item',
                'items.kategori',
                'item_pengadaans.jumlah',
                'bidang',
                'kategoris.nama as nama_kategori',
                'satuans.nama as nama_satuan'
            )
            ->orderBy('items.kategori', 'asc')
            ->orderBy('items.id', 'asc')
            ->get();


        $realisasi_pengadaan_date = RealisasiPengadaan::find($id)->created_at;

        $pengadaan = RealisasiPengadaan::where('id', $id)->first();

        // Get unique kategori from realisasi_pengadaan
        $kategori = $realisasi_pengadaan_detail->unique('kategori')->pluck('kategori')->sort();
        $kategori = $kategori->mapWithKeys(function ($item) {
            return [$item => Kategori::find($item)->nama];
        });


        // Group realisasi_pengadaan by nama_item, then sum jumlah by bidang
        $realisasi_pengadaan_detail = $realisasi_pengadaan_detail->groupBy('nama_item')->map(function ($item) {
            // Return kategori and jumlah groupby bidang
            $newItem = collect();
            $newItem->put('kategori', $item->first()->nama_kategori);
            $newItem->put('satuan', $item->first()->nama_satuan);
            $newItem->put('bidang', $item->groupBy('bidang')->map(function ($item) {
                return $item->sum('jumlah');
            }));
            return $newItem;
        });

        $realisasi_pengadaan = RealisasiPengadaan::find($id);


        return view('pengadaan.approvedHistoryDetail', compact('realisasi_pengadaan_detail', 'kategori', 'realisasi_pengadaan_date', 'id', 'realisasi_pengadaan'));
    }


    /**
     * Display a list of the resource that need to verify.
     *
     * @return \Illuminate\Http\Response
     */
    public function verifikasi()
    {
        $user = auth()->user();
        $role = $user->Role->nama;
        $path = request()->path();


        if ($path === 'bidang/pengadaan/verifikasi' && $role === 'Sector Head') {
            $pengadaan = Pengadaan::where('bidang', $user->bidang)
                ->where('status_manager_bidang', null)
                ->orderBy('updated_at', 'desc')
                ->get();
        } elseif ($path === 'umum/pengadaan/approval/layanan' && $role === 'Manager') {
            $pengadaan = Pengadaan::where('status_manager_bidang', true)
                ->where('status_manager_umum', null)
                ->where('bidang', 1)
                ->orderBy('updated_at', 'desc')
                ->get();
        } elseif ($path === 'umum/pengadaan/approval/keuangan' && $role === 'Manager') {
            $pengadaan = Pengadaan::where('status_manager_bidang', true)
                ->where('status_manager_umum', null)
                ->where('bidang', 2)
                ->orderBy('updated_at', 'desc')
                ->get();
        } elseif ($path === 'umum/pengadaan/approval/sdm' && $role === 'Manager') {
            $pengadaan = Pengadaan::where('status_manager_bidang', true)
                ->where('status_manager_umum', null)
                ->where('bidang', 3)
                ->orderBy('updated_at', 'desc')
                ->get();
        } else {
            $pengadaan = Pengadaan::where('pemohon', $user->id)->orderBy('updated_at', 'desc')->get();
        }

        return view('pengadaan.verifikasi', compact('pengadaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get all kategori
        $kategori = Kategori::all();

        // get all items
        $items = Item::all();

        // return
        return view('pengadaan.create', compact('kategori', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePengadaanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengadaanRequest $request)
    {
        DB::beginTransaction();

        try {
            $pengadaan = Pengadaan::create([
                'kegiatan' => $request->kegiatan,
                'pemohon' => auth()->user()->id,
                'bidang' => $request->bidang,
            ]);

            for ($i = 0; $i < count($request->item); $i++) {
                $itemPengadaan = ItemPengadaan::create([
                    'id_pengadaan' => $pengadaan->id,
                    'id_item' => $request->item[$i],
                    'jumlah' => $request->jumlah[$i],
                ]);
            }

            DB::commit();

            return redirect()->route('pengadaan.history')->with('success', 'Berhasil menambahkan data pengadaan');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);

            return redirect()->route('dashboard.index')->with('error', 'Terjadi kesalahan saat menambahkan data pengadaan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengadaan  $pengadaan
     * @return \Illuminate\Http\Response
     */
    public function show(String $id)
    {
        // Get pengadaan
        $pengadaan = Pengadaan::find($id);

        // Get items on item_pengadaan where id_pengadaan = $id, inner join with item, sort by kategori
        $items = DB::table('item_pengadaans')
            ->select('item_pengadaans.id', 'item_pengadaans.jumlah', 'items.nama', 'kategoris.nama as kategori', 'satuans.nama as satuan')
            ->join('items', 'item_pengadaans.id_item', '=', 'items.id')
            ->join('kategoris', 'items.kategori', '=', 'kategoris.id')
            ->join('satuans', 'items.satuan', '=', 'satuans.id')
            ->where('item_pengadaans.id_pengadaan', $id)
            ->orderBy('items.kategori')
            ->get();

        //   Get unique kategori from $items and only get the 'nama' column
        $kategori = $items->unique('kategori')->pluck('kategori');

        return view('pengadaan.detail', compact('pengadaan', 'items', 'kategori'));
    }

    public function accept(String $id)
    {
        $pengadaan = Pengadaan::find($id);

        if (auth()->user()->Role->nama === 'Sector Head') {
            $pengadaan->status_manager_bidang = true;
            $pengadaan->manager_bidang = auth()->user()->id;
            $pengadaan->waktu_manager_bidang = now();
            $pengadaan->save();
            return redirect()->route('pengadaan.bidang.verifikasi')->with('success', 'Berhasil menerima pengadaan');
        } elseif (auth()->user()->Role->nama === 'Manager') {
            $pengadaan->status_manager_umum = true;
            $pengadaan->manager_umum = auth()->user()->id;
            $pengadaan->waktu_manager_umum = now();
            $pengadaan->save();
            return redirect()->route('pengadaan.umum.approval')->with('success', 'Berhasil menerima pengadaan');
        }
    }

    public function reject(String $id)
    {
        $alasan = request()->alasan;
        $pengadaan = Pengadaan::find($id);
        $user = auth()->user();
        $role = $user->Role->nama;

        if ($role === 'Sector Head') {
            $pengadaan->status_manager_bidang = false;
            $pengadaan->manager_bidang = $user->id;
            $pengadaan->waktu_manager_bidang = now();
            $pengadaan->alasan_manager_bidang = $alasan;
            $pengadaan->save();
            return redirect()->route('pengadaan.bidang.verifikasi')->with('success', 'Berhasil menolak pengadaan');
        } elseif ($role === 'Manager') {
            if (request()->tujuan == 'manajer-bidang') {
                $pengadaan->status_manager_umum = false;
                $pengadaan->manager_umum = $user->id;
                $pengadaan->waktu_manager_umum = now();
                $pengadaan->alasan_manager_umum = $alasan;
                $pengadaan->save();
                return redirect()->route('pengadaan.umum.verifikasi')->with('success', 'Berhasil menolak pengadaan');
            } else {
                $pengadaan->status_manager_umum = false;
                $pengadaan->status_manager_bidang = false;
                $pengadaan->manager_umum = $user->id;
                $pengadaan->waktu_manager_umum = now();
                $pengadaan->alasan_manager_umum = $alasan;
                $pengadaan->save();
                return redirect()->route('pengadaan.umum.verifikasi')->with('success', 'Berhasil menolak pengadaan');
            }
        }
    }

    public function revisi(String $id)
    {
        // Get pengadaan
        $pengadaan = Pengadaan::find($id);

        // Get items on item_pengadaan where id_pengadaan = $id, inner join with item, sort by kategori
        $selectedItems = DB::table('item_pengadaans')
            ->select('item_pengadaans.id', 'items.id as id_item', 'item_pengadaans.jumlah', 'items.nama', 'kategoris.nama as kategori', 'satuans.nama as satuan')
            ->join('items', 'item_pengadaans.id_item', '=', 'items.id')
            ->join('kategoris', 'items.kategori', '=', 'kategoris.id')
            ->join('satuans', 'items.satuan', '=', 'satuans.id')
            ->where('item_pengadaans.id_pengadaan', $id)
            ->orderBy('items.kategori')
            ->get();

        $items = Item::all();

        $kategori = DB::table('kategoris')->get();

        return view('pengadaan.revisi', compact('pengadaan', 'items', 'kategori', 'selectedItems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengadaan  $pengadaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengadaan $pengadaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePengadaanRequest  $request
     * @param  \App\Models\Pengadaan  $pengadaan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePengadaanRequest $request, Pengadaan $pengadaan)
    {
        $path = $request->path();
        $updateRequest = $request->all();
        DB::beginTransaction();

        try {
            $pengadaan = Pengadaan::find($request->id);

            if ($path === 'pengadaan/revisi') {
                $pengadaan->update([
                    'status_manager_bidang' => null,
                    'manager_bidang' => null,
                    'waktu_manager_bidang' => null,
                    'alasan_manager_bidang' => null,
                    'status_manager_umum' => null,
                    'manager_umum' => null,
                    'waktu_manager_umum' => null,
                    'alasan_manager_umum' => null,
                ]);
            } elseif ('bidang/pengadaan/revisi') {
                $pengadaan->update([
                    'status_manager_umum' => null,
                    'manager_umum' => null,
                    'waktu_manager_umum' => null,
                    'alasan_manager_umum' => null,
                ]);
            }
            ItemPengadaan::where('id_pengadaan', $request->id)->delete();

            for ($i = 0; $i < count($updateRequest['item']); $i++) {
                ItemPengadaan::create([
                    'id_pengadaan' => $request->id,
                    'id_item' => $updateRequest['item'][$i],
                    'jumlah' => $updateRequest['jumlah'][$i],
                ]);
            }

            DB::commit();

            if ($path === 'bidang/pengadaan/revisi') {
                return redirect()->route('pengadaan.bidang.history')->with('success', 'Berhasil mengubah data pengadaan');
            }
            return redirect()->route('pengadaan.history')->with('success', 'Berhasil mengubah data pengadaan');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);

            return redirect()->route('dashboard.index')->with('error', 'Terjadi kesalahan saat mengubah data pengadaan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengadaan  $pengadaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengadaan $pengadaan)
    {
        //
    }

    public function stok()
    {
        $items = Item::all();

        return view('pengadaan.stok', compact('items'));
    }

    public function inputStok(Request $request)
    {
        $layanan = $request->layanan;
        $keuangan = $request->keuangan;
        $umum = $request->umum;
        try {
            // Start transaction
            DB::beginTransaction();
            // for each item, add stok
            for ($i = 0; $i < count($layanan); $i++) {
                $item = Item::find($i + 1);
                $item->stok_bidang_layanan = $layanan[$i];
                $item->stok_bidang_keuangan = $keuangan[$i];
                $item->stok_bidang_umum = $umum[$i];
                $item->save();
            }
            // Commit transaction
            DB::commit();
            return redirect()->route('dashboard.index')->with('success', 'Berhasil mengubah stok');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('pengadaan.umum.stok')->with('error', 'Terjadi kesalahan saat mengubah stok: ' . $e->getMessage());
        }
    }
}
