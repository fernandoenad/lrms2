@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Overview</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Overview</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-photo-video"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Contents</span>
                        <span class="info-box-number">
                            {{ number_format($contents_c, 0) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-list"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Inventories</span>
                        <span class="info-box-number">
                            {{ number_format($inventories_c, 0) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Users</span>
                        <span class="info-box-number">
                            {{ number_format($users_c, 0) }}
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
                Recently Uploaded Contents
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0 table-hover">
                        <thead>
                            <tr>
                                <th>Content</th>
                                <th>Uploaded by</th>
                                <th>Status / Visibility</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeof($contents_f) > 0)
                                @foreach($contents_f as $content)
                                    <tr>
                                        <td title="{{ $content->description ?? '' }}">
                                            <a href="{{ route('admin.contents.display', $content->id) }}">
                                                <strong>{{ $content->name ?? '' }}</strong>
                                            </a>
                                            <br>
                                            {{ $content->course->name ?? '' }} / 
                                            {{ $content->course->category->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $content->user->name ?? '' }}
                                            <br>
                                            <span class="badge badge-info">{{ date('M d, Y h:ia', strtotime($content->created_at)) ?? '' }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $content->getStatusColor($content->status) ?? ''}}">
                                                {{ $content->getStatus($content->status) ?? '' }}
                                            </span>
                                            <br>
                                            <span class="badge badge-{{ $content->getVisibilityColor($content->visibility)}}">
                                                {{ $content->getVisibility($content->visibility) ?? '' }}
                                            </span>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>            
            </div>

            <div class="card-footer">
                <span class="float-right"><a href="{{ route('admin.contents') }}">View all</a></span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-header">Welcome to the Admin Portal</div>

            <div class="card-body">
                <p>
                    The <strong>LRMS Admin Portal</strong> allows you to manage the application 
                    including but not limited to Content, User, and Report
                    Management. 
                </p>

                <p>
                    To begin, click on any of the menu items found on the 
                    left side-bar. 
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
