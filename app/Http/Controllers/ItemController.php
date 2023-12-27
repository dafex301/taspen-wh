<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Satuan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.items.index', [
            'item' => Item::orderBy('updated_at', 'desc')->get(),
            'kategori' => Kategori::all(),
            'satuan' => Satuan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    { {
            $data = request()->validate([
                'nama' => 'required',
                'kode' => 'required',
                'harga' => 'required',
                'kategori' => 'required',
                'satuan' => 'required',
            ]);

            // Create user
            Item::create([
                'nama' => $data['nama'],
                'kode' => $data['kode'],
                'harga' => $data['harga'],
                'kategori' => $data['kategori'],
                'satuan' => $data['satuan'],
            ]);

            return redirect('/umum/items')->with('success', "Item successfully created.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $data = request()->validate([
            'nama' => 'required',
            'kode' => 'required',
            'harga' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
        ]);

        // Update item
        $item->update([
            'nama' => $data['nama'],
            'kode' => $data['kode'],
            'harga' => $data['harga'],
            'kategori' => $data['kategori'],
            'satuan' => $data['satuan'],
        ]);

        return redirect('/umum/items')->with('success', "User successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {

        $item->delete();

        return redirect('/umum/items')->with('success', "Item successfully deleted.");
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        $kategoriMap = Kategori::pluck('id', 'nama');
        $satuanMap = Satuan::pluck('id', 'nama');

        foreach ($fileContents as $line) {
            // skip first line
            if ($line == $fileContents[0]) {
                continue;
            }
            $data = str_getcsv($line);

            $satuanId = $satuanMap[$data[3]] ?? null;
            $kategoriId = $kategoriMap[$data[4]] ?? null;

            if ($kategoriId !== null && $satuanId !== null) {
                $item = Item::firstOrNew(['nama' => $data[2]]);

                // kode could be empty
                if ($data[1] !== '') {
                    $item->kode = $data[1];
                }
                $item->nama = $data[2];
                $item->satuan = $satuanId;
                $item->kategori = $kategoriId;
                $item->harga = $data[5];
                $item->save();
            }
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }

    public function importStok(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        foreach ($fileContents as $line) {
            if ($line == $fileContents[0]) {
                continue;
            }
            $data = str_getcsv($line);

            dd($data);

            // if no data, continue
            if ($data[2] == '' && $data[3] == '' && $data[4] == '' && $data[5] == '') {
                continue;
            }

            $item = Item::find($data[0]);
            $item->stok_bidang_layanan = $data[2];
            $item->stok_bidang_keuangan = $data[3];
            $item->stok_bidang_umum = $data[4];
            $item->stok_bidang_pensiun = $data[5];

            $item->save();
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }
}
