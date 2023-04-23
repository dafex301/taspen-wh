<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kategori;
use App\Models\Pengadaan;
use App\Models\Permintaan;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // get all data from items table
        $items = Item::all();

        if (auth()->check()) {
            if (auth()->user()->Role->nama == 'Staff') {

                $totalPermintaan = Permintaan::where('pemohon', auth()->user()->id)->count();

                $totalPengadaan = Pengadaan::where('pemohon', auth()->user()->id)->count();

                $revisiPermintaan = Permintaan::where('pemohon', auth()->user()->id)
                    ->where(function ($query) {
                        $query->where('status_manager_bidang', false)
                            ->orWhere('status_manager_umum', false);
                    })
                    ->count();

                $revisiPengadaan = Pengadaan::where('pemohon', auth()->user()->id)
                    ->where(function ($query) {
                        $query->where('status_manager_bidang', false)
                            ->orWhere('status_manager_umum', false);
                    })
                    ->count();

                return view('index', compact('items', 'totalPermintaan', 'totalPengadaan', 'revisiPermintaan', 'revisiPengadaan'));
            } elseif (auth()->user()->Role->nama == 'Manajer Bidang') {
                $permintaanMasuk = Permintaan::where('bidang', auth()->user()->bidang)
                    ->where('status_manager_bidang', null)
                    ->count();

                $pengadaanMasuk = Pengadaan::where('bidang', auth()->user()->bidang)
                    ->where('status_manager_bidang', null)
                    ->count();

                $revisiPermintaan = Permintaan::where('manager_bidang', auth()->user()->id)
                    ->where('status_manager_umum', false)
                    ->count();

                $revisiPengadaan = Pengadaan::where('manager_bidang', auth()->user()->id)
                    ->where('status_manager_umum', false)
                    ->count();

                return view('index', compact('items', 'permintaanMasuk', 'pengadaanMasuk', 'revisiPermintaan', 'revisiPengadaan'));
            } elseif (auth()->user()->Role->nama == 'Manajer Umum') {
                $totalPermintaan = Permintaan::all()->count();

                $totalPengadaan = Pengadaan::all()->count();

                $permintaanMasuk = Permintaan::where('status_manager_umum', null)
                    ->where('status_manager_bidang', true)
                    ->count();

                $pengadaanMasuk = Pengadaan::where('status_manager_umum', null)
                    ->where('status_manager_bidang', true)
                    ->count();

                return view('index', compact('items', 'totalPermintaan', 'totalPengadaan', 'permintaanMasuk', 'pengadaanMasuk'));
            }
        }

        // return data
        return view('index', compact('items'));
    }
}
