@extends('layouts.admin')

@section('content')
<!-- Controller: Admin/AdminController | For All Roles-->
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item" active>Dashboard</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="row">
            @auth
		    @if(Auth::user()->role <= 2)
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
            @endif
            @endauth
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
