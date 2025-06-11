@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Inventory Management</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Inventory Management</li>
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
        
        <div class="card card-outline card-primary">
            <div class="card-header border-transparent">
                Inventory List
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0 table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category / Area</th>
                                <th>LR Type</th>
                                <th>Copies</th>
                                <th>User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeof($inventories) > 0)
                                @foreach($inventories as $inventory)
                                    <tr>
                                        <td>{{ $inventory->title ?? '' }}</td>
                                        <td>{{ App\Models\Category::find($inventory->gradelevel)->name ?? '' }} / {{ $inventory->learningarea ?? '' }}</td>
                                        <td>{{ $inventory->lrtype ?? '' }}</td>
                                        <td>{{ $inventory->copies ?? '' }}</td>
                                        <td>{{ App\Models\User::find($inventory->user_id)->name ?? '' }}</td>
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
                <span class="float-right">{{ $inventories->links() }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        @include('admin.inventories._tools')
    </div>
</div>
@endsection
