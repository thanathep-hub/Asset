<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function vdProject()
    {
        $idComp = session('user')->idComp;
        $text_q = '';
        if (session('role') != 'admin') {
            $text_q = " AND pddp.idComp = $idComp ";
        }
        try {
            $query = DB::select("
                SELECT
                    pddp.idProject,
                    pddp.ProjectCode,
                    pddp.ProjectName,
                    pddp.idComp,
                    synd.CompCode,
                    synd.CompName,
                    SUBSTRING ( pddp.DateStart, 7, 2 ) + '-' + SUBSTRING ( pddp.DateStart, 5, 2 ) + '-' + SUBSTRING ( pddp.DateStart, 0, 5 ) AS DateStart,
                    -- pddp.DateStart,
                    pddp.Budget
                FROM
                    PchInvAndProject.dbo.dProject pddp
                    LEFT JOIN GR_Group.dbo.syndCompany synd ON pddp.idComp = synd.idComp
                    WHERE 1 = 1
                    $text_q
                ORDER BY
                    pddp.idProject DESC
            ");
            if ($query) {
                foreach ($query as $budget) {
                    $budget->Budget = $this->formatCurrency($budget->Budget);
                }
                return response()->json($query);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function vdProjectFilter(Request $request)
    {
        $comp = $request->query('comp');
        $startDate = $request->query('startDate');
        $startEnd = $request->query('startEnd');

        try {
            $query = DB::select("
                SELECT
                    pddp.idProject,
                    pddp.ProjectCode,
                    pddp.ProjectName,
                    pddp.idComp,
                    synd.CompCode,
                    synd.CompName,
                    SUBSTRING ( pddp.DateStart, 7, 2 ) + '-' + SUBSTRING ( pddp.DateStart, 5, 2 ) + '-' + SUBSTRING ( pddp.DateStart, 0, 5 ) AS DateStart,
                    -- pddp.DateStart,
                    pddp.Budget
                FROM
                    PchInvAndProject.dbo.dProject pddp
                    LEFT JOIN GR_Group.dbo.syndCompany synd ON pddp.idComp = synd.idComp
                ORDER BY
                    pddp.idProject DESC
            ");
            if ($query) {
                foreach ($query as $budget) {
                    $budget->Budget = $this->formatCurrency($budget->Budget);
                }
                return response()->json($query);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // public function vdProject_items($id)
    // {
    //     try {
    //         $query = DB::select("
    //             SELECT
    //                 *
    //             FROM
    //                 PchInvAndProject.dbo.vProject_InvDetail AS pdvpi
    //             WHERE
    //                 pdvpi.idProject = $id
    //             ORDER BY
    //                 pdvpi.idBuyDt DESC
    //         ");
    //         if ($query) {
    //             return response()->json($query);
    //         }
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }
    // }


    public function apiCompany()
    {
        try {
            $company = DB::select("
                SELECT DISTINCT
                    ass.idComp,
                    synd.CompCode,
                    synd.CompName
                FROM
                    PchInvAndProject.dbo.AssAssetD AS ass
                    LEFT JOIN GR_Group.dbo.syndCompany synd ON ass.idComp = synd.idComp
                WHERE
                    ass.idComp IS NOT NULL
            ");

            // Add new row with idComp = 0, CompCode = 0, CompName = 'ทั้งหมด'
            $newRow = (object) [
                'idComp' => 0,
                'CompCode' => 0,
                'CompName' => 'ทั้งหมด'
            ];

            // Append the new row to the company array
            array_unshift($company, $newRow);
            if ($company) {
                return response()->json($company);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function formatCurrency($amount)
    {
        // Ensure the amount is a float and formatted to 2 decimal places
        $formattedAmount = number_format((float)$amount, 2);

        // Prefix with the currency symbol and format as needed
        $currencyFormatted = "฿{$formattedAmount}";

        return $currencyFormatted;
    }
}