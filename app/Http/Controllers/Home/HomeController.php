<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\Content;
use App\Models\Download;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $categories = $this->getCategories()->get();

        return view('home.categories', compact('categories'));
    }

    public function getCategories()
    {
        $categories = Category::where('visibility', '=', 1)
            ->orderBy('sort', 'asc');

        return $categories;
    }

    public function showCategory(Category $category)
    {
        $categories = $this->getCategories()->get();
        $courses = $this->getCourses($category)->get();

        return view('home.courses', compact('categories', 'category', 'courses'));
    }

    public function getCourses(Category $category)
    {
        $courses = Course::where('category_id', '=', $category->id)
            ->where('visibility', '=', 1)
            ->orderBy('sort', 'asc');

        return $courses;
    }

    public function showCourse(Category $category, Course $course)
    {
        $categories = $this->getCategories()->get();
        $courses = $this->getCourses($category)->get();
        $contents = $this->getcontents($course)->get();

        return view('home.course', compact('categories', 'category', 'courses', 'course', 'contents'));
    }

    public function getContents(Course $course)
    {
        $contents = Content::where('course_id', '=', $course->id)
        ->where('status', '=', 1)
        ->where('visibility', '=', 1)
        ->orderBy('sort', 'asc');

        return $contents;
    }

    public function download(Content $content)
    {
        $user = Auth::user();

        Download::create([
            'content_id' => $content->id,
            'user_id' => $user->id,
            ]);
        
        $filePath = 'storage/'.$content->attachment;
        return response()->download($filePath);    
        return redirect()->back();
    }

}
 