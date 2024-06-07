<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function userLogout()
    {

        session()->flush(); // remove all data from the session
        return redirect('/login'); // return to login page

    }

    public function login(Request $request)
    {
        // dd($request->all());
        if ($request->input("user") != '' && $request->input("password") != '') {

            // dd('this controller');
            $user = $request->input("user");
            $password = $request->input("password");
            $query = "SELECT * FROM GR_Group.dbo.dEmployee WHERE GR_Group.dbo.dEmployee.UN = '$user' AND GR_Group.dbo.dEmployee.PW = '$password'";
            $data_user = collect(DB::select($query))->first();
        } else {
            Alert::error('เกิดข้อผิดพลาด!', 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง');
            return redirect()->back();
        }


        if ($data_user != null) {

            session()->put("user", $data_user);
            session()->put('username', $data_user->shortname);
            session()->put('idPositions', $data_user->idPositions);
            session()->put("idComp", $data_user->idComp);
            // session()->put('idPositions', 15); // position 15 กรรมการผู้บริหาร

            session()->put("permission_po", $this->permission_po($data_user->idPs));

            if ($data_user->idPositions === '15') {
                session()->put("role", 'admin');
            } else if ($data_user->idPositions === '17') {
                session()->put("role", 'superAdmin');
            } else {
                session()->put("role", 'user');
            }

            // ดึง URL ก่อนหน้าจาก session
            $previousUrl = Session::get('previous_url', '/');
            Session::forget('previous_url'); // ลบ URL ก่อนหน้าออกจาก session เพื่อป้องกันปัญหาในอนาคต

            // ดีบัก URL ก่อนหน้า
            // dd($previousUrl);

            return redirect()->to($previousUrl);
        } else {
            Alert::error('เกิดข้อผิดพลาด!', 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง');
            return redirect()->back();
        }
    }

    public function permission_po($id)
    {
        try {
            $query = collect(DB::select("
                SELECT
                    *
                FROM
                    PchInvAndProject.devsk.PO_Update_Permission AS pdpp
                    WHERE pdpp.idPS = $id
            "))->first();
        } catch (\Throwable $th) {
            //throw $th;
        }

        if ($query) {
            return $query;
        }
    }
}