@if(strpos(Route::currentRouteName(), 'admin') != '')
    @extends('layouts.admin')
@else 
    @extends('layouts.my')
@endif

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Unauthorized Access</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Unauthorized Access</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="error-page">    
        <h2 class="headline text-warning"> 401</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Unauthorized access.</h3>

            <p>
                You are not authorized to access this feature. Please consult
                the Site Managers. Meanwhile, you may <a href="{{ route('home') }}">return 
                to dashboard</a>.
            </p>         
        </div>
    </div>
</div>
@endsection
