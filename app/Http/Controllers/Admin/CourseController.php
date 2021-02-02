<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Category $category)
    {
        $categories = Category::orderBy('sort', 'asc')->get();
        $courses = $this->getcourses($category, '%')->get();
        $shown_c = $this->getcourses($category, 1)->count();
        $hidden_c = $this->getcourses($category, 0)->count();
        
        return view('admin.courses.index', compact('categories', 'category', 'courses', 'shown_c', 'hidden_c'));
    }

    public function getcourses(Category $category, $visibility)
    {
        $courses = $category->course()->where('visibility', 'like', $visibility)
            ->orderBy('sort', 'asc');

        return $courses;
    }

    public function search(Category $category){
        $str = request()->str;

        $courses = $this->getcourses($category, '%')
            ->where('courses.name', 'like', $str . '%')
            ->orderBy('courses.name', 'asc')
            ->get();

        $categories = Category::orderBy('sort', 'asc')->get();
        $shown_c = $this->getcourses($category, 1)->count();
        $hidden_c = $this->getcourses($category, 0)->count();
        
        return view('admin.courses.index', compact('categories', 'category', 'courses', 'shown_c', 'hidden_c'));
    }

    public function displaycourses(Category $category)
    {
        $route_name = request()->route()->getName();

        if($route_name == 'admin.courses.shown'){
            $visibility = 1;
        } else if ($route_name == 'admin.courses.hidden'){
            $visibility = 0;
        } 

        $categories = Category::orderBy('sort', 'asc')->get();
        $courses = $this->getcourses($category, $visibility)->get();
        $shown_c = $this->getcourses($category, 1)->count();
        $hidden_c = $this->getcourses($category, 0)->count();

        return view('admin.courses.index', compact('categories', 'category', 'courses', 'shown_c', 'hidden_c'));
    }

    public function create(Category $category)
    {
        $categories = Category::orderBy('sort', 'asc')->get();
        $courses = $this->getcourses($category, '%')->get();
        $shown_c = $this->getcourses($category, 1)->count();
        $hidden_c = $this->getcourses($category, 0)->count();
        $personnels = User::whereBetween('role', [2, 3])->orderBy('name', 'asc')->get();

        return view('admin.courses.index', compact('categories', 'category', 'courses', 'shown_c', 'hidden_c', 'personnels'));
    }

    public function store(Category $category)
    {
        $data = request()->validate([
            'category_id' => ['required'],
            'name' => ['required', 'string', 'min:3', 'max:255', 'unique:courses'],
            'user_id' => ['required'],
            'visibility' => ['required'],
            ],[
                'user_id.required' => 'The personnel field is required.',
            ]);

        $courseLast = Course::orderBy('id', 'desc')
            ->take(1)
            ->get();
        
        if(sizeof($courseLast) > 0)
            $sort = $courseLast->first()->sort + 1;
        else
            $sort = 1;
        
        $course = $category->course()->create(array_merge($data, [
            'sort' => $sort,
        ]));

        return redirect()->route('admin.courses.edit', compact('category', 'course'))->with('status', 'Course was successfully created.');
    }

    public function edit(Category $category, Course $course)
    {
        $categories = Category::orderBy('sort', 'asc')->get();
        $courses = $this->getcourses($category, '%')->get();
        $shown_c = $this->getcourses($category, 1)->count();
        $hidden_c = $this->getcourses($category, 0)->count();
        $personnels = User::whereBetween('role', [2, 3])->orderBy('name', 'asc')->get();

        return view('admin.courses.index', compact('categories', 'category', 'courses', 'course', 'shown_c', 'hidden_c', 'personnels'));
    }

    public function update(Category $category, Course $course)
    {
        $data = request()->validate([
            'category_id' => ['required'],
            'name' => ['required', 'string', 'min:3', 'max:255', Rule::unique('courses')->ignore($course->id)],
            'user_id' => ['required'],
            'visibility' => ['required'],
            ],[
                'user_id.required' => 'The personnel field is required.',
            ]);

        $course->update($data);
        
        return redirect()->route('admin.courses.edit', compact('category', 'course'))->with('status', 'Course was successfully updated.');
    }

    public function moveup(Category $category, Course $course)
    {
        $categories = Category::orderBy('sort', 'asc')->get();
        $courses = $this->getcourses($category, '%')->get();
        $shown_c = $this->getcourses($category, 1)->count();
        $hidden_c = $this->getcourses($category, 0)->count();

        $course->update([
            'sort' => $course->sort - 2,
            ]);

            return view('admin.courses.index', compact('categories', 'category', 'courses', 'course', 'shown_c', 'hidden_c'));
    }

    public function movedown(Category $category, Course $course)
    {
        $categories = Category::orderBy('sort', 'asc')->get();
        $courses = $this->getcourses($category, '%')->get();
        $shown_c = $this->getcourses($category, 1)->count();
        $hidden_c = $this->getcourses($category, 0)->count();

        $course->update([
            'sort' => $course->sort + 2,
            ]);

            return view('admin.courses.index', compact('categories', 'category', 'courses', 'course', 'shown_c', 'hidden_c'));
    }
}
