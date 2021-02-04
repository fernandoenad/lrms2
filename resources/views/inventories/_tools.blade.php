<div class="card">
    <div class="card-header">Administrative Tools</div>

    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nnav-item active pt-2 pb-2 pr-3">
                <form class="form-inline ml-3" method="POST" action="{{ route('inventory.search') }}">
                @csrf

                <div class="input-group input-group-md">
                    <input class="form-control form-control-navbar" type="search" name="str" value="{{ request()->str }}" placeholder="Search item" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                </form>
            </li>

            <li class="nav-item">
                <a href="{{ route('inventory') }}" class="nav-link">
                    <i class="fas fa-photo-video"></i>
                    View all 
                    <span class="badge badge-primary float-right">
                        {{ App\Models\Inventory::where('user_id', '=', Auth::user()->id)->count() }}
                    </span>
                </a>
            </li> 
            <li class="nav-item">
                <a href="{{ route('inventory.create') }}" class="nav-link">
                    <i class="fas fa-photo-video"></i>
                    New 
                </a>
            </li> 
            <li class="nav-item">
                <a href="#" class="nav-link"></a>
            </li> 
            <li class="nav-item">
                <a href="#" class="nav-link">
                    LR Type
                </a>
            </li> 
            <?php $lrtypes = App\Models\Inventory::where('user_id', '=', Auth::user()->id)->orderBy('lrtype', 'asc')->groupBy('lrtype')->select('lrtype')->get(); ?>
            @if(sizeof($lrtypes) > 0)
                @foreach($lrtypes as $lrtype)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            {{ $lrtype->lrtype ?? '' }}
                            <span class="badge badge-primary float-right">
                                {{ App\Models\Inventory::where('user_id', '=', Auth::user()->id)
                                    ->where('user_id', '=', Auth::user()->id)
                                    ->where('lrtype', '=', $lrtype->lrtype)->count() }}
                            </span>
                        </a>
                    </li>  
                @endforeach
            @endif   
        </ul>
    </div>
</div>