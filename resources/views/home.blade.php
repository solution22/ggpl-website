@extends('layouts.app')

@section('content')

    <!-- slider-area -->
    <section class="slider-area" data-background="img/bg/slider_area_bg.jpg">
        <div class="container custom-container">
            <div class="row">
                <div class="col-7">
                    <div class="slider-active">
                        
                        @foreach($slides as $slide)

                            <div class="single-slider slider-bg" data-background="{{$slide->getFirstMediaUrl('image')}}">
                                <div class="slider-content">
                                    <!--<h5 class="sub-title" data-animation="fadeInUp" data-delay=".2s">top deal !</h5>-->
                                    <h2 style="color: {{$slide->text_color}}; " class="title" data-animation="fadeInUp" data-delay=".4s">
                                        {{$slide->text}}
                                    </h2>
                                    <!--<p data-animation="fadeInUp" data-delay=".6s">Get up to 50% OFF Today Only</p>-->
                                    <a href="{{route('products')}}" style="background:{{$slide->background_color}}; color:{{$slide->button_color}};" class="btn rounded-btn" data-animation="fadeInUp" data-delay=".8s">{{$slide->button}}</a>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
                <div class="col-3">
                    <div class="slider-banner-img mb-20">
                        <a href="{{route('products')}}"><img src="{{asset('img/slider/slider_banner01.jpg')}}" alt=""></a>
                    </div>
                    <div class="slider-banner-img">
                        <a href="{{route('products')}}"><img src="{{asset('img/slider/slider_banner02.jpg')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="slider-banner-img">
                        <a href="{{route('products')}}"><img src="{{asset('img/slider/slider_banner03.jpg')}}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- category-area -->
        <div class="container custom-container">
            <div class="slider-category-wrap">
                <div class="text-right mb-3">
                    <a class="pp2"><i class="fa fa-arrow-left"></i></a>
                    <a class="nn2"><i class="fa fa-arrow-right"></i></a>
                </div>
                <div class="row category-active">

                    @if(count(Config::get('app.categories')) > 0)
                        @foreach(Config::get('app.categories') as $category)
                            <div class="col-lg-2">
                                <div class="category-item">
                                    <a href="{{ route('showCategoryProduct',[$category->id,strtolower(str_replace(' ','_',$category->name))]) }}" class="category-link"></a>
                                    <div class="category-thumb">
                                        
                                        @if($category->hasMedia('image'))
                                            <img src="{{$category->getFirstMediaUrl('image','thumb')}}" style="width:71%;" alt="{{$category->name}}">
                                        @else 
                                            <img src="{{ asset('img/product/category_img02.png') }}" alt="{{$category->name}}">
                                        @endif

                                    </div>
                                    <div class="category-content">
                                        <h6 class="title">{{$category->name}}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif    
                    
                </div>
            </div>
        </div>
        <!-- category-area-end -->

    </section>
    <!-- slider-area-end -->

    <!-- discount-area -->
    <!-- <section class="discount-area pt-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-8">
                    <div class="discount-item mb-20">
                        <div class="discount-thumb">
                            <img src="img/product/discount_img01.jpg" alt="">
                        </div>
                        <div class="discount-content">
                            <span>healthy food</span>
                            <h4 class="title"><a href="shop.html">100 organic UP TO 35%</a></h4>
                            <a href="shop.html" class="btn">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-8">
                    <div class="discount-item mb-20">
                        <div class="discount-thumb">
                            <img src="img/product/discount_img02.jpg" alt="">
                        </div>
                        <div class="discount-content">
                            <span>healthy food</span>
                            <h4 class="title"><a href="shop.html">Hygienically Packed</a></h4>
                            <a href="shop.html" class="btn">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-8">
                    <div class="discount-item style-two mb-20">
                        <div class="discount-thumb">
                            <img src="img/product/discount_img03.jpg" alt="">
                        </div>
                        <div class="discount-content">
                            <span>healthy food</span>
                            <h4 class="title"><a href="shop.html">baby favorite UP TO 15%</a></h4>
                            <a href="shop.html" class="btn">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- discount-area-end -->

    <!-- best-deal-area -->
    <section class="best-deal-area pt-60 pb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-9">
                    <div class="best-deal-top-wrap">
                        <div class="bd-section-title">
                            <h3 class="title">Best Deals <span>of this Week!</span></h3>
                            <p>A virtual assistant collects the products from your list</p>
                        </div>
                        <!--<div class="coming-time" data-countdown="2021/10/20"></div>-->
                    </div>
                </div>
            </div>
            <div class="text-right mb-3">
                <a class="pp3"><i class="fa fa-arrow-left"></i></a>
                <a class="nn3"><i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="row best-deal-active">
                
                @if(count($deals) > 0)
                    @foreach($deals as $product) 
                
                        <div class="col-xl-3">
                            <div class="best-deal-item">
                                <div class="best-deal-thumb">
                                    <a href="{{ route('showProduct',[$product->id,strtolower(str_replace(' ','_',$product->name))]) }}">
                                        @if($product->hasMedia('image'))
                                            <img src="{{$product->getFirstMediaUrl('image')}}" alt="">
                                        @else
                                            <img src="{{asset('img/product/sp_products09.png')}}" alt="">
                                        @endif
                                    </a>
                                </div>
                                <div class="best-deal-content">
                                    <div class="main-content">
                                        <div class="rating">
                                            @for($i=0; $i<$product->productReviewsSum(); $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                        </div>
                                        <h4 class="title"><a href="{{ route('showProduct',[$product->id,strtolower(str_replace(' ','_',$product->name))]) }}">{{$product->name}}</a></h4>
                                        <p>
                                            @if($product->discount_price > 0 && $product->discount_price < $product->price)    
                                                <del>
                                                    {!!setting('default_currency')!!}
                                                    <span class="pro-price">{{number_format($product->price,'2','.','')}}</span>
                                                </del>
                                                
                                                &nbsp;&nbsp;
                                                
                                                {!!setting('default_currency')!!}
                                                <span class="pro-dis-price">{{number_format($product->discount_price,'2','.','')}}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <!--<div class="icon"><a href="shop-details.html">+</a></div>-->
                                </div>
                            </div>
                        </div>
                
                    @endforeach
                @endif    
                
            </div>
        </div>
    </section> 
    <!-- best-deal-area-end -->

    <!-- special-products-area -->
    <section class="special-products-area gray-bg pt-30 pb-60">
        <div class="container">
            <div class="row align-items-end mb-50">
                <div class="col-md-8 col-sm-9">
                    <div class="section-title">
                        <span class="sub-title">Awesome Shop</span>
                        <h2 class="title">Our Special Products</h2>
                    </div>
                </div>
                <div class="col-md-4 col-sm-3">
                    <div class="section-btn text-left text-md-right">
                        <a href="{{route('products')}}" class="btn">View All</a>
                    </div>
                </div>
            </div>
            <div class="special-products-wrap">
                <div class="row">

                    <div class="col-3 d-none d-lg-block">
                        <div class="special-products-add">
                            <div class="sp-add-thumb">
                                <img src="{{asset('img/product/special_products_add.jpg')}}" alt="">
                            </div>
                            <div class="sp-add-content">
                                <!--<span class="sub-title">Farm Fresh vegetables</span>-->
                                <h4 class="title">Farm Fresh <b>vegetables</b></h4>
                                <p>Super Offer TO 50% OFF</p>
                                <a href="{{route('products')}}" class="btn rounded-btn">shop now</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-9">
                        <div class="row justify-content-center">


                            @if(count($products) > 0)
                                @foreach($products as $product)    

                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="sp-product-item mb-20">
                                        <div class="sp-product-thumb">
                                            
                                            @if($product->discount_price > 0)
                                                @php
                                                    $price = $product->price;
                                                    $discount = $product->discount_price;
                                                    $dis_percent = number_format((($price - $discount)*100) / $price,0);
                                                @endphp
                                                <span class="batch discount">{{$dis_percent}}%</span>
                                            @endif

                                            <a href="{{ route('showProduct',[$product->id,strtolower(str_replace(' ','_',$product->name))]) }}">
                                                @if($product->hasMedia('image'))
                                                    <img src="{{$product->getFirstMediaUrl('image')}}" alt="">
                                                @else
                                                    <img src="{{asset('img/product/sp_products09.png')}}" alt="">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="sp-product-content">
                                            <div class="rating">
                                                @for($i=0; $i<$product->productReviewsSum(); $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                            </div>
                                            <h6 class="title">
                                                <a href="{{ route('showProduct',[$product->id,strtolower(str_replace(' ','_',$product->name))]) }}">{{$product->name}}</a>
                                            </h6>
                                            <!-- <span class="product-status">IN Stock</span> -->

                                            {!! Form::open(['id' => 'addToCartForm'.$product->id, 'class' => 'addToCartForm']) !!}
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                <input type="hidden" name="type" value="1">
                                                
                                                <div class="sp-cart-wrap">
                                                    <div class="cart-plus-minus">
                                                        <input type="text" name="quantity" value="1">
                                                    </div>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <select class="unit-select" id="variation" name="variation">
                                                        <option value="{{$product->unit}}">{{$product->unit}}</option>
                                                        @if($product->alternative_unit > 0)
                                                            <option value="{{$product->secondary_unit}}">{{$product->secondary_unit}}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <p><b> 
                                                    @if($product->discount_price > 0 && $product->discount_price < $product->price)    
                                                        <del>
                                                            {!!setting('default_currency')!!}
                                                            <span class="pro-price">{{number_format($product->price,'2','.','')}}</span>
                                                        </del>
                                                        
                                                        &nbsp;&nbsp;
                                                        
                                                        {!!setting('default_currency')!!}
                                                        <span class="pro-dis-price">{{number_format($product->discount_price,'2','.','')}}</span>
                                                    @endif

                                                </b></p>        
                                                <button data-id="{{$product->id}}" type="button" class="cart-btn btn btn-primary btn-sm"> 
                                                    <i class="flaticon-shopping-basket"></i> Add to Cart
                                                </button>

                                            {!! Form::close() !!}



                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            @else    

                                <p>No Products Found</p>
                                    
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- special-products-area-end -->

    <!-- coupon-area -->
    <div class="coupon-area gray-bg pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="coupon-bg">
                        <div class="coupon-title">
                            <span>Use coupon Code</span>
                            <h3 class="title">Get 20% Discount Code</h3>
                        </div>
                        <div class="coupon-code-wrap">
                            <h5 class="code">PROMO1</h5>
                            <img src="img/images/coupon_code.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- coupon-area-end -->

    <!-- best-sellers-area -->
    <!-- <section class="best-sellers-area pt-75">
        <div class="container">
            <div class="row align-items-end mb-50">
                <div class="col-md-8 col-sm-9">
                    <div class="section-title">
                        <span class="sub-title">Best Sellers</span>
                        <h2 class="title">Best Offers View</h2>
                    </div>
                </div>
                <div class="col-md-4 col-sm-3">
                    <div class="section-btn text-left text-md-right">
                        <a href="shop.html" class="btn">View All</a>
                    </div>
                </div>
            </div>
            <div class="best-sellers-products">
                <div class="row justify-content-center">
                    <div class="col-3">
                        <div class="sp-product-item mb-20">
                            <div class="sp-product-thumb">
                                <span class="batch">New</span>
                                <a href="shop-details.html"><img src="img/product/sp_products09.png" alt=""></a>
                            </div>
                            <div class="sp-product-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h6 class="title"><a href="shop-details.html">Uncle Orange Vanla Ready Pice</a></h6>
                                <span class="product-status">IN Stock</span>
                                <div class="sp-cart-wrap">
                                    <form action="#">
                                        <div class="cart-plus-minus">
                                            <input type="text" value="1">
                                        </div>
                                    </form>
                                </div>
                                <p>$1.50 - 1 kg</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="sp-product-item mb-20">
                            <div class="sp-product-thumb">
                                <span class="batch discount">15%</span>
                                <a href="shop-details.html"><img src="img/product/sp_products02.png" alt=""></a>
                            </div>
                            <div class="sp-product-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h6 class="title"><a href="shop-details.html">Dannon Max Vanla ice cream</a></h6>
                                <span class="product-status">IN Stock</span>
                                <div class="sp-cart-wrap">
                                    <form action="#">
                                        <div class="cart-plus-minus">
                                            <input type="text" value="1">
                                        </div>
                                    </form>
                                </div>
                                <p>$3.50 - 1 lt</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="sp-product-item mb-20">
                            <div class="sp-product-thumb">
                                <span class="batch discount">25%</span>
                                <a href="shop-details.html"><img src="img/product/sp_products03.png" alt=""></a>
                            </div>
                            <div class="sp-product-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h6 class="title"><a href="shop-details.html">Walnuts Max Vanla Greek Pice</a></h6>
                                <span class="product-status">IN Stock</span>
                                <div class="sp-cart-wrap">
                                    <form action="#">
                                        <div class="cart-plus-minus">
                                            <input type="text" value="1">
                                        </div>
                                    </form>
                                </div>
                                <p>$2.99 - 1 kg</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="sp-product-item mb-20">
                            <div class="sp-product-thumb">
                                <span class="batch">new</span>
                                <a href="shop-details.html"><img src="img/product/sp_products04.png" alt=""></a>
                            </div>
                            <div class="sp-product-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h6 class="title"><a href="shop-details.html">Brachs Bens Vanla Ready Pice</a></h6>
                                <span class="product-status">IN Stock</span>
                                <div class="sp-cart-wrap">
                                    <form action="#">
                                        <div class="cart-plus-minus">
                                            <input type="text" value="1">
                                        </div>
                                    </form>
                                </div>
                                <p>$2.99 - 1 kg</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="sp-product-item mb-20">
                            <div class="sp-product-thumb">
                                <span class="batch discount">25%</span>
                                <a href="shop-details.html"><img src="img/product/sp_products05.png" alt=""></a>
                            </div>
                            <div class="sp-product-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h6 class="title"><a href="shop-details.html">Black Lady Vanla Greek Grapes</a></h6>
                                <span class="product-status">IN Stock</span>
                                <div class="sp-cart-wrap">
                                    <form action="#">
                                        <div class="cart-plus-minus">
                                            <input type="text" value="1">
                                        </div>
                                    </form>
                                </div>
                                <p>$5.99 - 1 kg</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- best-sellers-area-end -->
    
    <!-- discount-area -->
    <section class="discount-style-two pt-60 breadcrumb-bg-testimonials">
        <div class="container">
            <div class="row">
                @include('layouts.testimonials')
            </div>
        </div>
    </section>    

    <!-- discount-area -->
    <section class="discount-style-two pt-60 pb-50">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-6">
                    <div class="discount-item-two">
                        <div class="discount-thumb">
                            <img src="img/product/s_discount_img01.jpg" alt="">
                        </div>
                        <div class="discount-content">
                            <span class="text-white">healthy food</span>
                            <h4 class="title text-white"><a href="{{route('special-offers')}}">Farm Fresh vegetables and fruits</a></h4>
                            <p class="text-white">Super Offer TO 50% OFF</p>
                            <a href="{{route('special-offers')}}" class="btn rounded-btn">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="discount-item-two">
                        <div class="discount-thumb">
                            <img src="img/product/s_discount_img02.jpg" alt="">
                        </div>
                        <div class="discount-content">
                            <span class="text-white">healthy food</span>
                            <h4 class="title text-white"><a href="{{route('special-offers')}}">All year Fruits UP TO 15%</a></h4>
                            <p class="text-white">Super Offer TO 50% OFF</p>
                            <a href="{{route('special-offers')}}" class="btn rounded-btn">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- discount-area-end -->

@endsection
