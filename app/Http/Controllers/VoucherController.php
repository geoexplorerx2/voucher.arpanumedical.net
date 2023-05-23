<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Hotel;
use App\Models\SalesPerson;
use App\Models\Patient;
use App\Models\Voucher;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Builder $builder)
    {
        try {
            $hotels     = Hotel::orderBy('hotel_id', 'asc')->get();
            $hospitals  = Hospital::orderBy('hospital_id', 'asc')->get();
            $sales      = SalesPerson::orderBy('name_surname','asc')->get();
            $data       = array('hotels' => $hotels, 'hospitals' => $hospitals, 'sales' => $sales);
            $user       = auth()->user();
            return view('admin.vouchers.voucher_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new Voucher();
            $newData->hospital_id           = $request->input('clinic_name');
            $newData->foreseen_date         = date("Y-m-d ", strtotime($request->input('foreseen_date')));
            $newData->medical_type          = $request->input('medical_type');
            $newData->desc                  = $request->input('desc');
            $newData->patient_name          = $request->input('patient_name');
            $newData->hotel_id              = $request->input('hotel_name');
            $newData->room_type             = $request->input('room_type');
            $newData->category              = $request->input('category');
            $newData->hotel_checkin         = date("Y-m-d ", strtotime($request->input('hotel_checkin')));
            $newData->hotel_checkout        = date("Y-m-d ", strtotime($request->input('hotel_checkout')));
            $newData->confirmatiom_num      = $request->input('confirmatiom_num');
            $newData->nights                = $request->input('nights');
            $newData->arrival_date          = date("Y-m-d ", strtotime($request->input('arrival_date')));
            $newData->departure_date        = date("Y-m-d ", strtotime($request->input('departure_date')));
            $newData->arrival_time          = $request->input('arrival_time');
            $newData->departure_time        = $request->input('departure_time');
            $newData->pickup_time           = $request->input('pickup_time');
            $newData->arrival_airport       = $request->input('arrival_airport');
            $newData->departure_airport     = $request->input('departure_airport');
            $newData->airport_code          = $request->input('airport_code');
            $newData->contact_person        = $request->input('contact_person');
            $newData->payment_detail        = $request->input('payment_detail');
            $newData->important_note        = $request->input('important_note');
            $newData->clinic_balance        = $request->input('clinic_balance');
            $newData->prepayment_received   = $request->input('prepayment_received');
            $newData->currency              = $request->input('currency');
            $newData->total_package         = $request->input('total_package');
            $newData->user_id               = auth()->user()->id;
            $result                         = $newData->save();

            if ($result) {
                return response($newData->id, 200);
            }
            else {
                return response(false, 500);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
    public function show()
    {
        try {
            $user = auth()->user();
            $vouchers = Voucher::with('hospital','hotel')->orderBy('id', 'asc')->get();
            $data = array('vouchers' => $vouchers);
            return view('admin.vouchers.voucher_all')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        $hotels     = Hotel::orderBy('hotel_id', 'asc')->get();
        $hospitals  = Hospital::orderBy('hospital_id', 'asc')->get();
        $sales      = SalesPerson::orderBy('name_surname','asc')->get();
        $voucher    = Voucher::where('id', '=', $id)->first();
        $data = array('voucher' => $voucher, 'sales'=>$sales, 'hospitals'=>$hospitals, 'hotels'=>$hotels);

        return view('admin.vouchers.voucher_edit')->with($data);
    }
}
