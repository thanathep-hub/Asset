<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function project_mt($id)
    {
        return view('project.project-m');
        // return response()->json($id);
    }
}
