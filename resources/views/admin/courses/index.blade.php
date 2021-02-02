@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Course Management</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Course Management </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Shown</span>
                        <span class="info-box-number">
                            <a href="{{ route('admin.courses.shown', $category->id) }}">
                                {{ number_format($shown_c, 0) }}
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
                            <a href="{{ route('admin.courses.hidden', $category->id) }}">    
                             {{ number_format($hidden_c, 0) }}
                             </a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">All Shown</span>
                        <span class="info-box-number">
                            <a href="{{ route('admin.courses.shown', $category->id) }}">
                                {{ number_format($shown_c, 0) }}
                            </a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-muted elevation-1"><i class="fas fa-eye-slash"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">All Hidden</span>
                        <span class="info-box-number">
                            <a href="{{ route('admin.courses.hidden', $category->id) }}">    
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

        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Route::currentRouteName() == 'admin.courses.create')
                    <div class="card card-outline card-primary">
                        <div class="card-header border-transparent">
                            New Course
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.courses.store', $category->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Category') }}</label>

                                <div class="col-md-9">
                                    <input id="category_id" type="hidden" class="form-control @error('category_id') is-invalid @enderror" name="category_id" value="{{ old('category_id') ?? $category->id }}" autocomplete="category_id" autofocus>
                                    <input id="category_name" readonly type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ old('category_name') ?? $category->name }}" autocomplete="category_name" autofocus>

                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

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
                                <label for="user_id" class="col-md-3 col-form-label text-md-right">{{ __('Personnel') }}</label>

                                <div class="col-md-9">
                                    <select id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" autocomplete="user_id" autofocus>
                                        <option value="">Select</option>
                                        @foreach($personnels as $personnel)
                                            <option value="{{ $personnel->id }}" @if(old('user_id') == $personnel->id) {{ 'selected'}} @endif>{{ $personnel->name }} ({{ $personnel->getRole($personnel->role) }})</option> 
                                        @endforeach
                                    </select>

                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="visibility" class="col-md-3 col-form-label text-md-right">{{ __('Visibility') }}</label>

                                <div class="col-md-9">
                                    <select id="visibility" type="text" class="form-control @error('visibility') is-invalid @enderror" name="visibility" value="{{ old('visibility') }}" autocomplete="visibility" autofocus>
                                        <option value="1" @if(old('visibility') == 1) {{ 'selected' }} @endif>Show</option> 
                                        <option value="0" @if(old('visibility') == 0) {{ 'selected' }} @endif>Hide</option> 
                                        <option value="" @if(old('visibility') == null) {{ 'selected' }} @endif>Select</option> 
                                    </select>

                                    @error('visibility')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-3 offset-md-3">
                                    <a href="{{ route('admin.courses', $category->id) }}" class="btn btn-default">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary float-right">
                                        {{ __('Save category') }}
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

                @if(Route::currentRouteName() == 'admin.courses.edit')
                    <div class="card card-outline card-primary">
                        <div class="card-header border-transparent">
                            Modify Category
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.courses.update', [$category->id, $course->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Category') }}</label>

                                <div class="col-md-9">
                                    <input id="category_id" type="hidden" class="form-control @error('category_id') is-invalid @enderror" name="category_id" value="{{ old('category_id') ?? $category->id }}" autocomplete="category_id" autofocus>
                                    <input id="category_name" readonly type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ old('category_name') ?? $category->name }}" autocomplete="category_name" autofocus>

                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-9">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $course->name ?? '' }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_id" class="col-md-3 col-form-label text-md-right">{{ __('Personnel') }}</label>

                                <div class="col-md-9">
                                    <select id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" autocomplete="user_id" autofocus>
                                        <option value="">Select</option>
                                        @foreach($personnels as $personnel)
                                            <option value="{{ $personnel->id }}" @if(old('user_id') == $personnel->id || $personnel->id == $course->user_id) {{ 'selected'}} @endif>{{ $personnel->name }} ({{ $personnel->getRole($personnel->role) }})</option> 
                                        @endforeach
                                    </select>

                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="visibility" class="col-md-3 col-form-label text-md-right">{{ __('Visibility') }}</label>

                                <div class="col-md-9">
                                    <select id="visibility" type="text" class="form-control @error('visibility') is-invalid @enderror" name="visibility" value="{{ old('visibility') }}" autocomplete="visibility" autofocus>
                                        <option value="1" @if($course->visibility == 1) {{ 'selected' }} @endif>Show</option> 
                                        <option value="0" @if($course->visibility == 0) {{ 'selected' }} @endif>Hide</option> 
                                    </select>

                                    @error('visibility')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-3 offset-md-3">
                                    <a href="{{ route('admin.courses', $category->id) }}" class="btn btn-default">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary float-right">
                                        {{ __('Update category') }}
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
            </div>
        </div>
        <div class="row"> 
            <div class="col-md-4">
                @include('admin.courses._categories')
            </div>
            <div class="col-md-8">       
                <div class="card card-outline card-primary">
                    <div class="card-header border-transparent">
                        Course List
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0 table-hover">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Visibility</th>
                                        <th class="text-right">Contents #</th>
                                        <th width="30%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(sizeof($courses) > 0)
                                        @foreach($courses as $course)
                                            <tr>
                                                <td>
                                                    <a href="#" title="Owner: {{ $course->user->name ?? '' }}">
                                                        <strong>{{ $course->name ?? '' }}</strong>
                                                    </a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{ $course->getVisibilityColor($course->visibility) ?? '' }}">
                                                        {{ $course->getVisibility($course->visibility) ?? '' }}
                                                    </span>
                                                </td>
                                                <td class="text-right">
                                                    {{ $course->content->count() ?? '' }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.courses.edit', [$course->category->id, $course->id]) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('admin.courses.move-up', [$course->category->id, $course->id]) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-arrow-up"></i>
                                                    </a>
                                                    <a href="{{ route('admin.courses.move-down', [$course->category->id, $course->id]) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-arrow-down"></i>
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

                    <div class="card-footer pt-0 pb-0">
                        <span class="float-right"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        @include('admin.contents._tools')
    </div>
</div>
@endsection
