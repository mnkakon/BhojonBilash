@extends('layouts.admin_master')

@section('title')
    Order List
@endsection

@section('nav-links')
	<div class="collapse navbar-collapse" id="main-nav-collapse">
        <ul class="nav navbar-nav navbar-right text-uppercase">
            <li>
                <a href="{{ route('orderList') }}">Order List</a>
            </li>
            <li>
                <a href="{{ route('blacklist') }}">Blacklist</a>
            </li>
            <li>
                <a href="{{ route('pendinglist') }}">Pendinglist</a>
            </li>
            <li>
                <a href="{{ route('deliverer') }}">Deliverers</a>
            </li>
            <li class="active">
                <a href="{{ route('restaurantStatistics') }}">Restaurants Overview</a>
            </li>
        </ul>
    </div><!-- nav links -->
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h1 class="text-center">Order Percentage Of All Restaurants</h1>
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