<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string|min:6',
        ]);
        $credentials = $request->only('name', 'password');
        $admin = Admin::where('name', $request->name)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            return response()->json(['status' => true, 'message' => 'Login successful', 'admin' => Auth::user()], 200);
        }
        return response()->json(['status' => false, 'message' => 'Invalid credentials'], 401);
    }
    public function logout()
    {
        Auth::logout();
        return response()->json(['status' => true, 'message' => 'Logged out successfully'], 200);
    }
}
