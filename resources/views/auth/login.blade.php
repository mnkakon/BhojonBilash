@extends('layouts.master')

@section('title')
	Registration
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
        <li class="active">
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
				<h1>Login Form</h1>
				<div class="well">
					

					@include('includes.danger_alert')
					@include('includes.success_alert')


					{!! Form::open(['route' => 'login', 'method' => 'post']) !!}

						<div class="form-group">
							{{ Form::label('email', 'Email Address *') }}
							{{ Form::email('email', null, ['id' => 'email', 'placeholder' => 'Your Email Address', 'class' => 'form-control']) }}
						</div>
						
						<div class="form-group">
							{{ Form::label('password', 'Password *') }}
							{{ Form::password('password', ['id' => 'password', 'placeholder' => 'Your Password', 'class' => 'form-control']) }}
						</div>

						<div class="form-group">
		                	{{ Form::submit('Login', ['class' => 'btn btn-success']) }}
						</div>
		    		{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection