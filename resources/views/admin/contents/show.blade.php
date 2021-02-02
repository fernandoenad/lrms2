@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Content</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.contents') }}">Contents</a></li>
            <li class="breadcrumb-item active">Content</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
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

        <div class="card card-widget widget-user">
            <div class="widget-user-header bg-primary">
                <h3 class="widget-user-username">{{ $content->name ?? '' }}</h3>
                <h5 class="widget-user-desc">{{ $content->description ?? '' }}</h5>                
            </div>
            
            <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ asset('storage/images/file-icon.png') }}" alt="User Avatar">
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{ $content->course->name ?? '' }}</h5>
                            <span class="description-text">COURSE</span>
                        </div>
                    </div>

                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{ $content->course->category->name ?? '' }}</h5>
                            <span class="description-text">CATEGORY</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header">{{ $content->user->name ?? '' }}</h5>
                            <span class="description-text">UPLOADED BY</span>
                        </div>
                    </div>
                                        
                </div>

                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{ date('M d, Y h:ia', strtotime($content->created_at)) ?? '' }}</h5>
                            <span class="description-text">Uploaded at</span>
                        </div>
                    </div>

                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{ date('M d, Y h:ia', strtotime($content->updated_at)) ?? '' }}</h5>
                            <span class="description-text">Updated at</span>
                        </div>
                    </div>  

                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header">{{ $content->download->count() ?? '' }}</h5>
                            <span class="description-text">DOWNLOAD COUNT</span>
                        </div>
                    </div>                  
                </div>
            </div>
            <div class="card-footer p-2">
                <div class="row">
                    <div class="col-sm-12">
                            <span class="badge badge-{{ $content->getStatusColor($content->status) }}">
                                Status: {{ $content->getStatus($content->status) }}
                            </span>

                            <span class="badge badge-{{ $content->getVisibilityColor($content->visibility) }}">
                                Visibility: {{ $content->getVisibility($content->visibility) }}
                            </span>

                            <span class="float-right">
                                <a href="{{ asset('storage/' . $content->attachment) }}" download class="btn btn-primary btn-sm btn-sm"><i class="fas fa-download"></i> Download</a>
                                <a href="{{ route('admin.contents.edit', $content->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Modify</a>
                            </span>
                    </div> 
                </div>   
            </div>           
        </div>

        <div class="card card-outline card-primary">
            <div class="card-header border-transparent">
                Content Logs
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0 table-hover">
                        <thead>
                            <tr>
                                <th>Timestamp</th>
                                <th>User</th>                                
                                <th>Action</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeof($contentlogs) > 0)
                                @foreach($contentlogs as $contentlog)
                                    <tr>
                                        <td>{{ date('M d, Y h:ia', strtotime($contentlog->created_at)) ?? '' }}</td>
                                        <td>{{ $contentlog->user->name ?? '' }}</td>
                                        <td>{{ $contentlog->action ?? '' }}</td>
                                        <td>
                                            <?php $data = json_decode($contentlog->data, true); ?>
                                            Name: <span class="badge badge-default">
                                                {{ $data['name'] }}
                                            </span> <br>
                                            Description: <span class="badge badge-default">
                                                {{ $data['description'] }}
                                            </span> <br>
                                            Attachment: <a href="{{ asset('storage/' . $data['attachment']) }}" download>
                                                <span class="badge badge-default"><i class="fas fa-download"></i> Download
                                            </span></a><br>
                                            Course: <span class="badge badge-default">
                                                {{ App\Models\Course::find($data['course_id'])->name }}
                                            </span> <br>
                                            User: <span class="badge badge-default">
                                                {{ App\Models\User::find($data['user_id'])->name }}
                                            </span> <br>
                                            Status: <span class="badge badge-{{ $contentlog->content->getStatusColor($data['status']) }}">
                                                {{ $contentlog->content->getStatus($data['status']) }}
                                            </span> <br>
                                            Visibility: <span class="badge badge-{{ $contentlog->content->getVisibilityColor($data['visibility']) }}">
                                                {{ $contentlog->content->getVisibility($data['visibility']) }}
                                            </span> <br>
                                            Sort: <span class="badge badge-default">
                                                {{ $data['sort'] }}
                                            </span> <br>  
                                        </td>
                                    </ty>
                                @endforeach
                            @else
                                <tr><td colspan="4">No record found.</td></ty>
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

    <div class="col-md-3">
        @include('admin.contents._tools')
    </div>
</div>

@endsection
