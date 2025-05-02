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
                <img src="{{ asset('./img/logo.png') }}" alt="Logo" style="width:30px;">
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
						@if(Route::currentRouteName() == 'home' ||
							Route::currentRouteName() == 'my' 
							) 
								{{ __('menu-open') }} @endif">
						
						<a href="{{ route('home') }}" class="nav-link">
							<i class="nav-icon fas fa-th"></i>
							<p>Dashboard</p>
						</a>
					</li> 

					<li class="nav-item 
						@if(Route::currentRouteName() == 'content' ||
							Route::currentRouteName() == 'content.course.show' ||
							Route::currentRouteName() == 'content.category.show' ||
							Route::currentRouteName() == 'content.show' ||
							Route::currentRouteName() == 'content.show.report' 
							) 
								{{ __('menu-open') }} @endif">
						
						<a href="{{ route('content') }}" class="nav-link">
							<i class="nav-icon fas fa-photo-video"></i>
							<p>LR Contents</p>
						</a>
					</li> 
					@auth
						@if(Auth::user()->role == 4)
							<li class="nav-item
								@if(Route::currentRouteName() == 'inventory' ||
									Route::currentRouteName() == 'inventory.show' ||
									Route::currentRouteName() == 'inventory.create' ||
									Route::currentRouteName() == 'inventory.edit'
									) 
										{{ __('menu-open') }} @endif">

								<a href="{{ route('inventory') }}" class="nav-link">
									<i class="nav-icon fas fa-list"></i>
									<p>LR Inventory</p>
								</a>
							</li> 
						@endif
					@endauth
				</ul>
			</nav>
		</div>

		<div class="sidebar-custom">
			@auth
				@if(Auth::user()->role < 4)
					<a href="{{ route('admin') }}" class="btn btn-link hide-on-collapse text-white" title="Admin portal">
						<i class="fas fa-cogs"></i>
					</a>
				@else
					<a href="{{ route('home') }}" class="btn btn-link hide-on-collapse text-white" title="Main portal">
						<i class="fas fa-cogs"></i>
					</a>
				@endif
			@endauth
			<a href="{{ route('support') }}" class="btn btn-link hide-on-collapse pos-right text-white" title="Support site">
				<i class="fas fa-question-circle"></i>
			</a> 
        </div>        
	</aside>

	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				@yield('content')
			</div>
		</div>
	</div>

	@include('layouts._footer')
</div>
</body>
</html>