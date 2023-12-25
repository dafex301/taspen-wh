<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Bidang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate()
    {
    }

    public function register()
    {
        return view('auth.register');
    }

    public function create(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        auth()->login($user);

        return redirect('/')->with('success', "Account successfully registered.");
    }

    public function show()
    {
        return view('profile');
    }

    public function updatePassword()
    {

        // first get the current user id
        $id = auth()->user()->id;

        // then find the user from database
        $user = User::findOrFail($id);

        // validate the current password with password in database
        if (Hash::check(request('current_password'), $user->password)) {
            // now we are sure that current password is valid
            // go ahead and update the password
            $user->password = request('new_password');
            $user->save();

            return redirect('/profile')->with('success', "Password successfully updated.");
        } else {
            return redirect('/profile')->with('error', "Current password does not match.");
        }

        return redirect('/profile')->with('error', "Something went wrong.");
    }

    // CRUD User
    public function index()
    {
        return view('admin.user.index', [
            'users' => User::orderBy('updated_at', 'desc')->get(),
            'role' => Role::all(),
            'bidang' => Bidang::all()
        ]);
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'username' => 'required',
            'nik' => 'required',
            'role' => 'required',
            'bidang' => 'required',
            'password' => 'required',
        ]);

        // Create user
        $user = User::create([
            'nama' => $data['name'],
            'username' => $data['username'],
            'nik' => $data['nik'],
            'role' => $data['role'],
            'bidang' => $data['bidang'],
            'password' => bcrypt($data['password']),
        ]);

        return redirect('/umum/akun')->with('success', "User successfully created.");
    }

    public function update(User $user, String $id)
    {
        $data = request()->validate([
            'nama' => 'required',
            'username' => 'required',
            'nik' => 'required',
            'role' => 'required',
            'bidang' => 'required',
        ]);

        // Update user
        $user = User::where('id', $id)->update([
            'nama' => $data['nama'],
            'username' => $data['username'],
            'nik' => $data['nik'],
            'role' => $data['role'],
            'bidang' => $data['bidang'],
        ]);

        return redirect('/umum/users')->with('success', "User successfully updated.");
    }

    public function destroy(User $user, String $id)
    {
        $user = User::where('id', $id)->delete();

        return redirect('/umum/users')->with('success', "User successfully deleted.");
    }
}
