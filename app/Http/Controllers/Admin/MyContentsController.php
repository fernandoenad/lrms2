<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Content;
use App\Models\ContentReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use File;

class MyContentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contents = Content::join('courses', 'contents.course_id', '=', 'courses.id')
            ->where('courses.user_id', '=', Auth::user()->id)
            ->orderBy('contents.name', 'asc')
            ->select('contents.*')
            ->paginate(15);
        $courses = Course::where('user_id', '=', Auth::user()->id)
            ->orderBy('name', 'asc')->get();

        return view('admin.mycontents.index', compact('contents', 'courses'));
    }

    public function search()
    {
        $str = request()->str;

        $contents = Content::join('courses', 'contents.course_id', '=', 'courses.id')
            ->where('courses.user_id', '=', Auth::user()->id)
            ->where('contents.name', 'like', $str . '%')
            ->orderBy('contents.name', 'asc')
            ->select('contents.*')
            ->paginate(15);
        $courses = Course::where('user_id', '=', Auth::user()->id)
            ->orderBy('name', 'asc')->get();

        return view('admin.mycontents.index', compact('contents', 'courses'));
    }

    public function showcourse(Course $course)
    {
        $contents = Content::join('courses', 'contents.course_id', '=', 'courses.id')
            ->where('courses.user_id', '=', Auth::user()->id)
            ->where('contents.course_id', '=',$course->id)
            ->orderBy('contents.sort', 'asc')
            ->select('contents.*')
            ->paginate(15);

        $courses = Course::where('user_id', '=', Auth::user()->id)
            ->orderBy('name', 'asc')->get();

        return view('admin.mycontents.index', compact('contents', 'courses', 'course'));
    }

    public function display()
    {
        $route_name = request()->route()->getName();

        if($route_name == 'admin.mycontents.shown'){
            $status = 3;
            $visibility = 1;
        } else if($route_name == 'admin.mycontents.hidden'){
            $status = 3;
            $visibility = 0;
        } else if($route_name == 'admin.mycontents.submissions'){
            $status = '%';
            $visibility = '%';
        }  

        $contents = Content::join('courses', 'contents.course_id', '=', 'courses.id')
            ->where('courses.user_id', '=', Auth::user()->id)
            ->where('contents.status', 'like', $status)
            ->where('contents.visibility', '=', $visibility)
            ->orderBy('name', 'asc')
            ->select('contents.*')
            ->paginate(15);
            
        $courses = Course::where('user_id', '=', Auth::user()->id)
            ->orderBy('name', 'asc')->get();

        return view('admin.mycontents.index', compact('contents', 'courses'));
    }

    public function visibility(Course $course, Content $content)
    {

        $route_name = request()->route()->getName();

        if($route_name == 'admin.mycontents.course.hide'){
            $visibility = 0;
        } else if($route_name == 'admin.mycontents.course.show'){
            $visibility = 1;
        }

        $content->update([
            'visibility' => $visibility,
            ]);

        return redirect()->route('admin.mycontents.course', compact('course'));
    }

    public function sort(Course $course, Content $content)
    {
        $route_name = request()->route()->getName();

        if($route_name == 'admin.mycontents.course.move-up'){
            $sort =  ($content->sort <= 1 ? 0 : -2);
        } else if($route_name == 'admin.mycontents.course.move-down'){
            $sort = 2;
        }

        $content->update([
            'sort' => $content->sort + $sort,
            ]);

        return redirect()->route('admin.mycontents.course', compact('course'));
    }

    public function show(Course $course, Content $content)
    {
        $courses = Course::where('user_id', '=', Auth::user()->id)
            ->orderBy('name', 'asc')->get();
        
        $contentlogs = $content->contentlog()->orderBy('id', 'desc')
            ->get();

        $contentreports = ContentReport::where('content_id', '=', $content->id)
            ->orderBy('created_at', 'asc')->get();

        return view('admin.mycontents.show', compact('content', 'courses', 'course', 'contentlogs', 'contentreports'));
    }

    public function create()
    {
        $courses = Course::where('user_id', '=', Auth::user()->id)
            ->orderBy('name', 'asc')->get();

        return view('admin.mycontents.create', compact('courses'));
    }

    public function store()
    {
        $data = request()->validate([
            'course_id' => ['required'],
            'name' => ['required', 'string', 'min:3', 'max:255', 'unique:contents'],
            'description' => ['required', 'string', 'min:3', 'max:255'],
            'attachment' => ['required'],
            ]);

        $filePath = 'storage/' . request()->attachment->store('resources', 'public');
        $file_ext = File::extension($filePath);
        $unique_suffix = strtotime(now());
        $newFilePath = 'storage/resources/' . $data['name'] . '-' . $unique_suffix . '.' . $file_ext;
        rename($filePath, $newFilePath);
        $newFilePath = 'resources/' . $data['name'] . '-' . $unique_suffix . '.' . $file_ext;

        $contentLast = Content::where('course_id', '=', $data['course_id'])
            ->orderBy('id', 'desc')
            ->take(1)
            ->get();
        
        if(sizeof($contentLast) > 0)
            $sort = $contentLast->first()->sort + 1;
        else
            $sort = 1;
        
        $content = Content::create(array_merge($data, [
            'datefrom' => now(),
            'dateto' => now(),
            'attachment' => $newFilePath,
            'sort' => $sort,
            'user_id' => Auth::user()->id,
            'status' => 1,
            'visibility' => 0,
        ]));

        $course = $content->course;

        return redirect()->route('admin.mycontents.course.display', compact('content', 'course'))->with('status', 'Content was successfully created.');
    }

    public function edit(Course $course, Content $content)
    {
        $courses = Course::where('user_id', '=', Auth::user()->id)
            ->orderBy('name', 'asc')->get();

        return view('admin.mycontents.edit', compact('courses', 'content'));
    }

    public function update(Course $course, Content $content)
    {
        $data = request()->validate([
            'course_id' => ['required'],
            'name' => ['required', 'string', 'min:3', 'max:255', Rule::unique('contents')->ignore($content->id)],
            'description' => ['required', 'string', 'min:3', 'max:255'],
            ]);

        $content->contentlog()->create([
            'action' => 'update',
            'data' => $content->toJson(),
            'content_id' => $content->id,
            'user_id' => Auth::user()->id,
        ]);

        if(request()->attachment){
            $filePath = 'storage/' . request()->attachment->store('resources', 'public');
            $file_ext = File::extension($filePath);
            $unique_suffix = strtotime(now());
            $newFilePath = 'storage/resources/' . $content->name . '-' . $unique_suffix . '.' . $file_ext;
            rename($filePath, $newFilePath);
            $newFilePath = 'resources/' . $content->name . '-' . $unique_suffix . '.' . $file_ext;

            $content->update(array_merge($data, [
                'attachment' => $newFilePath,
                'user_id' => Auth::user()->id,
            ]));
        } else {
            $content->update(array_merge($data, [
                'user_id' => Auth::user()->id,
            ]));
        }    

        return redirect()->route('admin.mycontents.course.display', compact('content', 'course'))->with('status', 'Content was successfully updated.');
    }
}
