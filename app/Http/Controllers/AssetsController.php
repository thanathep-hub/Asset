<?php

namespace App\Http\Controllers;

use Dotenv\Store\File\Reader;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Ramsey\Uuid\Type\Decimal;

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
        $comAsset = $this->assetComp();
        return view('assets.detail', compact('idAsset', 'comAsset'));
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
        // Return a response
        // $fileName = null;
        // if ($request->hasFile('assetFile')) {
        //     $file = $request->file('assetFile');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $file->storeAs('/Asset/testpic/', $fileName, 'ftp');
        //     $fileNames = $fileName;
        // } else {
        //     $fileNames = null;
        // }

        //

        $assetCode = $this->fetchAssetCode(); //(int)
        $assetName = $request->input('inAssetName');
        $assetComp = $request->input('inAssetComp');
        $assetStatus = $request->input('inAssetStatus');
        $assetCategory = (int)$request->input('inAssetCategory');
        $assetPsts = (int)session('user')->idPs;
        $assetDateTs = $this->thaiDate();
        $assetRSP = (int)$request->input('inAssetRSP'); //ผู้รับผิดชอบ
        $assetAmount = (int)$request->input('inAssetAmount');
        $assetPrice = (float)$request->input('inAssetPrice');
        $assetPlace = $request->input('inAssetPlace');

        $insertAsset = DB::insert(
            "
            INSERT INTO AssAssetD_test (AssetCode, AssetName, idComp, idType, idPsTs, DateTs, idPsRp, AssAmount, Price, idStAss)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [$assetCode, $assetName, $assetComp, $assetCategory, $assetPsts, $assetDateTs, $assetRSP, $assetAmount, $assetPrice, 1]
        );

        if ($insertAsset) {
            $AssetInvInsert_id = DB::getPdo()->lastInsertId();
            $insertAssetDt = DB::insert(
                "
                    INSERT INTO AssAssetDt_test (idAsset, stAssBuyDt)
                    VALUES (?, ?)",
                [$AssetInvInsert_id, 0]
            );

            if ($insertAssetDt) {
                $fileName = null;
                if ($request->hasFile('assetFile')) {
                    $file = $request->file('assetFile');
                    $fileName = $AssetInvInsert_id . time() . '_1' . "." . $file->extension();
                    $file->storeAs('/Asset/testpic/', $fileName, 'ftp');
                    $fileNames = $fileName;
                } else {
                    $fileNames = null;
                }

                $insertAssetComponent = DB::insert(
                    "
                    INSERT INTO Asset_Components (component_name, asset_d,acs_id, created_by, location, image_url)
                    VALUES (?, ?, ?, ?, ?, ?)",
                    [$assetName, $AssetInvInsert_id, $assetStatus, (int)session('user')->idPs, $assetPlace, $fileNames]
                );

                if ($insertAssetComponent) {
                    $AssetComponent_id = DB::getPdo()->lastInsertId();
                    $insertAssetComponent_his = DB::insert(
                        "
                    INSERT INTO Asset_Component_History (acs_id, ac_id, acs_name, location_history)
                    VALUES (?, ?, ?, ?)",
                        [$assetStatus, $AssetComponent_id, $assetName, $assetPlace]
                    );

                    if ($insertAssetComponent_his && $insertAsset && $insertAssetDt && $insertAssetComponent) {
                        return response()->json([
                            'status' => 'success',
                        ], 201);
                    } else {
                        return response()->json([
                            'status' => 'error',
                        ], 400);
                    }
                }
            }
        }
    }

    public function fetchAssetCode()
    {
        $query = collect(DB::select("
            SELECT TOP
                1 RIGHT ( pdas.AssetCode, LEN( pdas.AssetCode ) - 2 ) AS AssetNumber
            FROM
                PchInvAndProject.dbo.AssAssetD_test pdas
            ORDER BY
                pdas.AssetCode DESC
        "))->first();

        if ($query) {
            // return $query->AssetNumber;
            if (preg_match('/^\d{4}$/', $query->AssetNumber)) {
                // แปลง assetid เป็นจำนวนเต็มและเพิ่มค่า 1
                $number = intval($query->AssetNumber) + 1;
                // แปลงค่าเป็น string ที่มีรูปแบบ AS000x
                $formattedId = 'AS' . str_pad($number, 4, '0', STR_PAD_LEFT);
                return $formattedId;
            }
        } else {
            return 'AS0001';
        }
    }

    public function assetComp()
    {
        try {
            $Comp = DB::select("
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

            if ($Comp) {
                return $Comp;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function thaiDate()
    {
        $Date = Carbon::now();
        $thaiYear = $Date->year + 543;
        $formattedDate = $thaiYear . $Date->format('md');

        return $formattedDate;
    }
}
