<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	@include('layouts._head') 
</head>

@guest
	<body class="hold-transition sidebar-collapse layout-fixed layout-footer-fixed layout-navbar-fixed">
@else
	<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed layout-navbar-fixed">
@endif 

<div class="wrapper" id="app">
	<nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top ">
		@guest
			<a class="navbar-brand" href="#">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" style="width:30px;">
                {{ config('app.name', 'Laravel') }}
            </a>
		@else
			<ul class="navbar-nav"> 
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('home') }}">Home</a>
				</li>
			</ul>
		@endif 

		<ul class="navbar-nav ml-auto">
			@include('layouts._nav')
		</ul>
	</nav>

	<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
		@include('layouts._sbheader')

		<div class="sidebar">
			<div class="pt-1"></div>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item 
						@if(strpos(Route::currentRouteName(), 'home') != '') {{ 'menu-open' }} @endif">
						
						<a href="{{ route('home') }}" class="nav-link">
							<i class="nav-icon fas fa-th"></i>
							<p>Dashboard</p>
						</a>
					</li> 

					<li class="nav-item">
						<a href="" class="nav-link" onClick="alert('Feature not yet available!'); return false;">
							<i class="nav-icon fas fa-list"></i>
							<p>School Inventory</p>
						</a>
					</li> 
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