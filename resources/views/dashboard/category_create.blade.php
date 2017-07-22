@extends('layouts.dashboard_master')

@section('title')
	Create New Category
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
		<div class="col-md-6 col-md-offset-3">
			<h1 class="text-center">Create New Category</h1>
			<div class="well">

				<div class="row">
					@include('includes.danger_alert')
					@include('includes.success_alert')
				</div>

				{!! Form::open(['route' => ['categoryCreate', $authUser->restaurant_id], 'method' => 'post']) !!}
					
					<div class="form-group">
						{{ Form::label('name', 'Category name *') }}
						{{ Form::text('category_name', null, ['id' => 'name', 'placeholder' => 'Name of new category', 'class' => 'form-control']) }}
					</div>

					<div class="form-group">
	                	{{ Form::submit('Create', ['class' => 'btn btn-success']) }}
					</div>

	    		{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection