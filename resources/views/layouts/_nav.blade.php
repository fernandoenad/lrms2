@guest 
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Login</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('support') }}">Help</a>
    </li>
@else
    @if(Auth::user()->role <= 3)
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell" style="margin-right: 6px"></i>
                <span class="badge badge-danger navbar-badge" style="margin-top: -6px;">
                    {{ App\Models\ContentReport::where('user_id', 'like', (Auth::user()->role <= 2 ? '%' : Auth::user()->id))
                        ->where('status', '=', 1)->get()->count() ?? 0 }}

                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header text-center">
                    {{ App\Models\ContentReport::where('user_id', 'like', (Auth::user()->role <= 2 ? '%' : Auth::user()->id))
                        ->where('status', '=', 1)->get()->count() ?? 0 }}
                    Report(s)
                </span>

                <div class="dropdown-divider"></div>
                    <?php $contentreports = App\Models\ContentReport::where('user_id', 'like', (Auth::user()->role <= 2 ? '%' : Auth::user()->id))
                        ->where('status', '=', 1)
                        ->orderBy('created_at', 'asc')->get(); ?>
                        
                    @if(sizeof($contentreports) > 0)
                        @foreach($contentreports as $contentreport)
                            <a href="{{ route('admin.reports.show', $contentreport->id) }}" class="dropdown-item">
                                <i class="fas fa-inbox"></i> 
                                <strong>{{ substr($contentreport->title, 0, 20) ?? '' }}...</strong>
                                <br>
                                <small>{{ substr($contentreport->description,0, 30) ?? '' }}...</small>                            
                            </a>
                        @endforeach
                    @else
                        <a href="#" class="dropdown-item dropdown-footer">
                            No report found.
                        </a>
                    @endif
                <div class="dropdown-divider"></div>
                
                <a href="{{ route('admin.reports') }}" class="dropdown-item dropdown-footer">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    See All Report(s)
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </a>
            </div>
        </li>
    @endif

    <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset('./img/no-avatar.jpg') }}" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline">{{ Auth::user()->name ?? '' }}</span>
        </a>
        
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <li class="user-header bg-primary">
                <img src="{{ asset('./img/no-avatar.jpg') }}" class="img-circle elevation-2" alt="User Image">
                <p>
                    {{ Auth::user()->name ?? '' }} 
                    <small>{{ Auth::user()->getRole(Auth::user()->role) ?? '' }}</small>
                </p>
            </li>
            <li class="user-footer">
                <a href="{{ route('my') }}" class="btn btn-default btn-flat">Profile</a>
                <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Sign out') }}
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </ul>
    </li>
@endguest