@extends('layouts.admin_master')

@section('title')
    Order List
@endsection

@section('nav-links')
	<div class="collapse navbar-collapse" id="main-nav-collapse">
        <ul class="nav navbar-nav navbar-right text-uppercase">
            <li class="active">
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
            <li>
                <a href="{{ route('restaurantStatistics') }}">Restaurants Overview</a>
            </li>
        </ul>
    </div><!-- nav links -->
@endsection

@section('content')

	<div class="container">
		<h1 class="text-center">All Orderlists in your queue</h1>

	    <table class="table table-stripped table-bordered text-center">
	    	<tr>
	    		<th>Order Number</th>
	    		<th>User Contact Number</th>
	    		<th>Address</th>
	    		<th>Delivered by</th>
	    		<th>Food Items</th>
	    		<th>Validity</th>
	    		<th>Order Cancel</th>
	    	</tr>
	    	@foreach($orderlists as $orderlist)
		    	<tr>
		    		<td>{{ $orderlist->id }}</td>
		    		<td>{{ $orderlist->contact }}</td>
		    		<td>{{ $orderlist->address }}</td>
		    		<td>{{ $orderlist->delivered_by }}</td>
		    		<td>
		    			@foreach($orderlist->orderFoodItems as $orderFoodItem)
		    				{{$orderFoodItem->foodItem->name}} ({{$orderFoodItem->quantity}})<br />
		    			@endforeach
		    		</td>
		    		<td><a href="{{ route('ordervalidity', $orderlist->id) }}" class="btn btn-success">Valid</a></td>
		    		<td><a href="{{  route('ordercancel', $orderlist->id) }}" class="btn btn-danger">Cancel</a></td>
		    	</tr>
		    @endforeach
	    </table>
	</div>
@endsection