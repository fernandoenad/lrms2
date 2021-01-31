@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">User Management</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">User Management</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users-cog"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Managers</span>
                        <span class="info-box-number">
                            {{ number_format($managers_c, 0) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Staff</span>
                        <span class="info-box-number">
                            {{ number_format($staff_c, 0) }}
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
                User List
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0 table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Role</th>                                
                                <th>Status</th>
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeof($users_f) > 0)
                                @foreach($users_f as $user)
                                    <tr>
                                        <td title="{{ $user->service ?? '' }} [{{ $user->district ?? '' }}] ">
                                            {{ $user->name ?? '' }}
                                        </td>
                                        <td title="{{ $user->email ?? '' }}">
                                            {{ $user->username ?? '' }}
                                        </td>
                                        <td>{{ $user->getRole($user->role) ?? '' }}</td>
                                        <td title="{{ date('F d, Y', strtotime($user->created_at)) ?? '' }}" >
                                            {{ $user->getStatus($user->status) ?? '' }}
                                        </td>
                                        <td>    
                                            <a href="" class="btn btn-warning btn-sm" title="Modify user">
                                                <i class="fas fa-user-edit"></i>
                                            </a>
                                            <a href="" class="btn btn-danger btn-sm" title="Disable user">
                                                <i class="fas fa-user-slash"></i>
                                            </a>
                                            <a href="" class="btn btn-success btn-sm" title="Reset user password">
                                                <i class="fas fa-user-shield"></i>
                                            </a>
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

            <div class="card-footer pt-2 pb-0">
                <span class="float-right">{{ $users_f->links() }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-outline card-primary">
            <div class="card-header">Administrative Tools</div>

            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nnav-item active pt-2 pb-2 pr-3">
                        <form class="form-inline ml-3">
                        <div class="input-group input-group-md">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search users" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users') }}" class="nav-link">
                            <i class="fas fa-users"></i>
                            View all 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.inactive') }}" class="nav-link">
                            <i class="fas fa-users-slash"></i>
                            View disabled 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user-plus"></i>
                            New 
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
