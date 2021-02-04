@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Content</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.mycontents') }}">Content Mgmt</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.mycontents.course', $course->id) }}">Courses</a></li>
            <li class="breadcrumb-item active">Content</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row"> 
            <div class="col-md-12">       
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-primary">
                        <h3 class="widget-user-username">{{ $content->name ?? '' }}</h3>
                        <h5 class="widget-user-desc">{{ $content->description ?? '' }}</h5>                
                    </div>
                    
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{{ asset('storage/images/file-icon.png') }}" alt="User Avatar">
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">
                                        <a href="{{ route('admin.mycontents.course', $content->course->id) }}">
                                            {{ $content->course->name ?? '' }}
                                        </a>
                                    </h5>
                                    <span class="description-text">COURSE</span>
                                </div>
                            </div>

                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">
                                        {{ $content->course->category->name ?? '' }}
                                    </h5>
                                    <span class="description-text">CATEGORY</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $content->user->name ?? '' }}</h5>
                                    <span class="description-text">UPLOADED BY</span>
                                </div>
                            </div>
                                                
                        </div>

                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><small>{{ date('M d, Y h:ia', strtotime($content->created_at)) ?? '' }}</small></h5>
                                    <span class="description-text"><small>Uploaded at</small></span>
                                </div>
                            </div>

                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><small>{{ date('M d, Y h:ia', strtotime($content->updated_at)) ?? '' }}</small></h5>
                                    <span class="description-text"><small>Updated at</small></span>
                                </div>
                            </div>  

                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header"><small>{{ $content->download->count() ?? '' }}</small></h5>
                                    <span class="description-text"><small>DOWNLOAD COUNT</small></span>
                                </div>
                            </div>                  
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <div class="row">
                            <div class="col-sm-12">
                                <span class="badge badge-{{ $content->getStatusColor($content->status) }}">
                                    Status: {{ $content->getStatus($content->status) }}
                                </span>

                                <span class="badge badge-{{ $content->getVisibilityColor($content->visibility) }}">
                                    Visibility: {{ $content->getVisibility($content->visibility) }}
                                </span>

                                <span class="float-right">
                                    <a href="{{ asset('storage/' . $content->attachment) }}" download class="btn btn-primary btn-sm btn-sm"><i class="fas fa-download"></i> Download</a>
                                    @if($content->status <= 2)  
                                        <a href="{{ route('admin.mycontents.edit', [$content->course->id, $content->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Modify</a>
                                    @endif                                    
                                </span>
                            </div> 
                        </div>   
                    </div>           
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex p-0">
                        <ul class="nav nav-pills p-2">
                            <li class="nav-item"><a class="nav-link" href="#tab_1" data-toggle="tab">Logs</a></li>
                            <li class="nav-item"><a class="nav-link active" href="#tab_2" data-toggle="tab">Reports</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane" id="tab_1">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0 table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Timestamp</th>
                                                    <th>User</th>                                
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(sizeof($contentlogs) > 0)
                                                    @foreach($contentlogs as $contentlog)
                                                        <tr>
                                                            <td>
                                                                <span class="badge badge-default">
                                                                    {{ date('M d, Y h:ia', strtotime($contentlog->created_at)) ?? '' }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-default">
                                                                    {{ $contentlog->user->name ?? '' }}
                                                                </span>   
                                                                </td>
                                                            <td>
                                                                <?php $data = json_decode($contentlog->data, true); ?>
                                                                <small>
                                                                Action: <span class="badge badge-default">
                                                                    {{ $contentlog->action ?? '' }}
                                                                </span> <br>
                                                                Name: <span class="badge badge-default">
                                                                    {{ $data['name'] }}
                                                                </span> <br>
                                                                Description: <span class="badge badge-default">
                                                                    {{ $data['description'] }}
                                                                </span> <br>
                                                                Attachment: <a href="{{ asset('storage/' . $data['attachment']) }}" download>
                                                                    <span class="badge badge-default"><i class="fas fa-download"></i> Download
                                                                </span></a><br>
                                                                Course: <span class="badge badge-default">
                                                                    {{ App\Models\Course::find($data['course_id'])->name }}
                                                                </span> <br>
                                                                User: <span class="badge badge-default">
                                                                    {{ App\Models\User::find($data['user_id'])->name }}
                                                                </span> <br>
                                                                Status: <span class="badge badge-{{ $contentlog->content->getStatusColor($data['status']) }}">
                                                                    {{ $contentlog->content->getStatus($data['status']) }}
                                                                </span> <br>
                                                                Visibility: <span class="badge badge-{{ $contentlog->content->getVisibilityColor($data['visibility']) }}">
                                                                    {{ $contentlog->content->getVisibility($data['visibility']) }}
                                                                </span> <br>
                                                                Sort: <span class="badge badge-default">
                                                                    {{ $data['sort'] }}
                                                                </span> <br>  
                                                                </small>
                                                            </td>
                                                        </ty>
                                                    @endforeach
                                                @else
                                                    <tr><td colspan="4">No record found.</td></ty>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>            
                                </div>
                            </div>
                            <div class="tab-pane active" id="tab_2">
                                <div class="table-responsive">
                                    <table class="table m-0 table-hover">
                                        <thead>
                                            <tr>
                                                <th>Timestamp / User</th>
                                                <th>Title / Description</th>
                                                <th>Status</th>
                                                <th>Remarks</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(sizeof($contentreports) > 0)
                                                @foreach($contentreports as $contentreport)
                                                    <tr>
                                                        <td>
                                                            {{ $contentreport->user->name ?? '' }}
                                                            <br>
                                                            {{ date('M d, Y', strtotime($contentreport->created_at)) ?? '' }}
                                                        </td>
                                                        <td>
                                                            <strong>{{ $contentreport->title ?? '' }}</strong>
                                                            <br>
                                                            {{ $contentreport->description ?? '' }}
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-{{ $contentreport->getStatusColor($contentreport->status) ?? '' }}">
                                                                {{ $contentreport->getStatus($contentreport->status) ?? '' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-default">
                                                                {{ $contentreport->messages ?? '' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @if($contentreport->user_id == Auth::user()->id && $contentreport->status == 1)
                                                                <a href="{{ route('content.show.report-delete', [$contentreport->content_id, $contentreport->id]) }}" class="text-red" onClick="return confirm('Are you sure you wish to proceed?')">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr><td colspan="4">No record found.</td></ty>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        @include('admin.mycontents._tools')
    </div>
</div>
@endsection
