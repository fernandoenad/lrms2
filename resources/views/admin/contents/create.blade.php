@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark"> New Content</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.categories') }}">Categories</a></li>
            <li class="breadcrumb-item active">New Content</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="card card-outline card-primary">
            <div class="card-header border-transparent">
                New Content
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.contents.store') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="form-group row">
                    <label for="course_id" class="col-md-2 col-form-label text-md-right">{{ __('Course') }}</label>

                    <div class="col-md-10">
                        <select id="course_id" type="text" class="form-control @error('course_id') is-invalid @enderror" name="course_id" value="{{ old('course_id') }}" autocomplete="course_id" autofocus>
                            <option value="">Select</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" @if(old('course_id') == $course->id) ?? {{ 'selected' }} @endif>{{ $course->name }} ({{ $course->category->name }})</option>
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
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

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
                        <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description" autofocus>{{ old('description') }} </textarea>

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

                        @error('attachment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status" class="col-md-2 col-form-label text-md-right">{{ __('Status') }}</label>

                    <div class="col-md-10">
                        <select id="status" type="text"  class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" autocomplete="status" autofocus>
                            <option value="">Select</option>
                            <option value="1" @if(old('status') == 1) {{ 'selected' }} @endif>New</option>
                            <option value="2" @if(old('status') == 2) {{ 'selected' }} @endif>Pending</option>
                            <option value="3" @if(old('status') == 3) {{ 'selected' }} @endif>Approved</option>
                        </select>

                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-4 offset-md-2">
                        <a href="{{ route('admin.contents') }}" class="btn btn-default">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" id="image-submit" class="btn btn-primary float-right">
                            {{ __('Save content') }}
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
        @include('admin.contents._tools')
    </div>
</div>

<div class="modal fade" id="progress-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content bg-default">
            <div class="modal-body">
                <strong class="text-center">Uploading media...</strong>
            </div>
            
        </div>
    </div>
</div>

@endsection
