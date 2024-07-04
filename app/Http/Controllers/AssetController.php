<?php

namespace App\Http\Controllers;

use Image;
use Throwable;
use Illuminate\Support\Number;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Type\Decimal;

class AssetController extends Controller
{
    public function index()
    {
        // idStAss 1 ใช้งาน | null  = สินทรัพย์ประเภทวัสดุ
        $asset_category = $this->asset_category();
        $Comp = $this->assetComp();

        return view('asset', compact('asset_category', 'Comp'));
    }

    public function asset_query($year, $category)
    {
        if ($category == 0) {
            $chartData = DB::select("
                SELECT
                    CONVERT(DECIMAL(10, 2), SUM(ass.AssAmount * ass.Price)) AS AssTotal,
                    SUBSTRING(ass.AssDate, 5, 2) AS monthText,
                    dbo.fn_GetTextMonth(SUBSTRING(ass.AssDate, 5, 2)) AS textMonthAsset,
                    dbo.fn_GetTextMonthEng(SUBSTRING(ass.AssDate, 5, 2)) AS textMonthAssetEng,
                    SUBSTRING(ass.AssDate, 1, 4) AS DateAsset
                FROM
                    PchInvAndProject.dbo.AssAssetD AS ass
                    LEFT JOIN PchInvAndProject.dbo.AssTypeD AS assType ON ass.idType = assType.idAssType
                WHERE
                    ass.idType != 17
                    AND CAST(SUBSTRING(ass.AssDate, 1, 4) AS INT) = '$year'
                GROUP BY
                    SUBSTRING(ass.AssDate, 1, 4),
                    SUBSTRING(ass.AssDate, 5, 2)
                ORDER BY
                    SUBSTRING(ass.AssDate, 5, 2) ASC
            ");
        } else {
            $chartData = DB::select("
                SELECT
                    CONVERT(DECIMAL(10, 2), SUM(ass.AssAmount * ass.Price)) AS AssTotal,
                    SUBSTRING(ass.AssDate, 5, 2) AS monthText,
                    dbo.fn_GetTextMonth(SUBSTRING(ass.AssDate, 5, 2)) AS textMonthAsset,
                    dbo.fn_GetTextMonthEng(SUBSTRING(ass.AssDate, 5, 2)) AS textMonthAssetEng,
                    SUBSTRING(ass.AssDate, 1, 4) AS DateAsset
                FROM
                    PchInvAndProject.dbo.AssAssetD AS ass
                    LEFT JOIN PchInvAndProject.dbo.AssTypeD AS assType ON ass.idType = assType.idAssType
                WHERE
                    ass.idType != 17
                    AND CAST(SUBSTRING(ass.AssDate, 1, 4) AS INT) = '$year' AND ass.idType = '$category'
                GROUP BY
                    SUBSTRING(ass.AssDate, 1, 4),
                    SUBSTRING(ass.AssDate, 5, 2)
                ORDER BY
                    SUBSTRING(ass.AssDate, 5, 2) ASC
            ");
        }
        // AND ass.idType = '$category'
        // foreach ($chartData as $items) {
        // Format the assPriceTotal property to have two decimal places
        // $items->AssTotal = number_format($items->AssTotal, 2);
        // }
        return response()->json($chartData);
    }

    public function asset_all()
    {

        $user = session('user');

        $asset_all = DB::select(
            "
            SELECT TOP 20
                PchInvAndProject.dbo.AssAssetD.idAsset,
                PchInvAndProject.dbo.AssAssetD.AssetCode,
                PchInvAndProject.dbo.AssAssetD.AssetName,
				PchInvAndProject.dbo.AssAssetD.idComp,
            CASE
                WHEN PchInvAndProject.dbo.AssAssetD.idType IS NULL THEN
                    '0' ELSE PchInvAndProject.dbo.AssAssetD.idType
                END AS idType,
            CASE
                WHEN PchInvAndProject.dbo.AssTypeD.AssTypeName IS NULL THEN
                    'ไม่ระบุประเภท' ELSE PchInvAndProject.dbo.AssTypeD.AssTypeName
                END AS AssTypeName,
                (PchInvAndProject.dbo.AssAssetD.Price * PchInvAndProject.dbo.AssAssetD.AssAmount) AS assPriceTotal
            FROM
                PchInvAndProject.dbo.AssAssetD
                LEFT JOIN PchInvAndProject.dbo.AssTypeD ON PchInvAndProject.dbo.AssAssetD.idType = PchInvAndProject.dbo.AssTypeD.idAssType
			WHERE PchInvAndProject.dbo.AssAssetD.idComp = $user->idComp AND PchInvAndProject.dbo.AssAssetD.idBuy IS NOT NULL
            ORDER BY
                PchInvAndProject.dbo.AssAssetD.idAsset DESC
            "
        );
        foreach ($asset_all as $items) {
            // Format the assPriceTotal property to have two decimal places
            $items->assPriceTotal = number_format($items->assPriceTotal, 2);
        }

        return response()->json($asset_all);
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
            return $Comp;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function asset_category()
    {
        $asset_category = DB::select("
            SELECT DISTINCT idAssType, AssTypeName
            FROM PchInvAndProject.dbo.AssTypeD
            WHERE PchInvAndProject.dbo.AssTypeD.idAssType != 17
        ");
        return $asset_category;
    }

    public function asset_detail($id)
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
        } catch (Throwable $e) {
            //throw $th; error
            return view('404');
        }

        if ($asset_detail == null) {
            return view('404');
        }

        $detail_two = collect(DB::select("
            SELECT *
            FROM
                PchInvAndProject.devsk.vAssAssetD
            WHERE
                idAsset = $id
        "))->first();

        $detail_three = collect(DB::select("
            SELECT *
            FROM
                PchInvAndProject.devsk.vAssAssetDt
            WHERE
                idAsset = $id
        "))->first();

        $asset_recheck = collect(DB::select("
            SELECT
                *
            FROM
                dbo.stRecheck
            WHERE
                dbo.stRecheck.idAsset = $id
        "))->first();

        $asset_pic = DB::select(
            "
            SELECT *
            FROM dbo.stRecheckPic
            WHERE dbo.stRecheckPic.id_asset = $id
            "
        );

        // if ($asset_recheck) {
        //     Alert::success(Session('success', 'สินทรัพย์นี้ถูก Recheck เรียบร้อย'));
        // } else {
        //     Alert::warning(Session('warning', 'สินทรัพย์นี้ยังไม่ถูก Recheck'));
        // }

        return view('asset.asset_details', compact('asset_detail', 'detail_two', 'detail_three', 'asset_pic', 'asset_recheck'));
    }

    public function asset_active(Request $request)
    {

        $user = session('user');
        $current = Carbon::now()->toDateTimeString();

        $validator = Validator::make($request->all(), [
            'filenames.*' => 'file|mimes:jpg,png|max:5120', //|max:2048
        ]);

        if ($validator->fails()) {
            Alert::error(Session('error', 'ขนาดรูปภาพต้องไม่เกิน 5mb.'));
            return redirect()->back();
        }


        if ($this->check_asset($request->idAsset)) {
            // delete old pic
        } else {
            DB::insert(
                "
                    INSERT INTO stRecheck (idAsset, AssetCode,AssetName,Asset_status,created_at,compName,user_created)
                    VALUES ('$request->idAsset', '$request->AssetCode', '$request->AssetName', '1', '$current','$request->CompName','$user->idPs')
                    "
            );
        }
        // if ($request->hasfile('filenames')) {

        //     foreach ($request->file('filenames') as $file) {

        //         $filename = $request->idAsset . "-" . uniqid() . "." . $file->extension();
        //         $fileU = $file->storeAs('/Asset/pictest', $filename, 'ftp');
        //         $this->pic_insert($request->idAsset, $filename);
        //     }

        //     Alert::success(Session('success', 'อัพเดตสถานะสินทรัพย์สำเร็จ!'));
        //     return redirect()->back();
        // }

        try {

            if ($request->hasfile('filenames')) {

                foreach ($request->file('filenames') as $file) {

                    $filename = $request->idAsset . "-" . uniqid() . "." . $file->extension();
                    $fileU = $file->storeAs('/Asset/pictest', $filename, 'ftp');
                    $this->pic_insert($request->idAsset, $filename);
                }

                Alert::success(Session('success', 'อัพเดตสถานะสินทรัพย์สำเร็จ!'));
                return redirect()->back();
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'อัพเดตสถานะสินทรัพย์ไม่สำเร็จ!');
        }
    }

    public function check_asset($id_check)
    {
        $query_check = DB::select(
            "
            SELECT *
            FROM dbo.stRecheck
            WHERE dbo.stRecheck.idAsset = $id_check
            "
        );

        if (count($query_check) > 0) {

            try {
                $ftp = ftp_connect('203.151.27.229', '21');
                $login_result = ftp_login($ftp, 'spm', 'a0815209598');

                if ($login_result == true) {
                    $pic_items = DB::select( // get data image asset
                        "
                        SELECT *
                        FROM dbo.stRecheckPic
                        WHERE dbo.stRecheckPic.id_asset = $id_check
                        "
                    );

                    DB::delete( // delete data image asset
                        "
                        DELETE FROM dbo.stRecheckPic
                        WHERE dbo.stRecheckPic.id_asset = $id_check
                    "
                    );
                    foreach ($pic_items as $items) {
                        ftp_delete($ftp, "Asset/PicAsset/$items->pic_name"); // dalete image files asset
                    }
                    ftp_close($ftp); // disconnected ftp

                }
            } catch (\Throwable $th) {
                //throw $th;
            }

            return true;
        } else {
            return false;
        }
    }
    public function pic_insert($id_asset, $pic_name)
    {
        DB::insert(
            "
            INSERT INTO stRecheckPic (pic_name, id_asset)
            VALUES ('$pic_name', '$id_asset')
            "
        );
    }

    public function asset_act() // ยืนยันแล้ว
    {
        try {
            $query_active = DB::select(
                "
            SELECT *
            FROM PchInvAndProject.dbo.stRecheck
            WHERE PchInvAndProject.dbo.stRecheck.Asset_status = 1
            "
            );
        } catch (\Throwable $th) {
            //throw $th;
        }

        return view('asset.asset_active', compact('query_active'));
    }

    public function asset_blank($asset_cat_id)
    {

        $user = session('user');

        $asset_blank = DB::select(
            "
            SELECT
                PchInvAndProject.dbo.AssAssetD.idAsset,
                PchInvAndProject.dbo.AssAssetD.AssetCode,
                PchInvAndProject.dbo.AssAssetD.AssetName,
                PchInvAndProject.dbo.AssAssetD.idComp,
            CASE

                    WHEN PchInvAndProject.dbo.AssAssetD.idType IS NULL THEN
                    '0' ELSE PchInvAndProject.dbo.AssAssetD.idType
                END AS idType,
            CASE

                    WHEN PchInvAndProject.dbo.AssTypeD.AssTypeName IS NULL THEN
                    'ไม่ระบุประเภท' ELSE PchInvAndProject.dbo.AssTypeD.AssTypeName
                END AS AssTypeName,
                GR_Group.dbo.syndCompany.CompName
            FROM
                PchInvAndProject.dbo.AssAssetD
                LEFT JOIN PchInvAndProject.dbo.AssTypeD ON PchInvAndProject.dbo.AssAssetD.idType = PchInvAndProject.dbo.AssTypeD.idAssType
                LEFT JOIN GR_Group.dbo.syndCompany ON PchInvAndProject.dbo.AssAssetD.idComp = GR_Group.dbo.syndCompany.idComp
            WHERE
                PchInvAndProject.dbo.AssAssetD.idComp = $user->idComp
                AND PchInvAndProject.dbo.AssAssetD.idBuy IS NOT NULL
                AND PchInvAndProject.dbo.AssAssetD.idType = $asset_cat_id
            ORDER BY
                PchInvAndProject.dbo.AssAssetD.idAsset DESC
            "
        );

        $asset_cat = collect(DB::select("
            SELECT
                AssTypeName
            FROM
                PchInvAndProject.dbo.AssTypeD
            WHERE
                PchInvAndProject.dbo.AssTypeD.idAssType = $asset_cat_id
        "))->first();
        $asset_title = $asset_cat->AssTypeName;

        return view('asset.asset_blank', compact('asset_blank', 'asset_title'));
    }

    public function asset_search(Request $request)
    {
        $user = session('user');
        $input = "";

        if ($request->searchInput != "") {
            // Request contains data
            $input .= "AND (PchInvAndProject.dbo.AssAssetD.AssetName LIKE '%$request->searchInput%' OR PchInvAndProject.dbo.AssAssetD.AssetCode LIKE '%$request->searchInput%')";
        }

        $search_asset = DB::select("
        SELECT
                PchInvAndProject.dbo.AssAssetD.idAsset,
                PchInvAndProject.dbo.AssAssetD.AssetCode,
                PchInvAndProject.dbo.AssAssetD.AssetName,
				PchInvAndProject.dbo.AssAssetD.idComp,
            CASE
                WHEN PchInvAndProject.dbo.AssAssetD.idType IS NULL THEN
                    '0' ELSE PchInvAndProject.dbo.AssAssetD.idType
                END AS idType,
            CASE
                WHEN PchInvAndProject.dbo.AssTypeD.AssTypeName IS NULL THEN
                    'ไม่ระบุประเภท' ELSE PchInvAndProject.dbo.AssTypeD.AssTypeName
                END AS AssTypeName,
                (PchInvAndProject.dbo.AssAssetD.Price * PchInvAndProject.dbo.AssAssetD.AssAmount) AS assPriceTotal
            FROM
                PchInvAndProject.dbo.AssAssetD
                LEFT JOIN PchInvAndProject.dbo.AssTypeD ON PchInvAndProject.dbo.AssAssetD.idType = PchInvAndProject.dbo.AssTypeD.idAssType
			WHERE PchInvAndProject.dbo.AssAssetD.idType != 17
            AND PchInvAndProject.dbo.AssAssetD.idComp = $user->idComp
			$input
            ORDER BY
                PchInvAndProject.dbo.AssAssetD.idAsset DESC
        ");
        foreach ($search_asset as $items) {
            // Format the assPriceTotal property to have two decimal places
            $items->assPriceTotal = number_format($items->assPriceTotal, 2);
        }

        $sum_asset_result = collect(
            DB::select("
            SELECT
                SUM(PchInvAndProject.dbo.AssAssetD.Price * PchInvAndProject.dbo.AssAssetD.AssAmount) AS assPriceTotal
            FROM
                PchInvAndProject.dbo.AssAssetD
            WHERE
                PchInvAndProject.dbo.AssAssetD.idType != 17
            ")
        )->first();

        $combinedResult = [
            'assAll' => $search_asset,
            'totalAssets' => $sum_asset_result
        ];

        return response()->json($combinedResult);
    }


    public function asset_act_ex()
    {
        $search_asset = DB::select("
        SELECT TOP 10
            pds.idAsset,
            pds.AssetCode,
            pds.AssetName,
            pds.compName
        FROM
            PchInvAndProject.dbo.stRecheck AS pds
        ");
        return response()->json($search_asset);
    }

    public function asset_act_search(Request $request)
    {
        $search_asset = DB::select("
        SELECT TOP 20
            pds.idAsset,
            pds.AssetCode,
            pds.AssetName,
            pds.compName
        FROM
            PchInvAndProject.dbo.stRecheck AS pds
        WHERE
            pds.AssetCode LIKE '%$request->searchInput%'
            OR pds.AssetName LIKE '%$request->searchInput%'
        ");
        return response()->json($search_asset);
    }

    public function asset_repair()
    {
        return view('asset.asset_repair');
    }

    public function asset_ytm(Request $request)
    {
        $text = "";
        if ($request->selectedCategory != 0) {
            $text = "AND ass.idType = '" . $request->selectedCategory . "'";
        }
        $sql = "
            SELECT
                ass.idAsset, ass.AssetCode, ass.AssetName, SUBSTRING ( ass.AssDate, 5, 2 ) AS AssMonth,
                assType.idAssType,
                CASE
                    WHEN assType.AssTypeName IS NULL THEN 'ไม่ระบุประเภท'
                    ELSE assType.AssTypeName
                END AS AssTypeName
            FROM
                PchInvAndProject.dbo.AssAssetD AS ass
                LEFT JOIN PchInvAndProject.dbo.AssTypeD AS assType ON ass.idType = assType.idAssType
            WHERE
            SUBSTRING ( ass.AssDate, 1, 4 ) = '$request->selectedValue'
                $text
                AND SUBSTRING ( ass.AssDate, 5, 2 ) = '$request->month'
            ORDER BY
                ass.idAsset DESC
        ";

        $result_ytm = DB::select($sql);


        return response()->json($result_ytm);
    }
    public function asset_comp_repair()
    {
        $result = collect(DB::select("
            SELECT DISTINCT pda.idComp , pdd.CompCode, pdd.CompName
            FROM PchInvAndProject.dbo.AssRepairMt AS pda
            LEFT JOIN PchInvAndProject.dbo.dCompany AS pdd ON pda.idComp = pdd.idComp
            ORDER BY pda.idComp DESC;
        "));

        return $result;
    }

    public function search_repair(Request $request)
    {
        $user = session('user');
        $idPositions = session('idPositions');
        $sql_text = "";
        $input = "";

        if ($idPositions != 15) {
            $sql_text = "AND pda.idComp = '$user->idComp'";
        }
        if ($request->searchInput != "") {
            $input = "AND pda.RepairCode LIKE '%$request->searchInput%' OR pda.Note LIKE '%$request->searchInput%'";
        }

        $result = DB::select("
            SELECT TOP 20  pda.idRepair, pdd.CompCode,
            SUBSTRING ( pda.BillDate, 7, 2 ) + '-' + SUBSTRING ( pda.BillDate, 5, 2 ) + '-' + SUBSTRING ( pda.BillDate, 0, 5 ) AS BillDate
            , pda.RepairCode, pda.BillCodeRef, pda.TotalNet , pda.Note
            FROM
                PchInvAndProject.dbo.AssRepairMt AS pda
                LEFT JOIN PchInvAndProject.dbo.dCompany AS pdd ON pda.idComp = pdd.idComp
            WHERE
                1 = 1
                $sql_text
                $input
            ORDER BY pda.BillDate DESC
        ");

        return response()->json($result);
    }

    public function FilterSearch(Request $request) // bill asset repair
    {
        $user = session('user');
        $idPositions = session('idPositions');

        if ($request->dateFirst != '' && $request->dateSecond != '') {
            $FirstDate = Carbon::createFromFormat('m/d/Y', $request->dateFirst);
            $SecondDate = Carbon::createFromFormat('m/d/Y', $request->dateSecond);
            $FirstDate = $FirstDate->addYears(543);
            $SecondDate = $SecondDate->addYears(543);

            $resultDate_first = $FirstDate->format('Ymd');
            $resultDate_second = $SecondDate->format('Ymd');
        }

        $sql_text = "";
        if ($idPositions != 15) {
            $sql_text .= "AND pda.idComp = '$user->idComp'";
        } else {
            $sql_text .= "AND pda.idComp = '$request->id_comp'";
        }
        if ($request->dateFirst != '' && $request->dateSecond != '') {
            $sql_text .= " AND pda.BillDate BETWEEN '$resultDate_first' AND '$resultDate_second'";
        }

        try {
            $result = DB::select("
            SELECT TOP 30  pda.idRepair, pdd.CompCode,
                SUBSTRING ( pda.BillDate, 7, 2 ) + '-' + SUBSTRING ( pda.BillDate, 5, 2 ) + '-' + SUBSTRING ( pda.BillDate, 0, 5 ) AS BillDate
                , pda.RepairCode, pda.BillCodeRef, pda.TotalNet , pda.Note
            FROM
                PchInvAndProject.dbo.AssRepairMt AS pda
                LEFT JOIN PchInvAndProject.dbo.dCompany AS pdd ON pda.idComp = pdd.idComp
            WHERE
                1 = 1
                $sql_text
            ORDER BY
                pda.BillDate DESC

        ");
            return response()->json($result);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function search_filter_asset(Request $request)
    {
        $id_comp = $request->id_comp;
        $id_category = $request->id_category;

        if ($request->dateFirst != '' && $request->dateSecond != '') {
            $FirstDate = Carbon::createFromFormat('m/d/Y', $request->dateFirst);
            $SecondDate = Carbon::createFromFormat('m/d/Y', $request->dateSecond);
            $FirstDate = $FirstDate->addYears(543);
            $SecondDate = $SecondDate->addYears(543);

            $resultDate_first = $FirstDate->format('Ymd');
            $resultDate_second = $SecondDate->format('Ymd');
        }

        $sql_text = "";

        if ($id_comp != 0) {
            $sql_text .= " AND PchInvAndProject.dbo.AssAssetD.idComp = '$id_comp'";
        }

        if ($id_category != 0) {
            $sql_text .= " AND PchInvAndProject.dbo.AssAssetD.idType = '$id_category'";
        }

        if ($request->dateFirst != '' && $request->dateSecond != '') {
            $sql_text .= " AND PchInvAndProject.dbo.AssAssetD.AssDate BETWEEN '$resultDate_first' AND '$resultDate_second'";
        }

        try {
            $result = DB::select("
                SELECT
                    PchInvAndProject.dbo.AssAssetD.idAsset,
                    PchInvAndProject.dbo.AssAssetD.AssetCode,
                    PchInvAndProject.dbo.AssAssetD.AssetName,
                    PchInvAndProject.dbo.AssAssetD.idComp,
                    PchInvAndProject.dbo.AssAssetD.AssDate,
                CASE

                        WHEN PchInvAndProject.dbo.AssAssetD.idType IS NULL THEN
                        '0' ELSE PchInvAndProject.dbo.AssAssetD.idType
                    END AS idType,
                CASE

                        WHEN PchInvAndProject.dbo.AssTypeD.AssTypeName IS NULL THEN
                        'ไม่ระบุประเภท' ELSE PchInvAndProject.dbo.AssTypeD.AssTypeName
                    END AS AssTypeName,
                    (PchInvAndProject.dbo.AssAssetD.Price * PchInvAndProject.dbo.AssAssetD.AssAmount) AS assPriceTotal
                FROM
                    PchInvAndProject.dbo.AssAssetD
                    LEFT JOIN PchInvAndProject.dbo.AssTypeD ON PchInvAndProject.dbo.AssAssetD.idType = PchInvAndProject.dbo.AssTypeD.idAssType
                WHERE
                    PchInvAndProject.dbo.AssAssetD.idType != 17 $sql_text
                ORDER BY
                    PchInvAndProject.dbo.AssAssetD.idAsset DESC
            ");

            foreach ($result as $items) {
                // Format the assPriceTotal property to have two decimal places
                $items->assPriceTotal = number_format($items->assPriceTotal, 2);
            }

            $sum_asset_result = collect(
                DB::select("
                SELECT
                    SUM(PchInvAndProject.dbo.AssAssetD.Price * PchInvAndProject.dbo.AssAssetD.AssAmount) AS assPriceTotal
                FROM
                    PchInvAndProject.dbo.AssAssetD
                WHERE
                    PchInvAndProject.dbo.AssAssetD.idType != 17 $sql_text
                ")
            )->first();

            $combinedResult = [
                'assAll' => $result,
                'totalAssets' => $sum_asset_result
            ];

            return response()->json($combinedResult);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function assetQrcode($id)
    {
        try {
            $qrAsset = collect(DB::select("
            SELECT
                assD.AssetCode,
                assD.AssetName,
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
        } catch (\Throwable $th) {
            //throw $th;
            return view('404');
        }
        return view('asset.asset_qr', compact('qrAsset', 'id'));
    }

    public function LandIndex()
    {
        $asset_category = $this->asset_category();
        $Comp = $this->assetComp();

        return view('asset.asset_land', compact('asset_category', 'Comp'));
    }

    public function searchLand(Request $request)
    {
        if (!empty($request->all())) {
            $text = "AND (PchInvAndProject.dbo.AssAssetD.AssetName LIKE '%$request->searchInput%' OR PchInvAndProject.dbo.AssAssetD.AssetCode LIKE '%$request->searchInput%')";
            $result = $this->searchLandQ($text);
        } else {
            $text = "";
            $result = $this->searchLandQ($text);
        }

        return response()->json($result);
    }
    public function searchLandQ($data)
    {
        $text = $data;
        try {
            $result = DB::select("
                SELECT
                    PchInvAndProject.dbo.AssAssetD.idAsset,
                    PchInvAndProject.dbo.AssAssetD.AssetCode,
                    PchInvAndProject.dbo.AssAssetD.AssetName,
                    PchInvAndProject.dbo.AssAssetD.idComp,
                CASE

                        WHEN PchInvAndProject.dbo.AssAssetD.idType IS NULL THEN
                        '0' ELSE PchInvAndProject.dbo.AssAssetD.idType
                    END AS idType,
                CASE

                        WHEN PchInvAndProject.dbo.AssTypeD.AssTypeName IS NULL THEN
                        'ไม่ระบุประเภท' ELSE PchInvAndProject.dbo.AssTypeD.AssTypeName
                    END AS AssTypeName,
                    ( PchInvAndProject.dbo.AssAssetD.Price * PchInvAndProject.dbo.AssAssetD.AssAmount ) AS assPriceTotal
                FROM
                    PchInvAndProject.dbo.AssAssetD
                    LEFT JOIN PchInvAndProject.dbo.AssTypeD ON PchInvAndProject.dbo.AssAssetD.idType = PchInvAndProject.dbo.AssTypeD.idAssType
                WHERE
                    PchInvAndProject.dbo.AssAssetD.idType = 17 $text
                ORDER BY
                    PchInvAndProject.dbo.AssAssetD.idAsset DESC
            ");

            $sum_asset_result = collect(
                DB::select("
                SELECT
                    SUM(PchInvAndProject.dbo.AssAssetD.Price * 1) AS assPriceTotal
                FROM
                    PchInvAndProject.dbo.AssAssetD
                WHERE
                    PchInvAndProject.dbo.AssAssetD.idType = 17 $text
                ")
            )->first();
        } catch (\Throwable $th) {
            //throw $th;
        }

        foreach ($result as $items) {
            // Format the assPriceTotal property to have two decimal places
            $items->assPriceTotal = number_format($items->assPriceTotal, 2);
        }

        $combinedResult = [
            'assAll' => $result,
            'totalAssets' => $sum_asset_result
        ];

        return $combinedResult;
    }

    public function search_filter_land(Request $request)
    {
        if (!empty($request->all())) {
            $text = "";
            if ($request->id_comp != 0) {
                $text = " AND PchInvAndProject.dbo.AssAssetD.idComp = '$request->id_comp'";
            }

            $result = $this->searchLandQ($text);
        } else {
            $text = "";
            $result = $this->searchLandQ($text);
        }
        return response()->json($result);
    }
}
