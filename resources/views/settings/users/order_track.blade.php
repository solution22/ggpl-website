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
                                <li class="breadcrumb-item active" aria-current="page">Order Tracking</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->
    
     <div class="container">
        <div class="row mt-30 mb-50">
            
            <div class="col-xl-4 offset-xl-4 col-md-4 offset-md-4">
                <h4 class="text-center">Tracking</h4>
                <lottie-player src="{{url('img/images/15345-onoff-your-location.json')}}" background="transparent"  speed="1" loop autoplay></lottie-player>
            </div>
            <div class="col-xl-8 offset-xl-2 col-md-4 offset-md-4">
                
                <div class="d-flex justify-content-between mb-20">
                        <span class="btn btn-xs btn-primary">{{$order->status}}</span>
                        <span class="date"><i class="far fa-clock"></i> {{date('d M Y',strtotime($order->created_at))}}</span>
                    </div>
                    
                    <table class="table table-bordered">
                        <tbody class="text-center">
                            <tr>
                              <th><b>Order ID</b></th>
                              <td><b>{{$order->order_code}}</b></td>
                              <th><b>Order Date</b></th>
                              <td><b>{{date('d M Y', strtotime($order->created_at))}}</b></td>
                              <th><b>Status</b></th>
                              <td>
                                <b>{{$order->status}}</b>
                              </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="order-info-extra mt--20">
                        <div class="row">

                            <div class="col-sm-12">
                                <table class="d table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Tax</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product_orders as $product_order)
                                        <tr>
                                            <td>{{$product_order->name}}</td>
                                            <td>{{ setting('default_currency').number_format($product_order->price,'2','.','') }}</td>
                                            <td>{{$product_order->quantity}} {{$product_order->unit}}</td>
                                            <td>
                                                {{ setting('default_currency').number_format($product_order->tax_amount,'2','.','') }} 
                                                ({{$product_order->tax_percent}}%)
                                            </td>
                                            <td>
                                                {{ setting('default_currency').number_format(($product_order->price * $product_order->quantity + $product_order->tax_amount),'2','.','') }}
                                            </td>
                                            <?php
                                                $total[] = $product_order->price * $product_order->quantity + $product_order->tax_amount;
                                            ?>
                                        </tr>
                                        @endforeach
                                        @if($order->redeem_amount > 0)
                                            <tr>
                                                <td colspan="4">Redeem Discount</td>
                                                <td>{{ setting('default_currency').number_format($order->redeem_amount,'2','.','') }}</td>
                                            </tr>
                                        @endif
                                        @if($order->coupon_amount > 0)
                                            <tr>
                                                <td colspan="4">Coupon Discount</td>
                                                <td>{{ setting('default_currency').number_format($order->coupon_amount,'2','.','') }}</td>
                                            </tr>
                                        @endif
                                        @if($order->delivery_fee > 0)
                                            <tr>
                                                <td colspan="4">Delivery Charge</td>
                                                <td>{{ setting('default_currency').number_format($order->delivery_fee,'2','.','') }}</td>
                                            </tr>
                                        @endif
                                        @if($order->contribution_amount > 0)
                                            <tr>
                                                <td colspan="4">Charity Contribution</td>
                                                <td>{{ setting('default_currency').number_format($order->contribution_amount,'2','.','') }}</td>
                                            </tr>
                                        @endif
                                            <tr>
                                                <td colspan="4">Total</td>
                                                <td>{{ setting('default_currency').number_format($order->order_amount,'2','.','') }}</td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-xl-6">
                                <h6>Order Status</h6>
                                <ul>
                                    @foreach($order_statuses as $order_status)
                                        <li style="font-size: 13px; background: linear-gradient(to right, #4eb92d, #4eb92d); margin: 12px; border-radius: 30px; width: 50%; padding: 5px; text-align: center;" class="@if($order->order_status_id==$order_status->id) text-white @else text-dark @endif">
                                            <b><i class="fas fa-check"></i> {{$order_status->status}}</b>
                                        </li>
                                        @if($order->order_status_id==$order_status->id) 
                                             <?php break ?>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-xl-6">
                                <h6>Delivery Address</h6>
                                <div class="destination-box">
                                    <ul>
                                        @if($order->address)
                                        <li>{{$order->address->address_line_1}}</li>
                                        <li>{{$order->address->address_line_2}}</li>
                                        <li>{{$order->address->city}}</li>
                                        <li>{{$order->address->state}} - {{$order->address->pincode}}.</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
            
        </div>
    </div>
    
    
@endsection
