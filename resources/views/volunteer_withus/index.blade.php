@extends('layouts.app')

@section('content')

	<style>
		.form-control {
			margin-bottom: 15px;
		}
	</style>

	<!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg-volunteer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Volunteer with us</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Volunteer with us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->
	
    <!-- slider-area -->
            <!-- <section class="slider-area" data-background="img/bg/slider_area_bg.jpg">
                <div class="container custom-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="slider-active">
                                <div class="single-slider slider-bg" data-background="img/slider/slider_bg01.jpg">
                                    <div class="slider-content">
                                        <h5 class="sub-title" data-animation="fadeInUp" data-delay=".2s">top deal !</h5>
                                        <h2 class="title" data-animation="fadeInUp" data-delay=".4s">organic food</h2>
                                        <p data-animation="fadeInUp" data-delay=".6s">Get up to 50% OFF Today Only</p>
                                        <a href="shop.html" class="btn rounded-btn" data-animation="fadeInUp" data-delay=".8s">Shop Now</a>
                                    </div>
                                </div>
                                <div class="single-slider slider-bg" data-background="img/slider/slider_bg01.jpg">
                                    <div class="slider-content">
                                        <h5 class="sub-title" data-animation="fadeInUp" data-delay=".2s">Real simple !</h5>
                                        <h2 class="title" data-animation="fadeInUp" data-delay=".4s">Time Grocery</h2>
                                        <p data-animation="fadeInUp" data-delay=".6s">Get up to 50% OFF Today Only</p>
                                        <a href="shop.html" class="btn rounded-btn" data-animation="fadeInUp" data-delay=".8s">Shop Now</a>
                                    </div>
                                </div>
                                <div class="single-slider slider-bg" data-background="img/slider/slider_bg01.jpg">
                                    <div class="slider-content">
                                        <h5 class="sub-title" data-animation="fadeInUp" data-delay=".2s">top deal !</h5>
                                        <h2 class="title" data-animation="fadeInUp" data-delay=".4s">organic food</h2>
                                        <p data-animation="fadeInUp" data-delay=".6s">Get up to 50% OFF Today Only</p>
                                        <a href="shop.html" class="btn rounded-btn" data-animation="fadeInUp" data-delay=".8s">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section> -->
            <!-- slider-area-end -->

	<!-- terms-and-conditions-area -->
    <section class="terms-and-conditions-area pt-30 pb-50">
        <div class="container">
            <div class="row justify-content-center">

            	<!--<div class="col-10 mb-30">
                    <div class="slider-active">
                        
                        <div class="single-slider slider-bg" data-background="img/volunteer/slider__bg01.jpg">
                            <div class="slider-content">
                                <h5 class="sub-title" data-animation="fadeInUp" data-delay=".2s">
                                	TOGETHER <i class="fa fa-star"></i> WE CAN
                                </h5>
                                <h2 class="title" data-animation="fadeInUp" data-delay=".4s">VOLUNTEER</h2>
                            </div>
                        </div>

                    </div>
                </div>-->

                <div class="col-xl-10">
                    
                    <div class="row">
                    	<div class="col-xl-7">
                    		<div class="terms-and-conditions-wrap">
		                        <h5>Volunteer with us</h5>
		                        <p>There are many variations of passages of lorem ipsum available, but the majority have suffered alteration in some form,
		                        by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of
		                        lorem ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the lorem ipsum
		                        generators on the internet tend to repeat predefined chunks as necessary, making this the first true generator on the
		                        internet. It uses a dictionary of over 200 latin words, combined with a handful of model sentence structures, to
		                        generate lorem ipsum which looks reasonable.</p>
		                        <p>The generated lorem ipsum is therefore always free from repetition,
		                        injected humour, or non-characteristic words etc. It is a long established fact that a reader will be distracted by the
		                        readable content of a page when looking at its layout. The point of using lorem ipsum is that it has a more-or-less
		                        normal distribution of letters, as opposed to using 'Content here.The point of using lorem ipsum is that it has a more-or-less
		                        normal distribution of letters, as opposed to using 'Content here. The point of using lorem ipsum is that it has a more-or-less
		                        normal distribution of letters, as opposed to using 'Content here.</p>
		                    </div>
                    	</div>

                    	<div class="col-xl-5">
                    		
                    		@if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                    		
                    		{!! Form::open(['route' => 'volunteer-form', 'id' => 'volunteer-form', 'class' => 'mt-4 eflux-login-form', 'method' => 'POST']) !!}

                    			<div class="form-group">
						            <input type="text" name="name" value="{{ old('name') }}" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="{{ __('Name') }}" placeholder="name"/>
						            @if ($errors->has('name'))
						                    <span class="text-danger">{{ $errors->first('name') }}</span>
						                @endif
						        </div>

						        <div class="row">
						          <div class="col-md-6">
						        
						              <div class="form-group">
						                  {!! Form::select('gender', [null => 'Please Select Gender', 'male' => 'Male', 'female' => 'Female', 'others' => 'Others'], null, ['class' => 'select2 form-control']) !!}
						                  @if ($errors->has('gender'))
						                      <span class="text-danger">{{ $errors->first('gender') }}</span>
						                  @endif
						              </div>  

						          </div>
						          <div class="col-md-6">
						              <div class="form-group">
						                  <input type="text" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control datepicker  {{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" placeholder="Date of Birth"/>
						                  @if ($errors->has('date_of_birth'))
						                      <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
						                  @endif
						              </div>
						          </div>
						        </div>

						        <div class="row">

						          <div class="col-md-6">
						            <div class="form-group">
						                <input type="email" name="email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email Address"/>
						                @if ($errors->has('email'))
						                    <span class="text-danger">{{ $errors->first('email') }}</span>
						                @endif
						            </div>
						          </div>

						          <div class="col-md-6">
						            <div class="form-group">
						                <input type="mobile_no" name="mobile_no" value="{{ old('mobile_no') }}" class="form-control {{ $errors->has('mobile_no') ? ' is-invalid' : '' }}" name="mobile_no" placeholder="Mobile number"/>
						                @if ($errors->has('mobile_no'))
						                    <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
						                @endif
						            </div>
						          </div>
						          
						        </div>

						        <div class="form-group">
							        <input type="text" name="address_line_1" id="address_line_1" value="{{ old('address_line_1') }}" class="form-control  {{ $errors->has('address_line_1') ? ' is-invalid' : '' }}" placeholder="Address Line 1"/>
							        @if ($errors->has('address_line_1'))
							            <span class="text-danger">{{ $errors->first('address_line_1') }}</span>
							        @endif
							    </div>

							    <div class="form-group">
							        <input type="text" name="address_line_2" id="address_line_2" value="{{ old('address_line_2') }}" class="form-control  {{ $errors->has('address_line_2') ? ' is-invalid' : '' }}" placeholder="Address Line 2"/>
							        @if ($errors->has('address_line_2'))
							            <span class="text-danger">{{ $errors->first('address_line_2') }}</span>
							        @endif
							    </div>

							    <div class="form-group">
							        <input type="text" name="city" id="city" value="{{ old('city') }}" class="form-control  {{ $errors->has('city') ? ' is-invalid' : '' }}" placeholder="City"/>
							        @if ($errors->has('city'))
							            <span class="text-danger">{{ $errors->first('city') }}</span>
							        @endif
							    </div>

							    <div class="form-group">
							        <input type="text" name="state" id="state" value="{{ old('state') }}" class="form-control  {{ $errors->has('state') ? ' is-invalid' : '' }}" placeholder="State"/>
							        @if ($errors->has('state'))
							            <span class="text-danger">{{ $errors->first('state') }}</span>
							        @endif
							    </div>

							    <div class="form-group">
							        <input type="text" name="pincode" id="pincode" value="{{ old('pincode') }}" class="form-control  {{ $errors->has('pincode') ? ' is-invalid' : '' }}" placeholder="Pincode"/>
							        @if ($errors->has('pincode'))
							            <span class="text-danger">{{ $errors->first('pincode') }}</span>
							        @endif
							    </div> 

							    <div class="form-group mt-10">
							    	<button type="submit" style="width: 100%;" class="btn btn-primary rounded btn-xs">Join</button>
							    </div>

                    		{!! Form::close() !!}

                    	</div>
                    </div>
                    

                    <div class="terms-and-conditions-wrap">
                        <h5>Where does it come from?</h5>
                        <p>There are many variations of passages of lorem ipsum available, but the majority have suffered alteration in some form,
                        by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of
                        lorem ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the lorem ipsum
                        generators on the internet tend to repeat predefined chunks as necessary, making this the first true generator on the
                        internet. It uses a dictionary of over 200 latin words, combined with a handful of model sentence structures, to
                        generate lorem ipsum which looks reasonable</p>
                        <p>The generated lorem ipsum is therefore always free from repetition,
                        injected humour, or non-characteristic words etc. It is a long established fact that a reader will be distracted by the
                        readable content of a page when looking at its layout. The point of using lorem ipsum is that it has a more-or-less
                        normal distribution of letters, as opposed to using
                        'Content here.</p>
                    </div>
                    <div class="terms-and-conditions-wrap">
                        <h5>Why do we use it?</h5>
                        <p>There are many variations of passages of lorem ipsum available, but the majority have suffered alteration in some form,
                        by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of
                        lorem ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the lorem ipsum
                        generators on the internet tend to repeat predefined chunks as necessary, making this the first true generator on the
                        internet. It uses a dictionary of over 200 latin words, combined with a handful of model sentence structures, to
                        generate lorem ipsum which looks reasonable.</p>
                        <ul>
                            <li>Passages of lorem ipsum available, but the majority have suffered alteration in some form the majority have suffered
                            alteration in some form by injected</li>
                            <li>But the majority have suffered alteration in some form by injected of lorem ipsum available, but the majority have
                            suffered alteration in some form</li>
                            <li>You need to be sure there isn't anything embarrassing hidden in the middle of text. All the lorem ipsum generators on the internet tend to repeat predefined chunks as necessary majority have suffered alteration in some form by injected of lorem ipsum available.</li>
                            <li>Duis repeat predefined chunks as necessary majority have suffered aute irure dolor in reprehenderit in voluptate velit
                            esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- terms-and-conditions-area-end -->

@endsection