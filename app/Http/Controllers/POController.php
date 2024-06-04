<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class POController extends Controller
{
    public function showPO($id)
    {
        $this->get_vAssPoBuyMt($id);
        $po_mt = $this->PO_MT($id);
        $po_dt = $this->PO_DT($id);
        $permission = $this->PO_Permission($id);

        session()->put("permission", 'permission');

        if ($po_mt === null) {
            return redirect('/errors/404');
        }

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
                SET stDoc = 4
                WHERE
                    idPoBuy = $idPoBuy
            ");
        }


        // ทดสอบการส่งค่ากลับ
        $PO_msg = $this->PO_line_update($idPoBuy);
        if ($update_po) {
            return response()->json([
                'message' => 'สำเร็จ',
                'status' => $inputStatus,
                'status2' => $idPoBuy,
                // 'PO_msg' => $PO_msg,
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

        // dd($po_mt);

        if ($po_mt != null) {
            return $po_mt;
        } else {
            return null;
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

    // line function
    public function PO_line_update($id_po)
    {
        $po_dt = $this->get_vAssPoBuyMt($id_po);
        $totalNet = number_format($po_dt->TotalNet, 2, '.', ',');

        $longUrl = "http://assets.advanceseeds.com/po/items/" . $id_po;
        $link_po = $this->tinyURL($longUrl);

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        date_default_timezone_set("Asia/Bangkok");

        // $sToken = "9gZvubJwRAJUnxxZp2Ny30IJOl7AIgfpJdANd7D6z8U"; // test
        $sToken = "uTrsM8eNXoDDiF5nL6uvVMwVUmmYoJIumhyicHwhY1h"; // po Update

        $sMessage = "\nเรียนผู้อนุมัติ (" . $po_dt->CompName . ") \n";
        $sMessage .= "ขออนุมัติจัดซื้อ PO : " . $po_dt->DocCode . "\n";
        $sMessage .= "จ่ายเงินให้ : " . $po_dt->SupName . "\n";
        $sMessage .= "จำนวนเงิน : " . $totalNet . " บาท\n";
        $sMessage .= "หมายเหตุ : " . $po_dt->Note . "\n";
        $sMessage .= "ผู้ออกคำสั่ง : " . $po_dt->PsCommand . "\n";
        $sMessage .= "ผู้ทำรายการ : " . $po_dt->PsTs . "\n";
        $sMessage .= "---------------- รายการ -------------------\n";
        $sMessage .= "รายละเอียด : \n";
        $sMessage .= "---------------- สถานะอนุมัติ --------------\n";
        $sMessage .= "ผู้ตรวจสอบ : " . $po_dt->PsCheck . "\n";
        $sMessage .= "ผู้รับทราบ : " . $po_dt->PsAccept  . "\n";
        $sMessage .= "ผู้อนุมัติ 1 : " . $po_dt->PsConfirm . "\n";
        $sMessage .= "ผู้อนุมัติ 2 : " . $po_dt->PsConfirm2 . "\n";
        $sMessage .= "----------------------------------------------\n";
        $sMessage .= "ลิ้งค์ทำรายการ : " . $link_po . "\n";



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
        // if (curl_error($chOne)) {
        //     echo 'error:' . curl_error($chOne);
        // } else {
        //     $result_ = json_decode($result, true);
        //     echo "status : " . $result_['status'];
        //     echo "message : " . $result_['message'];
        // }
        // curl_close($chOne);
        // if ($result) {
        //     $rt = "ทำรายการสำเร็จ!";
        // } else {
        //     $rt = "ทำรายการสำเร็จ";
        // }

        return $result;
    }

    public function get_vAssPoBuyMt($id)
    {
        try {
            $query = collect(DB::select("
                SELECT
                    *
                FROM
                    PchInvAndProject.devsk.vAssPoBuyMt AS pdva
                WHERE
                    pdva.idPoBuy = $id
            "))->first();
            //
        } catch (\Throwable $th) {
            //throw $th;
        }
        if ($query) {
            return $query;
        } else {
            // dd("not found");
            //
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
}

//ตรวจสอบ รับทราบ อนุมัติ1 อนุมัติ2
