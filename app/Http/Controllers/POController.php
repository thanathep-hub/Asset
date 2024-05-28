<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class POController extends Controller
{
    public function showPO($id)
    {
        $po_mt = $this->PO_MT($id);
        $po_dt = $this->PO_DT($id);

        return view('po.po', compact('po_mt', 'po_dt'));
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
}

//ตรวจสอบ รับทราบ อนุมัติ1 อนุมัติ2