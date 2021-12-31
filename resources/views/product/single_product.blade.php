@extends('layouts.app')

@section('content')

	<!-- breadcrumb-area -->
    <div class="breadcrumb-area breadcrumb-bg-two">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('products')}}">Products</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!-- shop-details-area -->
    <section class="shop-details-area pt-70 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="shop-details-flex-wrap">
                        <div class="shop-details-nav-wrap">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                
                                
                                @if($product->hasMedia('image'))
                                    
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="item-one-tab" data-toggle="tab" href="#item-one" role="tab" aria-controls="item-one" aria-selected="true">
                                            <img src="{{$product->getFirstMediaUrl('image', 'thumb')}}" alt="">
                                        </a>
                                    </li>
                                
                                @endif
                                
                                <!--<li class="nav-item" role="presentation">
                                    <a class="nav-link" id="item-two-tab" data-toggle="tab" href="#item-two" role="tab" aria-controls="item-two" aria-selected="false"><img src="../../img/product/sd_nav_img02.jpg" alt=""></a>
                                </li>
                                
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="item-three-tab" data-toggle="tab" href="#item-three" role="tab" aria-controls="item-three" aria-selected="false"><img src="../../img/product/sd_nav_img03.jpg" alt=""></a>
                                </li>-->

                            </ul>
                        </div>
                        <div class="shop-details-img-wrap">
                            <div class="tab-content" id="myTabContent">
                                
                                @if($product->hasMedia('image'))
                                    
                                    <div class="tab-pane fade show active" id="item-one" role="tabpanel" aria-labelledby="item-one-tab">
                                        <div class="shop-details-img">
                                            <img src="{{$product->getFirstMediaUrl('image', '')}}" alt="">
                                        </div>
                                    </div>
                                
                                @endif
                                
                                <!--<div class="tab-pane fade show active" id="item-one" role="tabpanel" aria-labelledby="item-one-tab">
                                    <div class="shop-details-img">
                                        <img src="../../img/product/shop_details_img01.jpg" alt="">
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="item-two" role="tabpanel" aria-labelledby="item-two-tab">
                                    <div class="shop-details-img">
                                        <img src="../../img/product/shop_details_img02.jpg" alt="">
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="item-three" role="tabpanel" aria-labelledby="item-three-tab">
                                    <div class="shop-details-img">
                                        <img src="../../img/product/shop_details_img03.jpg" alt="">
                                    </div>
                                </div>-->

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shop-details-content">
                        
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        
                        <h4 class="title">{{$product->name}}</h4>
                        <div class="shop-details-meta">
                            <ul>
                                <li>Category : <a href="">{{$product->category}}</a></li>
                                <li class="shop-details-review">
                                    <div class="rating">
                                        @for($i=0; $i<$product->productReviewsSum(); $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                    </div>
                                    <span>Review</span>
                                </li>
                                <li>CODE : <span>{{$product->bar_code}}</span></li>
                            </ul>
                        </div>
                        <div class="shop-details-price">
                            <h2 class="price">
                            	@if($product->discount_price > 0 && $product->discount_price < $product->price)    
                                    <del>
                                        {!!setting('default_currency')!!}
                                        <span class="pro-price">{{number_format($product->price,'2','.','')}}</span>
                                    </del>
                                    
                                    &nbsp;&nbsp;
                                    
                                    {!!setting('default_currency')!!}
                                    <span class="pro-dis-price">{{number_format($product->discount_price,'2','.','')}}</span>
                                @endif
                            </h2>
                            <!-- <h5 class="stock-status">- IN Stock</h5> -->
                        </div>
                        {!!$product->description!!}
                        <div class="shop-details-list">
                            <ul>
                                <li>UNITS : <span>{{$product->unit}}, {{$product->secondary_unit}}</span></li>
                                <!-- <li>XPD : <span>Aug 19.2021</span></li>
                                <li>CO : <span>Ganic</span></li> -->
                            </ul>
                        </div>
                        
                        {!! Form::open(['id' => 'addToCartForm'.$product->id, 'class' => 'addToCartForm']) !!}
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="type" value="1">
                            <div class="shop-perched-info">
                                <div class="sd-cart-wrap">
                                    <div class="cart-plus-minus">
                                        <input type="text" name="quantity" value="1">
                                    </div>
                                    &nbsp;&nbsp;&nbsp;
                                    <select class="single-unit-select" id="variation" name="variation">
                                        <option value="{{$product->unit}}">{{$product->unit}}</option>
                                        @if($product->alternative_unit > 0)
                                            <option value="{{$product->secondary_unit}}">{{$product->secondary_unit}}</option>
                                        @endif
                                    </select>
                                </div>
                                <button data-id="{{$product->id}}" type="button" class="cart-btn btn btn-primary btn-sm">add to cart</button>
                            </div>
                        {!! Form::close() !!}

                        <div class="shop-details-bottom">
                            <h5 class="title">
                                <a class="wish-link @if($product->favorite) text-danger @endif " data-id="{{$product->id}}" >
                                    <i class="fa fa-heart"></i> 
                                    @if($product->favorite) 
                                        Added To Wishlist
                                    @else
                                        Add To Wishlist
                                    @endif
                                </a>
                            </h5>
                            <ul>
                                <!-- <li>
                                    <span>Tag : </span>
                                    <a href="#">ICE Cream</a>
                                </li>
                                <li>
                                    <span>CATEGORIES :</span>
                                    <a href="#">women's,</a>
                                    <a href="#">bikini,</a>
                                    <a href="#">tops for,</a>
                                    <a href="#">large bust</a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-desc-wrap">
                        <ul class="nav nav-tabs" id="myTabTwo" role="tablist">
                            
                            <li class="nav-item">
                                <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab"
                                    aria-controls="details" aria-selected="true">Product Details</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                                    aria-controls="review" aria-selected="false">Product Reviews</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContentTwo">
                            
                            <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                                <div class="product-desc-content">
                                    <h4 class="title">Product Details</h4>
                                    <div class="row">
                                        <div class="col-xl-3 col-md-5">
                                            <div class="product-desc-img">
                                                @if($product->hasMedia('image'))
                                                    <img src="{{$product->getFirstMediaUrl('image')}}" alt="">
                                                @else
                                                    <img src="{{asset('img/product/sp_products09.png')}}" alt="">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-9 col-md-7">
                                            {!!$product->description!!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                <div class="product-desc-content">
                                    
                                    <div class="row">
                                        <div class="col-xl-8 offset-xl-2 col-md-12">

                                        @if(count($product_review) > 0)    
                                            @foreach($product_review as $review)
                                            <div class="avatar-post mt-1 mb-1">
                                                <div class="post-avatar-img">
                                                    <img src="../../img/blog/post_avatar_img.png" alt="img">
                                                </div>
                                                <div class="post-avatar-content">
                                                    <h5 style="display:inline-flex;">
                                                        {{$review->name}} &nbsp;&nbsp;&nbsp;
                                                        <div class="rating" style="color:#f89846;">
                                                            @for($i=0; $i<$review->rate; $i++)
                                                                <i class="fas fa-star"></i>
                                                            @endfor
                                                        </div>
                                                    </h5>
                                                    <p>{{$review->review}}</p>
                                                    <small><i class="fa fa-calendar"></i> {{date('d M Y',strtotime($review->created_at))}}</small>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif    

                                        	<div class="comment-reply-box">
			                                    <h5 class="title">LEAVE A REPLY</h5>
			                                    {!! Form::open(['route' => 'products.addreview', 'class' => 'comment-reply-form']) !!}

                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
			                                        <div class="row">
			                                            <div class="col-md-12">
			                                                <div class="form-grp float-left">
			                                                    <label>Rating</label>
                                                                <fieldset class="rating">
                                                                    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                                    <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                                    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                                    <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                                    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                                                    <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                                    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                                    <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                                    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                                                    <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                </fieldset>

			                                                </div>
			                                            </div>
			                                        </div>
			                                        <div class="form-grp">
			                                         <textarea name="review" id="review" required="required" placeholder="Write you review..."></textarea>
			                                        </div>
			                                        <button type="submit" class="btn rounded-btn">Submit now</button>
			                                    {!! Form::close() !!}
			                                </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- shop-details-area-end -->

    <!-- coupon-area -->
    <!-- <div class="coupon-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="coupon-bg">
                        <div class="coupon-title">
                            <span>Use coupon Code</span>
                            <h3 class="title">Get $3 Discount Code</h3>
                        </div>
                        <div class="coupon-code-wrap">
                            <h5 class="code">ganic21abs</h5>
                            <img src="img/images/coupon_code.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- coupon-area-end -->

    <!-- best-sellers-area -->
    <section class="best-deal-area pt-60 pb-80">
        <div class="container">
            <div class="row align-items-end mb-40">
                <div class="col-md-12 col-sm-12">
                    <div class="section-title">
                        <span class="sub-title text-center">Related Products</span>
                        <h2 class="title text-center">From this Collection</h2>
                    </div>
                </div>
                <!--<div class="col-md-4 col-sm-3">
                    <div class="section-btn text-left text-md-right">
                        <a href="{{route('products')}}" class="btn">View All</a>
                    </div>
                </div>-->
            </div>
            <div class="text-right mb-3">
                <a class="pp3"><i class="fa fa-arrow-left"></i></a>
                <a class="nn3"><i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="row best-deal-active">
                
                @if(count($related) > 0)
                    @foreach($related as $product) 
                
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
    <!-- best-sellers-area-end -->

@endsection