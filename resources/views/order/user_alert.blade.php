@extends('layouts.master')

@section('title')
	Alert
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
		<div class="row text-center">
			<div class="col-md-6 col-md-offset-3">
				<div style="padding: 100px 0px;">
					<h4>
						You are blacklisted. You have cancelled your order previously
					</h4>
					<p>
						Are you sure you seriously order that food items?
						<a href="{{ route('removeblacklist',[$blacklisted->id, $restaurantId]) }}" class="btn btn-success">Yes</a>
						<a href="{{ route('home') }}" class="btn btn-danger">No</a>
					</p>
				</div>
			</div>
		</div>
	</div>
@endsection