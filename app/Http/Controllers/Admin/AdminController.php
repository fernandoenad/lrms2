<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contents = $this->getContentList();            
        $contents_f = $contents->orderBy('id', 'desc')
            ->take(10)
            ->get();
        $contents_c = $contents->count();        
        $inventories_c = $this->getInventoryList();
        $users_c = $this->getUserList()->count();

        return view('admin.index', compact('contents_c', 'inventories_c', 'users_c', 'contents_f'));
    }

    public function getContentList()
    {
        $contents = Content::orderBy('id', 'desc');

        return $contents;
    }

    public function getInventoryList()
    {
        $inventories = 0;

        return $inventories;        
    }

    public function getUserList()
    {
        $users = User::orderBy('role', 'asc')
            ->orderBy('name', 'asc');

        return $users;        
    }
}
