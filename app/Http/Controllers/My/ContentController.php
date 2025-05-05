<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\Content;
use App\Models\Download;
use App\Models\ContentReport;
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
        
        /** 
        $file = Storage::disk('public')->path($content->attachment);
        $file_info = pathinfo($file);
        $file_ext = $file_info['extension'];
        $file_download = Storage::disk('public')->download($content->attachment, $content->name . '.' . $file_ext);
        */
        return redirect()->away($content->attachment);

        //return $file_download;               
    }

    public function show(Content $content)
    {
        $contents = Content::where('course_id', '=', $content->course->id)
            ->orderBy('sort', 'asc')->get();
        $contentreports = ContentReport::where('content_id', '=', $content->id)
            ->orderBy('created_at', 'asc')->get();

        return view('contents.content', compact('content', 'contents', 'contentreports'));
    }

    public function storereport(Content $content)
    {
        $data = request()->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:3'],
            ]);
        
        $content->contentreport()->create(array_merge($data,[
            'status' => 1,
            'messages' => '>>>Report created',
            'user_id' => Auth::user()->id,
        ]));

        return redirect()->route('content.show', compact('content'))->with('status', 'Report successfully recorded.');
    }

    public function deletereport(Content $content, ContentReport $contentreport)
    {
        if(Auth::user()->id != $contentreport->user_id)
            abort(401, 'Unauthorized action.');
        
        $contentreport->delete();

        return redirect()->route('content.show', compact('content'))->with('status', 'Report successfully recorded.');
    }

}
 