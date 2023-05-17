<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use Cache;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $users = User::with("roles")->get();
            $roles = Role::pluck('name', 'name')->all();
            $data = array('users' => $users, 'roles' => $roles);

            return view('admin.users.users_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->file('file') != NULL) {

                if ($request->input('image_path')) {
                    unlink(public_path('/photos/'.$request->input('image_path')));
                }
                $image = $request->file('file');
                $FileName = $image->hashName();
                $image->move(public_path('photos'), $FileName);
            }else{
                $FileName = NULL;
            }
            $newData = new User;
            $newData->image_path = $FileName;
            $newData->name = $request->input('name');
            $newData->email = $request->input('email');
            $newData->password = bcrypt($request->input('password'));
            $result = $newData->save();

            if ($result) {
                $newData->assignRole($request->input('roles'));
                if ($request->input('roles') == 'Doctor') {
                    return redirect()->route('doctor.index')->with('message', 'New Doctor Added Successfully!');
                }else{
                    return redirect()->route('user.index')->with('message', 'New User Added Successfully!');

                }            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($id)
    {
        try {
            $user = User::find($id);
            $roles = Role::pluck('name', 'name')->all();
            $userRole = $user->roles->pluck('name', 'name')->all();

            return view('users.edit_user', compact('user', 'roles', 'userRole'));
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        try {
            $user = User::find($id);

            $roles = Role::pluck('name', 'name')->all();

            $userRole = $user->roles->pluck('name', 'name')->all();

            return view('admin.users.edit_user', compact('user', 'roles', 'userRole'));
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if ($request->file('file') != NULL) {

                if ($request->input('image_path')) {
                    unlink(public_path('/photos/'.$request->input('image_path')));
                }
                $image = $request->file('file');
                $FileName = $image->hashName();
                $image->move(public_path('photos'), $FileName);
                $temp['image_path'] = $FileName;
            }
            $temp['name'] = $request->input('name');
            $temp['email'] = $request->input('email');
            $temp['note'] = $request->input('note');

            if ($request->has('password') && !empty($request->input('password'))) {
                $temp['password'] = bcrypt($request->input('password'));
            }

            $updateSelectedData = User::where('id', '=', $id)->first();
            if ($updateSelectedData->update($temp)) {
                DB::table('model_has_roles')->where('model_id', $id)->delete();
                $updateSelectedData->assignRole($request->input('roles'));
                if ($request->input('roles') == 'Doctor') {
                    return redirect()->route('doctor.index')->with('message', 'Doctor Updated Successfully!');
                }else{
                    return redirect()->route('user.index')->with('message', 'User Updated Successfully!');
                }
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Request $request,$id)
    {
        try {
            $user= User::find($id);

            if ($user->roles->first()->name == 'Doctor') {
                User::find($id)->delete();
                return redirect()->route('doctor.index')->with('message', 'Doctor Deleted Successfully!');
            }else{
                User::find($id)->delete();
                return redirect()->route('user.index')->with('message', 'User Deleted Successfully!');
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
