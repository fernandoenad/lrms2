@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Modify Content</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.mycontents.course', $content->course->id) }}">Courses</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.mycontents.course.display', [$content->course->id, $content->id]) }}">Content</a></li>
            <li class="breadcrumb-item active">Modify Content</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <div class="card card-outline card-primary">
            <div class="card-header border-transparent">
                Modify Content
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.mycontents.update', [$content->course->id, $content->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="form-group row">
                    <label for="course_id" class="col-md-2 col-form-label text-md-right">{{ __('Course') }}</label>

                    <div class="col-md-10">
                        <select id="course_id" type="text" class="form-control @error('course_id') is-invalid @enderror" name="course_id" value="{{ old('course_id') }}" autocomplete="course_id" autofocus>
                            <option value="">Select</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" @if(old('course_id') == $course->id || $content->course_id == $course->id) ?? {{ 'selected' }} @endif>{{ $course->name }} ({{ $course->category->name }})</option>
                            @endforeach                            
                        </select>

                        @error('course_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $content->name ?? '' }}" autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>

                    <div class="col-md-10">
                        <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description" autofocus>{{ old('description') ?? $content->description ?? '' }} </textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="attachment" class="col-md-2 col-form-label text-md-right">{{ __('Attachment') }}</label>

                    <div class="col-md-10">
                        <input id="attachment" type="file" class="form-control-file @error('attachment') is-invalid @enderror" name="attachment" value="{{ old('attachment') }}" autocomplete="attachment" autofocus>
                        <small>
                            Current attachment: 
                            <strong class="text-danger">
                                {{  $content->attachment ?? '' }}
                            </strong>
                        </small>

                        @error('attachment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-4 offset-md-2">
                        <a href="{{ route('admin.mycontents.course.display', [$content->course->id, $content->id]) }}" class="btn btn-default">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary float-right">
                            {{ __('Update content') }}
                        </button>
                    </div>
                </div>
                </form>
            </div>

            <div class="card-footer pt-0 pb-0">
                <span class="float-right"></span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        @include('admin.mycontents._tools')
    </div>
</div>
@endsection