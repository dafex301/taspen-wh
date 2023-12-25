<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Bidang;
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

        if ($path === 'bidang/pengadaan/history' && $role === 'Sector Head') {
            $permintaan = Permintaan::where('bidang', $user->bidang)->orderBy('updated_at', 'desc')->get();
        } elseif ($path === 'umum/permintaan/history' && $role === 'Manager') {
            $permintaan = Permintaan::orderBy('updated_at', 'desc')->get();
        } elseif ($path === 'umum/permintaan/history/layanan' && $role === 'Manager') {
            $permintaan = Permintaan::where('bidang', 1)->orderBy('updated_at', 'desc')->get();
        } elseif ($path === 'umum/permintaan/history/keuangan' && $role === 'Manager') {
            $permintaan = Permintaan::where('bidang', 2)->orderBy('updated_at', 'desc')->get();
        } elseif ($path === 'umum/permintaan/history/sdm' && $role === 'Manager') {
            $permintaan = Permintaan::where('bidang', 3)->orderBy('updated_at', 'desc')->get();
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

        // if path is /bidang/permintaan/verifikasi/{id}
        // or /umum/verifikasi/{id}
        // show one permintaan before by the user that status_manager_umum is true
        if (request()->path() === 'bidang/permintaan/verifikasi/' . $id || request()->path() === 'umum/permintaan/verifikasi/' . $id) {
            $lastPermintaan = Permintaan::where('pemohon', $permintaan->pemohon)
                ->where('status_manager_umum', true)
                ->orderBy('updated_at', 'desc')
                ->first();

            if ($lastPermintaan) {
                $lastItems = DB::table('item_permintaans')
                    ->select('item_permintaans.id', 'item_permintaans.jumlah', 'items.nama', 'permintaans.bidang as bidang', 'kategoris.nama as kategori', 'satuans.nama as satuan', 'stok_bidang_layanan', 'stok_bidang_keuangan', 'stok_bidang_umum')
                    ->join('items', 'item_permintaans.id_item', '=', 'items.id')
                    ->join('kategoris', 'items.kategori', '=', 'kategoris.id')
                    ->join('satuans', 'items.satuan', '=', 'satuans.id')
                    ->join('permintaans', 'item_permintaans.id_permintaan', '=', 'permintaans.id')
                    ->where('item_permintaans.id_permintaan', $lastPermintaan->id)
                    ->orderBy('items.kategori')
                    ->get();

                $lastKategori = $lastItems->unique('kategori')->pluck('kategori');

                return view('permintaan.detail', compact('permintaan', 'items', 'kategori', 'lastPermintaan', 'lastItems', 'lastKategori'));
            }
        }
        return view('permintaan.detail', compact('permintaan', 'items', 'kategori'));
    }

    public function accept(String $id)
    {
        try {
            DB::beginTransaction();

            $permintaan = Permintaan::find($id);

            if (auth()->user()->Role->nama === 'Sector Head') {
                $permintaan->status_manager_bidang = true;
                $permintaan->manager_bidang = auth()->user()->id;
                $permintaan->waktu_manager_bidang = now();
                $permintaan->save();

                DB::commit();

                return redirect()->route('permintaan.bidang.verifikasi')->with('success', 'Berhasil menerima permintaan');
            } elseif (auth()->user()->Role->nama === 'Manager') {
                $permintaan->status_manager_umum = true;
                $permintaan->manager_umum = auth()->user()->id;
                $permintaan->waktu_manager_umum = now();
                $permintaan->save();

                // Change stock in item table
                $items = ItemPermintaan::where('id_permintaan', $id)->get();
                $bidang = $permintaan->bidang;

                if ($bidang === 1) {
                    foreach ($items as $item) {
                        $itemStok = Item::find($item->id_item);
                        if ($itemStok->stok_bidang_layanan - $item->jumlah < 0) {
                            $item->jumlah -= $itemStok->stok_bidang_layanan;
                            $itemStok->stok_bidang_layanan = 0;
                            if ($itemStok->stok_bidang_umum - $item->jumlah < 0) {
                                $item->jumlah -= $itemStok->stok_bidang_umum;
                                $itemStok->stok_bidang_umum = 0;
                                $itemStok->stok_bidang_keuangan -= $item->jumlah;
                            } else {
                                $itemStok->stok_bidang_umum -= $item->jumlah;
                            }
                        } else {
                            $itemStok->stok_bidang_layanan -= $item->jumlah;
                        }
                        $itemStok->save();
                    }
                } elseif ($bidang === 2) {
                    foreach ($items as $item) {
                        $itemStok = Item::find($item->id_item);
                        if ($itemStok->stok_bidang_keuangan - $item->jumlah < 0) {
                            $item->jumlah -= $itemStok->stok_bidang_keuangan;
                            $itemStok->stok_bidang_keuangan = 0;
                            if ($itemStok->stok_bidang_umum - $item->jumlah < 0) {
                                $item->jumlah -= $itemStok->stok_bidang_umum;
                                $itemStok->stok_bidang_umum = 0;
                                $itemStok->stok_bidang_layanan -= $item->jumlah;
                            } else {
                                $itemStok->stok_bidang_umum -= $item->jumlah;
                            }
                        } else {
                            $itemStok->stok_bidang_keuangan -= $item->jumlah;
                        }
                        $itemStok->save();
                    }
                } elseif ($bidang === 3) {
                    foreach ($items as $item) {
                        $itemStok = Item::find($item->id_item);
                        if ($itemStok->stok_bidang_umum - $item->jumlah < 0) {
                            $item->jumlah -= $itemStok->stok_bidang_umum;
                            $itemStok->stok_bidang_umum = 0;
                            if ($itemStok->stok_bidang_layanan - $item->jumlah < 0) {
                                $item->jumlah -= $itemStok->stok_bidang_layanan;
                                $itemStok->stok_bidang_layanan = 0;
                                $itemStok->stok_bidang_keuangan -= $item->jumlah;
                            } else {
                                $itemStok->stok_bidang_layanan -= $item->jumlah;
                            }
                        } else {
                            $itemStok->stok_bidang_umum -= $item->jumlah;
                        }
                        $itemStok->save();
                    }
                }

                DB::commit();

                return redirect()->route('permintaan.umum.verifikasi')->with('success', 'Berhasil menerima permintaan');
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function reject(String $id)
    {
        $alasan = request()->alasan;
        $permintaan = Permintaan::find($id);
        $user = auth()->user();
        $role = $user->Role->nama;

        if ($role === 'Sector Head') {
            $permintaan->status_manager_bidang = false;
            $permintaan->manager_bidang = $user->id;
            $permintaan->waktu_manager_bidang = now();
            $permintaan->alasan_manager_bidang = $alasan;
            $permintaan->save();
            return redirect()->route('permintaan.bidang.verifikasi')->with('success', 'Berhasil menolak permintaan');
        } elseif ($role === 'Manager') {
            if (request()->tujuan == 'manajer-bidang') {
                $permintaan->status_manager_bidang = null;

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
                    'status_manager_bidang' => true,
                    'manager_bidang' => auth()->user()->id,
                    'waktu_manager_bidang' => now(),
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


        if ($path === 'bidang/permintaan/verifikasi' && $role === 'Sector Head') {
            $permintaan = Permintaan::where('bidang', $user->bidang)
                ->where('status_manager_bidang', null)
                ->orderBy('updated_at', 'desc')
                ->get();
        } elseif ($path === 'umum/permintaan/approval/layanan' && $role === 'Manager') {
            $permintaan = Permintaan::where('status_manager_bidang', true)
                ->where('status_manager_umum', null)
                ->where('bidang', 1)
                ->orderBy('updated_at', 'desc')
                ->get();
        } elseif ($path === 'umum/permintaan/approval/keuangan' && $role === 'Manager') {
            $permintaan = Permintaan::where('status_manager_bidang', true)
                ->where('status_manager_umum', null)
                ->where('bidang', 2)
                ->orderBy('updated_at', 'desc')
                ->get();
        } elseif ($path === 'umum/permintaan/approval/sdm' && $role === 'Manager') {
            $permintaan = Permintaan::where('status_manager_bidang', true)
                ->where('status_manager_umum', null)
                ->where('bidang', 3)
                ->orderBy('updated_at', 'desc')
                ->get();
        } elseif ($path === 'umum/permintaan/verifikasi' && $role === 'Manager') {
            $permintaan = Permintaan::where('status_manager_bidang', true)
                ->where('status_manager_umum', null)
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

    public function histories()
    {
        // Get permintaan that status_manager_umum is true, groupby bidang and count
        $permintaanCount = Permintaan::groupBy('bidang')
            ->selectRaw('bidang, count(*) as total')
            ->get();


        // flatten only get the bidang => total, total there is 3 bidang
        $permintaanCount = $permintaanCount->flatten()->toArray();

        // convert to bidang => total
        $permintaanCount = array_combine(array_column($permintaanCount, 'bidang'), array_column($permintaanCount, 'total'));

        // total permintaan
        $permintaanCount['total'] = array_sum($permintaanCount);

        return view('permintaan.histories', compact('permintaanCount'));
    }
}
