<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kategori;
use App\Models\Pengadaan;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePengadaanRequest;
use App\Http\Requests\UpdatePengadaanRequest;
use App\Models\ItemPengadaan;

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

        if ($path === 'bidang/pengadaan/history' && $role === 'Manajer Bidang') {
            $pengadaan = Pengadaan::where('bidang', $user->bidang)->orderBy('updated_at', 'desc')->get();
        } elseif ($path === 'umum/pengadaan/history' && $role === 'Manajer Umum') {
            $pengadaan = Pengadaan::all();
        } else {
            $pengadaan = Pengadaan::where('pemohon', $user->id)->orderBy('updated_at', 'desc')->get();
        }

        return view('pengadaan.history', compact('pengadaan'));
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

        if ($path === 'bidang/pengadaan/verifikasi' && $role === 'Manajer Bidang') {
            $pengadaan = Pengadaan::where('bidang', $user->bidang)
                ->where('status_manager_bidang', null)
                ->orderBy('updated_at', 'desc')
                ->get();
        } elseif ($path === 'umum/pengadaan/verifikasi' && $role === 'Manajer Umum') {
            $pengadaan = Pengadaan::where('status_manager_bidang', true)
                ->where('status_manager_umum', null)
                ->orderBy('updated_at', 'desc')
                ->get();
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

        if (auth()->user()->Role->nama === 'Manajer Bidang') {
            $pengadaan->status_manager_bidang = true;
            $pengadaan->manager_bidang = auth()->user()->id;
            $pengadaan->waktu_manager_bidang = now();
        } elseif (auth()->user()->Role->nama === 'Manajer Umum') {
            $pengadaan->status_manager_umum = true;
            $pengadaan->manager_umum = auth()->user()->id;
            $pengadaan->waktu_manager_umum = now();
        }

        $pengadaan->save();

        return redirect()->route('pengadaan.bidang.verifikasi')->with('success', 'Berhasil menerima pengadaan');
    }

    public function reject(String $id)
    {
        $alasan = request()->alasan;

        $pengadaan = Pengadaan::find($id);
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
        //
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
}
