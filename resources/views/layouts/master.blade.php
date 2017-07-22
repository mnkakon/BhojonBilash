<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="{{ url('favicon.ico') }}">

        <title>@yield('title') | {{ env('SITE_NAME') }}</title>

        <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ url('css/owl.carousel.css') }}" rel="stylesheet">
        <link href="{{ url('css/owl.theme.css') }}" rel="stylesheet">
        <link href="{{ url('css/style.css') }}" rel="stylesheet">
    </head>

  <body>

    <!-- site-navigation start -->  
    <nav id="mainNavigation" class="navbar navbar-fixed-top" role="navigation">
        <div class="container">
            
            <div class="navbar-header">
                
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <!-- navbar logo -->
                <div class="navbar-brand">
                    <span class="sr-only">BhojonBilash</span>
                    <a href="{{ route('home') }}">
                        BhojonBilash
                    </a>
                </div>
                <!-- navbar logo -->

            </div><!-- /.navbar-header -->

            <!-- nav links -->
            @yield('nav-links')
            
            
        </div><!-- /.container -->
    </nav>
    <!-- site-navigation end -->

    <div class="body-content">
        @yield('content')
    </div>

     <!-- begin:footer -->
    <section id="footer" class="footer">
        <!-- begin:copyright -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 copyright">
                    <p>Copyright &copy; Bhojon-Bilash 2016. All Right Reserved.</p>
                    <p>Credit : <strong>Md. Mustafijur Rahman</strong> &amp; <strong>Mahmudun Nobi Kakon</strong></p>
                </div>
            </div>
        </div>
    </section>
    <!-- end footer -->

    
    <script src="{{ url('js/jquery.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/owl.carousel.js') }}"></script>
    <script src="{{ url('js/script.js') }}"></script>
  </body>
</html>
