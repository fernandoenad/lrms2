@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Contents</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Contents</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-photo-video"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">New</span>
                        <span class="info-box-number">
                            <a href="{{ route('admin.contents.new') }}">
                                {{ number_format($new_c, 0) }}
                            </a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-photo-video"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pending</span>
                        <span class="info-box-number">
                            <a href="{{ route('admin.contents.pending') }}">
                                {{ number_format($pending_c, 0) }}
                            </a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-photo-video"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Approved</span>
                        <span class="info-box-number">
                            <a href="{{ route('admin.contents.approved') }}">
                            {{ number_format($approved_c, 0) }}
                            </a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-muted elevation-1"><i class="fas fa-eye-slash"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Hidden</span>
                        <span class="info-box-number">
                            <a href="{{ route('admin.contents.hidden') }}">    
                             {{ number_format($hidden_c, 0) }}
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
                                <th>Status</th>
                                <th>Visibility</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeof($contents) > 0)
                                @foreach($contents as $content)
                                <tr>
                                        <td>
                                            <a href="{{ route('admin.contents.show', $content->id) }}" title="{{ $content->description ?? '' }}">
                                                <strong>{{ $content->name ?? '' }}</strong>
                                            </a>
                                            <br>
                                            <a href="{{ route('admin.courses.show', $content->course->id) }}">
                                                {{ $content->course->name ?? '' }} 
                                            </a>
                                            / 
                                            <a href="{{ route('admin.courses', $content->course->category->id) }}">
                                                {{ $content->course->category->name ?? '' }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $content->user->name ?? '' }}
                                            <br>
                                            <span class="badge badge-info">{{ date('M d, Y h:ia', strtotime($content->created_at)) ?? '' }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $content->getStatusColor($content->status) }}">
                                                {{ $content->getStatus($content->status) ?? '' }}
                                            </span>
                                            <br>
                                            <span class="badge badge-info">{{ date('M d, Y h:ia', strtotime($content->updated_at)) ?? '' }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $content->getVisibilityColor($content->visibility) }}">
                                                {{ $content->getVisibility($content->visibility) ?? '' }}
                                            </span>
                                            <br>
                                            <a href="{{ asset('storage/' . $content->attachment) }}" download>
                                                <span class="badge badge-info">
                                                    <i class="fas fa-download"></i>
                                                    Download
                                                </span>
                                            </a>    
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="4">No record found.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>            
            </div>

            <div class="card-footer pt-2 pb-0">
                <span class="float-right">{{ $contents->links() }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        @include('admin.contents._tools')
    </div>
</div>
@endsection
