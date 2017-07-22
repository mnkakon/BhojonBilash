@extends('layouts.admin_master')

@section('title')
    Pending List
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
            <li class="active">
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
		<h1 class="text-center">All Pending Orders</h1>

	    <table class="table table-stripped table-bordered text-center">
	    	<tr>
	    		<th>Order Number</th>
	    		<th>User Contact Number</th>
	    		<th>Address</th>
	    		<th>Delivered by</th>
	    	</tr>
	    	@foreach($pendinglists as $pendinglist)
		    	<tr>
		    		<td>{{ $pendinglist->id }}</td>
		    		<td>{{ $pendinglist->contact }}</td>
		    		<td>{{ $pendinglist->address }}</td>
		    		<td>{{ $pendinglist->delivered_by }}</td>
		    	</tr>
		    @endforeach
	    </table>
	</div>
@endsection