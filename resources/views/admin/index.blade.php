@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Overview</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Overview</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-photo-video"></i></span>

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
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">LR Inventory</span>
                        <span class="info-box-number">
                            {{ number_format($inventories_c, 0) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Users</span>
                        <span class="info-box-number">
                            {{ number_format($users_c, 0) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-outline card-primary">
            <div class="card-header border-transparent">
                Latest Content Uploads
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th width="40%">Name</th>
                                <th>Uploaded by</th>
                                <th>Uploaded on</th>
                                <th class="text-right">Download Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeof($contents_f) > 0)
                                @foreach($contents_f as $content)
                                    <tr>
                                        <td>
                                            <strong>{{ $content->name ?? '' }}</strong>
                                            <br>
                                            <small>{{ $content->description ?? '' }}</small>
                                        </td>
                                        <td>{{ $content->user->name ?? '' }}</td>
                                        <td>{{ date('F d, Y', strtotime($content->created_at)) ?? '' }}</td>
                                        <td class="text-right">{{ $content->download->count() }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="3">No record found.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>            
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-outline card-primary">
            <div class="card-header">Welcome</div>

            <div class="card-body">
                <p>
                    <strong>LRMS Admin Portal</strong> allows you to manage
                    the application to suit your needs.
                </p>
                <p>
                    To get started, click on any menu items found on the left panel.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
