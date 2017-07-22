@extends('layouts.master')

@section('title')
	Order Food
@endsection

@section('nav-links')
<div class="collapse navbar-collapse" id="main-nav-collapse">
    <ul class="nav navbar-nav navbar-right text-uppercase">
        <li class="active">
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
				<h1>Order Your Food</h1>
				<div class="well">
					

					@include('includes.danger_alert')
					@include('includes.success_alert')


					{!! Form::open(['route' => ['orderComplete', $restaurant->id], 'method' => 'post']) !!}

						<div class="form-group">
							{{ Form::label('contact', 'Contact Number *') }}
							{{ Form::text('contact', null, ['id' => 'contact', 'placeholder' => 'Your Contact Number', 'class' => 'form-control']) }}
						</div>

						<div class="form-group">
							{{ Form::label('address', 'Address *') }}
							{{ Form::text('address', null, ['id' => 'address', 'placeholder' => 'Your Address', 'class' => 'form-control']) }}
						</div>

						<div class="form-group">
		                	{{ Form::submit('Click To Order', ['class' => 'btn btn-success']) }}
						</div>
		    		{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection