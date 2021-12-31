@extends('layouts.app')

@section('content')
	
	<!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg-special">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Special Offers</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Special Offers</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

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
                            <img src="{{asset('img/images/coupon_code.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- coupon-area-end -->

@endsection