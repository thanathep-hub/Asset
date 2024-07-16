<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function project_mt($id)
    {
        $query_mt = $this->project_query($id);
        $query_dt = $this->project_dt($id);

        if ($query_mt == null) {
            return redirect('/errors/404');
        }
        return view('project.project-m', compact('query_mt', 'query_dt'));
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
            return $query;
        } catch (\Throwable $th) {
            return redirect('/errors/404');
        }
    }
    public function project_dt($id)
    {
        try {
            $query = DB::select("
                SELECT
                    *
                FROM
                    PchInvAndProject.dbo.vProject_InvDetail AS pdvpi
                WHERE
                    pdvpi.idProject = $id
                ORDER BY
                    pdvpi.idBuyDt DESC
            ");
            return $query;
        } catch (\Throwable $th) {
            return redirect('/errors/404');
        }
    }
}



/*
ตรวจสอบ พี่ฝ้าย พี่จอม
รับทราบ คุณกล้า พี่หน่อย
อนุมัติ 1 อนวัต
อนุมัติ 2 ป๋า และ คุณชัช
 */