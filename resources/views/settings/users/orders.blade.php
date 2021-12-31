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
                                <li class="breadcrumb-item active" aria-current="page">Orders</li>
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

            @include('settings.users.profile_header')
            
            <div class="col-xl-12 col-md-12">
                
                @include('settings.users.profile_menu')

            </div>

            <div class="col-xl-10 col-md-10 offset-xl-1 profileDetails">
                
                <table class="table table-bordered text-center">
                  <thead>
                    <tr>
                      <th>ORDER ID</th>
                      <th>DATE</th>
                      <th>TOTAL</th>
                      <th>STATUS</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $order)
                      <tr>
                        <td>#{{$order->order_code}}</td>
                        <td>{{date('d M Y',strtotime($order->created_at))}}</td>
                        <td>{{setting('default_currency')}}{{number_format($order->order_amount,'2','.','')}}</td>
                        <td>{{$order->status}}</td>
                        <td>
                          <a href="{{ route('users.order',$order->id) }}" class="btn btn-primary btn-xs rounded">View</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

            </div>


        </div>
    </div>
    

	
@endsection