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
            $hotels     = Hotel::orderBy('id', 'asc')->get();
            $hospitals  = Hospital::orderBy('id', 'asc')->get();
            $sales      = SalesPerson::orderBy('name_surname','asc')->get();
            $data       = array('hotels' => $hotels, 'hospitals' => $hospitals, 'sales' => $sales);
            $user       = auth()->user();
            return view('admin.vouchers.voucher_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
    public function indexIT(Builder $builder)
    {
        try {
            $hotels     = Hotel::orderBy('id', 'asc')->get();
            $hospitals  = Hospital::orderBy('id', 'asc')->get();
            $sales      = SalesPerson::orderBy('name_surname','asc')->get();
            $data       = array('hotels' => $hotels, 'hospitals' => $hospitals, 'sales' => $sales);
            $user       = auth()->user();
            return view('admin.vouchers.voucher_it')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
    public function indexES(Builder $builder)
    {
        try {
            $hotels     = Hotel::orderBy('id', 'asc')->get();
            $hospitals  = Hospital::orderBy('id', 'asc')->get();
            $sales      = SalesPerson::orderBy('name_surname','asc')->get();
            $data       = array('hotels' => $hotels, 'hospitals' => $hospitals, 'sales' => $sales);
            $user       = auth()->user();
            return view('admin.vouchers.voucher_es')->with($data);
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
            $newData->hospital_img          = $request->input('hospital_img');
            $newData->foreseen_date         = $request->input('foreseen_date');
            $newData->medical_type          = $request->input('medical_type');
            $newData->desc                  = $request->input('desc');
            $newData->patient_name          = $request->input('patient_name');
            $newData->hotel_id              = $request->input('hotel_name');
            $newData->hotel_img             = $request->input('hotel_img');
            $newData->room_type             = $request->input('room_type');
            $newData->category              = $request->input('category');
            $newData->hotel_checkin         = $request->input('hotel_checkin');
            $newData->hotel_checkout        = $request->input('hotel_checkout');
            $newData->confirmation_num      = $request->input('confirmatiom_num');
            $newData->nights                = $request->input('nights');
            $newData->arrival_date          = $request->input('arrival_date');
            $newData->departure_date        = $request->input('departure_date');
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
            $newData->flight_number         = $request->input('flight_number');
            $newData->code_img              = $request->input('code_img');
            $newData->dhi_supplement        = $request->input('dhi_supplement');
            $newData->language              = $request->input('language');
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
            $vouchers = Voucher::with('hospital','hotel')->orderBy('created_at', 'desc')->get();
            $data = array('vouchers' => $vouchers);
            return view('admin.vouchers.voucher_all')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        $hotels         = Hotel::orderBy('id', 'asc')->get();
        $hospitals      = Hospital::orderBy('id', 'asc')->get();
        $sales          = SalesPerson::orderBy('name_surname','asc')->get();
        $voucher        = Voucher::where('id', '=', $id)->with('hospital','hotel')->first();
        $names = explode(' - ', $voucher->contact_person);
        $contactPersons = [];
        foreach ($names as $name) {
            $contactPerson = SalesPerson::where('phone_number', '=', $name)->first();
            if ($contactPerson) {
                $contactPersons[] = $contactPerson;
            }
        }
        $data = array('contactPersons' => $contactPersons, 'voucher' => $voucher, 'sales'=>$sales, 'hospitals'=>$hospitals, 'hotels'=>$hotels);

        return view('admin.vouchers.voucher_edit')->with($data);
    }
    public function editES($id)
    {
        $hotels         = Hotel::orderBy('id', 'asc')->get();
        $hospitals      = Hospital::orderBy('id', 'asc')->get();
        $sales          = SalesPerson::orderBy('name_surname','asc')->get();
        $voucher        = Voucher::where('id', '=', $id)->with('hospital','hotel')->first();
        $names = explode(' - ', $voucher->contact_person);
        $contactPersons = [];
        foreach ($names as $name) {
            $contactPerson = SalesPerson::where('phone_number', '=', $name)->first();
            if ($contactPerson) {
                $contactPersons[] = $contactPerson;
            }
        }
        $data = array('contactPersons' => $contactPersons, 'voucher' => $voucher, 'sales'=>$sales, 'hospitals'=>$hospitals, 'hotels'=>$hotels);

        return view('admin.vouchers.voucher_edit_es')->with($data);
    }

    public function editIT($id)
    {
        $hotels         = Hotel::orderBy('id', 'asc')->get();
        $hospitals      = Hospital::orderBy('id', 'asc')->get();
        $sales          = SalesPerson::orderBy('name_surname','asc')->get();
        $voucher        = Voucher::where('id', '=', $id)->with('hospital','hotel')->first();
        $names = explode(' - ', $voucher->contact_person);
        $contactPersons = [];
        foreach ($names as $name) {
            $contactPerson = SalesPerson::where('phone_number', '=', $name)->first();
            if ($contactPerson) {
                $contactPersons[] = $contactPerson;
            }
        }
        $data = array('contactPersons' => $contactPersons, 'voucher' => $voucher, 'sales'=>$sales, 'hospitals'=>$hospitals, 'hotels'=>$hotels);

        return view('admin.vouchers.voucher_edit_it')->with($data);
    }
    public function update(Request $request, $id)
    {
        try {
            $temp['hospital_id']           = $request->input('clinic_name');
            $temp['hospital_img']          = $request->input('hospital_img');
            $temp['foreseen_date']         = $request->input('foreseen_date');
            $temp['medical_type']          = $request->input('medical_type');
            $temp['desc']                  = $request->input('desc');
            $temp['patient_name']          = $request->input('patient_name');
            $temp['hotel_id']              = $request->input('hotel_name');
            $temp['hotel_img']             = $request->input('hotel_img');
            $temp['room_type']             = $request->input('room_type');
            $temp['category']              = $request->input('category');
            $temp['hotel_checkin']         = $request->input('hotel_checkin');
            $temp['hotel_checkout']        = $request->input('hotel_checkout');
            $temp['confirmation_num']      = $request->input('confirmatiom_num');
            $temp['nights']                = $request->input('nights');
            $temp['arrival_date']          = $request->input('arrival_date');
            $temp['departure_date']        = $request->input('departure_date');
            $temp['arrival_time']          = $request->input('arrival_time');
            $temp['departure_time']        = $request->input('departure_time');
            $temp['pickup_time']           = $request->input('pickup_time');
            $temp['arrival_airport']       = $request->input('arrival_airport');
            $temp['departure_airport']     = $request->input('departure_airport');
            $temp['airport_code']          = $request->input('airport_code');
            $temp['contact_person']        = $request->input('contact_person');
            $temp['payment_detail']        = $request->input('payment_detail');
            $temp['important_note']        = $request->input('important_note');
            $temp['clinic_balance']        = $request->input('clinic_balance');
            $temp['prepayment_received']   = $request->input('prepayment_received');
            $temp['currency']              = $request->input('currency');
            $temp['total_package']         = $request->input('total_package');
            $temp['flight_number']         = $request->input('flight_number');
            $temp['code_img']              = $request->input('code_img');
            $temp['dhi_supplement']        = $request->input('dhi_supplement');
            $temp['user_id']               = auth()->user()->id;

            if (Voucher::where('id', '=', $id)->update($temp)) {
                return response($id, 200);
            }
            else {
                return response(false, 500);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
    public function destroy($id){
        Voucher::where('id', '=',$id)->delete();
        return redirect()->route('voucher.show')->with('message', 'Voucher Deleted Successfully!');
    }
}
