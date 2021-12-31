<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/logo/logo.png') }}">
        <!-- Place favicon.ico in the root directory -->

         <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- CSS here -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
        <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
        <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('css/default.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Toast Alert -->
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/izitoast/dist/css/iziToast.min.css">
        <!-- Toast Alert -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <script type="text/javascript">
            function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: '', layout:
                google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
            }
        </script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap');
        </style>
        
    </head>
    <body>

        <!-- preloader -->
        <div id="preloader">
            <div id="loading-center">
                    <lottie-player src="{{url('img/images/45869-farmers.json')}}" style="width:300px;" background="transparent"  speed="3" loop autoplay></lottie-player>
                <!--<div class="loader">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>-->
            </div>
        </div>
        <!-- preloader-end -->


        <!-- Scroll-top -->
        <button class="scroll-top scroll-to-target" data-target="html">
            <i class="fas fa-angle-up"></i>
        </button>
        <!-- Scroll-top-end-->

        <!-- header-area -->
        <header>

            <!-- header-message -->
            <!-- <div class="header-message-wrap">
                <div class="container custom-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="top-notify-message">
                                <p>place your complaints (if any) within 24hrs of receiving your delivery</p>
                                <span class="message-remove">X</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- header-message-end -->

            <!-- header-top-start -->
            <div class="header-top-wrap">
                <div class="container custom-container">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <div class="header-top-left">
                                <ul>
                                    <li class="header-top-lang">
                                        <div id="google_translate_element"></div>
                                        <!--<div class="dropdown">
                                            <button class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">English</button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                <a class="dropdown-item" href="#">Gujarati</a>
                                                <a class="dropdown-item" href="#">Hindi</a>
                                            </div>
                                        </div>-->
                                    </li>
                                    <!-- <li class="header-top-currency">
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">USD - US Dollar</button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                                <a class="dropdown-item" href="index.html">INR - IN Rupe</a>
                                                <a class="dropdown-item" href="index.html">BDT - BD Taka</a>
                                                <a class="dropdown-item" href="index.html">SAR - SA Riyal</a>
                                            </div>
                                        </div>
                                    </li> -->
                                    <li class="header-work-time">
                                        Working time: <span> Mon - Sat : 8:00 AM  - 10:00 PM</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="header-top-right">
                                <ul>
                                    @if(auth()->user())
                                        <li><a href="{{route('users.profile')}}">Welcome! {{auth()->user()->name}}</a></li>
                                    @else
                                        <li><a href="{{route('login')}}">Login</a></li>
                                    @endif    
                                    <li><a href="{{route('about-us')}}">About Us</a></li>
                                    <li><a href="{{route('contact-us')}}">Contact</a></li>
                                    <li><a href="{{route('faq')}}">FAQ</a></li>

                                    @if(auth()->user())
                                    <li>
                                        <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{route('logout')}}">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                    </li>
                                    @endif
                                    

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-top-end -->

            <!-- header-search-area -->
            <div class="header-search-area">
                <div class="container custom-container">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-lg-3 d-none d-lg-block">
                            <div class="logo">
                                <a href="{{route('home')}}">
                                    <img style="width: 50%;" src="{{ asset('img/logo/logo.png') }}" alt="Logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-9">
                            <div class="d-block d-sm-flex align-items-center justify-content-end">
                                <div class="header-search-wrap">
                                    {!! Form::open(['route' => 'products', 'class' => 'search-form', 'method' => 'GET']) !!}
                                        <select name="category" class="custom-select">
                                            <option selected="" disabled="" >All Categories</option>
                                            @if(count(Config::get('app.categories')) > 0)
                                                @foreach(Config::get('app.categories') as $category)
                                                    @if(isset($_GET['category'])) 
                                                        @php $selCate = $_GET['category'] @endphp
                                                    @else
                                                        @php $selCate = '' @endphp
                                                    @endif
                                                    
                                                    <option @if($selCate==$category->id) selected="selected" @endif  value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        {!! Form::text('search', isset($_GET['search']) ? $_GET['search'] : null ,  ['placeholder'=> 'Search Product...']) !!}
                                        <button><i class="flaticon-loupe-1"></i></button>
                                    {!! Form::close() !!}
                                </div>
                                <div class="header-action">
                                    <ul>
                                        <li class="header-phone">
                                            <div class="icon"><i class="flaticon-telephone"></i></div>
                                            <a href="tel:1234566789"><span>Call Us Now</span>{{setting('app_website_mobile')}}</a>
                                        </li>
                                        @if(auth()->user())
                                            <li class="header-user">
                                                <a href="{{route('users.profile')}}"><i class="flaticon-user"></i></a>
                                            </li>
                                        @else
                                            <li class="header-user">
                                                <a href="{{route('login')}}"><i class="flaticon-user"></i></a>
                                            </li>
                                        @endif    

                                        <li class="header-wishlist">
                                            <a href="{{route('wishlist')}}"><i class="flaticon-heart-shape-outline"></i></a>
                                            <span class="wishlist-count item-count">
                                                {{ (Cookie::get('favourites')!==null)  ? Cookie::get('favourites') : 0 }}
                                            </span>
                                        </li>
                                        <li class="header-cart-action">
                                            
                                            @include('layouts.cart_widget')

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-search-area-end -->

            <div id="sticky-header" class="menu-area">
                <div class="container custom-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                            <div class="menu-wrap">
                                <nav class="menu-nav">
                                    <div class="logo d-block d-lg-none">
                                        <a href="{{route('home')}}">
                                            <img src="img/logo/logo.png" style="width: 16%;" alt="">
                                        </a>
                                    </div>
                                    <div class="header-category d-none d-lg-block">
                                        <a href="#" class="cat-toggle"><i class="fas fa-bars"></i>ALL DEPARTMENT<i class="fas fa-angle-down"></i></a>
                                        <ul class="category-menu">

                                            @if(count(Config::get('app.categories')) > 0)
                                                @foreach(Config::get('app.categories') as $category)
                                                    <li>
                                                        <a href="{{ route('showCategoryProduct',[$category->id,strtolower(str_replace(' ','_',$category->name))]) }}">
                                                        <!--<i class="flaticon-groceries"></i>-->
                                                        @if($category->hasMedia('image'))
                                                            <img style="width:15%;" src="{{$category->getFirstMediaUrl('image','icon')}}" alt=""> &nbsp;&nbsp;
                                                        @else
                                                            <i class="flaticon-groceries"></i>
                                                        @endif
                                                        {{$category->name}}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif

                                        </ul>
                                    </div>
                                    <div class="navbar-wrap main-menu d-none d-lg-flex">
                                        <ul class="navigation">
                                            <li @if(Route::currentRouteName()=='home') class="active" @endif><a href="{{route('home')}}">Home</a></li>
                                            <li @if(Route::currentRouteName()=='products' || Route::currentRouteName()=='showProduct' || Route::currentRouteName()=='showCategoryProduct') class="active" @endif><a href="{{route('products')}}">Products</a></li>
                                            <li @if(Route::currentRouteName()=='about-us') class="active" @endif><a href="{{route('about-us')}}">About Us</a></li>
                                            <li @if(Route::currentRouteName()=='social-responsibility') class="active" @endif><a href="{{route('social-responsibility')}}">Social Responsibility</a></li>
                                            <li @if(Route::currentRouteName()=='special-offers') class="active" @endif><a href="{{route('special-offers')}}">Special Offers</a></li>
                                            <li @if(Route::currentRouteName()=='volunteer-with-us') class="active" @endif><a href="{{route('volunteer-with-us')}}">Volunteer with us</a></li>
                                            <li @if(Route::currentRouteName()=='contact-us') class="active" @endif><a href="{{route('contact-us')}}">Contact us</a></li>
                                        </ul>
                                    </div>
                                    <!-- <div class="header-super-store d-none d-xl-block d-lg-none d-md-block">
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" type="button" id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i class="flaticon-shop"></i> Super Store</button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                                <a class="dropdown-item" href="shop.html">Super Store 01</a>
                                                <a class="dropdown-item" href="shop.html">Super Store 02</a>
                                                <a class="dropdown-item" href="shop.html">Super Store 03</a>
                                            </div>
                                        </div>
                                    </div> -->
                                </nav>
                            </div>
                            <!-- Mobile Menu  -->
                            <div class="mobile-menu">
                                <nav class="menu-box">
                                    <div class="close-btn"><i class="fas fa-times"></i></div>
                                    <div class="nav-logo">
                                        <a href="{{route('home')}}">
                                            <img src="img/logo/logo.png" alt="" title="">
                                        </a>
                                    </div>
                                    <div class="menu-outer">
                                        <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                                    </div>
                                    <div class="social-links">
                                        <ul class="clearfix">
                                            <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                            <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                            <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                                            <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                            <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <div class="menu-backdrop"></div>
                            <!-- End Mobile Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header-area-end -->


        <!-- main-area -->
        <main>

            @yield('content')

        </main>
        <!-- main-area-end -->


        <!-- footer-area -->
        <footer class="mt-100">
            <div class="footer-area gray-bg pt-10 pb-0">
                <div class="container">
                    <div class="row justify-content-between">
                        
                        <div class="col-xl-10 offset-xl-1 col-lg-12 col-md-12 subscription-section mb-50">
                            <div class="row">
                                <div class="col-xl-4">
                                    <img style="width:100%; position: absolute; bottom: 0;" src="{{asset('img/footer/mailchimp-image1.png')}}" class="attachment-full" alt="">
                                </div>
                                <div class="col-xl-8">
                                    @if(session()->has('message'))
                                        <div class="text-white text-center">
                                            {{ session()->get('message') }}
                                        </div>
                                    @endif
                                    <h4 class="text-white pl-50">Subscribe to our Newsletter:</h4>
                                    {!! Form::open(['route' => 'subscribe','class' => 'pl-50', 'id' => 'subscriptionForm']) !!}
                                        <input type="email" name="email" class="subscribe-field" value="" />
                                        <button class="subscribe-btn" type="submit">Subscribe <i class="fa fa-arrow-right"></i></button>
                                    {!! Form::close() !!}
                                    &nbsp;
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="footer-widget ">
                                <div class="footer-logo mb-25 ">
                                    <a href="{{route('home')}}"><img style="width: 30%;" src="{{asset('img/logo/logo.png')}}" alt=""></a>
                                </div>
                                <div class="footer-contact-list">
                                    <ul>
                                        <li>
                                            <div class="icon"><i class="flaticon-shop"></i></div>
                                            <p><b>{{setting('app_name')}}</b></p>
                                        </li>
                                        <li>
                                            <div class="icon"><i class="flaticon-place"></i></div>
                                            <p>
                                                {{setting('app_store_address_line_1')}}, {{setting('app_store_address_line_2')}},
                                                {{setting('app_store_city')}} - {{setting('app_store_pincode')}},
                                                {{setting('app_store_state')}}, {{setting('app_store_country')}}.
                                            </p>
                                        </li>
                                        <li>
                                            <div class="icon"><i class="flaticon-telephone-1"></i></div>
                                            <h5 class="text-white"><a href="tel:{{setting('app_store_phone_no')}}">{{setting('app_website_mobile')}}</a></h5>
                                        </li>
                                        <li>
                                            <div class="icon"><i class="flaticon-mail"></i></div>
                                            <p><a href="mailto:{{setting('app_website_email')}}">{{setting('app_website_email')}}</a></p>
                                        </li>
                                        <!-- <li>
                                            <div class="icon"><i class="flaticon-wall-clock"></i></div>
                                            <p>Week 7 days from 7:00 to 20:00</p>
                                        </li> -->
                                    </ul>
                                </div>
                                <!-- <div class="footer-social">
                                    <ul>
                                        <li><a href="{{setting('app_facebook_url')}}"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="{{setting('app_twitter_url')}}"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="{{setting('app_instagram_url')}}"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="{{setting('app_linkedin_url')}}"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="footer-widget mb-50">
                                <div class="fw-title">
                                    <h5 class="title">Customer Service</h5>
                                </div>
                                <div class="fw-link">
                                    <ul>
                                        <li><a href="{{route('about-us')}}">About us</a></li>
                                        <li><a href="{{route('contact-us')}}">Contact us</a></li>
                                        <li><a href="{{route('volunteer-with-us')}}">Volunteer with us</a></li>
                                        <li><a href="{{route('faq')}}">FAQ</a></li>
                                        <li><a href="{{route('users.orderTracking')}}">Order Tracking</a></li>
                                        <li><a href="{{route('terms-and-conditions')}}">Terms & Conditions</a></li>
                                        <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="footer-widget mb-50">
                                <div class="fw-title">
                                    <h5 class="title">Useful Links</h5>
                                </div>
                                <div class="fw-link">
                                    <ul>
                                        <li><a href="{{route('special-offers')}}">Special Offers</a></li>
                                        <li><a href="{{route('rewards')}}">Rewards</a></li>
                                        <li><a href="{{route('products')}}">Products</a></li>
                                        <li><a href="{{route('users.profile')}}">My Account</a></li>
                                        <li><a href="{{route('social-responsibility')}}">Social Responsibility</a></li>
                                        <li><a href="{{route('cart')}}">Shopping Cart</a></li>
                                        <li><a href="{{route('checkout')}}">Checkout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="footer-widget footer-box-widget">
                                <div class="f-download-wrap">
                                    <div class="fw-title">
                                        <h5 class="title">Download App</h5>
                                    </div>
                                    <div class="download-btns">
                                        <a target="_blank" href="{{setting('app_website_android_url')}}">
                                            <img style="width:48%" src="{{asset('img/icon/g_play.png')}}" alt="">
                                        </a>
                                        <a target="_blank" href="{{setting('app_website_ios_url')}}">
                                            <img style="width:48%" src="{{asset('img/icon/app_store.png')}}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <hr>
                                <div class="contact-social">
                                    <ul>
                                        <li><a href="{{setting('app_facebook_url')}}"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="{{setting('app_twitter_url')}}"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="{{setting('app_instagram_url')}}"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="{{setting('app_linkedin_url')}}"><i class="fab fa-linkedin-in"></i></a></li>
                                        <!--<li><a href="{{setting('app_linkedin_url')}}"><i class="fab fa-telegram"></i></a></li>-->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-wrap">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="copyright-text">
                                <p>Copyright &copy; {{date('Y')}} {{setting('app_name')}} All Rights Reserved</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="payment-accepted text-center text-md-right">
                                <img src="{{asset('img/images/payment_card.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer-area-end -->

        <!-- JS here -->
        <script src="{{ asset('js/vendor/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/slick.min.js') }}"></script>
        <script src="{{ asset('js/ajax-form.js') }}"></script>
        <script src="{{ asset('js/wow.min.js') }}"></script>
        <script src="{{ asset('js/aos.js') }}"></script>
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
        <script src="{{ asset('js/main.js') }}"></script>

        <!-- Toast Alert -->
        <script src="https://unpkg.com/izitoast/dist/js/iziToast.min.js"></script>
        <!-- Toast Alert -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

        @stack('scripts_lib')

        <script>

            //var siteURL = $('#site_url').val();

            function updateCart() {
               $.ajax({
                  type: "GET",
                  url: "{{ url('products/cartItems') }}", // This is what I have updated
                  dataType:'json',
                  data: {
                      "_method": "GET",
                      "_token": "{{ csrf_token() }}"
                  }
              }).done(function(data) {
                  console.log(data);

                  $('.header-cart-action').load("{{url('products/loadSidbarCart')}}", function() {
                      //$('#loadingImg').hide();
                  });
                  $('.cartTotals').load("{{url('cartTotals')}}", function() { });

              }).fail(function(results) {
                  console.log(results);
              }); 
            } 


            $("document").ready(function(){
                $(".addToCartForm").submit(function(e){
                    //console.log($(this).closest('.cart-btn'));
                    $(this).find('.cart-btn').attr("disabled", true);
                    $(this).find('.cart-btn').html('Adding... <i class="fas fa-spinner fa-spin"></i>');

                    e.preventDefault();
                    //var action = this.action;
                    var action = "{{ url('products/addToCart') }}";

                    $.ajax({
                        url: action,
                        type: 'post',
                        dataType: 'JSON',
                        data: $(this).serialize()
                    })
                    .done(function(results) {
                        if(results.status=='success') {    
                            iziToast.success({
                                backgroundColor:'#4eb92d',
                                messageColor:'#fff',
                                timeout: 5000,
                                icon: 'fa fa-check',
                                position: "topRight",
                                iconColor:'#fff',
                                message: results.message
                            });

                            $(this).trigger("reset");
                            $('.cart-btn').attr("disabled", false);
                            $('.cart-btn').html('<i class="flaticon-shopping-basket"></i> Add to cart');
                            updateCart();
                        } else if(results.status=='faliure') {
                            iziToast.success({
                                backgroundColor:'#4eb92d',
                                messageColor:'#fff',
                                timeout: 5000,
                                icon: 'fa fa-check',
                                position: "topRight",
                                iconColor:'#fff',
                                message: results.message
                            });

                            $(this).trigger("reset");
                            $('.cart-btn').attr("disabled", false);
                            $('.cart-btn').html('<i class="flaticon-shopping-basket"></i> Add to cart');
                            updateCart();    
                        }
                    })
                    .fail(function(results) {
                        iziToast.warning({
                            backgroundColor: '#d9b44a',
                            messageColor: '#fff', 
                            timeout: 5000, icon: 'fa fa-exclamation-triangle', 
                            position: "topRight", 
                            iconColor:'#fff', message: results.responseJSON.message
                        });
                        updateCart();
                    });

                });
            });

            function removeItem(elem) {
                var id = $(elem).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ url('products/removeCartItem') }}", // This is what I have updated
                    dataType:'json',
                    data: {
                        "_method": "POST",
                        "_token": "{{ csrf_token() }}",
                        "product_id": id
                    }
                }).done(function(msg) {
                    iziToast.success({
                        backgroundColor: '#4eb92d',
                        messageColor: '#fff',
                        timeout: 5000,
                        icon: 'fa fa-shopping-basket',
                        position: "topRight",
                        iconColor:'#fff',
                        message: 'Item Removed Successfully'
                    });
                    updateCart();
                }).fail(function(results) {
                    console.log(results);
                });
            }

            $('.cart-btn').click(function() {
                var id = $(this).data('id');
                $("#addToCartForm"+id).submit();
                //$(this).closest('form').submit();
            });



            $(document).ready(function(){
              $('.apply-coupon-btn').click(function(e){
                 e.preventDefault();
                 /*Ajax Request Header setup*/
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                /* Submit form data using ajax*/
                 $.ajax({
                    url: "{{ route('apply-coupon') }}",
                    method: 'POST',
                    data: $('.apply-coupon').serialize(),
                    success: function(response){
                       //------------------------
                          if(response.data!=null) {
                                $('.coupon_code').val('');
                                iziToast.success({
                                    backgroundColor: '#4eb92d', 
                                    messageColor: '#fff', 
                                    timeout: 2000, 
                                    icon: 'fa fa-tag', 
                                    position: "topCenter", 
                                    iconColor:'#fff', 
                                    message: response.message
                                });
                                location.reload();
                          } else {
                                iziToast.warning({
                                    backgroundColor: '#4eb92d', 
                                    messageColor: '#fff', 
                                    timeout: 2000, 
                                    icon: 'fa fa-tag', 
                                    position: "topCenter", 
                                    iconColor:'#fff', 
                                    message: response.message
                                });
                          }
                          updateCart();
                       //--------------------------
                    }});
                });
            });
      

            function removeCoupon() {
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
               });
               /* Submit form data using ajax*/
               $.ajax({
                    url: "{{ route('remove-coupon') }}",
                    method: 'GET',
                    data: 'coupon',
                    success: function(response){
                       //------------------------
                          iziToast.success({
                            backgroundColor: '#4eb92d',
                            messageColor: '#fff', 
                            timeout: 5000, 
                            icon: 'fa fa-tag', 
                            position: "center", 
                            iconColor:'#fff', 
                            message: response.message});
                            location.reload();
                       //--------------------------
                    }
               });
            }
            
            function removeContribution() {
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
               });
               /* Submit form data using ajax*/
               $.ajax({
                    url: "{{ route('remove-contribution') }}",
                    method: 'GET',
                    data: 'coupon',
                    success: function(response){
                       //------------------------
                          iziToast.success({
                            backgroundColor: '#4eb92d',
                            messageColor: '#fff', 
                            timeout: 5000, 
                            icon: 'fa fa-tag', 
                            position: "center", 
                            iconColor:'#fff', 
                            message: response.message});
                            location.reload();
                       //--------------------------
                    }
               });
            }

            function removeCartItem(product_id) {
                $.ajax({
                  type: "POST",
                  url: "{{ url('products/removeCartItem') }}", // This is what I have updated
                  dataType:'json',
                  data: {
                      "_method": "POST",
                      "_token": "{{ csrf_token() }}",
                      "product_id": product_id
                  }
              }).done(function(msg) {
                    updateCart();
                    iziToast.success({
                        backgroundColor: '#4eb92d', 
                        messageColor: '#fff', 
                        timeout: 3000, 
                        icon: 'fa fa-shopping-basket', 
                        position: "center", 
                        iconColor:'#fff', 
                        message: 'Cart item removed'
                    });
                    location.reload();
              }).fail(function(results) {
                  console.log(results);
              });
            }


            $(document).ready(function(){
                $('.update-cart-btn').click(function(e){
                    $('.cart-update').submit(); 
                });
            });

            $(function () {
              $(".datepicker").datepicker({ 
                    autoclose: true, 
                    todayHighlight: true,
                    format: 'dd-mm-yyyy'
              });
            });

            $('.payment_type').click(function(e){ 
                var payment_type = $("input[name='payment_type']:checked").val();
                if(payment_type=='CARD') {
                    $('.paymentGateway').fadeIn(1000);    
                } else {
                    $('.paymentGateway').fadeOut(1000);
                }
            });


            $('.edit-address').click(function(e){
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "{{url('')}}" + '/deliveryAddresses/' + id, // This is what I have updated
                    dataType:'json',
                    data: { }
                }).done(function(results) {
                    if(results.status == 'success') {
                        
                        $("#address-add").modal('show');
                        
                        $('.form-type').html('<input name="_method" type="hidden" value="PATCH">');
                        $('#deliveryAddress').attr('action', "{{url('')}}" + '/deliveryAddresses/' + id);

                        $('.description').val(results.data.description);
                        $('.address_line_1').val(results.data.address_line_1);
                        $('.address_line_2').val(results.data.address_line_1);
                        $('.city').val(results.data.city);
                        $('.state').val(results.data.state);
                        $('.pincode').val(results.data.pincode);
                        $('.latitude').val(results.data.latitude);
                        $('.longitude').val(results.data.longitude);
                    }
                }).fail(function(results) {
                    console.log(results);
                });
            });    

            function createAddress() {
                $('#address-add').modal('show');
                $('#deliveryAddress').trigger("reset");
                //$('#deliveryAddress').attr('action', siteURL + '/deliveryAddresses/store');
            }


            $("document").ready(function(){
                $("#deliveryAddress").submit(function(e){
                    var form_status = $("#deliveryAddress").valid();
                    if(form_status==true) {    

                        $('.address-add-btn').attr("disabled", true);
                        $('.address-add-btn').html('Adding...');
                        e.preventDefault();
                        var action = this.action;
                        $.ajax({
                            url: action,
                            type: 'post',
                            dataType: 'JSON',
                            data: $('#deliveryAddress').serialize()
                        })
                        .done(function(results) {
                            if(results.data!='') {
                                iziToast.success({
                                    backgroundColor: '#4eb92d', 
                                    messageColor: '#fff', 
                                    timeout: 3000, 
                                    icon: 'fa fa-check', 
                                    position: "center", 
                                    iconColor:'#fff', 
                                    message: results.message
                                });
                                $("#deliveryAddress").trigger("reset");
                                $(".address-edit-box").modal('hide');
                                location.reload();
                            }
                        })
                        .fail(function(results) {
                            iziToast.warning({
                                backgroundColor: '#4eb92d', 
                                messageColor: '#fff', 
                                timeout: 3000, 
                                icon: 'fa fa-exclamation-triangle', 
                                position: "center", 
                                iconColor:'#fff', 
                                message: results.responseJSON.message
                            });
                        });

                    }

                });
            });

            $(document).on("click",".wish-link", function () {
                var product_id = $(this).data("id");
                $.ajax({
                  type: "GET",
                  url: "{{ url('') }}/products/addToFavorite", // This is what I have updated
                  dataType:'json',
                  data: {
                      "_method": "GET",
                      "product_id": product_id
                  }
                }).done(function(msg) {
                    console.log(msg);
                    $('.wishlist-count').html(msg.data);
                    iziToast.success({
                        backgroundColor: '#4eb92d', 
                        messageColor: '#fff', 
                        timeout: 3000, 
                        icon: 'fas fa-heart', 
                        position: "center", 
                        iconColor:'#f55050', 
                        message: msg.message
                    });
                    location.reload();
                }).fail(function(results) {
                  //if(results.statusText=='error') {
                      location.href="{{ route('login') }}";
                  //}
                });
            });
            
            function redeemPoints() {
               var points = $('#redeem_points').val();
               if(points > 0) {
    
                  $.ajax({
                      type: "POST",
                      url: "{{url('')}}" + '/redeemPoints', // This is what I have updated
                      dataType:'json',
                      data: {
                        "_method": "POST",
                        "_token": "{{ csrf_token() }}",
                        "redeem": points
                      }
                  }).done(function(results) {
                      console.log(results);
                      if(results.data!=0) {
                        iziToast.success({
                            backgroundColor: '#4eb92d',
                            messageColor: '#fff',
                            timeout: 3000,
                            icon: 'fa fa-check',
                            position: "center",
                            iconColor:'#fff',
                            message: results.message
                        });
                        $('.points-worth').html((results.data).toFixed(2));
                        updateCart();
                      } else {
                        iziToast.success({
                            backgroundColor: '#4eb92d',
                            messageColor: '#fff',
                            timeout: 3000,
                            icon: 'fa fa-exclamation-triangle',
                            position: "center",
                            iconColor:'#fff',
                            message: results.message
                        });
                      }
                  }).fail(function(results) {
                      console.log(results);
                  });
    
               } else {
                 iziToast.warning({
                     backgroundColor: '#4eb92d',
                     messageColor: '#fff',
                     timeout: 3000,
                     icon: 'fa fa-exclamation-triangle',
                     position: "topRight",
                     iconColor:'#fff',
                     message:'Please enter the valid points'
                 });
               }
            }

        </script>


    <script src="https://maps.googleapis.com/maps/api/js?key={{setting('google_api_key')}}&libraries=places&callback=initAutocomplete" async defer></script>
    
    @if(!Auth()->user())

    <script type="text/javascript">
        var placeSearch, autocomplete, geocoder;

        function initAutocomplete() {
          geocoder = new google.maps.Geocoder();
          autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('address_line_1')), {
              types: ['geocode']
            });

          autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
          var place = autocomplete.getPlace();  
            // Location details
            console.log(place.address_components);
            for (var i = 0; i < place.address_components.length; i++) {
                if(place.address_components[i].types[0] == 'postal_code'){
                    document.getElementById('pincode').value = place.address_components[i].long_name;
                }
                if(place.address_components[i].types[0] == 'administrative_area_level_1'){
                    document.getElementById('state').value = place.address_components[i].long_name;
                }
                if(place.address_components[i].types[0] == 'administrative_area_level_2'){
                    document.getElementById('city').value = place.address_components[i].long_name;
                }
            }
            //document.getElementById('address_line_1').value = place.formatted_address;
            document.getElementById('lat').value = place.geometry.location.lat();
            document.getElementById('lon').value = place.geometry.location.lng();
            
              
            @if(Request::is('checkout*'))
            
              const service = new google.maps.DistanceMatrixService();
              // build request
              const from = { lat: {{setting('app_store_latitude')}}, lng: {{setting('app_store_longitude')}} };
              const to   = { lat: place.geometry.location.lat(), lng: place.geometry.location.lng()};
              const request = {
                origins: [from],
                destinations: [to],
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC,
                avoidHighways: false,
                avoidTolls: false,
              };
              // get distance matrix response
              service.getDistanceMatrix(request).then((response) => {
                // put response
                
                
                $.ajax({
                      type: "POST",
                      url: "{{url('calculateDeliveryCharge')}}", // This is what I have updated
                      dataType:'json',
                      data: {
                        "_method": "POST",
                        "_token": "{{ csrf_token() }}",
                        "data": response
                      }
                  }).done(function(results) {
                      if(results.data!=0) {
                          iziToast.success({backgroundColor: '#01422a', messageColor: '#fff', timeout: 5000, icon: 'fa fa-check', position: "topRight", iconColor:'#fff', message: results.message});
                          updateCart();
                      } else {
                          iziToast.success({backgroundColor: '#d9b44a', messageColor: '#fff', timeout: 5000, icon: 'fa fa-check', position: "topRight", iconColor:'#fff', message: results.message});                             
                          $('.address_line_1').val('');
                          $('.address_line_2').val('');
                          $('.city').val('');
                          $('.state').val('');
                          $('.pincode').val('');
                          $('.latitude').val('');
                          $('.longitude').val('');
                          updateCart();
                      }
                  }).fail(function(results) {
                      console.log(results);
                  });
                
              });
              
            @endif  
            
        }
    </script>
    
    @else
    
    <script>
        var placeSearch, autocomplete, geocoder;

        function initAutocomplete() {
          geocoder = new google.maps.Geocoder();
          autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('address_line_1')), {
              types: ['geocode']
            });

          autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
          var place = autocomplete.getPlace();  
            // Location details
            for (var i = 0; i < place.address_components.length; i++) {
                if(place.address_components[i].types[0] == 'postal_code'){
                    document.getElementById('pincode').value = place.address_components[i].long_name;
                }
                if(place.address_components[i].types[0] == 'administrative_area_level_1'){
                    document.getElementById('state').value = place.address_components[i].long_name;
                }
                if(place.address_components[i].types[0] == 'administrative_area_level_2'){
                    document.getElementById('city').value = place.address_components[i].long_name;
                }
            }
            //document.getElementById('address_line_1').value = place.formatted_address;
            document.getElementById('lat').value = place.geometry.location.lat();
            document.getElementById('lon').value = place.geometry.location.lng();
        }
        

        function deliveryAddressSet(elem) {

            var lat = $(elem).data("lat");
            var lon = $(elem).data("lon");
            var id  = $(elem).val();
            if(lat!='' && lon!=''&& id!='') {
              /*alert(lat); alert(lon);*/  
              const service = new google.maps.DistanceMatrixService();
              // build request
              const from = { lat: {!!setting('app_store_latitude')!!}, lng: {!!setting('app_store_longitude')!!} };
              const to   = { lat: lat, lng: lon};
              const request = {
                origins: [from],
                destinations: [to],
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC,
                avoidHighways: false,
                avoidTolls: false,
              };
                // get distance matrix response
                service.getDistanceMatrix(request).then((response) => {
                // put response
                    console.log(response);
                    $.ajax({
                          type: "POST",
                          url: "{{url('calculateDeliveryCharge')}}", // This is what I have updated
                          dataType:'json',
                          data: {
                            "_method": "POST",
                            "_token": "{{ csrf_token() }}",
                            "data": response,
                            "id":id
                          }
                    }).done(function(results) {
                        if(results.data!=0) {
                            iziToast.success({
                                backgroundColor: '#4eb92d', 
                                messageColor: '#fff', 
                                timeout: 3000, 
                                icon: 'fa fa-check', 
                                position: "center", 
                                iconColor:'#fff', 
                                message: results.message
                            });
                            updateCart();
                        } else {
                            iziToast.success({
                                backgroundColor: '#4eb92d', 
                                messageColor: '#fff', 
                                timeout: 3000, 
                                icon: 'fa fa-check', 
                                position: "center", 
                                iconColor:'#fff', 
                                message: results.message
                            });                             
                            $('.address_line_1').val('');
                            $('.address_line_2').val('');
                            $('.city').val('');
                            $('.state').val('');
                            $('.pincode').val('');
                            $('.latitude').val('');
                            $('.longitude').val('');
                            updateCart();
                            elem.checked = false;
                        }
                    }).fail(function(results) {
                          console.log(results);
                    });
                
                });

            } else {
                elem.checked = false;    
                iziToast.warning({
                    backgroundColor: '#d9b44a', 
                    messageColor: '#fff', 
                    timeout: 5000, 
                    icon: 'fa fa-check', 
                    position: "center", 
                    iconColor:'#fff', 
                    message: 'Invalid Address'
                });      
            }

        }

    </script>
    
    @endif
    
    <script>
        var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?24495';
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = url;
        var options = {
          "enabled":true,
          "chatButtonSetting":{
              "backgroundColor":"#4dc247",
              "ctaText":"",
              "borderRadius":"25",
              "marginLeft":"0",
              "marginBottom":"50",
              "marginRight":"50",
              "position":"right"
          },
          "brandSetting":{
              "brandName":"Grounded Goodness Private Limited",
              "brandSubTitle":"Typically replies within a day",
              "brandImg":"https://www.s22beta.com.au/ggpl_admin_demo/storage/app/public/140/logo.png",
              "welcomeText":"Hi there!\nHow can I help you?",
              "messageText":"Hello, I have a question about ",
              "backgroundColor":"#0a5f54",
              "ctaText":"Start Chat",
              "borderRadius":"25",
              "autoShow":false,
              "phoneNumber":"61401275544"
          }
        };
        s.onload = function() {
            CreateWhatsappChatWidget(options);
        };
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
    </script>
    <script>
        $(document).ready(function() {
           $('head').append('<style>body { top:0px !important; }</style>') 
        });
    </script>        
    </body>
</html>
