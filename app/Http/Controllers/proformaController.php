<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerformInvoiceListModel;
use App\Models\Country;
use Illuminate\Support\Carbon;

class ProformaController extends Controller
{
    public function show()
    {
        $characters = '123456789';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(100, 999) . mt_rand(100, 999) . $characters[rand(0, strlen($characters) - 1)];

        while (1) {
            if (PerformInvoiceListModel::where('ReceiptNo', $pin)->count() == 0) {
                break;
            } else {
                $pin = mt_rand(100, 999) . mt_rand(100, 999) . $characters[rand(0, strlen($characters) - 1)];
            }
        }

        return view('admin.proforma.proforma_all', ['ReceiptNo' => $pin, 'countries' => Country::all()]);
    }
    public function proformaList()
    {
        $data = PerformInvoiceListModel::all();
        return view('admin.proforma.proforma_list', ['data' => $data]);
    }
    public function proformaEdit($id)
    {
        $data = PerformInvoiceListModel::where('id', $id)->get();
        return view('admin.proforma.proforma_all', ['data' => $data, 'countries' => Country::all()]);
    }
    public function destroyperforma($id)
    {
        PerformInvoiceListModel::findorfail($id)->delete();
        return back();
    }
    public function Create(Request $request)
    {
        $servicesTemp = array();
        $date = isset($request->dateValue) ? Carbon::createFromFormat('d-m-Y', $request->dateValue) : false;
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
        $Services = $request->Services;
        foreach ($Services as $item) {
            if ((json_decode(json_encode($item), true))["status"]=="true") {
                array_push($servicesTemp, $item);
            }
        }
        if (
            $date
            && $gender
            && $fullname
            && $city
            && $ReceiptNo
            && $surchargepayment
            && $surchargepaymentValue
            // && $surchargepayment2
            // && $surchargepaymentValue2
            // && $DHI
            // && $DHIValue
        ) {
            $checkReceiptNo = PerformInvoiceListModel::where('ReceiptNo', $ReceiptNo)->count();
            if ($checkReceiptNo == 0) {
                if (PerformInvoiceListModel::create([
                    'date' => $date,
                    'gender' => $gender,
                    'fullname' => $fullname,
                    'city' => $city,
                    'perNight' => 0,
                    'ReceiptNo' => $ReceiptNo,
                    'surchargepayment' => $surchargepayment,
                    'surchargepaymentUnit' => $surchargepaymentValue,
                    'surchargepayment2' => 0,
                    'surchargepaymentUnit2' => '',
                    'DHI' => $DHI != false ? $DHI : '0',
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
    }
    public function Update(Request $request, $id)
    {
        $date = isset($request->dateValue) ? Carbon::createFromFormat('d-m-Y', $request->dateValue) : false;
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
            && $ReceiptNo
            && $surchargepayment
            && $surchargepaymentValue
            // && $surchargepayment2
            // && $surchargepaymentValue2
            && $DHI
            && $DHIValue
        ) {
            $updatingRecord = PerformInvoiceListModel::where('id', $id)->first();
            $updatingRecord->date = $date;
            $updatingRecord->gender = $gender;
            $updatingRecord->fullname = $fullname;
            $updatingRecord->city = $city;
            $updatingRecord->perNight = 0;
            $updatingRecord->ReceiptNo = $ReceiptNo;
            $updatingRecord->surchargepayment = $surchargepayment;
            $updatingRecord->surchargePaymentUnit = $surchargepaymentValue;
            $updatingRecord->surchargepayment2 = 0;
            $updatingRecord->surchargePaymentUnit2 = '';
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
    }
    public function getID($ReceiptNo)
    {
        $response = PerformInvoiceListModel::where('ReceiptNo', $ReceiptNo)->first();
        return $response->id;
    }
}
