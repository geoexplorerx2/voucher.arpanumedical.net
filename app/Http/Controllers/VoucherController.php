<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Hotel;
use App\Models\SalesPerson;
use App\Models\Patient;
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
            $hotels = Hotel::orderBy('hotel_id', 'asc')->get();
            $hospitals = Hospital::orderBy('hospital_id', 'asc')->get();
            $sales = SalesPerson::orderBy('name_surname','asc')->get();
            $data = array('hotels' => $hotels, 'hospitals' => $hospitals, 'sales' => $sales);
            $user = auth()->user();
            if (request()->ajax()) {
                $data = Patient::with('leadsource', 'country')
                ->when($user->hasRole('Sales Person'), function ($query) use ($user) {
                    $query->where('patients.user_id', '=', $user->id);
                });
                return DataTables::of($data)
                    ->editColumn('action', function ($item) {
                        $param = '<button type="button" class="btn btn-success action-btn registered-customer-reservation" id="'.$item->id.'" data-name="'.$item->name_surname.'"><i class="fa fa-check"></i> Choose</button>';
                        return $param;
                    })
                    ->rawColumns(['action'])
                    ->toJson();
                };
                $columns = [
                    ['data' => 'action', 'name' => 'action', 'title' => 'action', 'orderable' => false, 'searchable' => false],
                    ['data' => 'leadsource.name', 'name' => 'leadsource.name', 'title' => 'Lead Source'],
                    ['data' => 'name_surname', 'name' => 'name_surname', 'title' => 'Name'],
                    ['data' => 'phone_number', 'name' => 'phone_number', 'title' => 'Phone Number'],
                    ['data' => 'age', 'name' => 'age', 'title' => 'Age'],
                    ['data' => 'gender', 'name' => 'gender', 'title' => 'Gender'],
                    ['data' => 'country.name', 'name' => 'country.name', 'title' => 'Country'],
                    ['data' => 'email_address', 'name' => 'email_address', 'title' => 'Email Address'],
                ];
                $html = $builder->columns($columns)->parameters([
                    "pageLength" => 50
                ]);
            return view('admin.vouchers.voucher_list', compact('html'))->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
