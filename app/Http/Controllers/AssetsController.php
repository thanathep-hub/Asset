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


    public function search_query(Request $request)
    {
        $company = $request->input('company');
        $category = $request->input('category');
        $textQuery = $request->input('textQuery');

        $cate = '';
        $comp = '';

        if ($company != 0) {
            $comp = " AND a.idComp = $company ";
        }
        if ($category != 0) {
            $cate = "AND a.idType = $category ";
        }
        try {
            $query = DB::select(
                "
                SELECT top 10
                    a.idAsset,
                    a.AssetCode,
                    SUBSTRING(a.AssetName,0,60) AS AssetName,
                    a.AssAmount,
                    t.AssTypeName,
                    synd.CompCode
                FROM
                    PchInvAndProject.dbo.AssAssetD a
                    LEFT JOIN PchInvAndProject.dbo.AssTypeD t ON a.idType = t.idAssType
                    LEFT JOIN GR_Group.dbo.syndCompany synd ON a.idComp = synd.idComp
                WHERE
                    (a.idType IS NULL OR a.idType != 17)
                    AND (a.idType IS NULL OR a.idType != 30)
                    $comp
                    $cate
                    AND a.AssetName LIKE ?
                ORDER BY
                    a.idAsset DESC
        ",
                ["%$textQuery%"]
            );

            if ($query) {
                return response()->json($query);
            } else {
                return response()->json(['message' => 'No assets found'], 404);
            }
        } catch (\Throwable $th) {
            // Return a detailed error message
            return response()->json(['error' => $th->getMessage()], 500);
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
                emp.PsNameFS AS emp_PsName,
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
                synd.CompName,
                acom.location,
                acs.acs_name_th as status_name
            FROM
                PchInvAndProject.dbo.AssAssetD assD
                LEFT JOIN PchInvAndProject.dbo.AssTypeD assT ON assD.idType = assT.idAssType
                LEFT JOIN PchInvAndProject.dbo.AssPlaceD assPD ON assD.idPlace = assPD.idPlace
                LEFT JOIN GR_Group.dbo.syndCompany synd ON assD.idComp = synd.idComp
                LEFT JOIN GR_Group.dbo.dEmployee emp ON assD.idPsRp = emp.idPs
                LEFT JOIN PchInvAndProject.dbo.Asset_Components acom ON assD.idAsset = acom.asset_d
	            LEFT JOIN PchInvAndProject.dbo.Asset_Component_Status acs ON acom.acs_id = acs.acs_id
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

            if ($company) {
                return response()->json($company);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function apiSupplier()
    {
        try {
            $supplier = DB::select("
                SELECT DISTINCT
                    pdd.idSup,
                    pdd.SupName
                FROM
                    PchInvAndProject.dbo.dSupplier AS pdd
                WHERE
                    pdd.SupName IS NOT NULL
                    AND pdd.SupName != ''
                    AND pdd.idSupType = 29
                ORDER BY
                    pdd.idSup ASC
            ");

            if ($supplier) {
                return response()->json($supplier);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function assets_new(Request $request)
    {

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
            INSERT INTO AssAssetD (AssetCode, AssetName, idComp, idType, idPsTs, DateTs, idPsRp, AssAmount, Price, idStAss)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [$assetCode, $assetName, $assetComp, $assetCategory, $assetPsts, $assetDateTs, $assetRSP, $assetAmount, $assetPrice, 1]
        );

        if ($insertAsset) {
            $AssetInvInsert_id = DB::getPdo()->lastInsertId();
            $insertAssetDt = DB::insert(
                "
                    INSERT INTO AssAssetDt (idAsset, stAssBuyDt)
                    VALUES (?, ?)",
                [$AssetInvInsert_id, 0]
            );

            if ($insertAssetDt) {
                $i = 1;
                foreach ($request->file('assetFile') as $file) {
                    $fileName = $AssetInvInsert_id . '_' . $i . "." . $file->getClientOriginalExtension();
                    $file->storeAs('/Asset/PicAsset/', $fileName, 'ftp');

                    $insertImagPath = DB::insert(
                        "
                    INSERT INTO Asset_img_path (asset_id, name_img)
                    VALUES (?, ?)",
                        [$AssetInvInsert_id, $fileName]
                    );
                    $i++;
                }

                $insertAssetComponent = DB::insert(
                    "
                    INSERT INTO Asset_Components (component_name, asset_d,acs_id, created_by, location)
                    VALUES (?, ?, ?, ?, ?)",
                    [$assetName, $AssetInvInsert_id, $assetStatus, (int)session('user')->idPs, $assetPlace]
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

    public function Create_component()
    {
        $wait_create = "รอสร้างสินทรัพย์";

        try {
            $create_component = DB::insert(
                "
                    INSERT INTO Asset_Components (component_name,created_by)
                    VALUES (?,?)",
                [$wait_create, (int)session('user')->idPs]
            );
            $AssetComponentLast_id = DB::getPdo()->lastInsertId();
            if ($create_component) {
                return response()->json([
                    'status' => 'success',
                    'asset_id' => $AssetComponentLast_id
                ], 201);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function linkAssetComponent($id)
    {
        $checkAsset = collect(DB::select("
            SELECT
                *
            FROM
                PchInvAndProject.dbo.Asset_Components pdac
            WHERE
                pdac.component_id = :id
        ", ['id' => $id]))->first();

        if ($checkAsset) {
            if (!empty($checkAsset->asset_d)) {
                return redirect("/assets/detail/{$checkAsset->asset_d}");
            }
            return view('assets.qrcode.new-asset', compact('id'));
        }

        return view('errors.404');
    }

    public function qr_new_asset(Request $request)
    {
        $qrAssetName = $request->input('qrAssetName');
        $qrAssetPlace = $request->input('qrAssetPlace');
        $qrAssetId = $request->input('qrAssetId');

        $assetCode = $this->fetchAssetCode();
        $assetPsts = (int)session('user')->idPs;
        $assetDateTs = $this->thaiDate();

        $insert_assetD = DB::insert(
            "
            INSERT INTO AssAssetD (AssetCode, AssetName, idComp, idPsTs, DateTs, idPsRp, AssAmount, idStAss)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            [$assetCode, $qrAssetName, (int)session('user')->idComp, $assetPsts, $assetDateTs, $assetPsts, 1, 1]
        );

        if ($insert_assetD) {
            $AssetInvInsert_id = DB::getPdo()->lastInsertId();
            $insertAssetDt = DB::insert(
                "
                    INSERT INTO AssAssetDt (idAsset, stAssBuyDt)
                    VALUES (?, ?)",
                [$AssetInvInsert_id, 0]
            );
            if ($insertAssetDt) {
                $i = 1;
                foreach ($request->file('qrAssetImg') as $file) {
                    $fileName = $AssetInvInsert_id . '_' . $i . "." . $file->getClientOriginalExtension();
                    $file->storeAs('/Asset/PicAsset/', $fileName, 'ftp');

                    $insertImagPath = DB::insert(
                        "
                    INSERT INTO Asset_img_path (asset_id, name_img)
                    VALUES (?, ?)",
                        [$AssetInvInsert_id, $fileName]
                    );
                    $i++;
                }
                $updateAssetComponent = DB::update(
                    "
                        UPDATE Asset_Components
                        SET component_name = ?, asset_d = ?, acs_id = ?, created_by = ?, location = ?
                        WHERE component_id = ?",
                    [$qrAssetName, $AssetInvInsert_id, 1, (int)session('user')->idPs, $qrAssetPlace, $qrAssetId]
                );


                if ($updateAssetComponent) {
                    $AssetComponent_id = DB::getPdo()->lastInsertId();
                    $insertAssetComponent_his = DB::insert(
                        "
                    INSERT INTO Asset_Component_History (acs_id, ac_id, acs_name, location_history)
                    VALUES (?, ?, ?, ?)",
                        [1, $AssetComponent_id, $qrAssetName, $qrAssetPlace]
                    );

                    if ($insertAssetComponent_his && $insert_assetD && $insertAssetDt && $updateAssetComponent) {
                        return response()->json([
                            'status' => 'success',
                            'idAsset' => $AssetInvInsert_id
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


    public function assets_active(Request $request)
    {
        $idAsset = $request->input('idAsset');
        $active_place = $request->input('active_place');
        $active_name = $request->input('active_name');
        $active_status = $request->input('active_status');
        $active_rsp = $request->input('active_rsp');

        $q = $this->checkAssetComponent($idAsset);

        if ($q) { // active แล้ว
            return response()->json([
                'status' => 'wn',
                'msg' => 'สินทรัพย์ถูกยืนยันแล้ว'
            ], 201);
        } else { // ดำเนินการ active
            $insertAssetComponent = DB::insert(
                "
                    INSERT INTO Asset_Components (component_name, asset_d,acs_id, created_by, location)
                    VALUES (?, ?, ?, ?, ?)",
                [
                    $active_name,
                    $idAsset,
                    $active_status,
                    (int)session('user')->idPs,
                    $active_place
                ]
            );

            // รอ เปิดตอนใช้งานจริง
            $updateAsset = DB::update(
                "
                    UPDATE AssAssetD
                    SET idPsRp = ?
                    WHERE idAsset = ?",
                [$active_rsp, $idAsset]
            );

            if ($insertAssetComponent) {
                $AssetComponent_id = DB::getPdo()->lastInsertId();
                $insertAssetComponent_his = DB::insert(
                    "
                    INSERT INTO Asset_Component_History (acs_id, ac_id, acs_name, location_history)
                    VALUES (?, ?, ?, ?)",
                    [$active_status, $AssetComponent_id, $active_name, $active_place]
                );

                if ($insertAssetComponent_his && $insertAssetComponent) {
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

    public function assets_update(Request $request)
    {
        $check = $this->checkAssetComponent($request->input('id-asset'));

        if (!$check) {
            return response()->json([
                'status' => 'warning',
                'msg' => 'กรุณา active สินทรัพย์ก่อนอัพเดท',
            ], 200);
        }
        $validated = $request->validate([
            'name-asset' => 'required|string|max:255',
            'price-asset' => 'required|numeric|min:0',
            'amount-asset' => 'required|integer|min:1',
            'category-asset' => 'required|string|max:255',
            'status-asset' => 'required|string|max:50',
            'company-asset' => 'required|string|max:255',
            'psrp-asset' => 'nullable|numeric|min:0',
            'place-asset' => 'required|string|max:255',
        ]);

        $_idAsset = $request->input('id-asset');
        $_name = $request->input('name-asset');
        $_price = number_format((float)$request->input('price-asset'), 2, '.', '');
        $_amount = intval($request->input('amount-asset'));
        $_category = $request->input('category-asset');
        $_status = $request->input('status-asset');
        $_company = $request->input('company-asset');
        $_psrp = $request->input('psrp-asset');
        $_place = $request->input('place-asset');

        $update_assetD = DB::update(
            "
                UPDATE AssAssetD
                SET AssetName = ?, Price = ?, AssAmount = ?, idType = ?, idComp = ?, idPsRp = ?
                WHERE idAsset = ?",
            [$_name, $_price, $_amount, $_category, $_company, $_psrp, $_idAsset]
        );

        if ($update_assetD) {
            $update_component = DB::update(
                "
                UPDATE Asset_Components
                SET component_name = ?, acs_id = ?, location = ?, updated_by= ?
                WHERE asset_d = ?",
                [$_name, $_status, $_place, (int)session('user')->idPs, $_idAsset]
            );

            if ($update_component) {

                $select_asc_id = collect(DB::select("
                    SELECT
                        component_id
                    FROM
                        PchInvAndProject.dbo.Asset_Components
                    WHERE
                        asset_d = $_idAsset
                "))->first();

                if ($select_asc_id != null) {
                    $insertAssetComponent_his = DB::insert(
                        "
                    INSERT INTO Asset_Component_History (acs_id, ac_id, acs_name, location_history)
                    VALUES (?, ?, ?, ?)",
                        [$_status, $select_asc_id->component_id, $_name, $_place]
                    );

                    if ($insertAssetComponent_his) {
                        return response()->json([
                            'status' => 'success',
                            'msg' => 'Asset updated successfully',
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => 'error',
                            'msg' => 'has something error.',
                        ], 200);
                    }
                }
            }
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => 'has something error(update_assetD).',
            ], 200);
        }
    }

    public function checkAssetComponent($id)
    {
        $checkAssetComponent = collect(DB::select("
                SELECT
                    *
                FROM
                    PchInvAndProject.dbo.Asset_Components
                    WHERE PchInvAndProject.dbo.Asset_Components.asset_d = $id
            "))->first();
        return $checkAssetComponent;
    }

    public function fetchAssetCode()
    {
        $query = collect(DB::select("
            SELECT TOP
                1 RIGHT ( pdas.AssetCode, LEN( pdas.AssetCode ) - 2 ) AS AssetNumber
            FROM
                PchInvAndProject.dbo.AssAssetD pdas
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

    public function fetch_assetImg($id)
    {
        try {
            $query = DB::select("
                SELECT
                    *
                FROM
                    PchInvAndProject.dbo.Asset_img_path pdaip
                WHERE pdaip.asset_id = ?
            ", [$id]);

            if ($query) {
                return response()->json($query);
            }

            return response()->json(['message' => 'No data found'], 404);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
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

    public function edbi_save(Request $request)
    {
        $check = $this->checkAssetComponent($request->input('uid'));

        if (!$check) {
            return response()->json([
                'status' => 'error',
                'msg' => 'กรุณายืนยันสินทรัพย์ก่อนอัพเดท',
            ], 200);
        }

        $uid = $request->input('uid');
        $uname = $request->input('uname');
        $ucategory = $request->input('ucategory');
        $uamount = $request->input('uamount');
        $uplace = $request->input('uplace');

        $update_assetD = DB::update(
            "
                UPDATE AssAssetD
                SET AssetName = ?, AssAmount = ?, idType = ?
                WHERE idAsset = ?",
            [$uname, $uamount, $ucategory, $uid]
        );
        if ($update_assetD) {
            $Component = DB::update(
                "
                UPDATE Asset_Components
                SET location = ?
                WHERE asset_d = ?",
                [$uplace, $uid]
            );
            if ($Component) {
                return response()->json([
                    'status' => 'success',
                    'msg' => 'อัพเดทสำเร็จ',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'There was an error updating the asset.',
                ], 500);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => 'There was an error updating the asset.',
            ], 500);
        }
    }
    public function edps_save(Request $request)
    {
        $check = $this->checkAssetComponent($request->input('uid'));

        if (!$check) {
            return response()->json([
                'status' => 'error',
                'msg' => 'กรุณายืนยันสินทรัพย์ก่อนอัพเดท',
            ], 200);
        }

        $uid = $request->input('uid');
        $upsrp = $request->input('upsrp');
        $ustatus = $request->input('ustatus');
        $udate = $request->input('udate');

        $update_assetD = DB::update(
            "
                UPDATE AssAssetD
                SET idPsRp = ?, AssDate = ?
                WHERE idAsset = ?",
            [$upsrp, $udate, $uid]
        );
        if ($update_assetD) {
            $Component = DB::update(
                "
                UPDATE Asset_Components
                SET acs_id = ?
                WHERE asset_d = ?",
                [$ustatus, $uid]
            );
            if ($Component) {
                return response()->json([
                    'status' => 'success',
                    'msg' => 'อัพเดทสำเร็จ',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'There was an error updating the asset.',
                ], 500);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => 'There was an error updating the asset.',
            ], 500);
        }
    }
    public function edii_save(Request $request)
    {
        //
        $check = $this->checkAssetComponent($request->input('uid'));

        if (!$check) {
            return response()->json([
                'status' => 'error',
                'msg' => 'กรุณายืนยันสินทรัพย์ก่อนอัพเดท',
            ], 200);
        }

        $uid = $request->input('uid');
        $uinsur = $request->input('upsrp');
        $uins = $request->input('uins');
        $uine = $request->input('uine');

        $update_assetD = DB::update(
            "
                UPDATE AssAssetD
                SET stInsur = ?, DateInsur1 = ?, DateInsur2 = ?
                WHERE idAsset = ?",
            [$uinsur, $uins, $uine, $uid]
        );
        if ($update_assetD) {
            return response()->json([
                'status' => 'success',
                'msg' => 'อัพเดทสำเร็จ',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => 'There was an error updating the asset.',
            ], 500);
        }
    }
    public function edimg_save(Request $request)
    {
        if ($request->hasFile('img')) {
            $id = $request->input('assetId');
            $i = 1;
            $chk = $this->checkPathImg($id);
            if ($chk) {
                $ftp = ftp_connect('203.151.27.229', '21');
                $login_result = ftp_login($ftp, 'spm', 'a0815209598');

                if ($login_result == true) {

                    foreach ($chk as $items) {
                        ftp_delete($ftp, "Asset/PicAsset/$items->name_img");
                    }
                    ftp_close($ftp);
                }
                $del = DB::delete("
                    DELETE FROM PchInvAndProject.dbo.Asset_img_path
                    WHERE asset_id = $id
                ");
                if ($del) {
                    foreach ($request->file('img') as $file) {
                        $validatedData = $request->validate([
                            'img.*' => 'required|mimes:jpeg,png,jpg|max:2048',
                        ]);

                        $fileName = $id . '_' . $i . "." . $file->getClientOriginalExtension();
                        $file->storeAs('/Asset/PicAsset/', $fileName, 'ftp');

                        DB::insert(
                            "
                        INSERT INTO Asset_img_path (asset_id, name_img)
                        VALUES (?, ?)",
                            [$id, $fileName]
                        );
                        $i++;
                    }

                    return response()->json([
                        'status' => 'success',
                        'msg' => 'อัพเดทสำเร็จ',
                    ], 200);
                }
            } else {
                foreach ($request->file('img') as $file) {
                    $validatedData = $request->validate([
                        'img.*' => 'required|mimes:jpeg,png,jpg|max:2048',
                    ]);
                    $fileName = $id . '_' . $i . "." . $file->getClientOriginalExtension();
                    $file->storeAs('/Asset/PicAsset/', $fileName, 'ftp');

                    DB::insert(
                        "
                            INSERT INTO Asset_img_path (asset_id, name_img)
                            VALUES (?, ?)",
                        [$id, $fileName]
                    );
                    $i++;
                }
                return response()->json([
                    'status' => 'success',
                    'msg' => 'อัพเดทสำเร็จ',
                ], 200);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => 'There was an error updating the asset.',
            ], 500);
        }
    }

    public function checkPathImg($id)
    {
        try {
            $query = DB::select("
                SELECT
                    *
                FROM
                    PchInvAndProject.dbo.Asset_img_path pdaip
                WHERE pdaip.asset_id = $id
            ");
            if ($query) {
                return $query;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getAsset_waitApprove()
    {
        $idComp =  (int)session('user')->idComp;
        // Fetch assets based on session data or predefined criteria
        try {
            $assetWaitApprove = DB::select("
            SELECT TOP 10
                pdas.idAsset,
                pdas.AssetName,
                pdas.AssDate,
                pdac.location,
                pdac.acs_id,
                pdacs.acs_name_th
            FROM
                PchInvAndProject.dbo.AssAssetD pdas
                LEFT JOIN PchInvAndProject.dbo.Asset_Components pdac ON pdas.idAsset = pdac.asset_d
                LEFT JOIN PchInvAndProject.dbo.Asset_Component_Status pdacs ON pdac.acs_id = pdacs.acs_id
            WHERE
                pdas.idComp = $idComp
            ORDER BY
                pdas.idAsset DESC
        ");

            if ($assetWaitApprove) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Assets found and awaiting approval',
                    'data' => $assetWaitApprove
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No assets found'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $th->getMessage()
            ]);
        }
    }
}
