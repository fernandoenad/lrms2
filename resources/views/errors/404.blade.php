@if(strpos(Route::currentRouteName(), 'admin') != '')
    @extends('layouts.admin')
@else 
    @extends('layouts.my')
@endif

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Page Not Found</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Page Not Found</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="error-page">    
        <h2 class="headline text-danger"> 404</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Page not found.</h3>

            <p>
                We could not find the page you were looking for. 
                Meanwhile, you may <a href="{{ route('home') }}">return 
                to dashboard</a>.
            </p>         
        </div>
    </div>
</div>
@endsection
