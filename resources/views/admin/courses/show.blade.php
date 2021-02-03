@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Course</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.courses.allshown') }}">Courses</a></li>
            <li class="breadcrumb-item active">Course </li>
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
                        Content List
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0 table-hover">
                                <thead>
                                    <tr>
                                        <th>Content</th>
                                        <th>Status</th>
                                        <th>Uploader</th>
                                        <th class="text-right">Download #</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(sizeof($contents) > 0)
                                        @foreach($contents as $content)
                                            <tr>
                                                <td title="{{ $content->description ?? '' }}">
                                                    <a href="{{ route('admin.contents.show', $content->id) }}">
                                                        <strong>{{ $content->name ?? '' }}</strong>
                                                    </a>
                                                    <br>
                                                    <small>
                                                        {{ $content->course->name ?? '' }} / 
                                                        {{ $content->course->category->name ?? '' }}
                                                    </small>
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{ $content->getStatusColor($content->status) ?? 'info' }}">
                                                        {{ $content->getStatus($content->status) ?? '' }}
                                                    </span>
                                                    <br>
                                                    <span class="badge badge-{{ $content->getVisibilityColor($content->visibility) ?? 'info' }}">
                                                        {{ $content->getVisibility($content->visibility) ?? '' }}
                                                    </span>
                                                </td>
                                                <td>{{ $content->user->name ?? '' }}</td>
                                                <td class="text-right">{{ $content->download->count() ?? '' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.contents.move-up', $content->id) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-arrow-up"></i>
                                                    </a>
                                                    <a href="{{ route('admin.contents.move-down', $content->id) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-arrow-down"></i>
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

                    <div class="card-footer pb-0">
                        <span class="float-right">{{ $contents->links() }}</span>
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
