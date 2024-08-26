<?php

namespace App\Http\Controllers;

use App\Models\Price;

class BigDataController extends Controller
{
    public function index()
    {
        $bigData = Price::where('year', 2017)->limit(100000)->get();
        dd($bigData);

        return view('big-data.index', compact('bigData'));
    }
}
