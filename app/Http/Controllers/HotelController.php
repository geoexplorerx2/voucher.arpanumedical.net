<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        try {
            $hotels = Hotel::orderBy('hotel_id', 'asc')->get();
            $data = array('hotels' => $hotels, 'pageTitle' => 'New Hotel');
            return view('admin.hotels.hotels_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new Hotel();
            $newData->hotel_name                    = $request->input('name');
            $newData->hotel_address                 = $request->input('hotelAddress');
            $newData->hotel_phone                   = $request->input('phone');
            $newData->hotel_email                   = $request->input('email');
            $newData->hotel_zone                    = $request->input('hotelZone');
            $newData->hotel_city                    = $request->input('hotelCity');
            $newData->hotel_reservation_info_emails = $request->input('hotel_reservation_info_emails');
            $newData->short_desc                    = $request->input('short_desc');
            $newData->user_id                       = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return redirect()->route('hotel.index')->with('message', 'New Hotel Added Successfully!');
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
        return view('admin.hotels.new_hotel');
    }
    public function edit($id)
    {
        $hotel = Hotel::where('id', '=', $id)->first();

        return view('admin.hotels.edit_hotel', ['hotels' => $hotel]);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['hotel_name']                          = $request->input('hotel_name');
            $temp['hotel_address']                       = $request->input('hotel_address');
            $temp['hotel_phone']                         = $request->input('hotel_phone');
            $temp['hotel_email']                         = $request->input('hotel_email');
            $temp['hotel_zone']                          = $request->input('hotel_zone');
            $temp['hotel_city']                          = $request->input('hotel_city');
            $temp['hotel_map']                           = $request->input('hotel_map');
            $temp['short_desc']                          = $request->input('short_desc');
            $temp['hotel_reservation_info_emails']       = $request->input('hotel_reservation_info_emails');

            if (Hotel::where('id', '=', $id)->update($temp)) {
                return redirect()->route('hotel.index')->with('message', 'Hotel Updated Successfully!');
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
        Hotel::where('hotel_id',$id)->delete();
        return redirect()->route('hotel.index')->with('message', 'Hotel Deleted Successfully!');
    }
}
