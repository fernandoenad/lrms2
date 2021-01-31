@extends('layouts.home')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Server Error</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Server Error</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="error-page">    
        <h2 class="headline text-warning"> 500</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Server error.</h3>

            <p>
                The server encountered an error. Please reach out the web admin. Meanwhile, you may <a href="{{ route('home') }}">return 
                to dashboard</a>.
            </p>         
        </div>
    </div>
</div>
@endsection
