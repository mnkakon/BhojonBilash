@extends('layouts.dashboard_master')

@section('title')
	Update Food Item
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
			<h1 class="text-center">Update {{ $foodDetails->name }}</h1>
			<div class="well">

				{!! Form::model($foodDetails,['route' => ['foodUpdate', $foodDetails->id], 'method' => 'post', 'files' => true]) !!}
					
					<div class="form-group">
						{{ Form::label('name', 'Food item name *') }}
						{{ Form::text('name', null, ['id' => 'name', 'placeholder' => 'Name of your food item', 'class' => 'form-control']) }}
					</div>

					<div class="form-group">
						{{ Form::label('price', 'Price of food item *') }}
						{{ Form::number('price', null, ['id' => 'price', 'placeholder' => 'Price', 'class' => 'form-control']) }}
					</div>

					<div class="form-group">
						{{ Form::label('image', 'Image of your food item *') }}
						{{ Form::file('image', null, ['id' => 'image', 'placeholder' => 'Food Item Image', 'class' => 'form-control']) }}
					</div>

					<div class="form-group">
						{{ Form::label('person_count', 'How many person can eat 1 unit *') }}
						{{ Form::number('person_count', null, ['id' => 'person_count', 'placeholder' => 'Head-count for 1 unit', 'class' => 'form-control']) }}
					</div>

					<div class="form-group">
						{{ Form::label('ingredients', 'Ingredients *') }}
						{{ Form::textarea('ingredients', null, ['id' => 'ingredients', 'placeholder' => 'Ingreients to make this food', 'class' => 'form-control']) }}
					</div>

					<div class="form-group">
						{{ Form::label('description', 'Description *') }}
						{{ Form::textarea('description', null, ['id' => 'description', 'placeholder' => 'Description about this food', 'class' => 'form-control']) }}
					</div>

					<div class="form-group">
	                	{{ Form::submit('Update', ['class' => 'btn btn-success']) }}
					</div>

	    		{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection