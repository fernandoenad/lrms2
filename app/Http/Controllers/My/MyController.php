<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Content;
use App\Models\Download;
use Illuminate\Support\Facades\Hash;

class MyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $contents = Content::where('status', '=', 3)
        ->where('visibility', '=', 1)
        ->orderBy('created_at', 'desc')
        ->take(20)
        ->get();

        $user = Auth::user();
        $downloads = Download::join('contents', 'downloads.content_id', '=', 'contents.id')
        ->where('status', '=', 3)
        ->where('visibility', '=', 1)
        ->where('downloads.user_id', '=', $user->id)
        ->orderBy('downloads.id', 'desc')
        ->take(15)
        ->get();

        return view('my.index', compact('contents', 'downloads'));
    }

    public function profile()
    {
        $user = Auth::user();

        return view('my.profile', compact('user'));
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
