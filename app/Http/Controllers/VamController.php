<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use RealRashid\SweetAlert\Facades\Alert;

class VamController extends Controller
{
    public function index()
    {
        $user = session('user');

        $query_vam = DB::select(
            "
                SELECT DISTINCT
                    id_rec_car,
                    name_brand_car,
                    num_register,
                    dprtment,
                    department,
                CASE
                WHEN name_generation IS NULL THEN
                    '-' ELSE name_generation
                END AS name_generation
                FROM
                    VAM.dbo.vCar
                WHERE
                stdel = 0
                    -- department IS NOT NULL
                    -- AND department != '-'
            "
        );
        $CarTotal = collect(DB::select("
            SELECT COUNT(*) AS CarTotal
            FROM
                VAM.dbo.vCar 	AS vdvc
            WHERE
                stdel = 0
                -- vdvc.department IS NOT NULL
                -- AND vdvc.department != '-'
        "))->first();

        return view('vam', compact('query_vam', 'CarTotal'));
    }

    public function vam_detail($vam_id)
    {
        try {
            $query_vam = collect(DB::select("
            SELECT DISTINCT *
            FROM VAM.dbo.vCar
            WHERE id_rec_car = $vam_id
        "))->first();
        } catch (\Throwable $th) {
            return view('404');
        }

        $sum_total = DB::select("
        SELECT SUM(vam.dbo.recinv.total) AS sum_total
        FROM vam.dbo.recinv
        WHERE vam.dbo.recinv.id_rec_car = $vam_id
        AND vam.dbo.recinv.type_bill = 0
    ");

        $query_oil = collect(DB::select("
        SELECT
            vam.dbo.recinv.num_receipt,
            vam.dbo.recinv.comment,
            vam.dbo.recinv.namepic_bill,
            CONVERT(DATE, vam.dbo.recInv.dateDo) AS dateDo,
            vam.dbo.recinv.code_project,
            vam.dbo.recinv.total,
            PchInvAndProject.dbo.dPerson.PsNameF AS PsName,
            PchInvAndProject.dbo.dProject.ProjectName
        FROM
            vam.dbo.recinv,
            PchInvAndProject.dbo.dPerson,
            PchInvAndProject.dbo.dProject
        WHERE
            PchInvAndProject.dbo.dPerson.idPs = vam.dbo.recinv.code_user
            AND PchInvAndProject.dbo.dProject.idProject = vam.dbo.recinv.code_project
            AND vam.dbo.recinv.id_rec_car = $vam_id
            AND vam.dbo.recinv.type_bill = 0
        ORDER BY
            vam.dbo.recinv.dateDo DESC
    "));

        $query_m = $this->query_maintenance($vam_id);
        $m_total = $this->cal_total($query_m);

        // Insurance ค่าเบี้ยประกัน
        $query_insurance = $this->query_insurance($vam_id);
        $insurance_total = $this->cal_total($query_insurance);

        // Query_prb พรบ
        $query_prb = $this->query_prb($vam_id);
        $prb_total = $this->cal_total($query_prb);

        // Query_vat ภาษี
        $query_vat = $this->query_vat($vam_id);
        $vat_total = $this->cal_total($query_vat);

        // Query_repair ค่าซ่อม
        $query_repair = $this->query_repair($vam_id);
        $repair_total = $this->cal_total($query_repair);

        // Query_price
        $query_price = $this->query_price($vam_id);

        $CarMaintenance = collect(DB::select("
        SELECT * FROM VAM.dbo.CarMaintenance
        WHERE VAM.dbo.CarMaintenance.CarID = $vam_id
    "))->first();

        return view(
            'vam.vam_detail',
            compact(
                'query_vam',
                'sum_total',
                'query_oil',
                'query_m',
                'm_total',
                'query_insurance',
                'insurance_total',
                'query_prb',
                'prb_total',
                'query_vat',
                'vat_total',
                'query_repair',
                'repair_total',
                'query_price',
                'CarMaintenance'
            )
        );
    }


    public function query_maintenance($id)
    {
        $maintenance = DB::select("
            SELECT
                vam.dbo.recinv.num_receipt,
                vam.dbo.recinv.comment,
                CONVERT(DATE, vam.dbo.recInv.dateDo) AS dateDo,
                vam.dbo.recinv.code_project,
                vam.dbo.recinv.total,
                vam.dbo.recInv_type.type_name,
                vam.dbo.recInv_group.group_name,
                vam.dbo.recInv_group.gid,
                PchInvAndProject.dbo.dPerson.PsNameF AS PsName,
                PchInvAndProject.dbo.dProject.ProjectName
            FROM
                vam.dbo.recinv,
                vam.dbo.recInv_type,
                vam.dbo.recInv_group,
                PchInvAndProject.dbo.dPerson,
                PchInvAndProject.dbo.dProject
            WHERE
                PchInvAndProject.dbo.dPerson.idPs = vam.dbo.recinv.code_user
                AND PchInvAndProject.dbo.dProject.idProject = vam.dbo.recinv.code_project
                AND vam.dbo.recInv_group.gid = vam.dbo.recInv.code_group
				AND vam.dbo.recInv_type.typeId = vam.dbo.recInv.type_bill
                AND vam.dbo.recinv.id_rec_car = $id
                AND vam.dbo.recinv.type_bill = 1
                AND (vam.dbo.recInv_group.gid = 1 OR vam.dbo.recInv_group.gid = 2 OR vam.dbo.recInv_group.gid = 3 OR vam.dbo.recInv_group.gid = 16)
            ORDER BY vam.dbo.recinv.date_AddFuel DESC
        ");
        return $maintenance;
    }
    public function cal_total($item)
    {
        $sum_total = 0;
        foreach ($item as $items) {
            $sum_total = $items->total + $sum_total;
        }
        return $sum_total;
    }

    public function query_insurance($id)
    {
        $query_insurance = DB::select("
            SELECT
                vam.dbo.recinv.idRec,
                vam.dbo.recinv.comment,
                vam.dbo.recinv.num_receipt,
                CONVERT ( DATE, vam.dbo.recInv.dateDo ) AS dateDo,
                vam.dbo.recinv.code_project,
                vam.dbo.recinv.total,
                vam.dbo.recInv_type.type_name,
                vam.dbo.recInv_group.group_name,
                vam.dbo.recInv_group.gid,
                PchInvAndProject.dbo.dPerson.PsNameF AS PsName,
                PchInvAndProject.dbo.dProject.ProjectName
            FROM
                vam.dbo.recinv,
                vam.dbo.recInv_type,
                vam.dbo.recInv_group,
                PchInvAndProject.dbo.dPerson,
                PchInvAndProject.dbo.dProject
            WHERE
                PchInvAndProject.dbo.dPerson.idPs = vam.dbo.recinv.code_user
                AND PchInvAndProject.dbo.dProject.idProject = vam.dbo.recinv.code_project
                AND vam.dbo.recInv_group.gid = vam.dbo.recInv.code_group
                AND vam.dbo.recInv_type.typeId = vam.dbo.recInv.type_bill
                AND vam.dbo.recinv.id_rec_car = $id
                AND vam.dbo.recinv.type_bill = 2
                AND vam.dbo.recInv_group.gid = 12
            ORDER BY
                vam.dbo.recInv.dateDo DESC
            ");
        return $query_insurance;
    }

    public function query_prb($id)
    {
        $query_prb = DB::select("
            SELECT
                vam.dbo.recinv.num_receipt,
                vam.dbo.recinv.comment,
                CONVERT(DATE, vam.dbo.recInv.dateDo) AS dateDo,
            -- 	vam.dbo.recInv.id_rec_car,
                vam.dbo.recinv.code_project,
                vam.dbo.recinv.total,
                vam.dbo.recInv_type.type_name,
                vam.dbo.recInv_group.group_name,
                vam.dbo.recInv_group.gid,
                PchInvAndProject.dbo.dPerson.PsNameF AS PsName,
                PchInvAndProject.dbo.dProject.ProjectName
            FROM
                vam.dbo.recinv,
                vam.dbo.recInv_type,
                vam.dbo.recInv_group,
                PchInvAndProject.dbo.dPerson,
                PchInvAndProject.dbo.dProject
            WHERE
                PchInvAndProject.dbo.dPerson.idPs = vam.dbo.recinv.code_user
                AND PchInvAndProject.dbo.dProject.idProject = vam.dbo.recinv.code_project
                AND vam.dbo.recInv_group.gid = vam.dbo.recInv.code_group
				AND vam.dbo.recInv_type.typeId = vam.dbo.recInv.type_bill
                AND vam.dbo.recinv.id_rec_car = $id
                AND vam.dbo.recinv.type_bill = 2
                AND vam.dbo.recInv_group.gid = 11
            ORDER BY
                vam.dbo.recinv.date_AddFuel DESC
        ");
        return $query_prb;
    }

    public function query_vat($id)
    {
        $query_vat = DB::select("
            SELECT
                vam.dbo.recinv.num_receipt,
                vam.dbo.recinv.comment,
                CONVERT(DATE, vam.dbo.recInv.dateDo) AS dateDo,
            -- 	vam.dbo.recInv.id_rec_car,
                vam.dbo.recinv.code_project,
                vam.dbo.recinv.total,
                vam.dbo.recInv_type.type_name,
                vam.dbo.recInv_group.group_name,
                vam.dbo.recInv_group.gid,
                PchInvAndProject.dbo.dPerson.PsNameF AS PsName,
                PchInvAndProject.dbo.dProject.ProjectName
            FROM
                vam.dbo.recinv,
                vam.dbo.recInv_type,
                vam.dbo.recInv_group,
                PchInvAndProject.dbo.dPerson,
                PchInvAndProject.dbo.dProject
            WHERE
                PchInvAndProject.dbo.dPerson.idPs = vam.dbo.recinv.code_user
                AND PchInvAndProject.dbo.dProject.idProject = vam.dbo.recinv.code_project
                AND vam.dbo.recInv_group.gid = vam.dbo.recInv.code_group
                AND vam.dbo.recInv_type.typeId = vam.dbo.recInv.type_bill
                AND vam.dbo.recinv.id_rec_car = $id
                AND vam.dbo.recinv.type_bill = 2
                AND vam.dbo.recInv_group.gid = 13
            ORDER BY
                vam.dbo.recinv.date_AddFuel DESC
    ");
        return $query_vat;
    }

    public function query_repair($id)
    {
        $query_repair = DB::select("
            SELECT
                vam.dbo.recinv.num_receipt,
                vam.dbo.recinv.comment,
                CONVERT(DATE, vam.dbo.recInv.dateDo) AS dateDo,
            -- 	vam.dbo.recInv.id_rec_car,
                vam.dbo.recinv.code_project,
                vam.dbo.recinv.total,
                vam.dbo.recInv_type.type_name,
                vam.dbo.recInv_group.group_name,
                vam.dbo.recInv_group.gid,
                PchInvAndProject.dbo.dPerson.PsNameF AS PsName,
                PchInvAndProject.dbo.dProject.ProjectName
            FROM
                vam.dbo.recinv,
                vam.dbo.recInv_type,
                vam.dbo.recInv_group,
                PchInvAndProject.dbo.dPerson,
                PchInvAndProject.dbo.dProject
            WHERE
                PchInvAndProject.dbo.dPerson.idPs = vam.dbo.recinv.code_user
                AND PchInvAndProject.dbo.dProject.idProject = vam.dbo.recinv.code_project
                AND vam.dbo.recInv_group.gid = vam.dbo.recInv.code_group
				AND vam.dbo.recInv_type.typeId = vam.dbo.recInv.type_bill
                AND vam.dbo.recinv.id_rec_car = $id
                AND vam.dbo.recinv.type_bill = 1
                AND vam.dbo.recInv_group.gid = 0
            ORDER BY
                vam.dbo.recinv.date_AddFuel DESC
        ");
        return $query_repair;
    }

    public function query_price($id)
    {
        $query_price = collect(DB::select("
        SELECT
            id_rec_car,
            num_register,
            price_car,
            CONVERT ( DATE, date_register ) AS date_register,
            YEAR ( getdate( ) ) - YEAR ( date_register ) AS life_Time,
            Price_Car + ( SELECT SUM ( money ) FROM vam.dbo.vInvListDoWorking WHERE stAsset = 1 AND type_bill <> 3 AND vInvListDoWorking.id_rec_car = vCar.id_rec_car ) AS PriceCurrent,
            ( SELECT  vam.vam.sp_CalDepreciate ( price_car, ( YEAR ( getdate( ) ) - YEAR ( date_register ) ) ) ) AS Deteriorate_price
        FROM
            VAM.dbo.vCar
        WHERE
            id_rec_car = $id
        "))->first();

        return $query_price;
    }

    public function car_maintenance(Request $request)
    {
        $user = session('user');
        $current = Carbon::now()->toDateTimeString();
        $oneYearLater = Carbon::now()->addYear()->toDateString();

        $Mileage = $request->Mileage;
        $id_rec_car = $request->id_rec_car;
        $note = $request->note;

        $con1 = $request->filled('EngineOilCheck');
        $con2 = $request->filled('TireCheck');
        $con3 = $request->filled('otherCheck');

        $car_check = DB::select("
        SELECT * FROM VAM.dbo.CarMaintenance
        WHERE VAM.dbo.CarMaintenance.CarID = $id_rec_car
    ");

        if (count($car_check) == 0) {
            DB::insert("
            INSERT INTO VAM.dbo.CarMaintenance (CarID, CarMileage, LatestEngineOilChangeMileage, LatestEngineOilChangeDate, LastTireChangeDate, SchedulTireChangeDate, note, user_created, last_do_date)
            VALUES ('$id_rec_car', '$Mileage', '$Mileage', '$current', '$current', '$oneYearLater', '$note', '$user->idPs', '$current')
        ");

            Alert::success(Session('success', 'ทำรายการสำเร็จ!'));
            return redirect('/vam/car_maintenance/list');
        } else {
            if ($request->filled('EngineOilCheck') || $request->filled('TireCheck') || $request->filled('otherCheck')) {
                $insertData = "
                UPDATE VAM.dbo.CarMaintenance
                SET VAM.dbo.CarMaintenance.CarMileage = '$Mileage', VAM.dbo.CarMaintenance.user_created = '$user->idPs', VAM.dbo.CarMaintenance.last_do_date = '$current'
            ";

                if ($con1) {
                    $insertData .= ", VAM.dbo.CarMaintenance.LatestEngineOilChangeMileage = '$Mileage', VAM.dbo.CarMaintenance.LatestEngineOilChangeDate = '$current'";
                }

                if ($con2) {
                    $insertData .= ", VAM.dbo.CarMaintenance.LastTireChangeDate = '$current', VAM.dbo.CarMaintenance.SchedulTireChangeDate = '$oneYearLater'";
                }

                $insertData .= ", VAM.dbo.CarMaintenance.note = '$note'";

                $insertData .= " WHERE VAM.dbo.CarMaintenance.CarID = '$id_rec_car'";
                DB::statement($insertData);

                Alert::success(Session('success', 'ทำรายการสำเร็จ!'));
                return redirect('/vam/car_maintenance/list');
            } else {
                Alert::warning(Session('warning', 'หากไม่ใช่ เปลี่ยนน้ำมันเครื่อง,เปลี่ยนยาง ให้เลือกอื่นๆ'));
                return redirect()->back();
            }
        }
    }


    public function maintenance_list()
    {
        $query = DB::select("
        SELECT TOP 10 VAM.dbo.CarMaintenance.*, car.num_register
        FROM VAM.dbo.CarMaintenance
        LEFT JOIN VAM.dbo.Car AS car ON VAM.dbo.CarMaintenance.CarID = car.id_rec_car
        ");

        return view('vam.noti_vam', compact('query'));
    }

    public function listAll()
    {
        $query = DB::select("
        SELECT TOP
            10 vdc.CM_id,
            vdc.CarID,
            vdc.CarMileage,
            vdc.LatestEngineOilChangeMileage,
            CONVERT ( DATE, vdc.LatestEngineOilChangeDate ) AS LatestEngineOilChangeDate,
            CONVERT ( DATE, vdc.LastTireChangeDate ) AS LastTireChangeDate,
            CONVERT ( DATE, vdc.SchedulTireChangeDate ) AS SchedulTireChangeDate,
            CONVERT ( DATE, vdc.last_do_date ) AS last_do_date,
            vdc.note,
            vdc.user_created,
            car.num_register
        FROM
            VAM.dbo.CarMaintenance AS vdc
            LEFT JOIN VAM.dbo.Car AS car ON vdc.CarID = car.id_rec_car
            ORDER BY vdc.CM_id DESC
        ");

        return response()->json($query);
    }

    public function listOwner()
    {
        $user = session('user');
        $query = DB::select("
        SELECT TOP
            10 vdc.CM_id,
            vdc.CarID,
            vdc.CarMileage,
            vdc.LatestEngineOilChangeMileage,
            CONVERT ( DATE, vdc.LatestEngineOilChangeDate ) AS LatestEngineOilChangeDate,
            CONVERT ( DATE, vdc.LastTireChangeDate ) AS LastTireChangeDate,
            CONVERT ( DATE, vdc.SchedulTireChangeDate ) AS SchedulTireChangeDate,
            CONVERT ( DATE, vdc.last_do_date ) AS last_do_date,
            vdc.note,
            vdc.user_created,
            car.num_register
        FROM
            VAM.dbo.CarMaintenance AS vdc
            LEFT JOIN VAM.dbo.Car AS car ON vdc.CarID = car.id_rec_car
            WHERE vdc.user_created = $user->idPs
            ORDER BY vdc.CM_id DESC
        ");

        return response()->json($query);
    }

    public function listSearch(Request $request)
    {
        $SearchQuery = DB::select("
            SELECT TOP 10 *
            FROM
                VAM.dbo.vCarMaintenance AS vdvc
            WHERE
                vdvc.num_register LIKE '%$request->searchInput%'
        ");

        return response()->json($SearchQuery);
    }

    public function cm_detail(Request $request){
        $result = collect(DB::select("
            SELECT *
            FROM VAM.dbo.vCarMaintenance as vdvc
            WHERE vdvc.CM_id = '$request->searchID'
        "))->first();
        return response()->json($result);
    }

    public function vamSearch(Request $request)
    {
        $SearchVam = DB::select("
        SELECT TOP 10
            id_rec_car,
            name_brand_car,
            num_register,
            dprtment,
            department,
        CASE

                WHEN name_generation IS NULL THEN
                '-' ELSE name_generation
            END AS name_generation
        FROM
            VAM.dbo.vCar
        WHERE
            department IS NOT NULL
            AND department != '-'
            AND num_register LIKE '%$request->searchInput%'
        ");

        return response()->json($SearchVam);
    }

    public function vamQrcode($id)
    {
        try {
            $qrVam = collect(DB::select("
                SELECT vdvc.id_rec_car, vdvc.num_register, vdvc.name_car, vdvc.Compname
                FROM VAM.dbo.vCar AS vdvc
                WHERE vdvc.id_rec_car = $id
        "))->first();
        } catch (\Throwable $th) {
            //throw $th;
            return view('404');
        }
        return view('vam.qr-code', compact('qrVam', 'id'));
    }
}
