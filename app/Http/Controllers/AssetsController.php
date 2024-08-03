<?php

namespace App\Http\Controllers;

use Dotenv\Store\File\Reader;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetsController extends Controller
{
    public function assets()
    {
        session()->put("routeIs", 'assets');
        return view('assets.assets');
    }

    public function assets_search(Request $request)
    {
        $search = $request->input('textInput', '');

        try {
            $query = DB::select(
                "
                SELECT
                    a.idAsset,
                    a.AssetCode,
                    SUBSTRING(a.AssetName,0,60) AS AssetName,
	                a.AssAmount
                FROM
                    PchInvAndProject.dbo.AssAssetD a
                    LEFT JOIN PchInvAndProject.dbo.AssTypeD t ON a.idType = t.idAssType
                WHERE
                    (a.idType IS NULL OR a.idType != 17)
                    AND (a.idType IS NULL OR a.idType != 30)
                    AND a.AssetName LIKE ?
                ORDER BY
                    a.idAsset DESC
        ",
                ["%$search%"]
            );

            if ($query) {
                return response()->json($query);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function assets_detail($id)
    {
        $idAsset = $id;
        return view('assets.detail', compact('idAsset'));
    }

    public function apiAsset_detail($id)
    {
        try {
            $asset_detail = collect(DB::select("
            SELECT
                assT.idAssType,
                assT.AssTypeName,
                assT.AssPerc,
                assT.AssYear AS AssYearType,
                assD.*,
                SUBSTRING ( assD.AssDate, 7, 2 ) + '/' + SUBSTRING ( assD.AssDate, 5, 2 ) + '/' + SUBSTRING ( assD.AssDate, 0, 5 ) AS AssDateT,
                SUBSTRING ( assD.AssDate, 7, 2 ) + '/' + SUBSTRING ( assD.AssDate, 5, 2 ) + '/' + CAST ( YEAR ( CAST ( assD.AssDate AS DATE ) ) + assT.AssYear AS nvarchar ) AS AssDateTEnd,
            CASE

                    WHEN assD.idPsCancel IS NULL THEN
                    'ใช้งาน' ELSE '-'
                END AS statusUse,
                assPD.PlaceName,
                HR_Seeds.hr.employeename ( assD.idPsTs, 8005 ) AS PsName,
                SUBSTRING ( assD.DateInsur1, 7, 2 ) + '/' + SUBSTRING ( assD.DateInsur1, 5, 2 ) + '/' + SUBSTRING ( assD.DateInsur1, 0, 5 ) AS DateInsurStrat,
                SUBSTRING ( assD.DateInsur2, 7, 2 ) + '/' + SUBSTRING ( assD.DateInsur2, 5, 2 ) + '/' + SUBSTRING ( assD.DateInsur2, 0, 5 ) AS DateInsurEnd,
            CASE

                    WHEN YEAR ( assD.DateInsur2 ) < YEAR ( GETDATE( ) ) + 543 THEN
                    'หมดประกัน'
                    WHEN YEAR ( assD.DateInsur2 ) >= YEAR ( GETDATE( ) ) + 543 THEN
                    'มีประกัน' ELSE 'ไม่มีประกัน'
                END AS stIns,
                YEAR ( assD.DateInsur1 ) - YEAR ( assD.DateInsur2 ) AS YearInsur,
                YEAR ( GETDATE( ) ) + 543 AS YearDate,
                YEAR ( assD.AssDate ) AS YearAss,
                ( YEAR ( GETDATE( ) ) + 543 ) - YEAR ( assD.AssDate ) AS YearAsset,
                synd.CompCode,
                synd.CompName
            FROM
                PchInvAndProject.dbo.AssAssetD assD
                LEFT JOIN PchInvAndProject.dbo.AssTypeD assT ON assD.idType = assT.idAssType
                LEFT JOIN PchInvAndProject.dbo.AssPlaceD assPD ON assD.idPlace = assPD.idPlace
                LEFT JOIN GR_Group.dbo.syndCompany synd ON assD.idComp = synd.idComp
            WHERE
                assD.idAsset = $id
        "))->first();

            if ($asset_detail) {
                return response()->json($asset_detail);
            }
        } catch (Throwable $e) {
            //throw $th; error
            return view('404');
        }
    }

    public function apiAsset_catagory()
    {
        try {
            $query = DB::select("
                SELECT
                    pchat.idAssType,
                    pchat.AssTypeName,
                    pchat.AssPerc,
                    pchat.AssYear
                FROM
                    PchInvAndProject.dbo.AssTypeD pchat
                WHERE
                    ( pchat.idAssType IS NULL OR pchat.idAssType != 17 )
                    AND ( pchat.idAssType IS NULL OR pchat.idAssType != 30 )
                ORDER BY
                    pchat.idAssType DESC
            ");

            if ($query) {
                return response()->json($query);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function apiUser_fullname()
    {
        $user = session('user');
        try {
            $query = DB::select("
                SELECT
                    gddem.idPs,
                    gddem.PsNameFS
                FROM
                    GR_Group.dbo.dEmployee gddem
                WHERE
                    gddem.idStWork = 1
                    AND gddem.idCompb = $user->idCompb
            ");

            if ($query) {
                return response()->json($query);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function assets_new(Request $request)
    {

        // $file = $request->file('assetFile');

        // $filenames = $file->storeAs('/Asset/testpic/', $file, 'ftp');
        // $name = $request->input('inputAssetName');
        // if ($request->hasFile('assetFile')) {
        //     return response()->json(['message' => 'Asset created successfully!', 'name' => $name], 201);
        // } else {
        //     return response()->json(['message' => 'Asset No Has Files!'], 201);
        // }

        // Return a response
        $name = $request->input('inputAssetName');
        $fileName = null;
        if ($request->hasFile('assetFile')) {
            $file = $request->file('assetFile');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('/Asset/testpic/', $fileName, 'ftp');
            $fileNames = $fileName;
        }
        return response()->json([
            'message' => 'Asset created successfully!',
            'name' => $name,
            'assetFiles' => $fileNames
        ], 201);
    }
}
