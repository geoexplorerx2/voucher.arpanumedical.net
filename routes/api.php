<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\PerformInvoiceListModel;
use Illuminate\Support\Carbon;

header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::POST('/login', 'Api\AuthController@login');
Route::POST('/create/proformainvoice', function (Request $request) {

    $date = isset($request->dateValue) ? Carbon::createFromFormat('m-d-Y', $request->dateValue) : false;
    $gender = isset($request->gender) ? $request->gender : false;
    $fullname = isset($request->fullname) ? $request->fullname : false;
    $city = isset($request->city) ? $request->city : false;
    $perNight = isset($request->PerNight) ? $request->PerNight : false;
    $ReceiptNo = isset($request->ReceiptNo) ? $request->ReceiptNo : false;
    $surchargepayment = isset($request->surchargepayment) ? $request->surchargepayment  : false;
    $surchargepaymentValue = isset($request->surchargepaymentValue) ? $request->surchargepaymentValue  : false;
    $surchargepayment2 = isset($request->surchargepayment2) ? $request->surchargepayment2  : false;
    $surchargepaymentValue2 = isset($request->surchargepaymentValue2) ? $request->surchargepaymentValue2  : false;
    $DHI = isset($request->DHI) ? $request->DHI  : false;
    $DHIValue = isset($request->DHIValue) ? $request->DHIValue  : false;

    if (
        $date
        && $gender
        && $fullname
        && $city
        && $perNight
        && $ReceiptNo
        && $surchargepayment
        && $surchargepaymentValue
        && $surchargepayment2
        && $surchargepaymentValue2
        && $DHI
        && $DHIValue
    ) {
        $checkReceiptNo = PerformInvoiceListModel::where('ReceiptNo', $ReceiptNo)->count();
        if ($checkReceiptNo == 0) {
            if (PerformInvoiceListModel::create([
                'date' => $date,
                'gender' => $gender,
                'fullname' => $fullname,
                'city' => $city,
                'perNight' => $perNight,
                'ReceiptNo' => $ReceiptNo,
                'surchargepayment' => $surchargepayment,
                'surchargepaymentUnit' => $surchargepaymentValue,
                'surchargepayment2' => $surchargepayment2,
                'surchargepaymentUnit2' => $surchargepaymentValue2,
                'DHI' => $DHI,
                'DHIUnit' => $DHIValue,
            ])) {
                return response()->json([
                    "status" => true,
                    "data" => "proforma Invoice created",
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "data" => "opration Failed",
                ]);
            }
        } else {
            return response()->json([
                "status" => false,
                "data" => "creating proforma Invoice failed",
            ]);
        }
    } else {
        return "Ops ... , Creating Perform Invoice Failed";
    }
});
Route::POST('/proforma/update/{id}', function (Request $request, $id) {
    $date = isset($request->dateValue) ? Carbon::createFromFormat('m-d-Y', $request->dateValue) : false;
    $gender = isset($request->gender) ? $request->gender : false;
    $fullname = isset($request->fullname) ? $request->fullname : false;
    $city = isset($request->city) ? $request->city : false;
    $perNight = isset($request->PerNight) ? $request->PerNight : false;
    $ReceiptNo = isset($request->ReceiptNo) ? $request->ReceiptNo : false;
    $surchargepayment = isset($request->surchargepayment) ? $request->surchargepayment  : false;
    $surchargepaymentValue = isset($request->surchargepaymentValue) ? $request->surchargepaymentValue  : false;
    $surchargepayment2 = isset($request->surchargepayment2) ? $request->surchargepayment2  : false;
    $surchargepaymentValue2 = isset($request->surchargepaymentValue2) ? $request->surchargepaymentValue2  : false;
    $DHI = isset($request->DHI) ? $request->DHI  : false;
    $DHIValue = isset($request->DHIValue) ? $request->DHIValue  : false;

    if (
        $date
        && $gender
        && $fullname
        && $city
        && $perNight
        && $ReceiptNo
        && $surchargepayment
        && $surchargepaymentValue
        && $surchargepayment2
        && $surchargepaymentValue2
        && $DHI
        && $DHIValue
    ) {
        $updatingRecord = PerformInvoiceListModel::where('id', $id)->first();
        $updatingRecord->date = $date;
        $updatingRecord->gender = $gender;
        $updatingRecord->fullname = $fullname;
        $updatingRecord->city = $city;
        $updatingRecord->perNight = $perNight;
        $updatingRecord->ReceiptNo = $ReceiptNo;
        $updatingRecord->surchargepayment = $surchargepayment;
        $updatingRecord->surchargePaymentUnit = $surchargepaymentValue;
        $updatingRecord->surchargepayment2 = $surchargepayment2;
        $updatingRecord->surchargePaymentUnit2 = $surchargepaymentValue2;
        $updatingRecord->DHI = $DHI;
        $updatingRecord->DHIUnit = $DHIValue;
        if ($updatingRecord->save()) {
            return response()->json([
                "status" => true,
                "data" => "Record Updated Successfully",
            ]);
        } else {
            return response()->json([
                "status" => false,
                "data" => "Opration Failed",
            ]);
        }
    } else {
        return "Ops ... , Creating Perform Invoice Failed";
    }
});
