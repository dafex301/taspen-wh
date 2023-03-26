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
        DB::beginTransaction();

        try {
            $pengadaan = Permintaan::create([
                'kegiatan' => $request->kegiatan,
                'pemohon' => auth()->user()->id,
                'bidang' => $request->bidang,
            ]);

            for ($i = 0; $i < count($request->item); $i++) {
                $itemPengadaan = ItemPermintaan::create([
                    'id_permintaan' => $pengadaan->id,
                    'id_item' => $request->item[$i],
                    'jumlah' => $request->jumlah[$i],
                ]);
            }

            DB::commit();

            return redirect()->route('permintaan.history')->with('success', 'Berhasil menambahkan data pengadaan');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);

            return redirect()->route('dashboard.index')->with('error', 'Terjadi kesalahan saat menambahkan data pengadaan: ' . $e->getMessage());
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
            ->select('item_permintaans.id', 'item_permintaans.jumlah', 'items.nama', 'kategoris.nama as kategori', 'satuans.nama as satuan')
            ->join('items', 'item_permintaans.id_item', '=', 'items.id')
            ->join('kategoris', 'items.kategori', '=', 'kategoris.id')
            ->join('satuans', 'items.satuan', '=', 'satuans.id')
            ->where('item_permintaans.id_permintaan', $id)
            ->orderBy('items.kategori')
            ->get();

        //   Get unique kategori from $items and only get the 'nama' column
        $kategori = $items->unique('kategori')->pluck('kategori');

        return view('permintaan.detail', compact('permintaan', 'items', 'kategori'));
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
        //
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
}
