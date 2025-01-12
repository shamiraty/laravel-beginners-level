<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/'); // Replace with your intended route
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Show registration form
    public function showRegisterForm()
    {
        $departments = Department::all();
        $roles = Role::all();
        $users = User::all();
    
        // Count number of users by role
        $roleCounts = User::select('role_id', \DB::raw('count(*) as users_count'))
                         ->groupBy('role_id')
                         ->with('role')  // To get role names
                         ->get();
    
        // Count number of users by department
        $departmentCounts = User::select('department_id', \DB::raw('count(*) as users_count'))
                                ->groupBy('department_id')
                                ->with('department')  // To get department names
                                ->get();
    
        return view('auth.register', compact('departments', 'roles', 'users', 'roleCounts', 'departmentCounts'));
    }
    
    // Handle registration
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'phone' => 'required|string|max:15',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'department_id' => $validated['department_id'],
            'role_id' => $validated['role_id'],
        ]);

        return redirect()->route('register')->with('success', 'Registration successful.');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

     // Show user details
     public function show(User $user)
     {
         return view('auth.user_view', compact('user'));
     }
 
     // Delete user
     public function destroy(User $user)
     {
         $user->delete();
 
         return redirect()->route('register')->with('success', 'User deleted successfully.');
     }

     // Edit user
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $departments = Department::all();
        $roles = Role::all();
        return view('auth.edit', compact('user', 'departments', 'roles'));
    }

    // Update user
    public function updateUser(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->update($validated);

        return redirect()->route('register')->with('success', 'User updated successfully');
    }  
}
