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
        $contentreports = ContentReport::where('user_id', 'like', (Auth::user()->role <= 2 ? '%' : Auth::user()->id))
            ->where('status', 'like', '%')
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'asc')
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
