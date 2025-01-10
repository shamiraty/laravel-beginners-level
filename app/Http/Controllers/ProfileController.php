<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Display the user profile form
    public function show()
    {
        return view('profile.edit');
    }

    // Update the user's password
    public function update(Request $request)
    {
        $user = Auth::user(); // Get the current logged-in user

        // Validate the input fields
        $request->validate([
            'password' => [
                'required', 
                'string', 
                'min:8', 
                'confirmed', 
                function ($attribute, $value, $fail) use ($user) {
                    if (Hash::check($value, $user->password)) {
                        $fail('The new password must not be the same as the old password.');
                    }
                },
            ],
        ]);

        // Update the password
        $user->password = Hash::make($request->password);

        // Save the changes
        $user->save();

        // Redirect to a success page
        return redirect()->route('profile.edit')->with('success', 'Password updated successfully!');
    }
}
