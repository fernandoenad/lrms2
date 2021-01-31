@extends('layouts.home')

@section('content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">User Information</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('my') }}">Home</a></li>
            <li class="breadcrumb-item active">User Information</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="card card-widget widget-user-2">
            <div class="widget-user-header bg-primary">
                <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="{{ asset('storage/'.$user->image ?? 'storage/avatars/no-avatar.jpg') }}" alt="User Avatar">
                </div>
                <h3 class="widget-user-username">{{ $user->name ?? '' }}</h3>
                <h5 class="widget-user-desc">{{ Auth::user()->getRole(Auth::user()->role) ?? '' }}</h5>
            </div>
            <div class="card-footer p-0">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            ID <span class="float-right">{{ $user->id ?? '' }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Email <span class="float-right">{{ $user->email ?? '' }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Username <span class="float-right">{{ $user->username ?? '' }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Service <span class="float-right">{{ $user->service ?? '' }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            District <span class="float-right">{{ $user->district ?? '' }}</span>
                        </a>
                    </li>
                </ul>
            </div>       
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header">Change password</div>

            <div class="card-body">
                <form method="POST" action="{{ route('my.password-change') }}">
                @csrf

                <div class="form-group row">
                    <label for="password" class="col-md-3 col-form-label">{{ __('Password') }}</label>

                    <div class="col-md-9">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-3 col-form-label">{{ __('Confirm') }}</label>

                    <div class="col-md-9">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3"></div>

                    <div class="col-md-9">
                        <button type="submit" class="btn btn-primary float-right">
                            Update password
                        </button>
                    </div>
                </form>
            </div>            
        </div>
    </div>
</div>
@endsection
