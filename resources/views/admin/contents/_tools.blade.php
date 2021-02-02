<div class="card">
    <div class="card-header">Administrative Tools</div>

    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            @if(strpos(Route::currentRouteName(), 'admin.contents') != '')
                <li class="nnav-item active pt-2 pb-2 pr-3">
                    <form class="form-inline ml-3" method="POST" action="{{ route('admin.contents.search') }}">
                    @csrf

                    <div class="input-group input-group-md">
                        <input class="form-control form-control-navbar" type="search" name="str" value="{{ request()->str }}" placeholder="Search content" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    </form>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.contents') }}" class="nav-link">
                        <i class="fas fa-photo-video"></i>
                        View all 
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.contents.create') }}" class="nav-link">
                        <i class="fas fa-plus-square"></i>
                        New 
                    </a>
                </li>
            @endif

            @if(strpos(Route::currentRouteName(), 'admin.categories') != '')
                <li class="nnav-item active pt-2 pb-2 pr-3">
                    <form class="form-inline ml-3" method="POST" action="{{ route('admin.categories.search') }}">
                    @csrf

                    <div class="input-group input-group-md">
                        <input class="form-control form-control-navbar" type="search" name="str" value="{{ request()->str }}" placeholder="Search category" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    </form>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.categories.create') }}" class="nav-link">
                        <i class="fas fa-plus-square"></i>
                        New 
                    </a>
                </li>
            @endif

            @if(strpos(Route::currentRouteName(), 'admin.courses') != '')
                <li class="nnav-item active pt-2 pb-2 pr-3">
                    <form class="form-inline ml-3" method="POST" action="{{ route('admin.courses.search', $category->id) }}">
                    @csrf

                    <div class="input-group input-group-md">
                        <input class="form-control form-control-navbar" type="search" name="str" value="{{ request()->str }}" placeholder="Search course" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    </form>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.courses.create', $category->id) }}" class="nav-link">
                        <i class="fas fa-plus-square"></i>
                        New 
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a href="#" class="nav-link">
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories') }}" class="nav-link">
                    <i class="fas fa-swatchbook"></i>
                    Categories
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.courses', App\Models\Category::orderBy('id', 'asc')->first()->id) }}" class="nav-link">
                    <i class="fas fa-book"></i>
                    Courses
                </a>
            </li>

            @if(Route::currentRouteName() != 'admin.contents')
                <li class="nav-item">
                    <a href="{{ route('admin.contents') }}" class="nav-link">
                        <i class="fas fa-photo-video"></i>
                        Contents 
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>