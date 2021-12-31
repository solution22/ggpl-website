@extends('layouts.app')

@section('content')

    <!-- main-area -->
    <main>

        <!-- breadcrumb-area -->
        <div class="breadcrumb-area breadcrumb-bg-two">
            <div class="container custom-container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb-area-end -->

        <!-- cart-area -->
        <div class="cart-area pt-90 pb-90">
            <div class="container">
                <div class="row justify-content-center">

                @if (!Cart::isEmpty())    

                    <div class="col-xl-7">
                        <div class="cart-wrapper">
                            <div class="table-responsive">

                                {!! Form::open(['route' => 'cart-update','class' => 'cart-update', 'method' => 'POST']) !!}

                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail"></th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">QUANTITY</th>
                                            <th class="product-subtotal">SUBTOTAL</th>
                                            <th class="product-delete"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if(Cart::getTotalQuantity() > 0)
                                            @foreach(Cart::getContent() as $cartItem)
                                                <tr>
                                                    <td class="product-thumbnail">
                                                        <a href="{{ route('showProduct',[$cartItem->attributes->id,strtolower(str_replace(' ','_',$cartItem->name))]) }}">
                                                            <img src="{{$cartItem->attributes->product_image}}" alt="">
                                                        </a>
                                                    </td>
                                                    <td class="product-name">
                                                        <h4>
                                                            <a href="{{ route('showProduct',[$cartItem->attributes->id,strtolower(str_replace(' ','_',$cartItem->name))]) }}">
                                                                {{$cartItem->name}} - {{$cartItem->attributes->unit}}
                                                            </a>
                                                        </h4>
                                                    </td>
                                                    <td class="product-price">
                                                        {{setting('default_currency').number_format($cartItem->price,'2','.','')}}
                                                    </td>
                                                    <td class="product-quantity">
                                                        <div class="cart--plus--minus">
                                                            <div class="num-block">
                                                                <input type="hidden" name="product_id[]" value="{{$cartItem->id}}">
                                                                <input type="text" name="quantity[]" class="in-num" value="{{$cartItem->quantity}}" readonly="">
                                                                <div class="qtybutton-box">
                                                                    <span class="plus"><i class="fas fa-angle-up"></i></span>
                                                                    <span class="minus dis"><i class="fas fa-angle-down"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="product-subtotal">
                                                        <span>
                                                            {{setting('default_currency').number_format($cartItem->getPriceSum(),'2','.','')}}     
                                                        </span>
                                                    </td>
                                                    <td class="product-delete">
                                                        <a class="text-danger" onclick="removeCartItem('{!!$cartItem->id!!}')" >
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif    

                                        
                                    </tbody>
                                </table>

                                {!! Form::close() !!}

                            </div>
                        </div>
                        <div class="shop-cart-bottom">
                            <div class="cart-coupon">
                                {!! Form::open(['route' => 'apply-coupon','class' => 'apply-coupon', 'method' => 'POST']) !!}
                                    {!! Form::text('coupon_code', null,  ['class' => 'coupon_code', 'placeholder' =>'Enter Coupon Code...']) !!}
                                    <button class="btn apply-coupon-btn">Apply Coupon</button>
                                {!! Form::close() !!}
                            </div>
                            <div class="continue-shopping ">
                                <button class="update-cart-btn btn">update Cart</button>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-xl-12">
                                
                                @if(auth()->user())
                                <div class="reward-box mt-30">    
                                    <p>
                                        <b>Redeem Reward Points</b>
                                        <span class="float-right">Points worth : <span class="pwrth">{{setting('default_currency')}} <span class="points-worth">0.00</span></span></span>    
                                    </p>
                                    <div class="row">
                                        <div class="col-md-3 redeem-sec">
                                            <span>Total Reward Points</span>
                                            <br>
                                            <span class="total-redeem-points">{{ auth()->user()->points }}</span>
                                        </div>
                                        <div class="col-md-3 redeem-sec">
                                            <span>Points Worth</span>
                                            <br>
                                            <span class="total-redeem-points-worth"> {{setting('default_currency')}} <span class="total-redeem-worth">{{ number_format(auth()->user()->points / 100,2,'.','') }}</span></span>
                                        </div>
                                        <div class="col-md-5">
                                            
                                            <input type="number" class="form-control" class="redeem_points" id="redeem_points" name="redeem_points">
                                            <br>
                                            <!--<span>Points worth : <span class="pwrth">{{setting('default_currency')}} <span class="points-worth">0.00</span></span></span>
                                            <br>-->
                                            <button onclick="redeemPoints();" class="redeem-btn float-right" type="submit">REDEEM POINTS</button>
                                        </div>
                                    </div>
                                    
                                </div>
                                @endif
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-xl-5 col-lg-12">
                        <div class="shop-cart-total">
                            <h3 class="title">Cart Totals</h3>
                            <div class="shop-cart-widget">
                                <form action="#">
                                    <ul class="cartTotals">
                                        @include('layouts.checkout_total')
                                    </ul>
                                    <a href="{{route('checkout')}}" class="btn">PROCEED TO CHECKOUT</a>
                                </form>
                            </div>
                        </div>
                    </div>

                @else
                    
                    <div class="col-md-12 text-center">
                        <p>No Items Available</p>
                        <a href="{{route('products')}}" class="btn btn-primary rounded-btn">Return to Shop</a>    
                    </div>

                @endif    


                </div>
            </div>
        </div>
        <!-- cart-area-end -->

    </main>
    <!-- main-area-end -->

@endsection
