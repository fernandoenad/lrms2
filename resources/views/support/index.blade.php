@extends('layouts.home')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Support Page</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Support Page</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h1>Frequently Asked Questions (FAQs)</h1>
        <br>
        <div id="accordion">
            <div class="card card-primary">
                <div class="card-header">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        How to login?
                    </a>
                </div>

                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="card-body">
                        To login, click on the Login link found on the menu bar and on the
                        login page, supply the provisioned username and password. Only 
                        provisioned users are allowed to access the LRMS portal.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
