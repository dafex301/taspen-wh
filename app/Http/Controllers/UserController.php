<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;

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

    // CRUD User
    public function index()
    {
        return view('admin.user.index', [
            'users' => User::all(),
            'role' => Role::all()
        ]);
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        // Create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'role' => $data['role'],
            'password' => bcrypt($data['password']),
        ]);

        return redirect('/admin/akun')->with('success', "User successfully created.");
    }

    public function update(User $user, String $id)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'role' => 'required',
        ]);

        // Update user
        $user = User::where('id', $id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'role' => $data['role'],
        ]);

        return redirect('/admin/akun')->with('success', "User successfully updated.");
    }

    public function destroy(User $user, String $id)
    {
        $user = User::where('id', $id)->delete();

        return redirect('/admin/akun')->with('success', "User successfully deleted.");
    }
}
