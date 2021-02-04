@extends('layouts.my')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Content</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('content') }}">LR Categories</a></li>
            <li class="breadcrumb-item"><a href="{{ route('content.category.show', $content->course->category->id) }}">Courses</a></li>
            <li class="breadcrumb-item"><a href="{{ route('content.course.show', [$content->course->category->id, $content->course->id]) }}">Courses</a></li>
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
                                        <a href="{{ route('content.course.show', [$content->course->category->id, $content->course->id]) }}">
                                            {{ $content->course->name ?? '' }}
                                        </a>
                                    </h5>
                                    <span class="description-text">COURSE</span>
                                </div>
                            </div>

                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">
                                        <a href="{{ route('content.category.show', $content->course->category->id) }}">
                                            {{ $content->course->category->name ?? '' }}
                                        </a>
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
                                    <a href="{{ route('content.show.report', $content->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-exclamation-triangle"></i> Report</a>
                                    <a href="{{ route('content.download', $content->id) }}" class="btn btn-primary btn-sm btn-sm"><i class="fas fa-download"></i> Download</a>
                                </span>
                            </div> 
                        </div>   
                    </div>           
                </div>
                
                @if(Route::currentRouteName() == 'content.show.report')
                    <div class="card card-outline card-primary col-md-8 offset-md-4 p-0">
                        <div class="card-header border-transparent">
                            New Report
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('content.show.report-store', $content->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Page number, Section name" autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea id="description"  type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description of the error" value="{{ old('description') }}" autocomplete="description" autofocus></textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <a href="{{ route('content.show', $content->id) }}" class="btn btn-default">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary float-right">
                                        {{ __('Save report') }}
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>

                        <div class="card-footer pt-0 pb-0">
                            <span class="float-right"></span>
                        </div>
                    </div>
                @endif

                <div class="card card-outline card-primary">
                    <div class="card-header border-transparent">
                        Report Logs
                    </div>

                    <div class="card-body p-0">
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
                                                <td class="text-right">
                                                    <div id="accordion">
                                                        <a class="text-primary" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{ $contentreport->id }}">
                                                            <i class="fas fa-plus-square"></i>
                                                        </a> 
                                                        <div id="collapseOne{{ $contentreport->id }}" class="panel-collapse collapse in">
                                                            <span class="badge badge-default">
                                                                {!! $contentreport->messages ?? '' !!}
                                                            </span>
                                                        </div>
                                                    </div>
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

    <div class="col-md-3">
        @include('contents._contents')
    </div>
</div>
@endsection
