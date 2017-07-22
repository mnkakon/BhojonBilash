@extends('layouts.master')

@section('title')
	Contact
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
        <li class="active">
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
				<h1>Contact Us</h1>
				<div class="well">
					

					@if (count($errors) > 0)
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif

				    @if(session('success'))
					    <div class="alert alert-success">
					    	{{ session('success') }}
					    </div>
					@endif


					{!! Form::open(['route' => 'contact', 'method' => 'post']) !!}
						<div class="form-group">
							{{ Form::label('name', 'Name *') }}
							{{ Form::text('name', null, ['id' => 'name', 'placeholder' => 'Your Name', 'class' => 'form-control']) }}
						</div>

						<div class="form-group">
							{{ Form::label('email', 'Email Address *') }}
							{{ Form::email('email', null, ['id' => 'email', 'placeholder' => 'Your Email Address', 'class' => 'form-control']) }}
						</div>
						
						<div class="form-group">
							{{ Form::label('message', 'Message *') }}
							{{ Form::textarea('message', null, ['id' => 'message', 'placeholder' => 'Your Message', 'class' => 'form-control']) }}
						</div>

						<div class="form-group">
		                	{{ Form::submit('Contact Us', ['class' => 'btn btn-success']) }}
						</div>
		    		{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection