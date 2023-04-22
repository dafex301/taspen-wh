<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kategori;
use App\Models\Permintaan;
use App\Models\ItemPermintaan;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePermintaanRequest;
use App\Http\Requests\UpdatePermintaanRequest;

class PermintaanController extends Controller
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

        if ($path === 'bidang/permintaan/history' && $role === 'Manajer Bidang') {
            $permintaan = Permintaan::where('bidang', $user->bidang)->orderBy('updated_at', 'desc')->get();
        } elseif ($path === 'umum/permintaan/history' && $role === 'Manajer Umum') {
            $permintaan = Permintaan::all();
        } else {
            $permintaan = Permintaan::where('pemohon', $user->id)->orderBy('updated_at', 'desc')->get();
        }

        return view('permintaan.history', compact('permintaan'));
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
        return view('permintaan.create', compact('kategori', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePermintaanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermintaanRequest $request)
    {
        // dd the request
        DB::beginTransaction();

        try {
            $permintaan = Permintaan::create([
                'kegiatan' => $request->kegiatan,
                'pemohon' => auth()->user()->id,
                'bidang' => $request->bidang,
            ]);

            for ($i = 0; $i < count($request->item); $i++) {
                $itemPermintaan = ItemPermintaan::create([
                    'id_permintaan' => $permintaan->id,
                    'id_item' => $request->item[$i],
                    'jumlah' => $request->jumlah[$i],
                ]);
            }

            DB::commit();

            return redirect()->route('permintaan.history')->with('success', 'Berhasil menambahkan data permintaan');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);

            return redirect()->route('dashboard.index')->with('error', 'Terjadi kesalahan saat menambahkan data permintaan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    public function show(String $id)
    {
        // Get permintaan
        $permintaan = Permintaan::find($id);

        // Get items on item_permintaan where id_permintaan = $id, inner join with item, sort by kategori
        $items = DB::table('item_permintaans')
            ->select('item_permintaans.id', 'item_permintaans.jumlah', 'items.nama', 'permintaans.bidang as bidang', 'kategoris.nama as kategori', 'satuans.nama as satuan', 'stok_bidang_layanan', 'stok_bidang_keuangan', 'stok_bidang_umum')
            ->join('items', 'item_permintaans.id_item', '=', 'items.id')
            ->join('kategoris', 'items.kategori', '=', 'kategoris.id')
            ->join('satuans', 'items.satuan', '=', 'satuans.id')
            ->join('permintaans', 'item_permintaans.id_permintaan', '=', 'permintaans.id')
            ->where('item_permintaans.id_permintaan', $id)
            ->orderBy('items.kategori')
            ->get();

        //   Get unique kategori from $items and only get the 'nama' column
        $kategori = $items->unique('kategori')->pluck('kategori');
        return view('permintaan.detail', compact('permintaan', 'items', 'kategori'));
    }

    public function accept(String $id)
    {
        $permintaan = Permintaan::find($id);

        if (auth()->user()->Role->nama === 'Manajer Bidang') {
            $permintaan->status_manager_bidang = true;
            $permintaan->manager_bidang = auth()->user()->id;
            $permintaan->waktu_manager_bidang = now();
            $permintaan->save();
            return redirect()->route('permintaan.bidang.verifikasi')->with('success', 'Berhasil menerima permintaan');
        } elseif (auth()->user()->Role->nama === 'Manajer Umum') {
            $permintaan->status_manager_umum = true;
            $permintaan->manager_umum = auth()->user()->id;
            $permintaan->waktu_manager_umum = now();
            $permintaan->save();
            return redirect()->route('permintaan.umum.verifikasi')->with('success', 'Berhasil menerima permintaan');
        }
    }

    public function reject(String $id)
    {
        $alasan = request()->alasan;
        $permintaan = Permintaan::find($id);
        $user = auth()->user();
        $role = $user->Role->nama;

        if ($role === 'Manajer Bidang') {
            $permintaan->status_manager_bidang = false;
            $permintaan->manager_bidang = $user->id;
            $permintaan->waktu_manager_bidang = now();
            $permintaan->alasan_manager_bidang = $alasan;
            $permintaan->save();
            return redirect()->route('permintaan.bidang.verifikasi')->with('success', 'Berhasil menolak permintaan');
        } elseif ($role === 'Manajer Umum') {
            if (request()->tujuan == 'manajer-bidang') {
                $permintaan->status_manager_bidang = null;
                $permintaan->manager_bidang = null;
                $permintaan->waktu_manager_bidang = null;

                $permintaan->status_manager_umum = false;
                $permintaan->manager_umum = $user->id;
                $permintaan->waktu_manager_umum = now();
                $permintaan->alasan_manager_umum = $alasan;
                $permintaan->save();
                return redirect()->route('permintaan.umum.verifikasi')->with('success', 'Berhasil menolak permintaan');
            } else {
                $permintaan->status_manager_umum = false;
                $permintaan->status_manager_bidang = false;
                $permintaan->manager_umum = $user->id;
                $permintaan->waktu_manager_umum = now();
                $permintaan->alasan_manager_umum = $alasan;
                $permintaan->save();
                return redirect()->route('permintaan.umum.verifikasi')->with('success', 'Berhasil menolak permintaan');
            }
        }
    }

    public function revisi(String $id)
    {
        // Get permintaan
        $permintaan = Permintaan::find($id);

        // Get items on item_permintaan where id_permintaan = $id, inner join with item, sort by kategori
        $selectedItems = DB::table('item_permintaans')
            ->select('item_permintaans.id', 'items.id as id_item', 'item_permintaans.jumlah', 'items.nama', 'kategoris.nama as kategori', 'satuans.nama as satuan')
            ->join('items', 'item_permintaans.id_item', '=', 'items.id')
            ->join('kategoris', 'items.kategori', '=', 'kategoris.id')
            ->join('satuans', 'items.satuan', '=', 'satuans.id')
            ->where('item_permintaans.id_permintaan', $id)
            ->orderBy('items.kategori')
            ->get();

        $items = Item::all();

        $kategori = DB::table('kategoris')->get();

        return view('permintaan.revisi', compact('permintaan', 'items', 'kategori', 'selectedItems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Permintaan $permintaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePermintaanRequest  $request
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermintaanRequest $request, Permintaan $permintaan)
    {
        $path = $request->path();
        $updateRequest = $request->all();
        DB::beginTransaction();

        try {
            $permintaan = Permintaan::find($request->id);

            if ($path === 'permintaan/revisi') {
                $permintaan->update([
                    'status_manager_bidang' => null,
                    'manager_bidang' => null,
                    'waktu_manager_bidang' => null,
                    'alasan_manager_bidang' => null,
                    'status_manager_umum' => null,
                    'manager_umum' => null,
                    'waktu_manager_umum' => null,
                    'alasan_manager_umum' => null,
                ]);
            } elseif ('bidang/permintaan/revisi') {
                $permintaan->update([
                    'status_manager_umum' => null,
                    'manager_umum' => null,
                    'waktu_manager_umum' => null,
                    'alasan_manager_umum' => null,
                ]);
            }
            ItemPermintaan::where('id_permintaan', $request->id)->delete();

            for ($i = 0; $i < count($updateRequest['item']); $i++) {
                ItemPermintaan::create([
                    'id_permintaan' => $request->id,
                    'id_item' => $updateRequest['item'][$i],
                    'jumlah' => $updateRequest['jumlah'][$i],
                ]);
            }

            DB::commit();

            if ($path === 'bidang/permintaan/revisi') {
                return redirect()->route('permintaan.bidang.history')->with('success', 'Berhasil mengubah data permintaan');
            }
            return redirect()->route('permintaan.history')->with('success', 'Berhasil mengubah data permintaan');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);

            return redirect()->route('dashboard.index')->with('error', 'Terjadi kesalahan saat mengubah data permintaan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permintaan $permintaan)
    {
        //
    }

    public function verifikasi()
    {
        $user = auth()->user();
        $role = $user->Role->nama;
        $path = request()->path();


        if ($path === 'bidang/permintaan/verifikasi' && $role === 'Manajer Bidang') {
            $permintaan = Permintaan::where('bidang', $user->bidang)
                ->where('status_manager_bidang', null)
                ->orderBy('updated_at', 'desc')
                ->get();
        } elseif ($path === 'umum/permintaan/approval/layanan' && $role === 'Manajer Umum') {
            $permintaan = Permintaan::where('status_manager_bidang', true)
                ->where('status_manager_umum', null)
                ->where('bidang', 1)
                ->orderBy('updated_at', 'desc')
                ->get();
        } elseif ($path === 'umum/permintaan/approval/keuangan' && $role === 'Manajer Umum') {
            $permintaan = Permintaan::where('status_manager_bidang', true)
                ->where('status_manager_umum', null)
                ->where('bidang', 2)
                ->orderBy('updated_at', 'desc')
                ->get();
        } elseif ($path === 'umum/permintaan/approval/sdm' && $role === 'Manajer Umum') {
            $permintaan = Permintaan::where('status_manager_bidang', true)
                ->where('status_manager_umum', null)
                ->where('bidang', 3)
                ->orderBy('updated_at', 'desc')
                ->get();
        } else {
            $permintaan = Permintaan::where('pemohon', $user->id)->orderBy('updated_at', 'desc')->get();
        }

        return view('permintaan.verifikasi', compact('permintaan'));
    }

    public function approval()
    {
        $permintaanLayanan = Permintaan::where('bidang', '1')
            ->where('status_manager_bidang', true)
            ->where('status_manager_umum', null)
            ->count();
        $permintaanKeuangan = Permintaan::where('bidang', '2')
            ->where('status_manager_bidang', true)
            ->where('status_manager_umum', null)
            ->count();
        $permintaanSDM = Permintaan::where('bidang', '3')
            ->where('status_manager_bidang', true)
            ->where('status_manager_umum', null)
            ->count();
        $permintaanTotal = Permintaan::where('status_manager_bidang', true)
            ->where('status_manager_umum', null)
            ->where('selesai', false)->count();

        return view('permintaan.approval', compact('permintaanLayanan', 'permintaanKeuangan', 'permintaanSDM', 'permintaanTotal'));
    }
}
