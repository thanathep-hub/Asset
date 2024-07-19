<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function project_mt($id)
    {
        $permiss = $this->project_permission();
        $check_approve = $this->checkApprove_status($id);

        if ($permiss && $check_approve) {
            $query_mt = $this->project_query($id);
            $query_dt = $this->project_dt($id);

            if ($query_mt === null) {
                return redirect('/errors/404');
            }
            return view('project.project-m', compact('query_mt', 'query_dt', 'permiss', 'check_approve'));
        } else {
            return view('project.no-access');
        }
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
            } else {
                return redirect('/errors/404');
            }
        } catch (\Throwable $th) {
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

    public function project_permission()
    {
        $user = session('user');
        try {
            $query = collect(DB::select(
                "
                SELECT
                    *
                FROM
                    PchInvAndProject.devsk.permission_approve_list AS pdpa
                WHERE
                    pdpa.idPs = $user->idPs AND pdpa.pj_view = 1
                "
            ))->first();
            return $query;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function projectMtApprove($id, Request $request)
    {
        // Get data from the POST request
        $permiss = $request->input('permiss');

        // Check if the data equals 'check'
        if ($permiss === 'check') {
            $check_approve = $this->Check_project($id);
            if ($check_approve == true) {
                return response()->json(['status' => true, 'message' => 'ได้รับการตรวจสอบโครงการเรียบร้อย!']);
            } else {
                return response()->json(['status' => false, 'message' => 'ทำการตรวจสอบไม่สำเร็จ']);
            }
        } else if ($permiss === 'accept') {
            $check_approve = $this->Accept_project($id);
            if ($check_approve == true) {
                return response()->json(['status' => true, 'message' => 'ได้รับการรับทราบโครงการเรียบร้อย!']);
            } else {
                return response()->json(['status' => false, 'message' => 'ทำการรับทราบไม่สำเร็จ']);
            }
        } else if ($permiss === 'confirm_1') {
            $check_approve = $this->Confirm_1_project($id);
            if ($check_approve == true) {
                return response()->json(['status' => true, 'message' => 'ได้รับการอนุมัติโครงการเรียบร้อย!']);
            } else {
                return response()->json(['status' => false, 'message' => 'ทำการอนุมัติไม่สำเร็จ']);
            }
        } else if ($permiss === 'confirm_2') {
            $check_approve = $this->Confirm_2_project($id);
            if ($check_approve == true) {
                return response()->json(['status' => true, 'message' => 'ได้รับการอนุมัติโครงการเรียบร้อย!']);
            } else {
                return response()->json(['status' => false, 'message' => 'ทำการอนุมัติไม่สำเร็จ']);
            }
        } else {
            return response()->json(['message' => 'Permiss is not check']);
        }
    }

    public function checkApprove_status($idProject)
    {
        try {
            $query = collect(DB::select("
                SELECT
                    pdda.idPsCheck,
                    pdda.idPsAccept,
                    pdda.idPsConfirm,
                    pdda.idPsConfirm2
                FROM
                    PchInvAndProject.dbo.dProject_Approve AS pdda
                    WHERE pdda.idProject = $idProject
            "))->first();
            return $query;
        } catch (\Throwable $th) {
            return redirect('/errors/404');
        }
    }

    public function Check_project($id)
    {
        $user = session('user');
        $datetime = Carbon::now()->toDateString();
        try {
            // Update data using the DB::update method with parameter binding
            $update_status_project = DB::update(
                'UPDATE PchInvAndProject.dbo.dProject_Approve
                SET idPsCheck = ?, DateCheck = ?
                WHERE idProject = ?',
                [$user->idPs, $datetime, $id]
            );

            if ($update_status_project) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            // Handle exception
            return response()->json(['success' => false, 'message' => 'An error occurred', 'error' => $th->getMessage()], 500);
        }
    }

    public function Accept_project($id)
    {
        $user = session('user');
        $datetime = Carbon::now()->toDateString();

        try {
            // Update data using the DB::update method with parameter binding
            $update_status_project = DB::update(
                'UPDATE PchInvAndProject.dbo.dProject_Approve
                SET idPsAccept = ?, DateAccept = ?
                WHERE idProject = ?',
                [$user->idPs, $datetime, $id]
            );

            if ($update_status_project) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            // Handle exception
            return response()->json(['success' => false, 'message' => 'An error occurred', 'error' => $th->getMessage()], 500);
        }
    }

    public function Confirm_1_project($id)
    {
        $user = session('user');
        $datetime = Carbon::now()->toDateString();

        try {
            // Update data using the DB::update method with parameter binding
            $update_status_project = DB::update(
                'UPDATE PchInvAndProject.dbo.dProject_Approve
                SET idPsConfirm = ?, DateConfirm = ?
                WHERE idProject = ?',
                [$user->idPs, $datetime, $id]
            );

            if ($update_status_project) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            // Handle exception
            return response()->json(['success' => false, 'message' => 'An error occurred', 'error' => $th->getMessage()], 500);
        }
    }

    public function Confirm_2_project($id)
    {
        $user = session('user');
        $datetime = Carbon::now()->toDateString();

        try {
            // Update data using the DB::update method with parameter binding
            $update_status_project = DB::update(
                'UPDATE PchInvAndProject.dbo.dProject_Approve
                SET idPsConfirm2 = ?, DateConfirm2 = ?
                WHERE idProject = ?',
                [$user->idPs, $datetime, $id]
            );

            if ($update_status_project) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            // Handle exception
            return response()->json(['success' => false, 'message' => 'An error occurred', 'error' => $th->getMessage()], 500);
        }
    }

    public function project_reject($id, Request $request)
    {
        $user = session('user');

        $note_status = $request->input('note_status');
        $note = $request->input('note');

        if ($note_status === 'Note_Reject') {
            try {
                $update_status_project = DB::update(
                    'UPDATE PchInvAndProject.dbo.dProject_Approve
                SET idPsConfirm_reject = ?, Note_Reject = ?
                WHERE idProject = ?',
                    [$user->idPs, $note, $id]
                );

                if ($update_status_project) {
                    return response()->json(['status' => true, 'message' => 'ยกเลิกโครงการเรียบร้อย!']);
                } else {
                    return response()->json(['status' => false, 'message' => 'ยกเลิกโครงการไม่สำเร็จ!']);
                }
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json(['success' => false, 'message' => 'An error approve Prject', 'error' => $th->getMessage()], 500);
            }
        }
        if ($note_status === 'Note_Reject2') {
            $update_status_project = DB::update(
                'UPDATE PchInvAndProject.dbo.dProject_Approve
                SET idPsConfirm_reject2 = ?, Note_Reject2 = ?
                WHERE idProject = ?',
                [$user->idPs, $note, $id]
            );
            if ($update_status_project) {
                return response()->json(['status' => true, 'message' => 'ยกเลิกโครงการเรียบร้อย!']);
            } else {
                return response()->json(['status' => false, 'message' => 'ยกเลิกโครงการไม่สำเร็จ!']);
            }
        }
    }
}



/*
ตรวจสอบ พี่ฝ้าย พี่จอม
รับทราบ คุณกล้า พี่หน่อย
อนุมัติ 1 อนวัต
อนุมัติ 2 ป๋า และ คุณชัช
 */