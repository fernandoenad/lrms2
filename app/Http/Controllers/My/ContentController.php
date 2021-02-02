<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\Content;
use App\Models\Download;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $categories = $this->getCategories()->get();

        return view('contents.index', compact('categories'));
    }

    public function getCategories()
    {
        $categories = Category::where('visibility', '=', 1)
            ->orderBy('sort', 'asc');

        return $categories;
    }

    public function showCategory(Category $category)
    {
        if($category->visibility != 1)
            return redirect()->route('content');

        $categories = $this->getCategories()->get();
        $courses = $this->getCourses($category)->get();

        return view('contents.category', compact('categories', 'category', 'courses'));
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
        if($course->visibility != 1)
            return redirect()->route('content.category.show', compact('category'));

        $categories = $this->getCategories()->get();
        $courses = $this->getCourses($category)->get();
        $contents = $this->getcontents($course)->get();

        return view('contents.course', compact('categories', 'category', 'courses', 'course', 'contents'));
    }

    public function getContents(Course $course)
    {
        $contents = Content::where('course_id', '=', $course->id)
        ->where('status', '=', 3)
        ->where('visibility', '=', 1)
        ->orderBy('sort', 'asc');

        return $contents;
    }

    public function download($id)
    {       
        
        $content = Content::find($id);
        $download = Download::create([
            'content_id' => $id,
            'user_id' => Auth::user()->id,
            ]);
        
        $file = Storage::disk('public')->path($content->attachment);
        $file_info = pathinfo($file);
        $file_ext = $file_info['extension'];
        $file_download = Storage::disk('public')->download($content->attachment, $content->name . '.' . $file_ext);

        return $file_download;               
    }

}
 