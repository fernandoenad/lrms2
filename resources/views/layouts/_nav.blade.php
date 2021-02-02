@guest 
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Login</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('support') }}">Help</a>
    </li>
@else
    <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset('storage/avatars/no-avatar.jpg') }}" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline">{{ Auth::user()->name ?? '' }}</span>
        </a>
        
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <li class="user-header bg-primary">
                <img src="{{ asset('storage/avatars/no-avatar.jpg') }}" class="img-circle elevation-2" alt="User Image">
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