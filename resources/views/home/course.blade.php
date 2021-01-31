@extends('layouts.home')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ $course->name }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('home.category.show', $category->id) }}">{{ $category->name }}</a></li>
            <li class="breadcrumb-item active">{{ $course->name }}</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        @if(sizeof($contents) > 0)
            @foreach($contents as $content)
                <div class="callout @if($contents->first()->id == $content->id) {{ 'callout-info' }} @endif">
                    <span class="badge badge-success  float-right"><small>Uploaded on {{ date('M d, Y', strtotime($content->created_at)) ?? '' }}</small></span>
                    <h5>{{ $content->name ?? '' }}</h5>
                    <span class="float-right">
                        <a href="{{ route('home.content.download', $content->id) }}">
                            Download</a>
                        &nbsp;({{ $content->join('downloads', 'contents.id', '=', 'downloads.content_id')
                                ->where('contents.id', '=', $content->id)
                                ->count() ?? '' }})  
                    </span>
                    <p>
                        {{ $content->description ?? '' }}
                        <br>
                        <em><small>Uploaded by <strong>{{ $content->user->name ?? '' }}</strong></small></em>
                    </p>
                    
                </div>
            @endforeach 
        @else
            <div class="callout callout-danger">
                <h5>No records found.</h5>
                <p>You may select other courses.</p>
            </div>
        @endif
    </div> 

    <div class="col-md-4">
        @include('home._courses')
    </div>
</div>
@endsection
