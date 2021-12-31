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
                <h4 class="text-center">Track your Order</h4>
                <lottie-player src="{{url('img/images/84633-tracking-order.json')}}" background="transparent"  speed="1" loop autoplay></lottie-player>
            </div>
            <div class="col-xl-4 offset-xl-4 col-md-4 offset-md-4">
                
                @if(session()->has('message'))
                    <div class="alert alert-danger mt-2">
                        {{ session()->get('message') }}
                    </div>
                @endif
                            
                {!! Form::open(['route' => 'users.orderTrack', 'method' => 'GET']) !!}
                
                    <div class="form-group">
                        <label>Order ID</label>
                        <input type="text" name="order_id" class="form-control" placeholder="Please enter your Order ID" required="required" />
                    </div>
                    
                    <div class="form-group text-center mt-30 mb-30">
                        <button type="submit" class="btn btn-primary rounded">Track Order</button>
                    </div>
                    
                {!! Form::close() !!}
            </div>
            
        </div>
    </div>
    
    
@endsection
