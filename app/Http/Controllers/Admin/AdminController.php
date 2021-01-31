<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;

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
        $users_c = $this->getUserList();

        return view('admin.index', compact('contents_c', 'inventories_c', 'users_c', 'contents_f'));
    }

    public function getContentList()
    {
        $contents = Content::where('status', '=', 1)
        ->where('visibility', '=', 1)
        ->orderBy('sort', 'asc');

        return $contents;
    }

    public function getInventoryList()
    {
        $inventories = 0;

        return $inventories;        
    }

    public function getUserList()
    {
        $users = 0;

        return $users;        
    }
}
