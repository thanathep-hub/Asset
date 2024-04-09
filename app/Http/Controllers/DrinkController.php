<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DrinkController extends Controller
{
    public function connect_admin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string', // ต้องมีค่าและเป็นสตริง
        ]);

        // ถ้าข้อมูลไม่ถูกต้อง
        if ($validator->fails()) {
            // ทำงานที่ต้องการเมื่อข้อมูลไม่ถูกต้อง
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->code === 'dev1234') {
            return redirect('/drink/admin');
        }
    }
    public function getMenus()
    {
        $result = DB::select('
            SELECT * FROM GR_GroupTest.dbo.gr_product_drink
            ORDER BY GR_GroupTest.dbo.gr_product_drink.name_product_drink ASC
        ');

        return $result;
    }

    public function drinks_success()
    {

        return view('drinks.success');
    }

    public function insertCart(Request $request)
    {

        $res = $this->createOrder($request->nameCustomer, $request->note); // ส่งคืนค่า order id back

        $orderDetail = $this->createOrderDetail(
            $request->cart,
            $res['orderID']
        );

        $msg = $this->createMSG($request->cart);

        $lineSendOrder = $this->putMessageLine(
            $msg['result'],
            $msg['totalPrice'],
            $res,
            $request->nameCustomer,
            $request->note
        );

        $putMessageLineAdmin = $this->putMessageLineAdmin( // change putMessageLineAdmin
            $msg['result'],
            $msg['totalPrice'],
            $res,
            $request->nameCustomer,
            $request->note
        );

        if ($lineSendOrder) {
            session()->put(
                "orderID",
                $res['orderID']
            );
            session()->put("cartSS", $request->cart);
            session()->put("customerSS", $request->nameCustomer);
            session()->put('note', $request->note);
            session()->put("totalSS", $msg['totalPrice']);
            return $res['orderID'];
        } else {
            return redirect('/');
        }
    }

    public function idOrder()
    {
        $lastTwoDigits = substr((date('Y') + 543), -2);
        $ymd = $lastTwoDigits . date('m') . date('d');

        $id_order_last = collect(DB::select("
            SELECT TOP 1  gdg.OrderID
            FROM GR_GroupTest.dbo.gr_orders_drink AS gdg
            ORDER BY  gdg.OrderID DESC;
        "))->first();

        $integerValue = 0;
        if ($id_order_last) {
            $substring = substr($id_order_last->OrderID, 0, 6);
            $substringCount = substr($id_order_last->OrderID, -4);
            $integerValue = intval($substringCount);
        } else {
            $substring = $ymd;
        }

        $lastTwoDigits = substr((date('Y') + 543), -2);
        $ymd = $lastTwoDigits . date('m') . date('d');

        $contOrder = 0;
        if ($substring === $ymd) {
            $contOrder = $integerValue + 1;
        } else {
            $contOrder = 1;
        }

        $fourDigitString = str_pad($contOrder, 4, '0', STR_PAD_LEFT);
        $result = $ymd . "/" . $fourDigitString;

        return $result;
    }

    public function createOrder($name, $note)
    {
        $orderID = $this->idOrder();
        $orderDate = date('Y-m-d'); // วันที่สั่งซื้อ
        $orderTime = date('H:i:s'); // เวลาที่สั่งซื้อ
        $orderStatus = 1; // สร้าง OrderStatus

        $NameCustomer = $name;


        $orderData = [
            'OrderID' => $orderID,
            'NameCustomer' => $NameCustomer,
            'OrderDate' => $orderDate,
            'OrderTime' => $orderTime,
            'OrderStatus' => $orderStatus,
            'Note' => $note,
        ];

        $insertNewOrder = DB::insert("
            INSERT INTO GR_GroupTest.dbo.gr_orders_drink (OrderID, CustomerName, OrderDate, OrderTime, OrderStatus,Note)
            VALUES (?, ?, ?, ?, ?,?)
            ", [
            $orderData['OrderID'],
            $orderData['NameCustomer'],
            $orderData['OrderDate'],
            $orderData['OrderTime'],
            $orderData['OrderStatus'],
            $orderData['Note'],
        ]);

        return $res = [
            'orderID' => $orderID,
            'orderDate' => $orderDate,
            'orderTime' => $orderTime
        ];

        // return $orderID;
    }

    public function createOrderDetail($dataCart, $orderID)
    {

        foreach ($dataCart as $item) {
            $orderID = $orderID;
            $productID = $item['productid'];
            $nameProduct = $item['nameProduct'];
            $cupSize = $item['size'];
            $type = $item['type'];
            $sweetness = $item['syrup'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $totalPrice = $item['totalPrice'];

            // แทรกข้อมูลลงในฐานข้อมูล
            try {
                $status = DB::insert("
                        INSERT INTO GR_GroupTest.dbo.gr_orderdetails_drink (OrderID, id_product, DrinkItem, CupSize, Type, Sweetness, Quantity, price, TotalPrice)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
                ", [
                    $orderID,
                    $productID,
                    $nameProduct,
                    $cupSize,
                    $type,
                    $sweetness,
                    $quantity,
                    $price,
                    $totalPrice
                ]);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }

    public function createMSG($cart)
    {
        $text = "";
        $msg = "";
        $totalPrice = 0;
        if ($cart) {
            foreach ($cart as $index => $item) {
                $text = "";
                $text .= ($index + 1) . ". ";
                $text .= $item['nameProduct'] . " ";
                $text .= $item['type'] . " (";
                // $sr = substr($item['syrup'], 7, 6);
                $sr =
                    substr($item['syrup'], strpos($item['syrup'], ' ') + 1);
                $text .= $sr . ") ";
                // $text = $this->cretext($text);
                // $text .= " ";
                $msg .= $text . $item['quantity'] . " แก้ว\n";
                $totalPrice = $totalPrice + $item['totalPrice'];
            }
            $result = $msg;
        }

        return $res = [
            'result' => $result,
            'totalPrice' => $totalPrice
        ];
    }
    public function cretext($text)
    {
        $text_without_tone_marks = preg_replace('/[\x{0E31}\x{0E34}-\x{0E3A}]/u', '', $text); // ลบสระวรรณยุกต์ออกจากข้อความ
        $length = mb_strlen($text_without_tone_marks, 'UTF-8');

        while ($length < 26) {
            $text = $text . "       ";
            // $text_without_tone_marks .= " "; // เพิ่มช่องว่างในตัวแปร $text_without_tone_marks
            $length++; // เพิ่มความยาวของ $text_without_tone_marks
        }

        return $text; // รีเทิร์นค่า $list_menu_text ที่ถูกแก้ไขให้กับตัวแปร $text
    }

    public function putMessageLine($msg, $totalPrice, $res, $name, $note)
    {
        $date = Carbon::createFromFormat('Y-m-d', $res['orderDate'])->locale('th')->isoFormat('YYYY'); // 02/04/2567
        $lastTwoDigits = ($date + 543);
        $ymd = date('d') . "/" . date('m') . "/" . $lastTwoDigits;
        $orderTime = substr($res['orderTime'], 0, 5); // 09:50

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        date_default_timezone_set("Asia/Bangkok");

        // $sToken = "aE5tlxsmvWBuSA6dYbeUs5Kew6tw2LOQ7Zw0N8LTTRo"; // token line
        // $sToken = "9gZvubJwRAJUnxxZp2Ny30IJOl7AIgfpJdANd7D6z8U"; //test line

        $sToken = "GWUxUPNBlHHlpD8GiBSWH4QdGyxESkAzCeqLkrKGZYz"; // ห้องตะวันยิ้ม

        // แยกส่วนของ ID เพื่อทำการแปลงรูปแบบ
        $firstPart = substr($res['orderID'], 0, 6);
        $secondPart = substr($res['orderID'], 7);

        // แปลงรูปแบบ ID
        $formattedID = $firstPart . $secondPart;

        $sMessage = "\nคำสั่งซื้อ #" . $res['orderID'] . "\n";
        $sMessage .= "วันที่ " . $ymd . " เวลา " . $orderTime . "น.\n";
        $sMessage .= "ผู้สั่ง : " . $name . "\n";
        $list = "รายการ" . " / จำนวน \n";
        // $list .= "                      " . "จำนวน\n";
        $sMessage .= $list . "===========================\n";
        $sMessage .= $msg;
        $sMessage .= "===========================\n";
        $sMessage .= "*หมายเหตุ : " . $note . "\n===========================\n";
        $sMessage .=  "รวมราคา " . $totalPrice . " บาท\nรอยืนยันออเดอร์\n";


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
            echo 'error:' . curl_error($chOne);
        } else {
            $result_ = json_decode($result, true);
            echo "status : " . $result_['status'];
            echo "message : " . $result_['message'];
        }
        curl_close($chOne);
        if ($result) {
            $rt = "ทำรายการสั่งซื้อสำเร็จ!";
        } else {
            $rt = "ทำรายการสั่งซื้อไม่สำเร็จ";
        }

        return $result;
    }

    public function putMessageLineAdmin($msg, $totalPrice, $res, $name, $note)
    {
        $date = Carbon::createFromFormat('Y-m-d', $res['orderDate'])->locale('th')->isoFormat('YYYY'); // 02/04/2567
        $lastTwoDigits = ($date + 543);
        $ymd = date('d') . "/" . date('m') . "/" . $lastTwoDigits;
        $orderTime = substr($res['orderTime'], 0, 5); // 09:50

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        date_default_timezone_set("Asia/Bangkok");

        // $sToken = "aE5tlxsmvWBuSA6dYbeUs5Kew6tw2LOQ7Zw0N8LTTRo"; // token line
        // $sToken = "9gZvubJwRAJUnxxZp2Ny30IJOl7AIgfpJdANd7D6z8U"; //test line

        $sToken = "vX3a7FVdtbLJ5SoiqXfzZwYcgMz1JDJgsGmJpO8k7cN"; // สำหรับรับออเดอร์

        // แยกส่วนของ ID เพื่อทำการแปลงรูปแบบ
        $firstPart = substr($res['orderID'], 0, 6);
        $secondPart = substr($res['orderID'], 7);

        // แปลงรูปแบบ ID
        $formattedID = $firstPart . $secondPart;

        $sMessage = "\nคำสั่งซื้อ #" . $res['orderID'] . "\n";
        $sMessage .= "วันที่ " . $ymd . " เวลา " . $orderTime . "น.\n";
        $sMessage .= "ผู้สั่ง : " . $name . "\n";
        $list = "รายการ" . " / จำนวน \n";
        // $list .= "                      " . "จำนวน\n";
        $sMessage .= $list . "===========================\n";
        $sMessage .= $msg;
        $sMessage .= "===========================\n";
        $sMessage .= "*หมายเหตุ : " . $note . "\n===========================\n";
        $sMessage .=  "รวมราคา " . $totalPrice . " บาท\nรับออเดอร์ http://assets.advanceseeds.com/drink/admin/order/" . $formattedID . " \n";


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
            echo 'error:' . curl_error($chOne);
        } else {
            $result_ = json_decode($result, true);
            echo "status : " . $result_['status'];
            echo "message : " . $result_['message'];
        }
        curl_close($chOne);
        if ($result) {
            $rt = "ทำรายการสั่งซื้อสำเร็จ!";
        } else {
            $rt = "ทำรายการสั่งซื้อไม่สำเร็จ";
        }

        return $result;
    }

    public function success()
    {
        // log(session('cartSS'));
        session()->flush(); // remove all data from the session
        return redirect('/drink');
    }

    public function test()
    {
        $test = DB::select("
        SELECT top 10 * FROM PchInvAndProject.dbo.AssAssetD
        ");
        dd($test);

        $lastTwoDigits = substr((date('Y') + 543), -2);
        $ymd = $lastTwoDigits . date('m') . date('d');

        $id_order_last = collect(DB::select("
            SELECT TOP 1  gdg.OrderID
            FROM GR_GroupTest.dbo.gr_orders_drink AS gdg
            ORDER BY  gdg.OrderID DESC;
        "))->first();

        $integerValue = 0;
        if ($id_order_last) {
            $substring = substr($id_order_last->OrderID, 0, 6);
            $substringCount = substr($id_order_last->OrderID, -4);
            $integerValue = intval($substringCount);
        } else {
            $substring = $ymd;
        }

        $lastTwoDigits = substr((date('Y') + 543), -2);
        $ymd = $lastTwoDigits . date('m') . date('d');

        $contOrder = 0;
        if ($substring === $ymd) {
            $contOrder = $integerValue + 1;
        } else {
            $contOrder = 1;
        }

        $fourDigitString = str_pad($contOrder, 4, '0', STR_PAD_LEFT);
        $result = $ymd . "/" . $fourDigitString;

        return $result;
    }
}