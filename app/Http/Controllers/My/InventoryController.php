<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $inventories = Inventory::where('user_id', '=', Auth::user()->id)
            ->paginate(15);

        return view('inventories.index', compact('inventories'));
    }

    public function create()
    {
        $categories = Category::where('visibility', '=', 1)
            ->get();

        return view('inventories.create', compact('categories'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'learningarea' => ['required', 'string', 'min:3', 'max:255'],
            'gradelevel' => ['required'],
            'author' => ['required', 'string', 'min:3', 'max:255'],
            'publisher' => ['required', 'string', 'min:3', 'max:255'],
            'lrtype' => ['required', 'string', 'min:3', 'max:255'],
            'acquisitiondate' => ['required', 'date', 'before:today'],
            'acquisitionmode' => ['required'],
            'copies' => ['required', 'integer', 'min:0', 'max:255'],
            'status' => ['required', 'string', 'min:3', 'max:255'],
            'schoolyear' => ['required', 'integer', 'min:2020'],
            ]);

        Inventory::create(array_merge($data,[
            'user_id' => Auth::user()->id,
            ]));

        return redirect()->route('inventory')->with('status', 'Inventory item added.');
    }

    public function edit(Inventory $inventory)
    {
        $categories = Category::where('visibility', '=', 1)
            ->get();

        return view('inventories.edit', compact(['inventory','categories']));
    }

    public function update(Inventory $inventory)
    {
        $data = request()->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'learningarea' => ['required', 'string', 'min:3', 'max:255'],
            'gradelevel' => ['required'],
            'author' => ['required', 'string', 'min:3', 'max:255'],
            'publisher' => ['required', 'string', 'min:3', 'max:255'],
            'lrtype' => ['required', 'string', 'min:3', 'max:255'],
            'acquisitiondate' => ['required', 'date', 'before:today'],
            'acquisitionmode' => ['required'],
            'copies' => ['required', 'integer', 'min:0', 'max:255'],
            'status' => ['required', 'string', 'min:3', 'max:255'],
            'schoolyear' => ['required', 'integer', 'min:2020'],
            ]);

        $inventory->update($data);

        return redirect()->route('inventory.edit', compact('inventory'))->with('status', 'Inventory item updated.');
    }

    public function delete(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->route('inventory')->with('status', 'Inventory item deleted.');
    }
}
