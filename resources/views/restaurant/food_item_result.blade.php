@extends('layouts.master')

@section('title')
	Search Food Result
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
		<div class="row text-center">
			@include('includes.danger_alert')
			@include('includes.success_alert')
		</div>
		<div class="row">
			<h2 class="page-tite text-center">Food Items of {{ $restaurantName }}</h2>
			<div class="col-md-6">
				<div class="search-result">
					<div class="row">
						@foreach ($foodItemLists as $foodItemList)
						<div class="col-md-12">
							<img src="{{ $foodItemList->image }}" class="img-responsive center-block" alt="{{ $foodItemList->name }}">
							
							<div class="col-md-6 col-xs-12">
								<h3 style="margin-top: 20px;">{{ $foodItemList->name }}</h3>
							</div>

							<div class="col-md-6 col-xs-12">
								<a href="{{ route('orderFood', $foodItemList->id) }}" class="text-center btn btn-success" style="margin-top: 15px; float: right;">Add To Cart</a>
							</div>

							<div class="col-md-12 col-xs-12">
								<h5><strong>Price</strong>: ${{ $foodItemList->price }}</h5>
								<p><strong>Description: </strong>{{ $foodItemList->description }}</p>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="cart" style="position: fixed;">
					<table class="table table-bordered text-center">
					    <thead>
					        <tr>
					            <th>Product</th>
					            <th>Qty</th>
					            <th>Item Price</th>
					            <th>Subtotal</th>
					        </tr>
					    </thead>

					    <tbody>
					    	@foreach(\Cart::content() as $row)
					        <tr>
					            <td>
					                <p><strong>{{ $row->name }}</strong></p>
					            </td>
					            <td><input type="text" value="{{ $row->qty }}"></td>
					            <td>${{ $row->price }}</td>
					            <td>${{ $row->subtotal }}</td>
					       </tr>
					    	@endforeach
					    </tbody>
					</table>
					<div class="row">
						<div class="col-md-6">
							<h4>Total: ${{ \Cart::total() }}</h4>
						</div>
						<div class="col-md-6">
							<a href="{{ route('checkout', $restaurantId) }}" class="btn btn-success pull-right">Checkout</a>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
@endsection