@extends('layouts.dashboard_master')

@section('title')
	Individual Food Statistics
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
	<div class="row">
		@include('includes.danger_alert')
		@include('includes.success_alert')
	</div>
	
	<div class="row">
		@foreach($foodItems as $foodItem)
		<div class="col-md-6">
			<div class="view-food" style="margin: 15px 0px;">
				<div class="row">
					<div class="col-md-6">
						<div class="view-food">
			                <img class="img-responsive center-block" src="{{ $foodItem->image }}" alt="{{ $foodItem->name }}">
			            </div>
					</div>

					<div class="col-md-6">
						<div class="food-description">
							<h4 style="margin-top: 0px;">{{ $foodItem->name }}</h4>
							<div class="row">
			            		<div class="col-md-6">
		                    		<p><strong>Qunatity</strong>: {{ $foodItem->person_count }} person</p>
			            		</div>
			            		<div class="col-md-6">
			            			<p><strong>Price</strong>: <span style="color: #2A3F54; margin-top: 3px; font-size: 14px">${{ $foodItem->price }}</span></p>
			            		</div>
			            	</div>
			            	<p style="margin-bottom: 10px;"><strong>Ingredients</strong>: {{ $foodItem->ingredients }}</p>
			            	<div class="row">
			            		<div class="col-md-6">
			            			<a href="{{ route('foodUpdate', $foodItem->id) }}" class="btn btn-success text-center">Update</a>
			            		</div>
			            		<div class="col-md-6">
			            			<a href="{{ route('foodDelete', $foodItem->id) }}" class="btn btn-danger text-center">Delete</a>
			            		</div>
			            	</div>
			            </div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
@endsection