@extends('layouts.my')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">New LR Item</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('inventory') }}">LR Inventory</a></li>
            <li class="breadcrumb-item active">New LR Item</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="card card-outline card-primary">
            <div class="card-header border-transparent">
                New LR Item    
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('inventory.store') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="form-group row">
                    <label for="schoolyear" class="col-md-3 col-form-label text-md-right">{{ __('School Year') }}</label>

                    <div class="col-md-9">
                        <input id="schoolyear" readonly type="text" class="form-control @error('schoolyear') is-invalid @enderror" name="schoolyear" value="{{ old('schoolyear') ?? 2020 }}" autocomplete="schoolyear" autofocus>

                        @error('schoolyear')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('LR Title') }}</label>

                    <div class="col-md-9">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="e.g. Ibong Adarna" autocomplete="title" autofocus>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="learningarea" class="col-md-3 col-form-label text-md-right">{{ __('Learning Area') }}</label>

                    <div class="col-md-9">
                        <input list="learningareas" id="learningarea" type="text" class="form-control @error('learningarea') is-invalid @enderror" name="learningarea" placeholder="e.g. English, Filipino, Mathematics" value="{{ old('learningarea') }}" autocomplete="learningarea" autofocus>
                        <datalist id="learningareas">
                            <?php 
                                $inventories = App\Models\Inventory::orderBy('learningarea', 'asc')
                                ->groupBy('learningarea')->select('learningarea')->get();
                            ?>
                            @foreach($inventories as $dropdown)
                            <option value="{{ $dropdown->learningarea ?? ''}}">
                            @endforeach
                        </datalist>

                        @error('learningarea')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="gradelevel" class="col-md-3 col-form-label text-md-right">{{ __('Grade Level') }}</label>

                    <div class="col-md-9">
                        <select id="gradelevel" type="text" class="form-control @error('gradelevel') is-invalid @enderror" name="gradelevel" value="{{ old('gradelevel') }}" autocomplete="gradelevel" autofocus>
                            <option value="">Select</option>
                            <option value="SPED" @if(old('gradelevel') == 'SPED') {{ 'selected' }} @endif>SPED</option>
                            <option value="Kindergarten" @if(old('gradelevel') == 'Kindergarten') {{ 'selected' }} @endif>Kindergarten</option>
                            @for($i=1; $i<=12; $i++)
                                <option value="Grade {{ $i }}" @if(old('gradelevel') == 'Grade ' . $i) {{ 'selected' }} @endif>Grade {{ $i }}</option>
                            @endfor
                        </select>

                        @error('gradelevel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="author" class="col-md-3 col-form-label text-md-right">{{ __('Author') }}</label>

                    <div class="col-md-9">
                        <input id="author" type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author') }}" placeholder="N/A of none." autocomplete="author" autofocus>

                        @error('author')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="publisher" class="col-md-3 col-form-label text-md-right">{{ __('Publisher') }}</label>

                    <div class="col-md-9">
                        <input id="publisher" type="text" class="form-control @error('publisher') is-invalid @enderror" name="publisher" value="{{ old('publisher') }}" placeholder="N/A of none." autocomplete="publisher" autofocus>

                        @error('publisher')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lrtype" class="col-md-3 col-form-label text-md-right">{{ __('LR Type') }}</label>

                    <div class="col-md-9">
                        <input list="lrtypes" id="lrtype" type="text" class="form-control @error('lrtype') is-invalid @enderror" name="lrtype" value="{{ old('lrtype') }}" placeholder="e.g. Module, Worksheet, Book, Activity Sheet, etc." autocomplete="lrtype" autofocus>
                        <datalist id="lrtypes">
                            <?php 
                                $inventories = App\Models\Inventory::orderBy('lrtype', 'asc')
                                ->groupBy('lrtype')->select('lrtype')->get();
                            ?>
                            @foreach($inventories as $dropdown)
                            <option value="{{ $dropdown->lrtype ?? '' }}">
                            @endforeach
                        </datalist>

                        @error('lrtype')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="acquisitiondate" class="col-md-3 col-form-label text-md-right">{{ __('Acquisition Date') }}</label>

                    <div class="col-md-9">
                        <input id="acquisitiondate" type="date" class="form-control @error('acquisitiondate') is-invalid @enderror" name="acquisitiondate" value="{{ old('acquisitiondate') }}" autocomplete="acquisitiondate" autofocus>

                        @error('acquisitiondate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="acquisitionmode" class="col-md-3 col-form-label text-md-right">{{ __('Acquisition Mode') }}</label>

                    <div class="col-md-9">
                        <select id="acquisitionmode" type="text" class="form-control @error('acquisitionmode') is-invalid @enderror" name="acquisitionmode" value="{{ old('acquisitionmode') }}" autocomplete="acquisitionmode" autofocus>
                            <option value="">Select</option>
                            <option value="Donated" @if(old('acquisitionmode') == 'Donated') {{ 'selected' }} @endif>Donated</option>
                            <option value="Procured" @if(old('acquisitionmode') == 'Procured') {{ 'selected' }} @endif>Procured</option>
                        </select>

                        @error('acquisitionmode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="copies" class="col-md-3 col-form-label text-md-right">{{ __('Copies') }}</label>

                    <div class="col-md-9">
                        <input id="copies" type="number" class="form-control @error('copies') is-invalid @enderror" name="copies" value="{{ old('copies') }}" placeholder="0" autocomplete="copies" autofocus>

                        @error('copies')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status" class="col-md-3 col-form-label text-md-right">{{ __('Status') }}</label>

                    <div class="col-md-9">
                        <select id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" autocomplete="status" autofocus>
                            <option value="">Select</option>
                            <option value="Distributed to Learners" @if(old('status') == "Distributed to Learners") {{ 'selected' }} @endif>Distributed to Learners</option>
                            <option value="Not Distributed to Learners" @if(old('status') == "Not Distributed to Learners") {{ 'selected' }} @endif>Not Distributed to Learners</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row mb-0">
                    <div class="col-md-3 offset-md-3">
                        <a href="{{ route('inventory') }}" class="btn btn-default">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary float-right">
                            {{ __('Save item') }}
                        </button>
                    </div>
                </div>
                </form>
            </div>
            <div class="card-footer p-0">
                <span class="float-right"></span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        @include('inventories._tools')
    </div>
</div>
@endsection