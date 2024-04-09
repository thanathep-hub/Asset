<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $QVam = $this->QVam();


        return view('home', compact('QVam'));
    }

    public function QVam()
    {
        $CarTotal = collect(DB::select("
            SELECT COUNT(*) AS CarTotal
            FROM
                VAM.dbo.vCar 	AS vdvc
            WHERE
                vdvc.department IS NOT NULL
                AND vdvc.department != '-'
        "))->first();

        return $CarTotal;

    }
}
