@extends('layouts.home')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Categories</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Categories</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Category List
            </div>

            <div class="card-body p-0">
                <table class="table table-hover m-0">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th class="text-right">Course Count</th>
                            <th class="text-right">Content Count</th>
                            <th class="text-right">Download Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(sizeof($categories) > 0)
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        <a href="{{ route('home.category.show', $category->id) }}">
                                            <strong>{{ $category->name ?? '' }}</strong>
                                        </a>
                                    </td>
                                    <td class="text-right">{{ $category->course->count() ?? '' }}</td>
                                    <td class="text-right">
                                        {{ $category->join('courses', 'categories.id', '=', 'courses.category_id')
                                            ->join('contents', 'courses.id', '=', 'contents.course_id')
                                            ->where('categories.id', '=', $category->id)
                                            ->count() ?? '' }}
                                    </td>
                                    <td class="text-right">
                                        @if(isset($category->course->first()->content()->first()->download))
                                            {{ $category->join('courses', 'categories.id', '=', 'courses.category_id')
                                                ->join('contents', 'courses.id', '=', 'contents.course_id')
                                                ->join('downloads', 'contents.id', '=', 'downloads.content_id')
                                                ->where('categories.id', '=', $category->id)
                                                ->count() ?? '' }}
                                        @else
                                            {{ '0' }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="4">No records found.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <small class="float-right"></small>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-outline card-primary">
            <div class="card-header">Welcome</div>

            <div class="card-body">
                <p>
                    <strong>LRMS</strong> or <strong>Learning Resources Management System</strong> 
                    is web-based application/system designed to provide management 
                    of digital learning resources tools to schools.
                </p>
                <p>
                    It aims to streamline the process of delivering 
                    instructional materials (e.g. modules, learning activity 
                    sheets, educational media, etc) to learners under the modular 
                    distance learning.
                </p>
                <p>
                    To get started, click on any categories found on the container panel.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
