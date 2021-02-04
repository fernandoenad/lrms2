@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Report Mgmt</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Report Mgmt</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-inbox"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">New</span>
                        <span class="info-box-number">
                            <a href="{{ route('admin.mycontents.shown') }}">    
                                {{ number_format(App\Models\ContentReport::where('user_id', 'like', (Auth::user()->role <= 2 ? '%' : Auth::user()->id))
                                    ->where('status', '=', 1)
                                    ->get()->count(), 0) }}
                             </a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-inbox"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pending</span>
                        <span class="info-box-number">
                            <a href="{{ route('admin.mycontents.hidden') }}">    
                                {{ number_format(App\Models\ContentReport::where('user_id', 'like', (Auth::user()->role <= 2 ? '%' : Auth::user()->id))
                                    ->where('status', '=', 2)
                                    ->get()->count(), 0) }}
                             </a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-inbox"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Approved</span>
                        <span class="info-box-number">
                            <a href="{{ route('admin.mycontents.submissions') }}">    
                                {{ number_format(App\Models\ContentReport::where('user_id', 'like', (Auth::user()->role <= 2 ? '%' : Auth::user()->id))
                                    ->where('status', '=', 3)
                                    ->get()->count(), 0) }}
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
                        Report List
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0 table-hover">
                                <thead>
                                    <tr>
                                        <th>Reported by / Timestamp</th>
                                        <th>Title / Description</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(sizeof($contentreports) > 0)
                                        @foreach($contentreports as $contentreport)
                                            <tr>
                                                <td>
                                                    <strong>{{ $contentreport->user->name ?? '' }}</strong>
                                                    <br>
                                                    <small>{{ date('M d, Y', strtotime($contentreport->created_at)) ?? '' }}</small>
                                                </td>
                                                <td>
                                                    <strong>{{ $contentreport->title ?? '' }}<strong>
                                                    <br>
                                                    <small>{{ $contentreport->description ?? '' }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{ $contentreport->getStatusColor($contentreport->status) ?? '' }}">
                                                        {{ $contentreport->getStatus($contentreport->status) ?? '' }}
                                                    </span>
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('admin.reports.show', $contentreport->id) }}" class="btn btn-primary btn-sm">Take action</a>
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

                    <div class="card-footer pt-0 pb-0">
                        <span class="float-right">{{ $contentreports->links() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        @include('admin.reports._tools')
    </div>
</div>
@endsection
