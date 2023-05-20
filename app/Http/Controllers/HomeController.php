<?php

namespace App\Http\Controllers;

use App\Models\SalesPerson;
use App\Models\Patient;
use App\Models\TreatmentPlan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    }
}
