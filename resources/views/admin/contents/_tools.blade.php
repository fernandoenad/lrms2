<div class="card">
    <div class="card-header">Administrative Tools</div>

    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            @if(Route::currentRouteName() == 'admin.contents' ||
                Route::currentRouteName() == 'admin.contents.show' ||
                Route::currentRouteName() == 'admin.contents.edit' ||
                Route::currentRouteName() == 'admin.contents.move-up' ||
                Route::currentRouteName() == 'admin.contents.move-down' ||
                Route::currentRouteName() == 'admin.contents.create' ||
                Route::currentRouteName() == 'admin.contents.search' ||
                Route::currentRouteName() == 'admin.contents.new' ||
                Route::currentRouteName() == 'admin.contents.pending' ||
                Route::currentRouteName() == 'admin.contents.approved' ||
                Route::currentRouteName() == 'admin.contents.hidden' ||
                Route::currentRouteName() == 'admin.courses.show'  
                
                )
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

            @if(Route::currentRouteName() == 'admin.categories' ||
                Route::currentRouteName() == 'admin.categories.edit' ||
                Route::currentRouteName() == 'admin.categories.move-up' ||
                Route::currentRouteName() == 'admin.categories.move-down' ||
                Route::currentRouteName() == 'admin.categories.create' ||
                Route::currentRouteName() == 'admin.categories.search' ||
                Route::currentRouteName() == 'admin.categories.shown' ||
                Route::currentRouteName() == 'admin.categories.hidden' 
                )
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

            @if(Route::currentRouteName() == 'admin.courses' ||
                Route::currentRouteName() == 'admin.courses.edit' ||
                Route::currentRouteName() == 'admin.courses.move-up' ||
                Route::currentRouteName() == 'admin.courses.move-down' ||
                Route::currentRouteName() == 'admin.courses.create' ||
                Route::currentRouteName() == 'admin.courses.search' ||
                Route::currentRouteName() == 'admin.courses.shown' ||
                Route::currentRouteName() == 'admin.courses.hidden' 
                )
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

            @if(Route::currentRouteName() == 'admin.courses.allsearch' ||
                Route::currentRouteName() == 'admin.courses.allshown' ||
                Route::currentRouteName() == 'admin.courses.allhidden'               
                )
                <li class="nnav-item active pt-2 pb-2 pr-3">
                    <form class="form-inline ml-3" method="POST" action="{{ route('admin.courses.allsearch') }}">
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