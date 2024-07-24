<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssetsController extends Controller
{
    public function assets()
    {
        session()->put("routeIs", 'assets');
        return view('assets.assets');
    }
}