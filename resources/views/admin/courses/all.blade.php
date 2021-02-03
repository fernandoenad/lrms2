@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Courses</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Courses </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">All Shown</span>
                        <span class="info-box-number">
                            <a href="{{ route('admin.courses.allshown') }}">
                                {{ number_format(App\Models\Course::where('visibility', '=', 1)->get()->count(), 0) }}
                            </a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-muted elevation-1"><i class="fas fa-eye-slash"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">All Hidden</span>
                        <span class="info-box-number">
                            <a href="{{ route('admin.courses.allhidden') }}">    
                             {{ number_format(App\Models\Course::where('visibility', '=', 0)->get()->count(), 0) }}
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

        <div class="row"> 
            <div class="col-md-12">       
                <div class="card card-outline card-primary">
                    <div class="card-header border-transparent">
                        Course List
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0 table-hover">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Category</th>
                                        <th>Visibility</th>
                                        <th>Owner</th>
                                        <th class="text-right">Contents #</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(sizeof($courses) > 0)
                                        @foreach($courses as $course)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.courses.show', $course->id) }}">
                                                        <strong>{{ $course->name ?? '' }}</strong>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.courses', $course->category->id) }}">
                                                        {{ $course->category->name ?? '' }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{ $course->getVisibilityColor($course->visibility) ?? '' }}">
                                                        {{ $course->getVisibility($course->visibility) ?? '' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $course->user->name ?? '' }}
                                                </td>
                                                <td class="text-right">
                                                    {{ $course->content->count() ?? '' }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.courses.edit', [$course->category->id, $course->id]) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
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

                    <div class="card-footer pb-0">
                        <span class="float-right">{{ $courses->links() }}</span>
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
