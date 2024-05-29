<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class POController extends Controller
{
    public function showPO($id)
    {
        $po_mt = $this->PO_MT($id);
        $po_dt = $this->PO_DT($id);
        $permission = $this->PO_Permission($id);

        session()->put("permission", 'permission');


        return view('po.po', compact('po_mt', 'po_dt', 'permission'));
    }

    public function confirmPO(Request $request)
    {
        // รับค่า status จาก URL และค่าต่างๆ จาก request
        $inputStatus = $request->input('status');
        $idPoBuy = $request->input('idPoBuy');

        $user = session('user');

        $status_sql = '';
        $date_sql = '';

        $DateApprove = $this->getFormattedDate();


        if ($inputStatus == 'confirm2') {
            $status_sql = 'idPsConfirm2';
            $date_sql = 'DateConfirm2';
        } elseif ($inputStatus == 'confirm1') {
            $status_sql = 'idPsConfirm';
            $date_sql = 'DateConfirm';
        } elseif ($inputStatus == 'accept') {
            $status_sql = 'idPsAccept';
            $date_sql = 'DateAccept';
        } elseif ($inputStatus == 'check') {
            $status_sql = 'idPsCheck';
            $date_sql = 'DateCheck';
        } else {
            //
        }

        $text_sql_update = "
            UPDATE PchInvAndProject.dbo.AssPoBuyMt
            SET $status_sql = $user->idPs , $date_sql = '$DateApprove'
            WHERE
                idPoBuy = $idPoBuy
        ";

        $update_po = DB::update($text_sql_update);

        $po_status = $this->CheckPo_status($idPoBuy);

        if ($po_status == true) {
            $stDoc_update = DB::update("
                UPDATE PchInvAndProject.dbo.AssPoBuyMt
                SET stDoc = 1
                WHERE
                    idPoBuy = $idPoBuy
            ");
        }


        // ทดสอบการส่งค่ากลับ
        if ($update_po) {
            return response()->json([
                'message' => 'สำเร็จ',
                'status' => $inputStatus,
                'status2' => $idPoBuy,
                // 'DateConfirm2' => $DateApprove,
                // 'text_sql' => $text_sql_update,
                // 'po_status' => $po_status
            ]);
        }
    }

    public function PO_MT($id)
    {

        try {
            $po_mt = collect(DB::select("
                SELECT
                    *
                FROM
                    PchInvAndProject.devsk.vAssPoBuyMt
                WHERE
                    idPoBuy = $id
            "))->first();
        } catch (\Throwable $th) {
            //throw $th;
        }

        if ($po_mt) {
            return $po_mt;
        }
    }

    public function PO_DT($id)
    {
        try {
            $po_dt = DB::select("
                SELECT
                    pdva.InvName_,
                    pdva.Amount AS AmountSub,
                    pdva.Price AS InvPrice,
                    pdva.TotalPrice,
                    pdva.UnitName,
                    pdva.Note,
                    pdva.idInv,
                    pdva.idPoBuyDt,
                    pdva.AmountRec,
                    pdva.stPoBuy,
                    0.00 AS PriceMin,
                    0.00 AS PriceLast,
                    0.00 AS PriceSD
                FROM
                    PchInvAndProject.devsk.vAssPoBuyDt AS pdva
                WHERE
                    pdva.idPoBuy = $id
                ORDER BY
                    pdva.InvName_ ASC
            ");
        } catch (\Throwable $th) {
            //throw $th;
        }
        if ($po_dt) {
            return $po_dt;
        }
    }
    public function PO_Permission($id)
    {
        $user = session('user');

        try {
            $query = collect(DB::select("
                SELECT
                    *
                FROM
                    PchInvAndProject.devsk.PO_Update_Permission AS pdpp
                    WHERE pdpp.idPS = $user->idPs
            "))->first();
        } catch (\Throwable $th) {
            //throw $th;
        }

        if ($query) {
            return $query;
        }
    }

    public function getFormattedDate()
    {
        // รับวันที่ปัจจุบัน
        $currentDate = Carbon::now();
        $year = $currentDate->year + 543;
        $month = $currentDate->format('m');
        $day = $currentDate->format('d');
        $formattedDate = $year . $month . $day;
        return $formattedDate;
    }

    public function CheckPo_status($id_po)
    {

        $query = collect(DB::select("
            SELECT
                pda.idPsCheck,
                pda.idPsAccept,
                pda.idPsConfirm,
                pda.idPsConfirm2
            FROM PchInvAndProject.dbo.AssPoBuyMt AS pda
            WHERE pda.idPoBuy = $id_po
        "))->first();

        if ($query->idPsCheck != null && $query->idPsAccept != null && $query->idPsConfirm != null && $query->idPsConfirm2 != null) {
            return true;
        } else {
            return false;
        }
    }
}

//ตรวจสอบ รับทราบ อนุมัติ1 อนุมัติ2
