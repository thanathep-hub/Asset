<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class POController extends Controller
{
    public function showPO()
    {
        return view('po.po');
    }
}

//ตรวจสอบ รับทราบ อนุมัติ1 อนุมัติ2