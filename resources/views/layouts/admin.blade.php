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
			<img src="{{ asset('./img/logo.png') }}" class="brand-image img-circle elevation-3"
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
						<li class="nav-item 
							@if(Route::currentRouteName() == 'admin.mycontents' || 
								Route::currentRouteName() == 'admin.mycontents.course' ||
								Route::currentRouteName() == 'admin.mycontents.search' ||
								Route::currentRouteName() == 'admin.mycontents.shown' ||
								Route::currentRouteName() == 'admin.mycontents.hidden' ||
								Route::currentRouteName() == 'admin.mycontents.submissions' ||
								Route::currentRouteName() == 'admin.mycontents.course.display' ||
								Route::currentRouteName() == 'admin.mycontents.create'
								
							) 
								{{ 'menu-open' }} @endif">
							
							<a href="{{ route('admin.mycontents') }}" class="nav-link">
								<i class="nav-icon fas fa-photo-video"></i>
								<p>Content Mgmt</p>
							</a>
						</li>
					@endif

					@if(Auth::user()->role < 3)	
						<li class="nav-item
							@if(Route::currentRouteName() == 'admin.contents' ||
								Route::currentRouteName() == 'admin.contents.search' || 
								Route::currentRouteName() == 'admin.contents.show' ||
								Route::currentRouteName() == 'admin.contents.display' ||
								Route::currentRouteName() == 'admin.contents.move-up' ||
								Route::currentRouteName() == 'admin.contents.move-down' ||
								Route::currentRouteName() == 'admin.contents.edit' ||
								Route::currentRouteName() == 'admin.contents.create' ||
								Route::currentRouteName() == 'admin.contents.new' ||
								Route::currentRouteName() == 'admin.contents.pending' ||
								Route::currentRouteName() == 'admin.contents.approved' ||
								Route::currentRouteName() == 'admin.contents.hidden' ||
								

								Route::currentRouteName() == 'admin.categories' ||
								Route::currentRouteName() == 'admin.categories.search' || 
								Route::currentRouteName() == 'admin.categories.edit' ||
								Route::currentRouteName() == 'admin.categories.create' || 
								Route::currentRouteName() == 'admin.categories.shown' || 
 								Route::currentRouteName() == 'admin.categories.hidden' ||
								Route::currentRouteName() == 'admin.categories.move-up' ||
								Route::currentRouteName() == 'admin.categories.move-down' ||

								Route::currentRouteName() == 'admin.courses.allshown' || 
								Route::currentRouteName() == 'admin.courses.allhidden' || 
								Route::currentRouteName() == 'admin.courses.allsearch' || 
								Route::currentRouteName() == 'admin.courses.show' || 

								Route::currentRouteName() == 'admin.courses' ||
								Route::currentRouteName() == 'admin.courses.search' || 
								Route::currentRouteName() == 'admin.courses.create' ||
								Route::currentRouteName() == 'admin.courses.edit' ||
								Route::currentRouteName() == 'admin.courses.shown' ||
								Route::currentRouteName() == 'admin.courses.hidden' ||
								Route::currentRouteName() == 'admin.courses.move-up' ||
								Route::currentRouteName() == 'admin.courses.move-down'
								 
							) 
								{{ 'menu-open' }} @endif">

							<a href="{{ route('admin.contents') }}" class="nav-link">
								<i class="nav-icon fas fa-photo-video"></i>
								<p>Content Mgmt</p>
							</a>
						</li> 

						<li class="nav-item 
							@if(Route::currentRouteName() == 'admin.reports' ||
								Route::currentRouteName() == 'admin.reports.show'						
							)
								{{ 'menu-open' }} @endif">

							<a href="{{ route('admin.reports') }}" class="nav-link">
								<i class="nav-icon fas fa-inbox"></i>
								<p>Report Mgmt</p>
							</a>
						</li> 
						
						<li class="nav-item">
							<a href="" class="nav-link" onClick="alert('Feature not yet available!'); return false;">
								<i class="nav-icon fas fa-list"></i>
								<p>Inventory Mgmt</p>
							</a>
						</li> 

						<li class="nav-item 
							@if(Route::currentRouteName() == 'admin.users' || 
								Route::currentRouteName() == 'admin.users.edit' ||
								Route::currentRouteName() == 'admin.users.disable' ||
								Route::currentRouteName() == 'admin.users.reset' ||
								Route::currentRouteName() == 'admin.users.create'
							) 
								{{ 'menu-open' }} @endif">
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
			<a href="{{ route('home') }}" class="btn btn-link hide-on-collapse text-white" title="Main portal">
				<i class="fas fa-home"></i>
			</a>

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