<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AssetController;
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




Route::get('/login', function () {
    if (Session::has('user')) {
        return redirect('/');
    } else {
        return view('auth.loginForm');
    }
});

Route::group(['middleware' => 'CheckLogin'], function () {

    Route::get('/', function () {
        return view('asset.asset_menu');
    });
    /* ---------------------------------------------- Asset All ---------------------------------------------- */
    Route::get('/asset', 'AssetController@index');
    Route::get('/asset/{id}', 'AssetController@asset_detail');

    Route::post('/asset_active', 'AssetController@asset_active');
    Route::get('/asset_act', 'AssetController@asset_act');
    Route::get('/asset_act_ex', 'AssetController@asset_act_ex')->name('asset_act_ex');
    Route::get('/asset_act/search', 'AssetController@asset_act_search')->name('asset_act_search');
    Route::get('/asset-repair', 'AssetController@asset_repair')->name('asset-repair');
    ///asset_ytm/
    Route::get('/asset_ytm', 'AssetController@asset_ytm')->name('asset_ytm');
    Route::get('/asset_menu', function () {
        return view('asset.asset_menu');
    });
    Route::get('/asset_graph', function () {

        $assetController = new AssetController();
        $asset_category = $assetController->asset_category();
        return view('asset.asset_graph', ['asset_category' => $asset_category]);
    });

    Route::get('/asset_bill_repair', function () {
        $assetController = new AssetController();
        $asset_category = $assetController->asset_comp_repair();
        return view('asset.asset_repair', ['Comp' => $asset_category]);
    });

    // page asset repair bill
    Route::get('/search_repair', 'AssetController@search_repair')->name('search_repair');
    // page asset
    Route::get('/search_filter', 'AssetController@FilterSearch')->name('search_filter_date');
    Route::get('/search_filter_asset', 'AssetController@search_filter_asset')->name('search_filter_asset');

    /* ---------------------------------------------- Asset Category ---------------------------------------------- */

    // Route::get('/chart-data/{value}/{category}', 'AssetController@asset_query');

    Route::get('/asset/type/{id}', 'AssetController@asset_blank');

    Route::get('/chart-data/{value}/{category}', 'AssetController@asset_query');
    Route::get('/asset/all', 'AssetController@asset_all')->name('asset_all');
    Route::get('/asset_search/asset_search', 'AssetController@asset_search')->name('asset_search');
    Route::get('/asset-qr/{id}', 'AssetController@assetQrcode');

    // asset ที่ดิน --------------------------------------------------------------------------------------------------------
    Route::get('/asset_land', 'AssetController@LandIndex');

    Route::get('/asset_land/search', 'AssetController@searchLand')->name('searchLand');
    // search_filter_land
    Route::get('/asset_land/search_filter_land', 'AssetController@search_filter_land')->name('search_filter_land');

    /* ---------------------------------------------- /PO ---------------------------------------------- */
    Route::get('/po/items/{id_po}', 'POController@showPO');
    Route::get('/po/list', 'POController@showPO_list');
    Route::post('/po/confirm', 'POController@confirmPO');

    Route::get('/BahtText/{number}', 'BahtTextController@bahtText');


    /* ---------------------------------------------- /Asset ---------------------------------------------- */

    Route::get('/vam', 'VamController@index');
    Route::get('/vam/search', 'VamController@vamSearch')->name('vamSearch');
    Route::get('/vam/{id}', 'VamController@vam_detail');
    Route::post('/vam/car_maintenance', 'VamController@car_maintenance');
    Route::get('/vam/car_maintenance/list', 'VamController@maintenance_list');
    Route::get('/vam/car_maintenance/listAll', 'VamController@listAll');
    Route::get('/vam/car_maintenance/listOwner', 'VamController@listOwner')->name('listOwner');
    Route::get('/vam/car_maintenance/search', 'VamController@listSearch')->name('listSearch');
    Route::get('/vam/car_maintenance/cm_detail', 'VamController@cm_detail')->name('cm_detail');

    Route::get('/vam-qr/qr-code/{id}', 'VamController@vamQrcode');
    Route::get('/vam_menu', function () {
        return view('vam.vam_menu');
    });


    Route::get('/storage-link', function () {
        Artisan::call('storage:link');
    });
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

//
//
//

//
//
//
/* drink  */

use App\Http\Controllers\DrinkController;

Route::get('/connect_admin', 'DrinkController@connect_admin')->name('connect_admin');
Route::get('/drink', function () {
    $DrinkController = new DrinkController();
    $getMenus = $DrinkController->getMenus();
    // session()->flush(); // remove all data from the session
    return view('drink', ['getMenus' => $getMenus]);
});

Route::get('/getMenus', 'DrinkController@getMenus')->name('getMenus');

Route::post('/insertCart', 'DrinkController@insertCart');

Route::get('/drinks_success', 'DrinkController@drinks_success');
Route::get('/back_to_drink', 'DrinkController@success')->name('back_to_drink');

// Route::get('/test', 'DrinkController@test');
// Route::get('/test/po/{id}', 'POController@PO_line_update');

Route::get('/drink_home', function () {
    return view('drinks.drink_home');
});

Route::get('/drink/admin', 'drink\AdminController@index');

Route::get('/drink/admin/oderdetail', 'drink\AdminController@adminGetOderdetail')->name('adminGetOderdetail');
Route::post('/drink/admin/OrderIdCancel', 'drink\AdminController@OrderIdCancel')->name('OrderIdCancel');
Route::post('/drink/admin/OrderSubmit', 'drink\AdminController@OrderSubmit')->name('OrderSubmit');

Route::get('/drink/admin/order/{id}', 'drink\AdminController@OrderAC');


Route::get('/drink/admin/getMenu', 'drink\AdminController@getMenu')->name('AdminGetMenu');
Route::post('/drink/admin/addMenu', 'drink\AdminController@addMenu');
Route::post('/drink/admin/updateMenu', 'drink\AdminController@updateMenu');
Route::post('/drink/admin/deleteMenu', 'drink\AdminController@deleteMenu');

Route::get('/drink/admin/getMenubyID/{id}', 'drink\AdminController@getMenubyID');

Route::get('drink/admin/getHistory', 'drink\AdminController@getHistoryOrder')->name('admin_get_history');

Route::get('/drink/admin/SumOrderDaily', 'drink\AdminController@SumOrderDaily')->name('SumOrderDaily');