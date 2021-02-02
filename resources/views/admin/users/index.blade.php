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
                        <span class="info-box-text">Personnel</span>
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

        <div class="row justify-content-center">
            @if(Route::currentRouteName() == 'admin.users.edit')
                <div class="col-md-8">
                    <div class="card card-outline card-primary">
                        <div class="card-header border-transparent">
                            Modify User
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-9">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-9">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}" autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-3 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-9">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') ?? $user->username }}" autocomplete="username" autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="service" class="col-md-3 col-form-label text-md-right">{{ __('Type') }}</label>

                                <div class="col-md-9">
                                    <input list="services" id="service" type="text" class="form-control @error('service') is-invalid @enderror" name="service" value="{{ old('service') ?? $user->service }}" autocomplete="service" autofocus>
                                    <datalist id="services">
                                        @foreach($services as $service)
                                            <option value="{{ $service->service }}">
                                        @endforeach
                                    </datalist>

                                    @error('service')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="district" class="col-md-3 col-form-label text-md-right">{{ __('District') }}</label>

                                <div class="col-md-9">
                                    <input list="districts" id="district" type="text" class="form-control @error('district') is-invalid @enderror" name="district" value="{{ old('district') ?? $user->district }}" autocomplete="district" autofocus>
                                    <datalist id="districts">
                                        @foreach($districts as $district)
                                            <option value="{{ $district->district }}">
                                        @endforeach
                                    </datalist>

                                    @error('district')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role" class="col-md-3 col-form-label text-md-right">{{ __('Role') }}</label>

                                <div class="col-md-9">
                                    <select id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') ?? $user->role }}" autocomplete="role" autofocus>
                                        <option value="">Select</option>
                                        <option value="2" @if(old('role') == 2 || $user->role == 2) {{ 'selected '}} @endif>Manager</option>
                                        <option value="3" @if(old('role') == 3 || $user->role == 3) {{ 'selected '}} @endif>Personnel</option>
                                        <option value="4" @if(old('role') == 4 || $user->role == 4) {{ 'selected '}} @endif>User</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-3 offset-md-3">
                                    <a href="{{ route('admin.users') }}" class="btn btn-default">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary float-right">
                                        {{ __('Update user') }}
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            @if(Route::currentRouteName() == 'admin.users.create')
                <div class="col-md-8">
                    <div class="card card-outline card-primary">
                        <div class="card-header border-transparent">
                            Create User
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.users.store') }}">
                            @csrf
                            @method('POST')

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-9">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-9">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-3 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-9">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>
                                    <small class="text-danger">Note: The default password is the same as the username.</small>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="service" class="col-md-3 col-form-label text-md-right">{{ __('Type') }}</label>

                                <div class="col-md-9">
                                    <input list="services" id="service" type="text" class="form-control @error('service') is-invalid @enderror" name="service" value="{{ old('service') }}" autocomplete="service" autofocus>
                                    <datalist id="services">
                                        @foreach($services as $service)
                                            <option value="{{ $service->service }}">
                                        @endforeach
                                    </datalist>

                                    @error('service')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="district" class="col-md-3 col-form-label text-md-right">{{ __('District') }}</label>

                                <div class="col-md-9">
                                    <input list="districts" id="district" type="text" class="form-control @error('district') is-invalid @enderror" name="district" value="{{ old('district') }}" autocomplete="district" autofocus>
                                    <datalist id="districts">
                                        @foreach($districts as $district)
                                            <option value="{{ $district->district }}">
                                        @endforeach
                                    </datalist>

                                    @error('district')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role" class="col-md-3 col-form-label text-md-right">{{ __('Role') }}</label>

                                <div class="col-md-9">
                                    <select id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" autocomplete="role" autofocus>
                                        <option value="">Select</option>
                                        <option value="2" @if(old('role') == 2) {{ 'selected' }} @endif>Manager</option>
                                        <option value="3" @if(old('role') == 3) {{ 'selected' }} @endif>Personnel</option>
                                        <option value="4" @if(old('role') == 4) {{ 'selected' }} @endif>User</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-3 offset-md-3">
                                    <a href="{{ route('admin.users') }}" class="btn btn-default">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary float-right">
                                        {{ __('Save user') }}
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            @if(Route::currentRouteName() == 'admin.users.disable')
                <div class="col-md-8">
                    <div class="card card-outline card-primary">
                        <div class="card-header border-transparent">
                            Confirm Deactivation
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.users.disabled', $user->id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <p>
                                        Are you sure you wish to perform an account 
                                        deactivation for <strong>{{ $user->name }}?</strong>
                                        This will disable the account from accessing the 
                                        LRMS portal.
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <a href="{{ route('admin.users') }}" class="btn btn-default">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary float-right">
                                        {{ __('Deactivate user') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(Route::currentRouteName() == 'admin.users.reset')
                <div class="col-md-8">
                    <div class="card card-outline card-primary">
                        <div class="card-header border-transparent">
                            Confirm Account Reset
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.users.resetted', $user->id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <p>
                                        Are you sure you wish to perform an account 
                                        reset for <strong>{{ $user->name }}</strong>? This will
                                        reactivate the account (if currently deactivated) 
                                        and reset the password back to its default.
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <a href="{{ route('admin.users') }}" class="btn btn-default">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary float-right">
                                        {{ __('Reset user') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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
                                            <a href="{{ route('admin.users.logs', $user->id) }}">
                                                <strong>{{ $user->name ?? '' }}</strong>
                                            </a>
                                        </td>
                                        <td title="{{ $user->email ?? '' }}">
                                            {{ $user->username ?? '' }}
                                        </td>
                                        <td>{{ $user->getRole($user->role) ?? '' }}</td>
                                        <td title="{{ date('F d, Y', strtotime($user->created_at)) ?? '' }}" >
                                            {{ $user->getStatus($user->status) ?? '' }}
                                        </td>
                                        <td>    
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm" title="Modify user">
                                                <i class="fas fa-user-edit"></i>
                                            </a>
                                            @if($user->status == 1)
                                                <a href="{{ route('admin.users.disable', $user->id) }}" class="btn btn-danger btn-sm" title="Disable user">
                                                    <i class="fas fa-user-slash"></i>
                                                </a>
                                            @else
                                                <button class="btn btn-danger btn-sm" disabled title="Deactivate user">
                                                    <i class="fas fa-user-slash"></i>
                                                </button>
                                            @endif
                                            <a href="{{ route('admin.users.reset', $user->id) }}" class="btn btn-success btn-sm" title="Reset user">
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
