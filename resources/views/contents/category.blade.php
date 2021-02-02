@extends('layouts.my')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Courses</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('content') }}">LR Categories</a></li>
            <li class="breadcrumb-item active">Courses</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        @include('contents._categories')
    </div>

    <div class="col-md-9">
        <div class="card card-outline card-primary">
            <div class="card-header">
                Course List of <strong>{{ $category->name }}</strong>
            </div>

            <div class="card-body p-0">
                <table class="table table-hover m-0">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th class="text-right">Content Count</th>
                            <th class="text-right">Download Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(sizeof($courses) > 0)
                            @foreach($courses as $course)
                                <tr>
                                    <td>
                                        <a href="{{ route('content.course.show', [$category->id, $course->id]) }}">
                                            <strong>{{ $course->name ?? '' }}</strong>
                                        </a>
                                    </td>
                                    <td class="text-right">
                                        {{ $course->join('contents', 'courses.id', '=', 'contents.course_id')
                                            ->where('courses.id', '=', $course->id)
                                            ->where('contents.status', '=', 3)
                                            ->where('contents.visibility', '=', 1)
                                            ->count() ?? '' }}
                                    </td>
                                    <td class="text-right">
                                        @if(isset($course->first()->content()->first()->download))
                                            {{ $course->join('contents', 'courses.id', '=', 'contents.course_id')
                                                ->join('downloads', 'contents.id', '=', 'downloads.content_id')
                                                ->where('courses.id', '=', $course->id)
                                                ->where('contents.status', '=', 3)
                                                ->where('contents.visibility', '=', 1)
                                                ->count() ?? '' }}
                                        @else
                                            {{ '0' }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="3">No records found.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <small class="float-right"></small>
            </div>
        </div>
    </div>
</div>
@endsection
