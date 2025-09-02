<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProjectController extends Controller
{
    public function project()
    {
        $project_wait_approve = $this->fetchCountProjectWaitApprove();
        session()->put("routeIs", 'project');
        return view('project.project', compact('project_wait_approve'));
    }
    public function project_mt($id)
    {
        $permiss = $this->project_permission();
        $check_approve = $this->checkApprove_status($id);
        $note_reject = $this->note_reject_approve();
        $sign = $this->sign($id);

        // dd($check_approve);

        if ($permiss && $check_approve) {
            $query_mt = $this->project_query($id);
            $query_dt = $this->project_dt($id);

            if ($query_mt) {
                return view('project.project-m', compact('query_mt', 'query_dt', 'permiss', 'check_approve', 'note_reject', 'sign'));
            } else {
                return redirect('/errors/404');
            }
        } else {
            return view('project.no-access');
        }
    }

    public function project_query($id)
    {
        try {
            $query = collect(DB::select("
                SELECT *,
                SUBSTRING ( pdvp.DateStart, 7, 2 ) + '-' + SUBSTRING ( pdvp.DateStart, 5, 2 ) + '-' + SUBSTRING ( pdvp.DateStart, 0, 5 ) AS DateStart_f,
	            SUBSTRING ( pdvp.DateEnd, 7, 2 ) + '-' + SUBSTRING ( pdvp.DateEnd, 5, 2 ) + '-' + SUBSTRING ( pdvp.DateEnd, 0, 5 ) AS DateEnd_f
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
                return $query;
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
                $line_status = $this->Project_line_update($id);
                return response()->json(['status' => true, 'message' => 'ได้รับการตรวจสอบโครงการเรียบร้อย!', 'line_status' => $line_status]);
            } else {
                return response()->json(['status' => false, 'message' => 'ทำการตรวจสอบไม่สำเร็จ']);
            }
        } else if ($permiss === 'accept') {
            $check_approve = $this->Accept_project($id);
            if ($check_approve == true) {
                $line_status = $this->Project_line_update($id);
                return response()->json(['status' => true, 'message' => 'ได้รับการรับทราบโครงการเรียบร้อย!']);
            } else {
                return response()->json(['status' => false, 'message' => 'ทำการรับทราบไม่สำเร็จ']);
            }
        } else if ($permiss === 'confirm_1') {
            $check_approve = $this->Confirm_1_project($id);
            if ($check_approve == true) {
                $line_status = $this->Project_line_update($id);
                return response()->json(['status' => true, 'message' => 'ได้รับการอนุมัติโครงการเรียบร้อย!']);
            } else {
                return response()->json(['status' => false, 'message' => 'ทำการอนุมัติไม่สำเร็จ']);
            }
        } else if ($permiss === 'confirm_2') {
            $check_approve = $this->Confirm_2_project($id);
            if ($check_approve == true) {
                $line_status = $this->Project_line_update($id);
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
                    pdda.idPsConfirm2,
                    pdda.idPsCancel
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
        $datetime = Carbon::now()->addYears(543)->format('Ymd');
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
        $datetime = Carbon::now()->addYears(543)->format('Ymd');

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
        $datetime = Carbon::now()->addYears(543)->format('Ymd');

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
        $datetime = Carbon::now()->addYears(543)->format('Ymd');

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
                $log_note = DB::insert("
                INSERT INTO PchInvAndProject.dbo.dProject_Approve_Note(id_project, note, idPs)
                VALUES (?, ?, ?)
                ", [
                    $id,
                    $note,
                    $user->idPs,
                ]);

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
            $log_note = DB::insert("
                INSERT INTO PchInvAndProject.dbo.dProject_Approve_Note(id_project, note, idPs)
                VALUES (?, ?, ?)
                ", [
                $id,
                $note,
                $user->idPs,
            ]);
            if ($update_status_project) {
                return response()->json(['status' => true, 'message' => 'ยกเลิกโครงการเรียบร้อย!']);
            } else {
                return response()->json(['status' => false, 'message' => 'ยกเลิกโครงการไม่สำเร็จ!']);
            }
        }
    }

    public function Project_line_update($id_project)
    {

        $project_mt = $this->project_query($id_project);

        $checkNameApprove = $this->CheckNameApprove($id_project);
        if ($checkNameApprove) {
            $budget = number_format($project_mt->Budget, 2, '.', ',');

            $longUrl = "https://assets.advanceseeds.com/project/items/" . $id_project;
            $link_project = $this->tinyURL($longUrl);

            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            date_default_timezone_set("Asia/Bangkok");

            $sToken = "9gZvubJwRAJUnxxZp2Ny30IJOl7AIgfpJdANd7D6z8U"; // test
            // $sToken = "iWhvlImxkt0vH6aIyu3W5LXVfFZXMwg4l78eEjhDiiA";

            $sMessage = "test 02";
            $sMessage = " เรียนผู้อนุมัติ (" . $project_mt->CompName . ") \n";
            $sMessage .= "ชื่อโครงการ : " . $project_mt->ProjectName . "\n";
            $sMessage .= "โครงการรอง : " . $project_mt->PjGroupMainName . "\n";
            $sMessage .= "ชื่อโครงการย่อย : " . $project_mt->PjGroupSubName . "\n";
            $sMessage .= "ผู้สั่งดำเนินการ : " . $project_mt->PsNamecom . "\n";
            $sMessage .= "วันที่เริ่มโครงการ : " . $project_mt->DateStart . "\n";
            $sMessage .= "วันสิ้นสุดโครงการ : " . $project_mt->DateEnd . "\n";
            $sMessage .= "รายละเอียด : " . $project_mt->Note . "\n";
            $sMessage .= "งบประมาณ : " . $budget . "\n";
            $sMessage .= "ผู้ทำรายการ : " . $project_mt->PsnameAdd . "\n";

            $sMessage .= "---------------- รายการ -------------------\n";
            $sMessage .= "รายละเอียด : \n";
            $sMessage .= "---------------- สถานะอนุมัติ --------------\n";
            $sMessage .= "ผู้ตรวจสอบ : " . ($checkNameApprove->PsNameCheck ?? '-') . "\n";
            $sMessage .= "ผู้รับทราบ : " . ($checkNameApprove->PsNameAccept ?? '-') . "\n";
            $sMessage .= "ผู้อนุมัติ 1 : " . ($checkNameApprove->PsNameConfirm ?? '-') . "\n";
            $sMessage .= "ผู้อนุมัติ 2 : " . ($checkNameApprove->PsNameConfirm2 ?? '-') . "\n";

            $sMessage .= "----------------------------------------------\n";
            $sMessage .= "ลิ้งค์ทำรายการ : " . $link_project . "\n";

            $chOne = curl_init();
            curl_setopt(
                $chOne,
                CURLOPT_URL,
                "https://notify-api.line.me/api/notify"
            );
            curl_setopt(
                $chOne,
                CURLOPT_SSL_VERIFYHOST,
                0
            );
            curl_setopt(
                $chOne,
                CURLOPT_SSL_VERIFYPEER,
                0
            );
            curl_setopt(
                $chOne,
                CURLOPT_POST,
                1
            );
            curl_setopt(
                $chOne,
                CURLOPT_POSTFIELDS,
                "message=" . $sMessage
            );
            $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken . '',);
            curl_setopt(
                $chOne,
                CURLOPT_HTTPHEADER,
                $headers
            );
            curl_setopt(
                $chOne,
                CURLOPT_RETURNTRANSFER,
                1
            );

            $result = curl_exec($chOne);

            $line_st = false;
            if (curl_error($chOne)) {
                $line_st = false;
            } else {
                $line_st = true;
            }
            curl_close($chOne);
            return $line_st;
        }
    }

    public function CheckNameApprove($id_poject)
    {
        try {
            $query = collect(DB::select("
                SELECT
                    pdda.idPsCheck, gddCheck.PsName AS PsNameCheck,
                    pdda.idPsAccept, gddAccept.PsName AS PsNameAccept,
                    pdda.idPsConfirm, gddConfirm.PsName AS PsNameConfirm,
                    pdda.idPsConfirm2, gddConfirm2.PsName AS PsNameConfirm2
                FROM
                    PchInvAndProject.dbo.dProject_Approve AS pdda
                    LEFT JOIN GR_Group.dbo.dEmployee AS gddCheck ON pdda.idPsCheck = gddCheck.idPs
                    LEFT JOIN GR_Group.dbo.dEmployee AS gddAccept ON pdda.idPsAccept = gddAccept.idPs
                    LEFT JOIN GR_Group.dbo.dEmployee AS gddConfirm ON pdda.idPsConfirm = gddConfirm.idPs
                    LEFT JOIN GR_Group.dbo.dEmployee AS gddConfirm2 ON pdda.idPsConfirm2 = gddConfirm2.idPs
                WHERE
                    pdda.idProject = $id_poject
            "))->first();
        } catch (\Throwable $th) {
            throw $th;
        }
        if ($query) {
            return $query;
        }
    }

    public function tinyURL($url)
    {
        $apiUrl = "https://tinyurl.com/api-create.php?url=" . $url;
        $response = Http::get($apiUrl);
        if ($response->successful()) {
            $shortUrl = $response->body();
            return $shortUrl;
        }
    }

    public function api_project()
    {

        try {
            $query_result = DB::select("
                SELECT TOP
                    300 pddap.idProject_Dt, pdvp.idProject, pdvp.ProjectName,pdvp.ProjStName, pdvp.CompName, CAST(pdvp.cDateStart AS DATE) cDateStart
                FROM
                    PchInvAndProject.dbo.dProject_Approve AS pddap
                    LEFT JOIN PchInvAndProject.dbo.vProject AS pdvp ON pddap.idProject = pdvp.idProject
                -- 	WHERE
                ORDER BY
                    pdvp.idProject DESC
            ");

            if ($query_result) {
                return response()->json([
                    'query_result' => $query_result
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function note_reject_approve()
    {

        try {
            //code...
            $query = DB::select("
                SELECT
                    pddpan.note_id_reject,
                    pddpan.note
                FROM
                    PchInvAndProject.dbo.dProject_Approve_Note AS pddpan
                ORDER BY
                    pddpan.note_id_reject DESC
        ");

            if ($query) {
                return $query;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function project_cancel($id)
    {
        $user = session('user');
        try {
            $update_status_project = DB::update(
                'UPDATE PchInvAndProject.dbo.dProject_Approve
                SET idPsCancel = ?
                WHERE idProject = ?',
                [$user->idPs, $id]
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

    public function sign($id)
    {
        try {
            $query = collect(DB::select("
                SELECT
                    pddp.idProject,
                    pddp.idPsCheck,
                    gdde.PsNameFS  AS nameCheck,
                    pddp.idPsAccept,
                    gddea.PsNameFS  AS nameAccept,
                    pddp.idPsConfirm,
                    gddec.PsNameFS  AS nameConfirm1,
                    pddp.idPsConfirm2,
                    gddecc.PsNameFS AS nameConfirm2
                FROM
                    PchInvAndProject.dbo.dProject_Approve pddp
                    LEFT JOIN GR_Group.dbo.dEmployee AS gdde ON pddp.idPsCheck = gdde.idPs
                    LEFT JOIN GR_Group.dbo.dEmployee AS gddea ON pddp.idPsAccept = gddea.idPs
                    LEFT JOIN GR_Group.dbo.dEmployee AS gddec ON pddp.idPsConfirm = gddec.idPs
                    LEFT JOIN GR_Group.dbo.dEmployee AS gddecc ON pddp.idPsConfirm2 = gddecc.idPs
                    WHERE pddp.idProject = $id
            "))->first();

            if ($query) {
                return $query;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function fetchCountProjectWaitApprove()
    {
        try {
            $query = collect(DB::select("
                SELECT COUNT
                    ( * ) AS project_wait_approve
                FROM
                    PchInvAndProject.dbo.dProject_Approve pdda
                WHERE
                    (pdda.idPsAccept IS NULL
                    OR pdda.idPsCheck IS NULL
                    OR pdda.idPsConfirm IS NULL
                    OR pdda.idPsConfirm2 IS NULL )
                    AND pdda.idPsCancel IS NULL
            "))->first();
            if ($query) {
                return $query;
            } else {
                return 0;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // project list

    public function project_list()
    {
        return view('project.project-list');
    }

    public function vdProject_Detail($id)
    {
        $img_path = 'https://seedsgroup.dyndns.org/spm/POP/images/pBill/AssetProPic'; // + id.jpg
        $pDetails = $this->project_query($id);
        $pItems = $this->project_dt($id);
        // dd($pDetails);
        $total = 0;
        foreach ($pItems as $item) {
            $total += $item->TotalPrice;
        }
        $total = number_format($total, 2);

        $grouped = collect($pItems)->groupBy('SectionName');
        $sectionSummary = [];
        foreach ($grouped as $section => $items) {
            $sectionSummary[] = [
                'section' => $section,
                'count' => count($items),
                'total' => number_format(collect($items)->sum('TotalPrice'), 2),
                'items' => $items,
            ];
        }

        return view('project.project-detail', compact('pDetails', 'pItems', 'img_path', 'total', 'sectionSummary'));
    }
    public function vdProject_items($id)
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
            if ($query) {
                return response()->json($query);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}



/*
ตรวจสอบ พี่ฝ้าย พี่จอม
รับทราบ คุณกล้า พี่หน่อย
อนุมัติ 1 อนวัต
อนุมัติ 2 ป๋า และ คุณชัช
 */
