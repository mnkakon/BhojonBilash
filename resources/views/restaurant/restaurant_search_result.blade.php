@extends('layouts.master')

@section('title')
	Search Result
@endsection

@section('nav-links')
<div class="collapse navbar-collapse" id="main-nav-collapse">
    <ul class="nav navbar-nav navbar-right text-uppercase">
        <li>
            <a href="{{ route('home') }}">home</a>
        </li>
        <li class="active">
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
			<h2 class="page-tite text-center">Search Results of Restaurants</h2>
			@foreach($restaurantLists as $restaurantList)
			<div class="col-md-6 col-xs-12">
				<div class="search-result">
					<div class="row">
						<div class="col-md-5">
							<img src="{{ $restaurantList->logo }}" class="img-responsive center-block" alt="{{ $restaurantList->name }}">
						</div>
						<div class="col-md-7">
							<h3>{{ $restaurantList->name }}</h3>
							<a href="{{ route('searchFood', $restaurantList->id) }}" class="btn btn-success">View Food Items</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
@endsection