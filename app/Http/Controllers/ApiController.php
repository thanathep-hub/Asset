<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function vdProject()
    {
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

    public function formatCurrency($amount)
    {
        // Ensure the amount is a float and formatted to 2 decimal places
        $formattedAmount = number_format((float)$amount, 2);

        // Prefix with the currency symbol and format as needed
        $currencyFormatted = "฿{$formattedAmount}";

        return $currencyFormatted;
    }
}