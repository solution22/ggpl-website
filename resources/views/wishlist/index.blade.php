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
                                <li class="breadcrumb-item"><a href="{{route('users.profile')}}">My Account</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Favorite</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->
	
	<!-- best-deal-area -->
    <section class="best-deal-area pt-60 pb-80">
        <div class="container">
            <div class="row ">

            	@if(count($favourites) > 0)
            		@foreach($favourites as $favourite)

		                <div class="col-xl-3 mb-20">
		                    <div class="best-deal-item">
		                    	
		                    	<a class="wish-link" data-id="{{$favourite->product->id}}"> 
		                    		<i class="fa fa-remove"></i> 
		                    	</a>

		                        <div class="best-deal-thumb">
		                            <a href="{{ route('showProduct',[$favourite->product->id,strtolower(str_replace(' ','_',$favourite->product->name))]) }}">
		                            	@if($favourite->product->hasMedia('image'))
                                            <img src="{{$favourite->product->getFirstMediaUrl('image')}}" alt="">
                                        @else
                                            <img src="{{asset('img/product/sp_products09.png')}}" alt="">
                                        @endif
		                            </a>
		                        </div>
		                        <div class="best-deal-content">
		                            <div class="main-content">
		                                <div class="rating">
		                                	@for($i=0; $i<$favourite->product->productReviewsSum(); $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
		                                </div>
		                                <h4 class="title">
		                                	<a href="{{ route('showProduct',[$favourite->product->id,strtolower(str_replace(' ','_',$favourite->product->name))]) }}">
		                                		{{$favourite->product->name}}
		                                	</a>
		                                </h4>
		                                <p>
		                                	@if($favourite->product->discount_price > 0 && $favourite->product->discount_price < $favourite->product->price)    
		                                        <del>
		                                            {!!setting('default_currency')!!}
		                                            <span class="pro-price">{{number_format($favourite->product->price,'2','.','')}}</span>
		                                        </del>
		                                        
		                                        &nbsp;&nbsp;
		                                        
		                                        {!!setting('default_currency')!!}
		                                        <span class="pro-dis-price">{{number_format($favourite->product->discount_price,'2','.','')}}</span>
		                                    @endif
		                                </p>
		                            </div>
		                            <div class="icon">

		                            	<a href="{{ route('showProduct',[$favourite->product->id,strtolower(str_replace(' ','_',$favourite->product->name))]) }}">+</a>

		                            		

		                            </div>
		                        </div>
		                    </div>
		                </div>


                	
                	@endforeach

                @else
                
                	<div class="col-md-12 text-center">
                        <p>No Items Available</p>
                        <a href="{{route('products')}}" class="btn btn-primary rounded-btn">Return to Shop</a>    
                    </div>	

                @endif
                	
            </div>
        </div>
    </section>
    <!-- best-deal-area-end -->

@endsection