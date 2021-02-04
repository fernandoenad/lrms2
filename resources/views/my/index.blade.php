@extends('layouts.my')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Overview</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Overview</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card card-outline card-primary">
            <div class="card-header">Recent Uploads</div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0 table-hover">
                        <thead>
                            <tr>
                                <th>Content</th>
                                <th>Course / Category</th>                                
                                <th>Uploaded by</th>
                                <th>Uploaded at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeof($contents) > 0)
                                @foreach($contents as $content)
                                    <tr>
                                        <td>
                                            <a href="{{ route('content.show', $content->id) }}">
                                                <strong>{{ $content->name ?? '' }}</strong>
                                            </a> 
                                        </td>
                                        <td>
                                            {{ $content->course->category->name ?? '' }} / 
                                            {{ $content->course->name ?? '' }}
                                        </td>
                                        <td>{{ $content->user->name ?? '' }}</td>
                                        <td>
                                            <span class="badge badge-default float-right">
                                                {{ date('M d, Y h:ia', strtotime($content->created_at)) ?? '' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>   
            </div>
            <div class="card-footer">
                <span class="float-right"><a href="{{ route('content') }}">View all</a></span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Your Recent Downloads</div>

            <div class="card-body p-0">
                <table class="table table-hover m-0">
                    <tbody>
                    
                        @if(sizeof($downloads) > 0)
                            @foreach($downloads as $download)
                                <tr>
                                    <td>
                                        {{ $download->content->name }}
                                        <span class="badge badge-default float-right">{{ date('m/d/Y h:ia', strtotime($download->created_at )) ?? '' }}</span>                                    
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer p-0">
            </div>
        </div>
    </div>
</div>
@endsection