<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Validation\Rule;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $inventories=Inventory::paginate(15);

        return view('admin.inventories.index', compact('inventories'));
    }

    
}
