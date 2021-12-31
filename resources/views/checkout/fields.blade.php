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
                                <span>Shipping</span>
                            </li>
                            <li>
                                <div class="icon">2</div>
                                <span>Order Successful</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="checkout-form-wrap">
                    
                        
                        <div class="checkout-form-top">
                            <h5 class="title">Account information</h5>
                            @if(!auth()->user())
                            	<p>Already have an account? <a href="{{route('login')}}">Log in</a></p>
                            @endif
                        </div>

                        @if(auth()->user())

                        	<div class="row">
                        		<div class="col-md-2">
                        			<img class="checkout-user" src="{{ asset('img/images/user.png') }}">
                        		</div>
                        		<div class="col-md-10">
                        			<p>
                        				<b>{{auth()->user()->name}}</b><br>
                        				<span>Email : {{auth()->user()->email}}</span>
                        			</p>
                        		</div>
                        	</div>


                        @else

                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="col-form-label text-md-right">{{ __('Email Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" >
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender" class="col-form-label text-md-right">{{ __('Gender') }}</label>
                                    <!-- <select id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}"  >
                                        <option selected="selected" disabled="disabled">Please Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Others</option>
                                    </select> -->

                                    {!! Form::select('gender', [null => 'Please Select Gender', 'male' => 'Male', 'female' => 'Female', 'others' => 'Others'], null, ['class' => 'select2 form-control']) !!}

                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob" class="col-form-label text-md-right">{{ __('Date of Birth') }}</label>
                                    <input id="date_of_birth" type="text" class="datepicker form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}"  autocomplete="date_of_birth" >
                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile_no" class="col-form-label text-md-right">{{ __('Mobile Number') }}</label>
                                    <input id="mobile_no" type="text" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}"  autocomplete="mobile_no" >
                                    @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"  autocomplete="password" >
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}"  autocomplete="password_confirmation" >
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> 

                        </div>

                        @endif


                        <div class="building-info-wrap">
                            
                        	<div class="checkout-form-top">
                                <h5 class="title">Delivery Address</h5>
                            </div>

                            @if(auth()->user())


                                @if(count($deliveryAddress) > 0)
                                    @foreach($deliveryAddress as $address)
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <div class="services-item">
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
                                        </div>
                                    @endforeach
                                @endif 

                                @if($errors->has('delivery_address'))
                                    <li>
                                        <span class="text-danger">{{ $errors->first('delivery_address') }}</span>
                                    </li>
                                @endif   
                                
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <button type="button" onclick="createAddress();" class="btn btn-primary mt-2 rounded btn-sm add-new-btn">
                                        Add New Address
                                    </button>
                                </div>

                            @else

                                <div class="row">

                                	<input type="hidden" name="lat" id="lat" value="{{ old('lat') }}" />
        							<input type="hidden" name="lon" id="lon" value="{{ old('lon') }}" />
                               		
                               		<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="col-form-label text-md-right">{{ __('Address type') }}</label>
                                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}"  autocomplete="description" >
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                               		<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address_line_1" class="col-form-label text-md-right">{{ __('Address Line 1') }}</label>
                                            <input id="address_line_1" type="text" class="form-control @error('address_line_1') is-invalid @enderror" name="address_line_1" value="{{ old('address_line_1') }}"  autocomplete="address_line_1" >
                                            @error('address_line_1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address_line_2" class="col-form-label text-md-right">{{ __('Address Line 2') }}</label>
                                            <input id="address_line_2" type="text" class="form-control @error('address_line_2') is-invalid @enderror" name="address_line_2" value="{{ old('address_line_2') }}"  autocomplete="address_line_2" >
                                            @error('address_line_2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city" class="col-form-label text-md-right">{{ __('City') }}</label>
                                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}"  autocomplete="city" >
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="state" class="col-form-label text-md-right">{{ __('State') }}</label>
                                            <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}"  autocomplete="state" >
                                            @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pincode" class="col-form-label text-md-right">{{ __('Pincode') }}</label>
                                            <input id="pincode" type="text" class="form-control @error('pincode') is-invalid @enderror" name="pincode" value="{{ old('pincode') }}"  autocomplete="pincode" >
                                            @error('pincode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                            @endif

                        </div>
                        
                        
                        <!-- <div class="news-and-offers custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="nao">
                            <label class="custom-control-label" for="nao">Keep me up to date on news and offers</label>
                        </div> -->


                    
                </div>
            </div>
            <div class="col-lg-5">
                <div class="shop-cart-total order-summary-wrap">
                    <h3 class="title">Order Summary</h3>
                    
                    @if(Cart::getTotalQuantity() > 0)
                		@foreach(Cart::getContent() as $cartItem)	

                            <div class="os-products-item">
                                <div class="thumb">
                                    <a href="{{ route('showProduct',[$cartItem->attributes->id,strtolower(str_replace(' ','_',$cartItem->name))]) }}"><img src="{{$cartItem->attributes->product_image}}" alt=""></a>
                                </div>
                                <div class="content">
                                    <h6 class="title">
                                    	<a href="{{ route('showProduct',[$cartItem->attributes->id,strtolower(str_replace(' ','_',$cartItem->name))]) }}">
                                    		{{$cartItem->name}}&nbsp;&nbsp;X&nbsp;&nbsp;{{$cartItem->quantity}} {{$cartItem->attributes->unit}}
                                    	</a>
                                    </h6>
                                    <span class="price">
                                    	{{setting('default_currency')}}{{number_format($cartItem->getPriceSum(),'2','.','')}} 
                                    </span>
                                </div>
                                <!--<a data-id="{{$cartItem->id}}" onclick="removeItem(this);"><i class="far fa-trash-alt"></i></a>-->
                            </div>

                    	@endforeach
                    @endif
                    



                    <div class="shop-cart-widget">
                            
                            <ul class="cartTotals">
                            	@include('layouts.checkout_total')
                            </ul>


                            <div class="payment-method-info">
                                
                                <?php /* ?>
                                <div class="paypal-method-flex">
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" name="payment_type" required="required" value="CASH" class="custom-control-input payment_type" id="customCheck5">
                                        <label class="custom-control-label" for="customCheck5">Cash on delivery</label>
                                        <p>Pay with cash upon delivery.</p>
                                    </div>
                                </div>
                                <?php /*/ ?>
                                
                                <div class="paypal-method-flex">
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" name="payment_type" required="required" value="CARD" class="custom-control-input payment_type" id="customCheckCARD">
                                        <label class="custom-control-label" for="customCheckCARD">Card Payment</label>
                                    </div>
                                    <div class="paypal-logo"><img src="img/images/card.png" alt=""></div>
                                </div>

                                
                                <div class="paymentGateway" style="display: none;">@include('layouts.stripe')</div>
                                

                                @error('payment_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="payment-terms">
                                <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="{{route('privacy-policy')}}">Privacy Policy</a></p>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" required="required" id="customCheckfor7" >
                                    <label class="custom-control-label" for="customCheckfor7">I agree to the website terms and conditions</label>
                                </div>
                            </div>

                            <button type="submit" class="btn checkout-btn">Place order</button>

                    </div>
                </div>
            </div>
        </div>