@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Report</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.reports') }}">Reports</a></li>
            <li class="breadcrumb-item active">Report</li>
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
                <div class="card bg-light card-outline card-primary">
                    <div class="card-header text-muted border-bottom-0">
                        {{ $content->name ?? ''  }}
                    </div>
            
                    <div class="card-body pt-2">
                        <div class="row">
                            <div class="col-7">
                                <h2 class="lead"><b>{{ $content->name ?? ''  }}</b></h2>
                                <p class="text-muted text-sm">
                                    <b>Course: </b> {{ $content->course->name ?? ''  }}<br>
                                    <b>Category: </b>{{ $content->course->category->name ?? ''  }}
                                </p>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-cloud-upload-alt"></i></span> Uploaded by: {{ $content->user->name ?? ''}}</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-cloud-upload-alt"></i></span> Uploaded at: {{ date('M d, Y', strtotime($content->created_at)) ?? ''}}</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-edit"></i></span> Last updated at: {{ date('M d, Y', strtotime($content->updated_at)) ?? ''}}</li>
                                </ul>
                                <span class="badge badge-{{ $content->getStatusColor($content->status) }}">
                                    Status: {{ $content->getStatus($content->status) }}
                                </span>

                                <span class="badge badge-{{ $content->getVisibilityColor($content->visibility) }}">
                                    Visibility: {{ $content->getVisibility($content->visibility) }}
                                </span>
                            </div>
                            <div class="col-5 text-center">
                                <img src="{{ asset('storage/images/file-icon.png') }}" alt="" class="img-circle img-fluid w-50">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="text-right">
                            <a href="{{ $content->attachment }}" target="_blank" class="btn btn-sm btn-primary">
                                <i class="fas fa-download"></i> Download
                            </a>
                            @if(Auth::user()->role <= 2) 
                                <a href="{{ route('admin.contents.edit', $content->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-photo-video"></i> Modify Content
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="callout col-md-10 float-right callout-{{ $contentreport->getStatusColor($contentreport->status) }}">
                    <div id="accordion">
                        <h5>{{ $contentreport->title ?? ''}}</h5>
                        <p>
                            {{ $contentreport->description ?? ''}}
                            &nbsp;
                            <a class="text-primary" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                <i class="fas fa-plus-square"></i>
                            </a>                        
                        </p>
                        <div id="collapseOne" class="panel-collapse collapse in">
                                {!! $contentreport->messages ?? '' !!}
                        </div>
                    </div>

                    @if(Auth::user()->role <= 2)
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.reports.update', $contentreport->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                <label for="messages" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>

                                <div class="col-md-8">
                                    <textarea id="messages" type="text" class="form-control @error('messages') is-invalid @enderror" name="messages" value="{{ old('messages') }}" autocomplete="messages" placeholder="Input action message here..." autofocus></textarea>

                                    @error('messages')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Action') }}</label>

                                <div class="col-md-8">
                                    <select id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" autocomplete="status" autofocus>
                                        <option value="">Select</option>
                                        <option value="2" @if(old('status') == 2 || $contentreport->status == 2) {{ 'selected' }} @endif>Pending</option>
                                        <option value="3" @if(old('status') == 3 || $contentreport->status == 3) {{ 'selected' }} @endif>Resolved</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-2 offset-md-4">
                                    <a href="{{ route('admin.reports') }}" class="btn btn-default">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary float-right">
                                        {{ __('Update report') }}
                                    </button>
                                </div>
                            </div>
                        </div> 
                    @endif             
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        @include('admin.reports._tools')
    </div>
</div>
@endsection
