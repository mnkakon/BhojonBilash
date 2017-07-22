@extends('layouts.dashboard_master')

@section('title')
	Individual Restaurant Statistics
@endsection

@section('dashboard_nav')
	<nav id="comparisonNavigation" class="navbar" role="navigation">
        <ul class="nav navbar-nav">
        	<li>
                <a href="{{ route('dashboard', $authUser->id) }}">Main Dashboard</a>
            </li>
            <li>
                <a href="{{ route('individualFood') }}">Order Statistics based on food</a>
            </li>
            <li class="active">
                <a href="{{ route('allRestaurant') }}">Order from all restaurant</a>
            </li>
        </ul>
    </nav>
@endsection

@section('content')
	<div class="restaurant-stat">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h1>Order Percentage Of All Restaurants</h1>
				<!-- bar chart of monthly order -->
				<canvas id="retaurantStat"></canvas>
			</div>
		</div>
	</div>
		
@endsection

@section('scripts')

	<script>
		var ctx = document.getElementById("retaurantStat").getContext("2d");
		var data = {!! $restaurantsData !!}
		var myDoughnutChart = new Chart(ctx).Doughnut(data);
	</script>
@endsection