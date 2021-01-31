<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = Auth::user();

        return view('my.index', compact('user'));
    }

    public function updatePassword()
    {
        $user = Auth::user();

        $data = request()->validate([
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            ]);

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        Auth::logout();

        return redirect()->route('login')->with('status', 'Please re-login to gain access.');
    }
}
