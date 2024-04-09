<?php

namespace App\Http\Controllers\drink;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DateTime;

class AdminController extends Controller
{
    public function index()
    {
        $dataOrder = $this->getOrder();
        return view('drinks.drink_admin', compact('dataOrder'));
    }

    public function getOrder()
    {
        $order = DB::select("
            SELECT
                gdg.OrderID,
                gdg.CustomerName,
                FORMAT(gdg.OrderDate, 'dd/MM/yyyy', 'th-TH') AS OrderDate,
                CONVERT(VARCHAR(5), CAST(gdg.OrderTime AS TIME), 108) AS OrderTime,
                SUM ( gdo.Quantity ) AS TotalQuantity,
                SUM ( gdo.TotalPrice ) AS TotalPrice
            FROM
                GR_GroupTest.dbo.gr_orders_drink AS gdg
                INNER JOIN GR_GroupTest.dbo.gr_orderdetails_drink AS gdo ON gdg.OrderID = gdo.OrderID
            WHERE
                gdg.OrderStatus = 1
            GROUP BY
                gdg.OrderID,
                gdg.CustomerName,
                gdg.OrderDate,
                gdg.OrderTime
            ORDER BY
                gdg.OrderID ASC
        ");

        return $order;
    }

    public function adminGetOderdetail(Request $request)
    {
        $orderId = $request->input('orderId');
        $orderm = collect(DB::select("
            SELECT
                gdg.OrderID,
                gdg.CustomerName,
                FORMAT(gdg.OrderDate, 'dd/MM/yyyy', 'th-TH') AS OrderDate,
                CONVERT(VARCHAR(5), CAST(gdg.OrderTime AS TIME), 108) AS OrderTime,
                SUM ( gdo.Quantity ) AS TotalQuantity,
                SUM ( gdo.TotalPrice ) AS TotalPrice
            FROM
                GR_GroupTest.dbo.gr_orders_drink AS gdg
                INNER JOIN GR_GroupTest.dbo.gr_orderdetails_drink AS gdo ON gdg.OrderID = gdo.OrderID
            WHERE
                gdg.OrderID = '$orderId'
            GROUP BY
                gdg.OrderID,
                gdg.CustomerName,
                gdg.OrderDate,
                gdg.OrderTime
        "))->first();

        $result = DB::select("
            SELECT
                *
            FROM
                GR_GroupTest.dbo.gr_orderdetails_drink as gdg
                WHERE gdg.OrderID = '$orderId'
        ");
        $res = [
            'order' => $orderm,
            'details' => $result
        ];
        return response()->json($res);
    }

    public function OrderIdCancel(Request $request)
    {
        $OrderIdCancel = $request->input('OrderIdCancel');
        $result = DB::update("
            UPDATE GR_GroupTest.dbo.gr_orders_drink
            SET OrderStatus = 0
            WHERE OrderID = '$OrderIdCancel';
        ");

        if ($result) {
            return ['status' => 'success'];
        }
    }

    public function OrderSubmit(Request $request)
    {
        $OrderIdSubmit = $request->input('OrderIdSubmit');
        $DateTime = new DateTime();
        $result = DB::update("
            UPDATE GR_GroupTest.dbo.gr_orders_drink
            SET OrderStatus = 2 ,OrderConfirmTime = GETDATE( )
            WHERE OrderID = '$OrderIdSubmit'
        ");
        $lineMSG = $this->putMessageLine($OrderIdSubmit);

        if ($lineMSG) {
            return $lineMSG;
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function putMessageLine($orderID)
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        date_default_timezone_set("Asia/Bangkok");

        // $sToken = "aE5tlxsmvWBuSA6dYbeUs5Kew6tw2LOQ7Zw0N8LTTRo"; // token line
        // $sToken = "9gZvubJwRAJUnxxZp2Ny30IJOl7AIgfpJdANd7D6z8U"; //test line

        $sToken = "GWUxUPNBlHHlpD8GiBSWH4QdGyxESkAzCeqLkrKGZYz"; // ห้องตะวันยิ้ม

        $sMessage = "\nคำสั่งซื้อ #" . $orderID . " ได้รับออเดอร์แล้ว";


        $chOne = curl_init();
        curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($chOne, CURLOPT_POST, 1);
        curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage);
        $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken . '',);
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($chOne);
        if (curl_error($chOne)) {
            $response = [
                'status' => 'error',
                'message' => 'เกิดข้อผิดพลาดในการส่งข้อความไปยัง LINE Notify'
            ];
        } else {
            $result_ = json_decode($result, true);
            $response = [
                'status' => 'success',
                'message' => 'ทำรายการสั่งซื้อสำเร็จ!'
            ];
            return response()->json($response);
        }
        curl_close($chOne);

        // ตรวจสอบสถานะของการส่งข้อความ LINE Notify
        // if ($result) {
        //     $response = [
        //         'status' => 'success',
        //         'message' => 'ทำรายการสั่งซื้อสำเร็จ!'
        //     ];
        // } else {
        //     $response = [
        //         'status' => 'error',
        //         'message' => 'เกิดข้อผิดพลาดในการส่งข้อความไปยัง LINE Notify'
        //     ];
        // }

        // return response()->json($response);
    }

    public function getMenu()
    {
        $menu = DB::select("
            SELECT *
            FROM GR_GroupTest.dbo.gr_product_drink
            ORDER BY id_product_drink DESC
        ");

        return response()->json($menu);
    }

    public function getMenubyID($id)
    {
        $menu = collect(DB::select("
            SELECT *
            FROM GR_GroupTest.dbo.gr_product_drink AS gdgd
            WHERE gdgd.id_product_drink ='$id'
        "))->first();

        return response()->json($menu);
    }

    public function updateMenu(Request $request)
    {
        $pd_id = $request->input('pd_id');
        $menu_select = $request->input('menu_select');
        $pd_name = $request->input('pd_name');
        $pd_price = $request->input('pd_price');

        $result = DB::update("
            UPDATE GR_GroupTest.dbo.gr_product_drink
            SET name_product_drink = '$pd_name', price_product_drink = $pd_price , cat_product_drink = $menu_select
            WHERE id_product_drink = $pd_id
        ");

        return response($result);
    }

    public function deleteMenu(Request $request)
    {
        $pd_id = $request->input('pd_id');

        $result = DB::delete("
            DELETE GR_GroupTest.dbo.gr_product_drink
            WHERE id_product_drink = $pd_id
            ");

        return response($result);
    }

    public function addMenu(Request $request)
    {

        $request->validate([
            'add_pd_name' => 'required|string|max:255',
            'add_pd_price' => 'required|numeric',
        ]);

        $add_pd_cat_select = $request->input('add_pd_cat_select');
        $add_pd_name = $request->input('add_pd_name');
        $add_pd_price = $request->input('add_pd_price');

        $searchByname = DB::select("
            SELECT *
            FROM GR_GroupTest.dbo.gr_product_drink AS gdg
            WHERE gdg.name_product_drink = '$add_pd_name'
        ");

        if (count($searchByname) > 0) {
            return response($result = ['status' => 'noadd']);
        } else {
            $result = DB::insert("
            INSERT INTO GR_GroupTest.dbo.gr_product_drink (name_product_drink, price_product_drink, cat_product_drink)
            VALUES (?, ?, ?)
            ", [
                $add_pd_name,
                $add_pd_price,
                $add_pd_cat_select
            ]);

            return response($result);
        }
    }


    public function getHistoryOrder()
    {

        try {
            $result = DB::select("
                SELECT
                    gdg.OrderID,
                    gdg.CustomerName,
                    FORMAT(gdg.OrderDate, 'dd/MM/yyyy', 'th-TH') AS OrderDate,
                    CONVERT(VARCHAR(5), CAST(gdg.OrderTime AS TIME), 108) AS OrderTime,
                    SUM(gdo.Quantity) AS TotalQuantity,
                    SUM(gdo.TotalPrice) AS TotalPrice
                FROM
                    GR_GroupTest.dbo.gr_orders_drink AS gdg
                INNER JOIN GR_GroupTest.dbo.gr_orderdetails_drink AS gdo ON gdg.OrderID = gdo.OrderID
                WHERE
                    gdg.OrderStatus = 2
                    AND CONVERT(DATE, gdg.OrderDate) = CONVERT(DATE, GETDATE())
                GROUP BY
                    gdg.OrderID,
                    gdg.CustomerName,
                    gdg.OrderDate,
                        gdg.OrderTime
                ORDER BY
                    gdg.OrderID DESC
            ");
        } catch (\Throwable $th) {
            //throw $th;
        }

        if ($result) {
            return response()->json($result);
        } else {
            return response()->json([], 204);
        }
    }

    public function OrderAC($id) // กดผ่านลิ้ง
    {
        // แยกส่วนของ ID เพื่อทำการแปลงรูปแบบ
        $firstPart = substr($id, 0, 6);
        $secondPart = substr($id, 6);

        $sts = true;
        // แปลงรูปแบบ I
        $formattedID = $firstPart . '/' . $secondPart; //"670401/0001"

        $check = $this->checkOrderStatus($formattedID);

        if ($check == true) {
            $DateTime = new DateTime();
            $formattedDateTime = $DateTime->format('Y-m-d H:i:s');
            $result = DB::update("
                    UPDATE GR_GroupTest.dbo.gr_orders_drink
                    SET OrderStatus = 2 ,
                        OrderConfirmTime = GETDATE( )
                    WHERE OrderID = '$formattedID'
                ");
            $lineMSG = $this->putMessageLine($formattedID); // ส่ง "670401/0001" ไปยัง ฟังชัน
            $sts = false;
        }

        $order = collect(DB::select("
            SELECT
                orders.OrderID,orders.CustomerName, orders.OrderDate,orders.OrderTime,orders.OrderConfirmTime,note,
                SUM(order_details.Quantity) AS TotalQuantity,
                SUM(order_details.TotalPrice) AS TotalPrice
            FROM
                GR_GroupTest.dbo.gr_orders_drink AS orders
            LEFT JOIN
                GR_GroupTest.dbo.gr_orderdetails_drink AS order_details ON orders.OrderID = order_details.OrderID
            WHERE
                orders.OrderID = '$formattedID'
            GROUP BY
                orders.OrderID,orders.CustomerName, orders.OrderDate,orders.OrderTime,orders.OrderConfirmTime,note
            ORDER BY
                orders.OrderID,orders.CustomerName, orders.OrderDate,orders.OrderTime,orders.OrderConfirmTime,note
        "))->first();
        if ($order) {
            $order->OrderConfirmTime = Carbon::parse($order->OrderConfirmTime);
        } else {
            return redirect()->back();
        }


        $orderDetails = DB::select("
            SELECT *
            FROM
                GR_GroupTest.dbo.gr_orderdetails_drink
            WHERE
                OrderID = '$formattedID'
        ");

        // dd($order);

        $dataOrder = ["order" => $order, "orderDetails" => $orderDetails, "sts" => $sts];

        // dd($dataOrder);
        return view('drinks.admin_order', compact('dataOrder'));
    }

    public function checkOrderStatus($id)
    {
        // dd($id);
        try {
            $order = collect(DB::select("
                select *
                from GR_GroupTest.dbo.gr_orders_drink
                where OrderID = '$id' AND OrderStatus = 1
            "))->first();

            if ($order) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function SumOrderDaily()
    {
        $OrderDaily = collect(DB::select("
            SELECT
                orders.OrderDate,
                SUM ( details.Quantity ) AS TotalQuantity,
                SUM ( details.TotalPrice ) AS TotalPrice
            FROM
                GR_GroupTest.dbo.gr_orders_drink AS orders
                LEFT JOIN GR_GroupTest.dbo.gr_orderdetails_drink AS details ON orders.OrderID = details.OrderID
            WHERE
                CONVERT ( DATE, orders.OrderDate ) = CONVERT ( DATE, GETDATE( ) )
                AND orders.OrderStatus = 2
            GROUP BY
                orders.OrderDate
        "))->first();

        $Detaildaily = DB::select("
            SELECT
                orders.OrderDate,
                details.DrinkItem,
                details.id_product,
                details.Type,
                SUM ( details.Quantity ) AS TotalQuantity,
                SUM ( details.TotalPrice ) AS TotalPrice
            FROM
                GR_GroupTest.dbo.gr_orderdetails_drink AS details
                LEFT JOIN GR_GroupTest.dbo.gr_orders_drink AS orders ON details.OrderID = orders.OrderID
            WHERE
                CONVERT ( DATE, orders.OrderDate ) = CONVERT ( DATE, GETDATE( ) ) AND orders.OrderStatus = 2
            GROUP BY
                orders.OrderDate,
                details.DrinkItem,
                details.id_product,
                details.Type
        ");
        $sumDaily = [
            'OrderDaily' => $OrderDaily,
            'Detaildaily' => $Detaildaily
        ];

        return response()->json($sumDaily);
    }
}
