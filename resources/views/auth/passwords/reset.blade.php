@extends('layouts.app')

@section('content')


<!-- contact-area -->
<section class="contact-area pt-70 pb-50">
    <div class="container">
        <div class="container-inner-wrap">
            <div class="row justify-content-center justify-content-lg-between">
                <div class="col-lg-6 col-md-8 order-2 order-lg-0">
                    <div class="contact-title mb-25">
                        <!--<h5 class="sub-title">{{ __('Login') }}</h5>-->
                        <h2 class="title">{{ __('Reset Password') }}</h2>
                    </div>
                    <div class="contact-wrap-content">
                         
                         @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif       
                        
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">
    
                            <div class="form-group">
                                <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" >
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" required autocomplete="password_confirmation" >
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group row mb-0 mt-20">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-primary login-btns rounded-btn">
                                        {{ __('Reset Password') }}
                                    </button>
                                    <br><br>
                                </div>
                            </div>
                            
                        </form>
                        
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 col-md-8">
                    <div class="contact-info-wrap" style="padding:38px 55px 1px;">
                        <div class="contact-img">
                            <!--<img style="width: 60%;" src="{{asset('img/images/signup-vector.png')}}" alt="">-->
                            <lottie-player src="{{url('img/images/76040-change-passwords.json')}}" background="transparent"  speed="3" loop autoplay></lottie-player>
                            <hr>
                            <p>Remember your password return to login</p>
                            
                            <a href="{{route('login')}}" class="btn btn-primary login-btns rounded-btn">{{ __('Login') }}</a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact-area-end -->

@endsection
