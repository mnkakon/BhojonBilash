@extends('layouts.master')

@section('title')
    Home
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
        
        <!-- Header -->
        <header id="header" class="header">
            <div class="container-fluid p-l-0 p-r-0">
                <div class="section-content overlay">
                    <div class="valign-center">
                        <h1>Online food order with home delivery</h1>
                        <p>Home delivery from hundreds of restaurants right to your door</p>

                        <!-- <form class="form-inline" method="post" action="php/areasearch.php">
                            <div class="form-group">
                                <input type="text" class="form-control" name="city" id="city" placeholder="Select City">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="area" name="area" placeholder="Select Area">
                            </div>
                            <button id="locationSubmit" type="submit" class="btn btn-default">Search</button>
                        </form> -->
                        {!! Form::open(['route' => 'searchRestaurant', 'method' => 'post', 'class' => 'form-inline']) !!}
                            <div class="form-group">
                                {{ Form::text('areaSearch', null, ['id' => 'areaSearch', 'placeholder' => 'Type Area From Where You Want To Order *', 'class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Search', ['class' => 'btn btn-success']) }}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->



        <!-- start: popular section -->
        <section id="popular" class="popular white-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="section-title">
                            <h2>Recent Hot Items</h2>
                            <p class="section-sub-title">
                                Best foods from order-list
                            </p> <!-- /.section-sub-title -->
                        </div>
                        <div id="foodSlide" class="owl-carousel owl-theme">
                            @foreach($bestFoods as $bestFood)
                            <div class="item">
                                <img class="img-responsive center-block" alt="{{ $bestFood->name }}" src="{{ $bestFood->image }}">
                                <div class="image-overlay"></div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="section-title">
                            <h2>Top Popular Restaurants</h2>
                            <p class="section-sub-title">
                                Top restaurants from people's choice
                            </p> <!-- /.section-sub-title -->
                        </div>

                        <div class="row">
                            @foreach($topRestaurants as $topRestaurant)
                                <div class="col-md-4">
                                    <div class="popular-restaurant">
                                        <img class="img-responsive center-block" alt="{{ $topRestaurant->name }}" src="{{ $topRestaurant->logo }}">
                                        <h4 class="text-center">{{ $topRestaurant->name }}</h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section> <!-- /#popular -->
        <!-- end: popular section-->



        <section class="discount">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="discount-food">
                            <img class="img-responsive center-block" src="{{ url('image/discount1.jpg') }}" alt="Discount Food">
                            <div class="discount-info">
                                <h4>Chicken Leg</h4>
                                <span>10% Discount</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="discount-food">
                            <img class="img-responsive center-block" src="{{ url('image/discount2.jpg') }}" alt="Discount Food">
                            <div class="discount-info">
                                <h4>Full Grill</h4>
                                <span>15% Discount</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="discount-food">
                            <img class="img-responsive center-block" src="{{ url('image/discount3.jpg') }}" alt="Discount Food">
                            <div class="discount-info">
                                <h4>Boneless Fry</h4>
                                <span>5% Discount</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="discount-food">
                            <img class="img-responsive center-block" src="{{ url('image/discount4.jpg') }}" alt="Discount Food">
                            <div class="discount-info">
                                <h4>Thai Stick</h4>
                                <span>20% Discount</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="discount-food">
                            <img class="img-responsive center-block" src="{{ url('image/discount5.jpg') }}" alt="Discount Food">
                            <div class="discount-info">
                                <h4>Vegetable Soup</h4>
                                <span>10% Discount</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                    </div>
                </div>
            </div>
        </section>




        <!--  begin testimonial section  -->

        <section class="testimonial white-bg">
            <div class="container">

                <div class="headline text-center">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="section-title">
                                <h2>Testimonials</h2>
                                <p class="section-sub-title">
                                    Review about our job
                                </p> <!-- /.section-sub-title -->
                            </div>
                        </div>
                    </div>
                </div> <!-- /.headline -->

                <div id="client-speech" class="owl-carousel owl-theme">

                    <div class="item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="client-box">
                                    <div class="about-client">
                                        <img src="{{ url('image/client1.jpg') }}" alt="client1">
                                        <p class="client-intro">Dr Md. Zafar Iqbal</p>
                                    </div> <!-- end of /.about-client -->
                                    <div class="main-speech">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                        </p>
                                    </div> <!-- end of /.main-speech  -->
                                </div> <!-- end of /.client-box -->
                            </div>

                            <div class="col-md-6">
                                <div class="client-box">
                                    <div class="about-client">
                                        <img src="{{ url('image/client2.jpg') }}" alt="client2">
                                        <p class="client-intro">Dr Md. Reza Selim</p>
                                    </div> <!-- end of /.about-client -->
                                    <div class="main-speech">
                                        <p>
                                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that.
                                        </p>
                                    </div> <!-- end of /.main-speech  -->
                                </div> <!-- end of /.client-box -->
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="client-box">
                                    <div class="about-client">
                                        <img src="{{ url('image/client3.jpg') }}" alt="client3">
                                        <p class="client-intro">Biswapriyo Chakrabarty</p>
                                    </div> <!-- end of /.about-client -->
                                    <div class="main-speech">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                        </p>
                                    </div> <!-- end of /.main-speech  -->
                                </div> <!-- end of /.client-box -->
                            </div>

                            <div class="col-md-6">
                                <div class="client-box">
                                    <div class="about-client">
                                        <img src="{{ url('image/client4.jpg') }}" alt="client4">
                                        <p class="client-intro">Sadia Sultana</p>
                                    </div> <!-- end of /.about-client -->
                                    <div class="main-speech">
                                        <p>
                                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that.
                                        </p>
                                    </div> <!-- end of /.main-speech  -->
                                </div> <!-- end of /.client-box -->
                            </div>
                        </div>
                    </div>
                    
                    <div class="item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="client-box">
                                    <div class="about-client">
                                        <img src="{{ url('image/client5.jpg') }}" alt="client5">
                                        <p class="client-intro">Md. Saiful Islam</p>
                                    </div> <!-- end of /.about-client -->
                                    <div class="main-speech">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                        </p>
                                    </div> <!-- end of /.main-speech  -->
                                </div> <!-- end of /.client-box -->
                            </div>

                            <div class="col-md-6">
                                <div class="client-box">
                                    <div class="about-client">
                                        <img src="{{ url('image/client6.jpg') }}" alt="client6">
                                        <p class="client-intro">Sheikh Nabil Mohammad</p>
                                    </div> <!-- end of /.about-client -->
                                    <div class="main-speech">
                                        <p>
                                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that.
                                        </p>
                                    </div> <!-- end of /.main-speech  -->
                                </div> <!-- end of /.client-box -->
                            </div>
                        </div>
                    </div>
                    
                </div> <!-- end of /#client-speech  /.owl-carousel -->

            </div> <!-- end of .container -->
        </section> 
        <!--  end of testimonial  section -->






        <!-- begin: advertise section -->
        <!-- <section class="app-advertise">
            <div class="container">
                <div class="row equal_height">
                    <div class="col-md-6 section_1">
                        <img src="{{ url('image/app.png') }}" class="img-responsive center-block" alt="App Advertising">
                    </div>

                    <div class="col-md-6 section_2">
                        <div class="section-content">
                            <div class="valign-center">
                                <h3>Download BhojonBilash App. The app that understands how hungry you are.</h3>

                                <h2>Just Download &amp; Order.</h2>

                                <div class="download">
                                    <a href="#">
                                        <img class="img-responsive" alt="Download Button" src="{{ url('image/google_play.png') }}">
                                    </a>
                                    <a href="#">
                                        <img class="img-responsive" alt="Download Button" src="{{ url('image/app_store.png') }}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- end: advertising section -->





        <!-- begin:subscribe -->
        <section id="subscribe" class="subscribe">
            <div class="container-fluid p-l-0 p-r-0">
                <div class="overlay">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <h3>Get Newsletter Update</h3>
                            <form class="form-inline" method="post" action="php/subscribe.php">
                                <div class="input-group">
                                    <input type="email" class="form-control input-lg" placeholder="Enter your mail id">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary btn-lg subscribe-btn" type="submit"><i class="fa fa-envelope"></i></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end:subscribe -->

        
@endsection