@extends('layouts.app')

@section('content')
	
	<!-- map-area -->
    <div id="map-bg"> <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12576.317055016503!2d145.2178591!3d-37.9986116!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9117f6383a318c55!2sSolution22!5e0!3m2!1sen!2sin!4v1637652453331!5m2!1sen!2sin" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe> </div>
    <!-- map-area-end -->
    <style>
        .invalid-feedback {
            display:block !important;
        }
    </style>
    <!-- contact-area -->
    <section class="contact-area pt-50 pb-50">
        <div class="container">
            <div class="container-inner-wrap">
                <div class="row justify-content-center justify-content-lg-between">
                    <div class="col-lg-6 col-md-8 order-2 order-lg-0">
                        <div class="contact-title mb-25">
                            <h5 class="sub-title">Contact Us</h5>
                            <h2 class="title">Let's Talk Question<span>.</span></h2>
                        </div>
                        <div class="contact-wrap-content">
                            <!-- <p>Making for software espially of the relating espeially of the face costa when unknown galley of type and scrambled.</p> -->

                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif

                            {!! Form::open(['route' => 'contactForm', 'id' => 'contact-form' , 'class' => 'contact-form', 'method' => 'post']) !!}    

                                <div class="form-grp">
                                    <label for="name">Your Name <span>*</span></label>
                                    <input type="text" name="name" id="name" placeholder="Jon Deo...">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-grp">
                                    <label for="mobile_no">Your Mobile No <span>*</span></label>
                                    <input type="text" name="mobile_no" id="mobile_no" placeholder="+91 9876543210...">
                                    @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-grp">
                                    <label for="email">Your Email <span>*</span></label>
                                    <input type="text" name="email" id="email" placeholder="info.example@.com">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-grp">
                                    <label for="message">Your Message <span>*</span></label>
                                    <textarea name="message" id="message" placeholder="Opinion..."></textarea>
                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- <div class="form-grp checkbox-grp">
                                    <input type="checkbox" id="checkbox">
                                    <label for="checkbox">Don’t show your email address</label>
                                </div> -->
                                <button type="submit" class="btn rounded-btn">Send Now</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-8">
                        <div class="contact-info-wrap">
                            <div class="contact-img">
                                <img src="img/images/contact_img.png" alt="">
                            </div>
                            <div class="contact-info-list">
                                <ul>
                                    <li>
                                        <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                        <div class="content">
                                            <p>
                                            	{{setting('app_store_address_line_1')}}, {{setting('app_store_address_line_2')}},
                                                {{setting('app_store_city')}} - {{setting('app_store_pincode')}},
                                                {{setting('app_store_state')}}, {{setting('app_store_country')}}.
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="fas fa-phone-alt"></i></div>
                                        <div class="content">
                                            <p>{{setting('app_website_mobile')}}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="fas fa-envelope-open"></i></div>
                                        <div class="content">
                                            <p>{{setting('app_website_email')}}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="contact-social">
                                <ul>
                                    <li><a href="{{setting('app_facebook_url')}}"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="{{setting('app_twitter_url')}}"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="{{setting('app_instagram_url')}}"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="{{setting('app_linkedin_url')}}"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

	
@endsection