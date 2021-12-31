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
                                <li class="breadcrumb-item"><a href="{{route('checkout')}}">Checkout</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Order Success</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="checkout-progress-wrap">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="checkout-progress-step">
                        <ul>
                            <li class="active">
                                <div class="icon"><i class="fas fa-check"></i></div>
                                <span>Order Successful</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="checkout-form-wrap">

                	<div class="row">
                		<div class="col-md-12 text-center">
                			<h2>Your order has been received.</h2>
			                <p>Thank you for order with {{setting('app_name')}}</p>
			                <a href="{{ route('users.order',[$order->id]) }}" class="btn btn-primary rounded btn-sm">View Order Details</a>		
                		</div>
                	</div>
                	
                	<table class="table table-bordered mt-3">
                		<tr>
                			<td>Your Order Number</td>
                			<td>#{{$order->order_code}}</td>
                		</tr>
                		<tr>
                			<td>Your Order Date</td>
                			<td>{{ date('d M Y h:i:s A',strtotime($order->created_at))}}</td>
                		</tr>
                		<tr>
                			<td>Total</td>
                			<td>{{setting('default_currency')}}{{number_format($order->order_amount,'2','.','')}}</td>
                		</tr>
                	</table>


                </div>
            </div>
    </div>

@endsection