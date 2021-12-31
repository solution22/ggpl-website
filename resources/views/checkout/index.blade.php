@extends('layouts.app')

@section('content')
	

    <style>
    /**
    * Shows how you can use CSS to style your Element's container.
    * These classes are added to your Stripe Element by default.
    * You can override these classNames by using the options passed
    * to the `iban` element.
    * https://stripe.com/docs/js/elements_object/create_element?type=iban#elements_create-options-classes
    */

    input,
    .StripeElement {
      height: 40px;
      padding: 10px 12px;

      color: #32325d;
      background-color: white;
      border: 1px solid transparent;
      border-radius: 4px;

      box-shadow: 0 1px 3px 0 #e6ebf1;
      -webkit-transition: box-shadow 150ms ease;
      transition: box-shadow 150ms ease;
    }

    input:focus,
    .StripeElement--focus {
      box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
      border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
      background-color: #fefde5 !important;
    }
    div#au-bank-account-element {
        width: 100%;
    }
    .login-item {
        padding: 5px 25px !important;
    }

    @media only screen and (min-width: 767px) {
        .shopping-cart-row {
            position:fixed;
            width: 36%;
        }
    }
    .input-item {
        padding: 10px 0px;
    }

    </style>


    @if(auth()->user())

        <!-- menu modal -->
        <div class="modal fade address-edit-box" id="address-add" tabindex="100000" aria-labelledby="address-add" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body" style="padding: 2rem !important;">
                        <!-- <h4>Add Your Address</h4> -->
                        {!! Form::open(['route' => 'deliveryAddresses', 'id' => 'deliveryAddress' , 'class' => 'address-form', 'method' => 'post']) !!}
                            
                            {!! Form::hidden('latitude', null, ['class' => 'form-control latitude', 'id' => 'lat']) !!}
                            {!! Form::hidden('longitude', null, ['class' => 'form-control longitude', 'id' => 'lon']) !!}
                        
                            <div class="form-type"></div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-item">
                                        {!! Form::text('description', null, ['class' => 'form-control description','placeholder'=> 'Address type']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item">
                                        {!! Form::text('address_line_1', null,  ['class' => 'form-control address_line_1','id'=>'address_line_1','placeholder'=> 'Address Line 1']) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-item">
                                        {!! Form::text('address_line_2', null,  ['class' => 'form-control address_line_2','id'=>'address_line_2','placeholder'=> 'Address Line 2']) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-item">
                                        {!! Form::text('city', null,  ['class' => 'form-control city','id'=>'city','placeholder'=> 'City']) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-item">
                                        {!! Form::text('state', null,  ['class' => 'form-control state','id'=>'state','placeholder'=> 'State']) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-item">
                                        {!! Form::text('pincode', null,  ['class' => 'form-control pincode','id'=>'pincode','placeholder'=> 'Pincode']) !!}
                                    </div>
                                </div>

                            </div>

                            <hr>
                            
                            <div>
                                <button class="btn btn-sm btn-primary rounded">Save</button>
                                <button data-dismiss="modal" class="btn btn-sm btn-primary rounded">Cancel</button>
                            </div>
                            <input type="hidden" name="user_id" value="{{auth()->id()}}">
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    @endif


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
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!-- checkout-area -->
    <div class="checkout-area pt-90 pb-90">
        <div class="container">

            @if (!Cart::isEmpty())

                {!! Form::open(['route' => 'order-checkout', 'id' => 'order-checkout', 'method' => 'POST']) !!}

                    @include('checkout.fields')

                {!! Form::close() !!}

            @else
                    
                <div class="col-md-12 text-center">
                    <p>No Items Available</p>
                    <a href="{{route('products')}}" class="btn btn-primary rounded-btn">Return to Shop</a>    
                </div>

            @endif    

        </div>
    </div>
    <!-- checkout-area-end -->

@endsection



