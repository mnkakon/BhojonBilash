@extends('layouts.dashboard_master')

@section('title')
	Individual Food Statistics
@endsection

@section('dashboard_nav')
	<nav id="comparisonNavigation" class="navbar" role="navigation">
        <ul class="nav navbar-nav">
        	<li>
                <a href="{{ route('dashboard', $authUser->id) }}">Main Dashboard</a>
            </li>
            <li class="active">
                <a href="{{ route('individualFood') }}">Order Statistics based on food</a>
            </li>
            <li>
                <a href="{{ route('allRestaurant') }}">Order from all restaurant</a>
            </li>
        </ul>
    </nav>
@endsection

@section('content')
	<div class="fooditem-stat">
		<div class="row">
			<div class="col-md-12">
				<h1>Order Number Of All Your Foods</h1>
				<!-- bar chart of monthly order -->
				<canvas id="fooditemStat"></canvas>
			</div>
		</div>
	</div>
		
@endsection
@section('scripts')
	<script>
			var ctx = document.getElementById("fooditemStat").getContext("2d");
			var data = {
			    labels: {!! $foodItemsList !!},
			    datasets: [
			        {
			            label: "My Second dataset",
			            fillColor: "rgba(151,187,205,0.5)",
			            strokeColor: "rgba(151,187,205,0.8)",
			            highlightFill: "rgba(151,187,205,0.75)",
			            highlightStroke: "rgba(151,187,205,1)",
			            data: {!! $orderCounts !!}
			        }
			    ]
			};
			var myBarChart = new Chart(ctx).Bar(data);
		</script>
@endsection