<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentReport;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contentreports = ContentReport::join('contents', 'contents.id', '=', 'content_reports.content_id')
            ->join('courses', 'courses.id', 'contents.course_id')
            ->where('courses.user_id', 'like', (Auth::user()->role == 1 ? '%' : Auth::user()->id))
            ->where('content_reports.status', 'like', '%')
            ->orderBy('content_reports.status', 'asc')
            ->orderBy('content_reports.created_at', 'asc')
            ->paginate(15);

        return view('admin.reports.index', compact('contentreports'));
    }

    public function show(ContentReport $contentreport)
    {
        $content = Content::find($contentreport->content_id);

        return view('admin.reports.show', compact('contentreport', 'content'));
    }

    public function update(ContentReport $contentreport)
    {
        $data = request()->validate([
            'messages' => ['required', 'string', 'min:3', 'max:255'],
            'status' => ['required'],
            ]);
        
        $status = ($data['status'] == 2 ? 'Pending' : 'Resolved');
        $messages = ">>>" . now() . "<br>Status: $status <br>Taken by: ". Auth::user()->name . "<br>Message: " .$data['messages'];
        $messages = $contentreport->messages . '<br>***********************<br>' . $messages;

        $contentreport->update(array_merge($data,[
            'messages' => $messages,
            ]));

        return redirect()->route('admin.reports.show', compact('contentreport'))->with('status', 'Report updated successfully.');
    }
}
