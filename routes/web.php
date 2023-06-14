<?php

use Illuminate\Support\Facades\Route;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\VoucherController::class, 'index'])->name('home');
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE';
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::GET('getCurrencies', 'CurrencyController@getCurrencies');
    Route::GET('hasRole', 'UserController@hasRole');

    //Users Operations
    Route::GET('definitions/users', 'UserController@index')->middleware(['middleware' => 'permission:show users'])->name('user.index');
    Route::POST('definitions/users/store', 'UserController@store')->middleware(['middleware' => 'permission:create users'])->name('user.store');
    Route::GET('definitions/users/edit/{id}', 'UserController@edit')->middleware(['middleware' => 'permission:edit users'])->name('user.edit');
    Route::POST('definitions/users/update/{id}', 'UserController@update')->middleware(['middleware' => 'permission:edit users'])->name('user.update');
    Route::GET('definitions/users/delete/{id}', 'UserController@destroy')->middleware(['middleware' => 'permission:delete users'])->name('user.destroy');

    //Roles and Permissions
    Route::GET('roles', 'RolePermissionController@index')->middleware(['middleware' => 'permission:show roles'])->name('role.index');
    Route::GET('roles/create', 'RolePermissionController@create')->middleware(['middleware' => 'permission:create roles'])->name('role.create');
    Route::POST('roles/store', 'RolePermissionController@store')->middleware(['middleware' => 'permission:create roles'])->name('role.store');
    Route::GET('roles/edit/{id}', 'RolePermissionController@edit')->middleware(['middleware' => 'permission:edit roles'])->name('role.edit');
    Route::POST('roles/update/{id}', 'RolePermissionController@update')->middleware(['middleware' => 'permission:edit roles'])->name('role.update');
    Route::GET('roles/delete/{id}', 'RolePermissionController@destroy')->middleware(['middleware' => 'permission:delete roles'])->name('role.destroy');
    Route::GET('roles/clone/{id}', 'RolePermissionController@cloneRole')->middleware(['middleware' => 'permission:edit roles']);
    //Roles and Permissions end

    //Sales Persons
    Route::GET('definitions/salespersons', 'SalesPersonController@index')->middleware(['middleware' => 'permission:show sales person'])->name('salesperson.index');
    Route::POST('definitions/salespersons/store', 'SalesPersonController@store')->middleware(['middleware' => 'permission:create sales person'])->name('salesperson.store');
    Route::GET('definitions/salespersons/edit/{id}', 'SalesPersonController@edit')->middleware(['middleware' => 'permission:edit sales person'])->name('salesperson.edit');
    Route::POST('definitions/salespersons/update/{id}', 'SalesPersonController@update')->middleware(['middleware' => 'permission:edit sales person'])->name('salesperson.update');
    Route::GET('definitions/salespersons/destroy/{id}', 'SalesPersonController@destroy')->middleware(['middleware' => 'permission:delete sales person'])->name('salesperson.destroy');
    //Sales Persons

    //Hospitals
    Route::GET('definitions/hospitals', 'HospitalController@index')->middleware(['middleware' => 'permission:show sales person'])->name('hospital.index');
    Route::POST('definitions/hospitals/store', 'HospitalController@store')->middleware(['middleware' => 'permission:create sales person'])->name('hospital.store');
    Route::GET('definitions/hospitals/edit/{id}', 'HospitalController@edit')->middleware(['middleware' => 'permission:edit sales person'])->name('hospital.edit');
    Route::POST('definitions/hospitals/update/{id}', 'HospitalController@update')->middleware(['middleware' => 'permission:edit sales person'])->name('hospital.update');
    Route::GET('definitions/hospitals/destroy/{id}', 'HospitalController@destroy')->middleware(['middleware' => 'permission:delete sales person'])->name('hospital.destroy');
    //Hospitals

    //Hotels
    Route::GET('definitions/hotels', 'HotelController@index')->middleware(['middleware' => 'permission:show sales person'])->name('hotel.index');
    Route::POST('definitions/hotels/store', 'HotelController@store')->middleware(['middleware' => 'permission:create sales person'])->name('hotel.store');
    Route::GET('definitions/hotels/edit/{id}', 'HotelController@edit')->middleware(['middleware' => 'permission:edit sales person'])->name('hotel.edit');
    Route::POST('definitions/hotels/update/{id}', 'HotelController@update')->middleware(['middleware' => 'permission:edit sales person'])->name('hotel.update');
    Route::GET('definitions/hotels/destroy/{id}', 'HotelController@destroy')->middleware(['middleware' => 'permission:delete sales person'])->name('hotel.destroy');
    //Hotels

    Route::GET('voucher', 'VoucherController@index')->name('voucher');
    Route::GET('voucher/it', 'VoucherController@indexIT')->name('it.voucher');
    Route::GET('voucher/es', 'VoucherController@indexES')->name('es.voucher');
    Route::POST('vouchers/store', 'VoucherController@store')->name('voucher.store');
    Route::GET('vouchers/list', 'VoucherController@show')->name('voucher.show');
    Route::GET('vouchers/edit/{id}', 'VoucherController@edit')->name('voucher.edit');
    Route::GET('vouchers/es/edit/{id}', 'VoucherController@editES')->name('voucher_es.edit');
    Route::GET('vouchers/it/edit/{id}', 'VoucherController@editIT')->name('voucher_it.edit');
    Route::POST('vouchers/update/{id}', 'VoucherController@update')->middleware(['middleware' => 'permission:edit sales person'])->name('voucher.update');
    Route::GET('vouchers/destroy/{id}', 'VoucherController@destroy')->middleware(['middleware' => 'permission:delete sales person'])->name('voucher.destroy');

    // PROFORMA INVOICE REQUESTS

    Route::GET('/proforma', 'proformaController@show')->name('proforma.show');
    Route::GET('/proforma/list', 'proformaController@proformaList')->name('proforma.List');
    Route::GET('/proforma/edit/{id}', 'proformaController@proformaEdit')->name('proforma.edit');
    Route::GET('/proforma/destroy/{id}', 'proformaController@destroyperforma')->name('proforma.destroy');
});
