<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        try {
            $hospitals = Hospital::orderBy('hospital_id', 'asc')->get();
            $data = array('hospitals' => $hospitals, 'pageTitle' => 'New Sales Person');
            return view('admin.hospitals.hospitals_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new Hospital();
            $newData->hospital_name = $request->input('name');
            $newData->hospital_address = $request->input('hospitalAddress');
            $newData->hospital_phone = $request->input('phone');
            $newData->hospital_email = $request->input('email');
            $newData->hospital_zone = $request->input('hospitalZone');
            $newData->hospital_city = $request->input('hospitalCity');
            $newData->short_desc = $request->input('short_desc');
            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return redirect()->route('hospital.index')->with('message', 'New Hospital Added Successfully!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
    public function create()
    {
        return view('admin.hospitals.new_hospital');
    }
    public function edit($id)
    {
        $sales_person = Hospital::where('id', '=', $id)->first();

        return view('admin.hospitals.edit_hospital', ['sales_persons' => $sales_person]);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['hospital_name']      = $request->input('hospital_name');
            $temp['hospital_address']   = $request->input('hospital_address');
            $temp['hospital_phone']     = $request->input('hospital_phone');
            $temp['hospital_email']     = $request->input('hospital_email');
            $temp['hospital_zone']      = $request->input('hospital_zone');
            $temp['hospital_city']      = $request->input('hospital_city');
            $temp['hospital_map']       = $request->input('hospital_map');
            $temp['short_desc']         = $request->input('short_desc');

            if (Hospital::where('id', '=', $id)->update($temp)) {
                return redirect()->route('hospital.index')->with('message', 'Hospital Updated Successfully!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id){
        Hospital::where('hospital',$id)->delete();
        return redirect()->route('hospital.index')->with('message', 'Hospital Deleted Successfully!');
    }
}
