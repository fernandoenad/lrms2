<div class="card">
    <div class="card-header">Administrative Tools</div>

    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nnav-item active pt-2 pb-2 pr-3">
                <form class="form-inline ml-3" method="POST" action="{{ route('admin.mycontents.search') }}">
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
                <a href="{{ route('admin.mycontents') }}" class="nav-link">
                    <i class="fas fa-photo-video"></i>
                    View all 
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.mycontents.create') }}" class="nav-link">
                    <i class="fas fa-photo-video"></i>
                    New 
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"></a>
            </li> 
            <li class="nav-item">
                <a href="#" class="nav-link">Assigned Courses</a>
            </li>         
            @if(sizeof($courses) > 0)
                @foreach($courses as $courseItem)
                <li class="nav-item @if(isset($course) && $course->id == $courseItem->id) {{ 'bg-primary' }} @else {{ '' }} @endif">
                    <a href="{{ route('admin.mycontents.course', $courseItem->id) }}" class="nav-link">
                        <i class="fas fa-book"></i>
                        <strong>{{ $courseItem->name }}</strong>
                        <span class="badge badge-info float-right text-white">{{ $courseItem->content->count() ?? '' }}</span>
                        <br>
                        <small>{{ $courseItem->category->name }}</small>
                    </a>
                </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>