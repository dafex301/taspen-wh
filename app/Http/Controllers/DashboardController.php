<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Kategori;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Get Laporan Total Count
        $laporanTotal = Laporan::count();

        // Get Laporan count that is completed false
        $laporanDiproses = Laporan::where('completed', false)->count();

        // Get Laporan count that completed is true
        $laporanSelesai = Laporan::where('completed', true)->count();

        // Get the laporan completed average
        $averageDifference = Laporan::selectRaw('AVG(TIMESTAMPDIFF(SECOND, created_at, dpnp_checked_at)/3600.0) as avg_diff_in_hours')
            ->get();

        $waktuPenyelesaian = round($averageDifference[0]->avg_diff_in_hours, 1);

        // Get all kategori, also add lain-lain to last element
        $kategori = Kategori::all();
        $kategori->push((object) ['id' => 0, 'name' => 'Lain-lain']);

        // Get laporan count for each category starting from this month - 1 year untill this month
        // Get each month from 1 year ago until this month
        // Also give the category name on the value
        $laporanPerKategori = collect();
        $months = collect();
        $currentMonth = date('m');
        $currentYear = date('Y');
        for ($i = 0; $i < 12; $i++) {
            $months->push((object) ['month' => $currentMonth, 'year' => $currentYear]);
            $currentMonth--;
            if ($currentMonth == 0) {
                $currentMonth = 12;
                $currentYear--;
            }
        }

        // Get laporan count for each category for each month
        foreach ($kategori as $key => $value) {
            $laporanPerKategori[$key] = collect();
            foreach ($months as $month) {
                $laporanPerKategori[$key]->push(Laporan::whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)
                    ->where('kategori', $value->id)
                    ->count());
            }
        }

        return view('index', compact('laporanTotal', 'laporanDiproses', 'laporanSelesai', 'waktuPenyelesaian', 'kategori', 'laporanPerKategori'));
    }
}
