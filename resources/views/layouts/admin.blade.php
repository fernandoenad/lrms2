<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts._head')   
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed layout-navbar-fixed">
<div class="wrapper" id="app">
	<nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top ">
        <ul class="navbar-nav"> 
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin') }}">Admin Portal</a>
            </li>
        </ul>

		<ul class="navbar-nav ml-auto">
            @include('layouts._nav')
		</ul>
	</nav>

	<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
		<a href="#" class="brand-link">
			<img src="{{ asset('storage/images/logo.png') }}" class="brand-image img-circle elevation-3"
			style="opacity: .8">
			<span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
		</a> 

		<div class="sidebar">
			<div class="pt-1"></div>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item 
						@if(Route::currentRouteName() == 'admin') {{ 'menu-open' }} @endif">
						
						<a href="{{ route('admin') }}" class="nav-link">
							<i class="nav-icon fas fa-th"></i>
							<p>Dashboard</p>
						</a>
					</li> 

					@if(Auth::user()->role == 3)	
                    <li class="nav-item">
						<a href="" class="nav-link" onClick="alert('Feature not yet available!'); return false;">
							<i class="nav-icon fas fa-swatchbook"></i>
							<p>My Content</p>
						</a>
					</li>
					@endif

					@if(Auth::user()->role < 3)	
						<li class="nav-item
							@if(strpos(Route::currentRouteName(), 'admin.contents') != '' ||
								strpos(Route::currentRouteName(), 'admin.categories') != '' ||
								strpos(Route::currentRouteName(), 'admin.courses') != ''
								) {{ 'menu-open' }} @endif">
							<a href="{{ route('admin.contents') }}" class="nav-link">
								<i class="nav-icon fas fa-photo-video"></i>
								<p>Content Mgmt</p>
							</a>
						</li> 

						<li class="nav-item">
							<a href="" class="nav-link" onClick="alert('Feature not yet available!'); return false;">
								<i class="nav-icon fas fa-list"></i>
								<p>Inventory Mgmt</p>
							</a>
						</li> 

						<li class="nav-item 
							@if(strpos(Route::currentRouteName(), 'admin.users') != '') {{ 'menu-open' }} @endif">
							<a href="{{ route('admin.users')}}" class="nav-link">
								<i class="nav-icon fas fa-users"></i>
								<p>User Mgmt</p>
							</a>
						</li> 

						<li class="nav-item">
							<a href="" class="nav-link" onClick="alert('Feature not yet available!'); return false;">
								<i class="nav-icon fas fa-sliders-h"></i>
								<p>Site Settings</p>
							</a>
						</li> 
					@endif
				</ul>
			</nav>
		</div>

        <div class="sidebar-custom">
		    @include('layouts._option')   
        </div>      
	</aside>

	<div class="content-wrapper">
		<div class="content-header">
			<div class="container">
				@yield('content')
			</div>
		</div>
	</div>

	@include('layouts._footer')   
</div>
</body>
</html>