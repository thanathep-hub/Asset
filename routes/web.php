<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\ProjectController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/depreciation', function () {
    return view('assets.rate');
});

Route::get('/login', function () {
    if (Session::has('user')) {
        return redirect('/');
    } else {
        return view('auth.loginForm2');
    }
});

Route::group(['middleware' => 'CheckLogin'], function () {

    Route::get('/', function () {
        return redirect('/asset');
    });
    Route::get('/assets', function () {
        return redirect('/asset');
    });
    /* ---------------------------------------------- Asset All ---------------------------------------------- */
    // Route::get('/asset', 'AssetController@index');
    Route::get('/asset/{id}', 'AssetController@asset_detail');
    Route::get('/asset-qr/{id}', 'AssetController@assetQrcode');

    // Route::post('/asset_active', 'AssetController@asset_active');
    // Route::get('/asset_act', 'AssetController@asset_act');
    // Route::get('/asset_act_ex', 'AssetController@asset_act_ex')->name('asset_act_ex');
    // Route::get('/asset_act/search', 'AssetController@asset_act_search')->name('asset_act_search');
    // Route::get('/asset-repair', 'AssetController@asset_repair')->name('asset-repair');
    // ///asset_ytm/
    // Route::get('/asset_ytm', 'AssetController@asset_ytm')->name('asset_ytm');
    // Route::get('/asset_menu', function () {
    //     return view('asset.asset_menu');
    // });

    // Route::get('/asset_bill_repair', function () {
    //     $assetController = new AssetController();
    //     $asset_category = $assetController->asset_comp_repair();
    //     return view('asset.asset_repair', ['Comp' => $asset_category]);
    // });

    // page asset repair bill
    // Route::get('/search_repair', 'AssetController@search_repair')->name('search_repair');
    // Route::get('/search_filter', 'AssetController@FilterSearch')->name('search_filter_date');
    // Route::get('/search_filter_asset', 'AssetController@search_filter_asset')->name('search_filter_asset');

    /* ---------------------------------------------- Asset Category ---------------------------------------------- */

    // Route::get('/chart-data/{value}/{category}', 'AssetController@asset_query');
    // Route::get('/asset/type/{id}', 'AssetController@asset_blank');
    // Route::get('/chart-data/{value}/{category}', 'AssetController@asset_query');
    // Route::get('/asset/all', 'AssetController@asset_all')->name('asset_all');
    // Route::get('/asset_search/asset_search', 'AssetController@asset_search')->name('asset_search');

    // asset ที่ดิน --------------------------------------------------------------------------------------------------------
    // Route::get('/asset_land', 'AssetController@LandIndex');
    // Route::get('/asset_land/search', 'AssetController@searchLand')->name('searchLand');
    // Route::get('/asset_land/search_filter_land', 'AssetController@search_filter_land')->name('search_filter_land');

    /* ---------------------------------------------- /PO ---------------------------------------------- */
    Route::get('/po/items/{id_po}', 'POController@showPO');
    Route::get('/po/list', 'POController@showPO_list');
    Route::post('/po/confirm', 'POController@confirmPO');
    Route::get('/BahtText/{number}', 'BahtTextController@bahtText');


    /* ---------------------------------------------- /Assets ---------------------------------------------- */
    Route::get('/asset', 'AssetsController@assets');
    Route::get('/assets/search/text_query', 'AssetsController@assets_search');
    Route::get('/assets/detail/{id}', 'AssetsController@assets_detail');

    route::get('/api/assets/wait-approve', 'AssetsController@getAsset_waitApprove');
    route::get('/api/assets/fetch-approve', 'AssetsController@getAsset_fetchApprove');

    Route::post('/assets/new-asset', 'AssetsController@assets_new');
    Route::post('/assets/detail/active', 'AssetsController@assets_active');
    Route::post('/assets/detail/update', 'AssetsController@assets_update');

    // edit
    Route::post('/assets/detail/edbi_save', 'AssetsController@edbi_save');
    Route::post('/assets/detail/edps_save', 'AssetsController@edps_save');
    Route::post('/assets/detail/edii_save', 'AssetsController@edii_save');
    Route::post('/assets/detail/edimg', 'AssetsController@edimg_save');
    // /assets/detail/edps_save

    // search input company , category and text input
    Route::get('/assets/search/input', 'AssetsController@search_query');
    // img assets
    Route::get('/api/assets/img/{id}', 'AssetsController@fetch_assetImg');

    // generate QR code to asset component
    Route::get('/assets/create-component/', 'AssetsController@Create_component');
    Route::get('/assets/link/id-component/{id}', 'AssetsController@linkAssetComponent');
    Route::post('/assets/qr-new-assets', 'AssetsController@qr_new_asset');

    Route::get('/assets/link/id-component/{id}/print', function ($id) {
        return view('assets.qrcode.print-qrcode', compact('id'));
    });

    // api apiAsset_detail
    Route::get('/api/asset/item/{id}', 'AssetsController@apiAsset_detail');
    Route::get('/api/asset/catagory', 'AssetsController@apiAsset_catagory');
    Route::get('/api/user/fullname', 'AssetsController@apiUser_fullname');
    Route::get('/api/company', 'AssetsController@apiCompany');
    Route::get('/api/supplier', 'AssetsController@apiSupplier');

    /* ---------------------------------------------- Project ---------------------------------------------- */

    Route::get('/project-all', 'ProjectController@project');
    Route::get('/project/items/{id}', 'ProjectController@project_mt');
    Route::post('/project/items/{id}', 'ProjectController@projectMtApprove');
    Route::post('/project/reject/{id}', 'ProjectController@project_reject');
    Route::post('/project/cancel/{id}', 'ProjectController@project_cancel');
    Route::get('/api/project', 'ProjectController@api_project')->name('get_project');

    /* project list */
    Route::get('/project-list', 'ProjectController@project_list'); //vdProjectFilter
    Route::get('/project-list-filter', 'ApiController@vdProjectFilter');

    Route::get('/project-list/d/{id}', 'ProjectController@vdProject_Detail');


    Route::get('/api/project-list', 'ApiController@vdProject');
    Route::get('/api/project/company', 'ApiController@apiCompany');


    // Route::get('/test-view', function () {
    //     session()->put("routeIs", 'active');
    //     return view('app.app');
    // });

    /* ---------------------------------------------- /Project ---------------------------------------------- */

    // Route::get('/storage-link', function () {
    //     Artisan::call('storage:link');
    // });

    // Route::get('/config-clear', function () {
    //     Artisan::call('config:clear');
    // });
    // Route::get('/config-cache', function () {
    //     Artisan::call('config:cache');
    // });
});

Route::get('/checkLogin', 'AuthController@Login');
Route::get('/logout', 'AuthController@userLogout');

Route::get(
    '/errors/404',
    function () {
        return view('errors.404');
    }
);

Route::get('ftp-connect', 'TestController@test');


// /* test upload file */
Route::get('up-file', function () {
    return view('upfile');
});

Route::post('/up-file-con', 'TestController@resizeAndSaveToFTP');


Route::get('test-img', function () {
    return view('test-img');
});