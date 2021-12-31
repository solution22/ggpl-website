@extends('layouts.app')

@section('content')

  <style>
    .input-item {
        padding: 10px 0px;
    }
  </style>
	
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
                                <li class="breadcrumb-item active" aria-current="page">Delivery Address</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->

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

                            <div class="col-md-12">
                              <div id="map"></div>
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

    <div class="container">
        <div class="row mt-30 mb-50">

            @include('settings.users.profile_header')
            
            <div class="col-xl-12 col-md-12">
                
                @include('settings.users.profile_menu')

            </div>

            <div class="col-xl-10 col-md-10 offset-xl-1 profileDetails">
                
                  @if(count($deliveryAddress) > 0)
                      @foreach($deliveryAddress as $address)
                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                              <div class="services-item">
                                  
                                  <div class="col-md-11" style="display: flex;">
                                  
                                  <div class="icon"><i class="fa fa-map-marker"></i></div>
                                  <div class="content">
                                      <h5>
                                          <div class="custom-control custom-checkbox">

                                              @php $status = ''; @endphp
                                              
                                              @if(Cart::getConditionsByType('delivery')) 
                                                 @foreach(Cart::getConditionsByType('delivery') as $delivery)
                                                      @if($address->id == $delivery->getAttributes()['id']) 
                                                          @php $status = 'checked="checked"'; @endphp
                                                      @else 
                                                          @php $status = ''; @endphp
                                                      @endif
                                                  @endforeach
                                              @endif

                                              <input type="radio" {{$status}} name="delivery_address" required="required" class="custom-control-input" data-lat="{{$address->latitude}}" data-lon="{{$address->longitude}}" value="{{$address->id}}" id="customCheck{{$address->id}}" onclick="deliveryAddressSet(this);">
                                              <label class="custom-control-label" for="customCheck{{$address->id}}"></label>

                                          </div>
                                          {{$address->description}}
                                      </h5>
                                      <p>
                                          {{ $address->address_line_1 }},
                                          {{ $address->address_line_2 }},
                                          {{ $address->city }},
                                          {{ $address->state }} - {{ $address->pincode }}
                                      </p>

                                  </div>

                                  </div>

                                  <!-- <button class="edit-address btn btn-xs btn-info" type="button" data-id="{{ $address->id }}">
                                    <i class="fas fa-edit"></i>
                                  </button>  

                                  &nbsp;&nbsp; -->

                                  {!! Form::open(['route' => ['deliveryAddresses.destroy', $address->id], 'method' => 'delete']) !!}
                                    {!! Form::button('<i class="fas fa-trash-alt"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs delete-address',
                                    'onclick' => "return confirm('Are you sure?')"
                                    ]) !!}
                                  {!! Form::close() !!}  

                              </div>
                          </div>
                      @endforeach
                  @endif

                  <button type="button" onclick="createAddress();" class="btn btn-primary mt-2 rounded btn-sm add-new-btn">
                      Add New Address
                  </button>

            </div>


        </div>
    </div>
    

	
@endsection