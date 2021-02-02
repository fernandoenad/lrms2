<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Route;
use File;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contents = $this->getContents('%', '%')
            ->paginate(15);
        $new_c = $this->getContents(1, '%')->count();
        $pending_c = $this->getContents(2, '%')->count();
        $approved_c = $this->getContents(3, '%')->count();
        $hidden_c = $this->getContents('%', 0)->count();
    
        return view('admin.contents.index', compact('contents', 'new_c', 'pending_c', 'approved_c', 'hidden_c'));
    }

    public function getContents($status, $visibility)
    {
        $contents = Content::where('status', 'like', $status)
            ->where('visibility', 'like', $visibility)
            ->orderBy('sort', 'asc');
        
        return $contents;
    }

    public function displaycontents()
    {
        $route_name = request()->route()->getName();

        if($route_name == 'admin.contents.new'){
            $status = 1;
            $visibility = '%';
        } else if ($route_name == 'admin.contents.pending'){
            $status = 2;
            $visibility = '%';
        } else if($route_name == 'admin.contents.approved'){
            $status = 3;
            $visibility = '%';
        } else if($route_name == 'admin.contents.hidden'){
            $status = '%';
            $visibility = 0;
        }

        $contents = $this->getContents($status, $visibility)
            ->paginate(15);
        $new_c = $this->getContents(1, '%')->count();
        $pending_c = $this->getContents(2, '%')->count();
        $approved_c = $this->getContents(3, '%')->count();
        $hidden_c = $this->getContents('%', 0)->count();

        return view('admin.contents.index', compact('contents', 'new_c', 'pending_c', 'approved_c', 'hidden_c'));
    }

    public function search()
    {
        $str = request()->str;

        $contents = $this->getContents('%', '%')
            ->where('contents.name', 'like', $str . '%')
            ->orderBy('contents.name', 'asc')
            ->paginate(15);
        $new_c = $this->getContents(1, '%')->count();
        $pending_c = $this->getContents(2, '%')->count();
        $approved_c = $this->getContents(3, '%')->count();
        $hidden_c = $this->getContents('%', 0)->count();

        $contents = $contents->appends(['str' => $str]);
        
        return view('admin.contents.index', compact('contents', 'new_c', 'pending_c', 'approved_c', 'hidden_c'));
    }

    public function create()
    {
        $courses = Course::orderBy('name', 'asc')
            ->get();

        return view('admin.contents.create', compact('courses'));
    }

    public function store()
    {
        $data = request()->validate([
            'course_id' => ['required'],
            'name' => ['required', 'string', 'min:3', 'max:255', 'unique:contents'],
            'description' => ['required', 'string', 'min:3', 'max:255'],
            'attachment' => ['required'],
            'status' => ['required'],
            'visibility' => ['required'],
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
        ]));

        return redirect()->route('admin.contents.show', compact('content'))->with('status', 'Content was successfully created.');
    }

    public function show(Content $content)
    {
        $contentlogs = $content->contentlog()->orderBy('id', 'desc')
            ->get();

        return view('admin.contents.show', compact('content', 'contentlogs'));
    }

    public function edit(Content $content)
    {
        $courses = Course::orderBy('name', 'asc')
            ->get();

        return view('admin.contents.edit', compact('content', 'courses'));
    }

    public function update(Content $content)
    {
        $data = request()->validate([
            'course_id' => ['required'],
            'name' => ['required', 'string', 'min:3', 'max:255', Rule::unique('contents')->ignore($content->id)],
            'description' => ['required', 'string', 'min:3', 'max:255'],
            'status' => ['required'],
            'visibility' => ['required'],
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

        return redirect()->route('admin.contents.show', compact('content'))->with('status', 'Content was successfully updated.');
    }
}
