@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">User Download Logs</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">User Management</a></li>
            <li class="breadcrumb-item active">User Download Logs</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="card card-outline card-primary">
            <div class="card-header">User Logs for <strong>{{ $user->name }} ({{ $user->username }})</strong></div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0 table-hover">
                        <thead>
                            <tr>
                                <th>Timestamp</th>                                
                                <th>Content (Course- Category)</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeof($logs) > 0)
                                @foreach($logs as $log)
                                    <tr>
                                        <td>{{ date('F d, Y H:ia', strtotime($log->created_at )) ?? '' }}</td>
                                        <td>
                                            <strong>{{ $log->content->name ?? '' }}</strong>
                                            ({{ $log->content->course->category->name ?? '' }}-
                                            {{ $log->content->course->name ?? '' }})
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">No record found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer pt-2 pb-0">
                <span class="float-right">{{ $logs->links() }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-outline card-primary">
            <div class="card-header">Administrative Tools</div>

            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nnav-item active pt-2 pb-2 pr-3">
                        <form class="form-inline ml-3" method="POST" action="{{ route('admin.users.search') }}">
                        @csrf

                        <div class="input-group input-group-md">
                            <input class="form-control form-control-navbar" type="search" name="str" value="{{ request()->str }}" placeholder="Search users" aria-label="Search">
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
                        <a href="{{ route('admin.users.create') }}" class="nav-link">
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
