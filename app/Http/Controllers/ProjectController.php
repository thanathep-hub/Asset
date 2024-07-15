<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function project_mt($id)
    {
        $query_mt = $this->project_query($id);
        return view('project.project-m', compact('query_mt'));
        // return response()->json($query_mt);
    }

    public function project_query($id)
    {

        try {
            $query = collect(DB::select("
                SELECT
                    *
                FROM
                    PchInvAndProject.dbo.vProject AS pdvp
                WHERE
                    pdvp.idProject = $id
                ORDER BY
                    pdvp.idProject DESC
            "))->first();
            if ($query) {
                return $query;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
