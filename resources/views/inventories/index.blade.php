@extends('layouts.my')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">LR Inventory</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">LR Inventory</li>
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
            <div class="card-header">Inventory List</div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0 table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Level / Area</th>                                
                                <th>LR Type</th>
                                <th class="text-right">Copies</th>
                                <th>School Year</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                         @if(sizeof($inventories) > 0)
                            @foreach($inventories as $inventory)
                                <tr>
                                    <td>{{ $inventory->title ?? '' }}</td>
                                    <td>{{ $inventory->gradelevel ?? '' }} / {{ $inventory->learningarea ?? '' }}</td>
                                    <td>{{ $inventory->lrtype ?? '' }}</td>
                                    <td class="text-right">{{ $inventory->copies ?? '' }}</td>
                                    <td>{{ $inventory->schoolyear ?? '' }}</td>
                                    <td class="text-right">
                                        <form method="POST" action="{{ route('inventory.delete', $inventory->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                            <a href="{{ route('inventory.edit', $inventory->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                onClick="return confirm('Are you sure you wish to delete this item?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="6">No record found.</td></tr>
                        @endif
                            
                        </tbody>
                    </table>
                </div>   
            </div>
            <div class="card-footer">
                <span class="float-right">{{ $inventories->links() }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        @include('inventories._tools')
    </div>
</div>
@endsection