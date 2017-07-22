<!DOCTYPE html>
<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>@yield('title') | {{ env('SITE_NAME') }}</title>

		<!-- Bootstrap core CSS -->

		<link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
	    <link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet">
	    <link href="{{ url('css/animate.min.css') }}" rel="stylesheet">
	    <link href="{{ url('css/green.css') }}" rel="stylesheet">
	    <link href="{{ url('css/custom_dashboard.css') }}" rel="stylesheet">
		<link href="{{ url('css/style.css') }}" rel="stylesheet">
	</head>


	<body class="nav-md">

		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">

						<div class="navbar nav_title" style="border: 0;">
							<a href="{{ route('home') }}" class="site_title">
								<i class="fa fa-coffee"></i> <span>Bhojon-Bilash</span>
							</a>
						</div>
						<div class="clearfix"></div>

						<!-- menu prile quick info -->
						<div class="profile">
							<div class="profile_pic">
								<img src="{{ $authUser->img }}" alt="{{ $authUser->name }}" class="img-circle profile_img">
							</div>
							<div class="profile_info">
								<span>Welcome,</span>
								<h2>{{ $authUser->name }}</h2>
							</div>
						</div>
						<!-- /menu prile quick info -->

						<br />

						<!-- sidebar menu -->
						<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

							<div class="menu_section">
								<ul class="nav side-menu">
									<li><a><i class="fa fa-home"></i>Categories<span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu" style="display: none">
											@foreach($categoriesList as $categoryList)
											<li><a href="{{ route('singleCategory', $categoryList->id) }}">{{ $categoryList->category_name }}</a></li>
											@endforeach
										</ul>
									</li>
									<li><a><i class="fa fa-edit"></i> Create New <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu" style="display: none">
											<li><a href="{{ route('newCategory') }}">Category</a>
											</li>
											<li><a href="{{ route('newfood') }}">Food Item</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
						<!-- /sidebar menu -->
					</div>
				</div>


				<!-- page content -->
				<div class="right_col" role="main">
					@yield('dashboard_nav')
					
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="dashboard_graph">
								@yield('content')
							</div>
						</div>

					</div>
					<br />
				</div>
				<!-- /page content -->

			</div>
		</div>
			


		<script src="{{ url('js/jquery.js') }}"></script>
		<script src="{{ url('js/bootstrap.min.js') }}"></script>
		<script src="{{ url('js/jquery.nicescroll.min.js') }}"></script>
		<script src="{{ url('js/Chart.js') }}"></script>
		<script src="{{ url('js/dashboard_script.js') }}"></script>

		<!-- dashbord linegraph -->
		@yield('scripts')
		

	</body>

</html>
