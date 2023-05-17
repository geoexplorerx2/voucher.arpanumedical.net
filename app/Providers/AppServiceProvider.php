<?php

namespace App\Providers;

use App\Models\User;
use App\Models\TreatmentPlan;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $users = User::all();

        $data = array('users' => $users);
        view()->share($data);
    }
}
