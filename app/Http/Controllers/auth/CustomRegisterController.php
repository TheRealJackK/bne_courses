<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class CustomRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // Your registration view
    }

    public function register(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'user_type' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Generate an s_number
        $s_number = $this->generateSNumber();

        // Create the new user with the generated s_number
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            's_number' => $s_number, // Assign the generated s_number
            'user_type' => $request->user_type, // Default user type as student
        ]);

        // Log the user in after registration
        Auth::login($user);

        // Redirect to home page or dashboard
        return redirect('/');
    }

    // Function to generate s_number
    private function generateSNumber()
    {
        // Generate a random 5 or 6 digit number with 'S' prefix
        do {
            $s_number = 'S' . rand(10000, 99999);
        } while (User::where('s_number', $s_number)->exists()); // Ensure it's unique

        return $s_number;
    }
}