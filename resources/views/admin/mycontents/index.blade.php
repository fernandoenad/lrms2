@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        @if(Route::currentRouteName() == 'admin.mycontents.course')
            <h1 class="m-0 text-dark">Course</h1>
        @else
            <h1 class="m-0 text-dark">Content Mgmt</h1>
        @endif
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            @if(Route::currentRouteName() == 'admin.mycontents.course')
                <li class="breadcrumb-item"><a href="{{ route('admin.mycontents') }}">Content Mgmt</a></li>
                <li class="breadcrumb-item active">Course</li>
            @else
                <li class="breadcrumb-item active">Content Mgmt</li>
            @endif
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-photo-video"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Shown</span>
                        <span class="info-box-number">
                            <a href="{{ route('admin.mycontents.shown') }}">    
                                {{ number_format(App\Models\Content::join('courses', 'contents.course_id', '=', 'courses.id')
                                    ->where('courses.user_id', '=', Auth::user()->id)
                                    ->where('contents.visibility', '=', 1)
                                    ->where('contents.status', '=', 3)
                                    ->get()->count(), 0) }}
                             </a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-muted elevation-1"><i class="fas fa-eye-slash"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Hidden</span>
                        <span class="info-box-number">
                            <a href="{{ route('admin.mycontents.hidden') }}">    
                                {{ number_format(App\Models\Content::join('courses', 'contents.course_id', '=', 'courses.id')
                                    ->where('courses.user_id', '=', Auth::user()->id)
                                    ->where('contents.visibility', '=', 0)
                                    ->where('contents.status', '=', 3)
                                    ->get()->count(), 0) }}
                             </a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-photo-video"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">My Submissions</span>
                        <span class="info-box-number">
                            <a href="{{ route('admin.mycontents.submissions') }}">    
                                {{ number_format(App\Models\Content::join('courses', 'contents.course_id', '=', 'courses.id')
                                    ->where('courses.user_id', '=', Auth::user()->id)
                                    ->where('contents.status', '<', 3)
                                    ->get()->count(), 0) }}
                             </a>
                        </span>
                    </div>
                </div>
            </div>
         
        </div>

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
                <div class="card card-outline card-primary">
                    <div class="card-header border-transparent">
                        Content List
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0 table-hover">
                                <thead>
                                    <tr>
                                        <th>Content</th>
                                        <th>Uploaded by</th>
                                        <th>Status / Visibility</th>
                                        <th>Remarks</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(sizeof($contents) > 0)
                                        @foreach($contents as $content)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.mycontents.course.display', [$content->course->id, $content->id]) }}">
                                                        <strong>{{ $content->name ?? '' }}</strong>
                                                    </a>
                                                    <br>
                                                    <small>
                                                        {{ $content->course->name ?? '' }} /    
                                                        {{ $content->course->category->name ?? '' }}    
                                                    </small>                                     
                                                </td>
                                                <td>
                                                    {{ $content->user->name ?? '' }}
                                                    <br>
                                                    <small>on {{ (date('M d, Y', strtotime($content->created_at))) ?? '' }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{ $content->getStatusColor($content->status) ?? '' }}">
                                                        {{  $content->getStatus($content->status) ?? '' }}
                                                    </span><br>
                                                    <span class="badge badge-{{ $content->getVisibilityColor($content->visibility) ?? '' }}">
                                                        {{  $content->getVisibility($content->visibility) ?? '' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-default }}">
                                                        Reports: {{  $content->contentreport->count() ?? '' }}
                                                    </span>
                                                    <br>
                                                    <span class="badge badge-default }}">
                                                        Downloads: {{  $content->download->count() ?? '' }}
                                                    </span>
                                                </td>
                                                <td class="text-right">
                                                    @if(Route::currentRouteName() == 'admin.mycontents.course')
                                                        @if($content->visibility == 1 && $content->status == 3)
                                                            <a href="{{ route('admin.mycontents.course.hide', [$content->course->id, $content->id]) }}">
                                                                <i class="fas fa-eye-slash"></i>
                                                            </a>  
                                                        @elseif($content->visibility == 0 && $content->status == 3)
                                                            <a href="{{ route('admin.mycontents.course.show', [$content->course->id, $content->id]) }}">
                                                                <i class="fas fa-eye"></i>
                                                            </a>   
                                                        @elseif($content->visibility == 0 && $content->status < 3)                                                     
                                                        @endif                                              
                                                        &nbsp;
                                                        <a href="{{ route('admin.mycontents.course.move-up', [$content->course->id, $content->id]) }}">
                                                            <i class="fas fa-arrow-up"></i>
                                                        </a>
                                                        &nbsp;
                                                        <a href="{{ route('admin.mycontents.course.move-down', [$content->course->id, $content->id]) }}">
                                                            <i class="fas fa-arrow-down"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="5">No record found.</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>            
                    </div>

                    <div class="card-footer pt-0 pb-0">
                        <span class="float-right">{{ $contents->links() }}</span>
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
