@extends('layouts.admin_master')

@section('title')
    Black List
@endsection

@section('nav-links')
	<div class="collapse navbar-collapse" id="main-nav-collapse">
        <ul class="nav navbar-nav navbar-right text-uppercase">
            <li>
                <a href="{{ route('orderList') }}">Order List</a>
            </li>
            <li class="active">
                <a href="{{ route('blacklist') }}">Blacklist</a>
            </li>
            <li>
                <a href="{{ route('pendinglist') }}">Pendinglist</a>
            </li>
            <li>
                <a href="{{ route('deliverer') }}">Deliverers</a>
            </li>
            <li>
                <a href="{{ route('restaurantStatistics') }}">Restaurants Overview</a>
            </li>
        </ul>
    </div><!-- nav links -->
@endsection

@section('content')

	<div class="container">
		<h1 class="text-center">All Blacklist Users</h1>

	    <table class="table table-stripped table-bordered text-center">
	    	<tr>
	    		<th>Order Number</th>
	    		<th>User Contact Number</th>
	    		<th>Address</th>
	    	</tr>
	    	@foreach($blacklists as $blacklist)
		    	<tr>
		    		<td>{{ $blacklist->id }}</td>
		    		<td>{{ $blacklist->contact }}</td>
		    		<td>{{ $blacklist->address }}</td>
		    	</tr>
		    @endforeach
	    </table>
	</div>
@endsection