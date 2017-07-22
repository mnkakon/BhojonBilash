@extends('layouts.dashboard_master')

@section('title')
	Dashboard
@endsection

@section('dashboard_nav')
	<nav id="comparisonNavigation" class="navbar" role="navigation">
        <ul class="nav navbar-nav">
        	<li class="active">
                <a href="{{ route('dashboard', $authUser->id) }}">Main Dashboard</a>
            </li>
            <li>
                <a href="{{ route('individualFood') }}">Order Statistics based on food</a>
            </li>
            <li>
                <a href="{{ route('allRestaurant') }}">Order from all restaurant</a>
            </li>
        </ul>
    </nav>
@endsection

@section('content')
	<div class="daily-info">
		<div class="row">
			@include('includes.danger_alert')
			@include('includes.success_alert')
		</div>
	
		<div class="row">
			<div class="col-md-6">
				<h1>Daily Order Infomation</h1>
				<div class="row">
					<div class="col-md-6">
						<div class="info-box">
							<h1>{{ $orderCount }}</h1>
							<h4>order from today</h4>
						</div>
					</div>
					<div class="col-md-6">
						<div class="info-box">
							<h1>${{ $price_total }}</h1>
							<h4>Price of order</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		
	<div class="monthly-stat">
		<div class="row">
			<div class="col-md-12">
				<h1>Monthly Order Statistics</h1>
				<!-- bar chart of monthly order -->
				<canvas id="monthlyChart"></canvas>
			</div>
		</div>
	</div>
		
@endsection

@section('scripts')
	<script>
			var ctx = document.getElementById("monthlyChart").getContext("2d");
			var data = {
			    labels: {!!$daysArray !!}, 
			    datasets: [
			        {
			            label: "My First dataset",
			            fillColor: "rgba(220,220,220,0.2)",
			            strokeColor: "rgba(220,220,220,1)",
			            pointColor: "rgba(220,220,220,1)",
			            pointStrokeColor: "#fff",
			            pointHighlightFill: "#fff",
			            pointHighlightStroke: "rgba(220,220,220,1)",
			            data: {!! $dailyOrderCounts !!}
			        }
			    ]
			};
			var myLine = new Chart(ctx).Line(data);
		</script>
@endsection