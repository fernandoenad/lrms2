<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = $this->getcategories('%')->get();
        $shown_c = $this->getcategories(1)->count();
        $hidden_c = $this->getcategories(0)->count();

        return view('admin.categories.index', compact('categories', 'shown_c', 'hidden_c'));
    }

    public function getcategories($visibility)
    {
        $categories = Category::where('visibility', 'like', $visibility)
            ->orderBy('sort', 'asc');

        return $categories;
    }

    public function search(){
        $str = request()->str;

        $categories = $this->getcategories('%')
            ->where('categories.name', 'like', $str . '%')
            ->orderBy('categories.name', 'asc')
            ->get();

        $shown_c = $this->getcategories(1)->count();
        $hidden_c = $this->getcategories(0)->count();
        
        return view('admin.categories.index', compact('categories', 'shown_c', 'hidden_c'));
    }

    public function displaycategories()
    {
        $route_name = request()->route()->getName();

        if($route_name == 'admin.categories.shown'){
            $visibility = 1;
        } else if ($route_name == 'admin.categories.hidden'){
            $visibility = 0;
        } 

        $categories = $this->getcategories($visibility)->get();
        $shown_c = $this->getcategories(1)->count();
        $hidden_c = $this->getcategories(0)->count();

        return view('admin.categories.index', compact('categories', 'shown_c', 'hidden_c'));
    }

    public function create()
    {
        $categories = $this->getcategories('%')->get();
        $shown_c = $this->getcategories(1)->count();
        $hidden_c = $this->getcategories(0)->count();

        return view('admin.categories.index', compact('categories', 'shown_c', 'hidden_c'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'min:3', 'max:255', 'unique:categories'],
            'visibility' => ['required'],
            ]);

        $categoryLast = Category::orderBy('id', 'desc')
            ->take(1)
            ->get();
        
        if(sizeof($categoryLast) > 0)
            $sort = $categoryLast->first()->sort + 1;
        else
            $sort = 1;
        
        $category = Category::create(array_merge($data, [
            'sort' => $sort,
        ]));

        return redirect()->route('admin.categories.edit', compact('category'))->with('status', 'Category was successfully created.');
    }

    public function edit(Category $category)
    {
        $categories = $this->getcategories('%')->get();
        $shown_c = $this->getcategories(1)->count();
        $hidden_c = $this->getcategories(0)->count();

        return view('admin.categories.index', compact('categories', 'shown_c', 'hidden_c', 'category'));
    }

    public function update(Category $category)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'min:3', 'max:255', Rule::unique('categories')->ignore($category->id)],
            'visibility' => ['required'],
            ]);

        $category->update($data);
        

        return redirect()->route('admin.categories.edit', compact('category'))->with('status', 'Category was successfully updated.');
    }

    public function moveup(Category $category)
    {
        $categories = $this->getcategories('%')->get();
        $shown_c = $this->getcategories(1)->count();
        $hidden_c = $this->getcategories(0)->count();

        $category->update([
            'sort' => $category->sort - ($category->sort <= 1 ? 0 : 2),
            ]);

        return view('admin.categories.index', compact('categories', 'shown_c', 'hidden_c'));
    }

    public function movedown(Category $category)
    {
        $categories = $this->getcategories('%')->get();
        $shown_c = $this->getcategories(1)->count();
        $hidden_c = $this->getcategories(0)->count();

        $category->update([
            'sort' => $category->sort + 2,
            ]);

        return view('admin.categories.index', compact('categories', 'shown_c', 'hidden_c'));
    }
}
