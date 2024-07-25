<?php

namespace App\Http\Controllers;

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
                    a.idType != 17
                    AND a.idType != 30
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
        return view('assets.detail');
    }
}
