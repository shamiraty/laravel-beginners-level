<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\{User, Department, Role};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $departments = Department::all();
        $roles = Role::all();
        return view('auth.register', compact('departments', 'roles'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required|unique:users',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'department_id' => $request->department_id,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('login')->with('success', 'User registered successfully!');
    }
}
