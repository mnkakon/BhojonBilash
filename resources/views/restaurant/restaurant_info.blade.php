@extends('layouts.master')

@section('title')
	Create Restaurant Info
@endsection

@section('nav-links')
<div class="collapse navbar-collapse" id="main-nav-collapse">
    <ul class="nav navbar-nav navbar-right text-uppercase">
        <li>
            <a href="{{ route('home') }}">home</a>
        </li>
        <li>
            <a href="{{ route('restaurants') }}">restaurants</a>
        </li>
        <li>
            <a href="{{ route('contact') }}">contact</a>
        </li>
        

        @if(Auth::check())

            @@if(Auth::user()->role == 'Admin')

            <li>
                <a href="{{ route('logout') }}">Logout</a>
            </li>

            @@else

            <li>
                <a href="{{ route('dashboard', Auth::user()->id) }}">DashBoard</a>
            </li>
            <li>
                <a href="{{ route('logout') }}">Logout</a>
            </li>
            
            @@endif
            
        @else
        <li>
             <a href="{{ route('registration') }}">Register</a>
        </li>
        <li>
            <a href="{{ route('login') }}">Login</a>
        </li>
        @endif
    </ul>
</div><!-- nav links -->
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1>Restaurant Information Form</h1>
				<div class="well">

					@include('includes.danger_alert')
					@include('includes.success_alert')

					{!! Form::open(['route' => ['restaurant_info_create', $restaurantInfo->id], 'method' => 'post', 'files' => true]) !!}
						
						<div class="form-group">
							{{ Form::label('restaurant_name', 'Restaurant Name *') }}
							{{ Form::text('restaurant_name', $restaurantInfo->name, ['id' => 'restaurant_name', 'placeholder' => 'Your Restaurant Name', 'class' => 'form-control']) }}
						</div>

						<div class="form-group">
							{{ Form::label('logo', 'Logo of your restaurant *') }}
							{{ Form::file('logo', null, ['id' => 'logo', 'placeholder' => 'Your Restaurant Logo', 'class' => 'form-control']) }}
						</div>

						<div class="form-group">
							{{ Form::label('email', 'Email Address *') }}
							{{ Form::email('email', null, ['id' => 'email', 'placeholder' => 'Restaurant Email Address', 'class' => 'form-control']) }}
						</div>

						<div class="form-group">
							{{ Form::label('website', 'Website *') }}
							{{ Form::url('website', null, ['id' => 'website', 'placeholder' => 'Web address of your restaurant', 'class' => 'form-control']) }}
						</div>

						<div class="form-group">
							{{ Form::label('phone', 'Phone Number *') }}
							{{ Form::text('phone', null, ['id' => 'phone', 'placeholder' => 'Restaurant Phone Number', 'class' => 'form-control']) }}
						</div>

						<div class="form-group">
							{{ Form::label('address', 'Address *') }}
							{{ Form::textarea('address', null, ['id' => 'address', 'placeholder' => 'Restaurant Address', 'class' => 'form-control']) }}
						</div>

						<div class="form-group">
		                	{{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
						</div>
		    		{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection