<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Controllers\Controller;
use App\Models\Item;

class DashboardController extends Controller
{
    public function index()
    {
        // get all data from items table
        $items = Item::all();

        // return data
        return view('index', compact('items'));
    }
}
