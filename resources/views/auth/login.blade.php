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
                        <h2 class="title">{{ __('Login') }}</h2>
                    </div>
                    <div class="contact-wrap-content">
                        
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group row mt-10">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if (Route::has('password.request'))
                                        <a class="float-right" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                                
                            </div>
                            <div class="form-group row mt-30 mb-0">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-primary login-btns rounded-btn">
                                        {{ __('Login') }}
                                    </button>
                                    <br><br>
                                </div>
                                <div class="col-md-12 mt-20">
                                    
                                    <style>
                                        .open-ids {
                                          width: auto;
                                          margin: 0 auto;
                                        }
                                        
                                        .auth-provider {
                                          font-family: system-ui,roboto,sans-serif;
                                          font-weight: 500;
                                          font-size: 16px;
                                          line-height: 40px;
                                          padding: 0 21px;
                                          border-radius: 20px;
                                          cursor: pointer;
                                          margin-bottom: 16px;
                                          box-sizing: border-box;
                                          border: 1px solid #d6d9dc;
                                          text-align: center;
                                          background: #FFF;
                                          color: #535a60
                                        }
                                        
                                        .google-login {
                                          color: #535a60;
                                          border-color: #d6d9dc
                                        }
                                        
                                        .facebook-login {
                                          color: #FFF;
                                          background-color: #395697;
                                          border-color: transparent
                                        }
                                        
                                        .kyber-login {
                                          color: #FFF;
                                          background-color: #54ae85;
                                          border-color: transparent
                                        }
                                        
                                        .telegram-login {
                                          margin-bottom: 12px;
                                        }
                                        
                                        .svg-icon {
                                          vertical-align: middle;
                                          padding-bottom: 4px;
                                        }
                                    </style>
                                    
                                    <div class="open-ids">
                                        
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <a href="{{ route('user.google.redirect') }}">
                                                    <div class="auth-provider google-login">
                                                      <svg aria-hidden="true" class="svg-icon" width="18" height="18" viewBox="0 0 18 18">
                                                         <g>
                                                            <path d="M16.51 8H8.98v3h4.3c-.18 1-.74 1.48-1.6 2.04v2.01h2.6a7.8 7.8 0 0 0 2.38-5.88c0-.57-.05-.66-.15-1.18z" fill="#4285F4"></path>
                                                            <path d="M8.98 17c2.16 0 3.97-.72 5.3-1.94l-2.6-2a4.8 4.8 0 0 1-7.18-2.54H1.83v2.07A8 8 0 0 0 8.98 17z" fill="#34A853"></path>
                                                            <path d="M4.5 10.52a4.8 4.8 0 0 1 0-3.04V5.41H1.83a8 8 0 0 0 0 7.18l2.67-2.07z" fill="#FBBC05"></path>
                                                            <path d="M8.98 4.18c1.17 0 2.23.4 3.06 1.2l2.3-2.3A8 8 0 0 0 1.83 5.4L4.5 7.49a4.77 4.77 0 0 1 4.48-3.3z" fill="#EA4335"></path>
                                                         </g>
                                                      </svg>
                                                      Login with Google
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-xl-6">
                                                <a href="{{ route('user.facebook.redirect') }}">
                                                    <div class="auth-provider facebook-login">
                                                      <svg aria-hidden="true" class="svg-icon" width="18" height="18" viewBox="0 0 18 18">
                                                         <path d="M1.88 1C1.4 1 1 1.4 1 1.88v14.24c0 .48.4.88.88.88h7.67v-6.2H7.46V8.4h2.09V6.61c0-2.07 1.26-3.2 3.1-3.2.88 0 1.64.07 1.87.1v2.16h-1.29c-1 0-1.19.48-1.19 1.18V8.4h2.39l-.31 2.42h-2.08V17h4.08c.48 0 .88-.4.88-.88V1.88c0-.48-.4-.88-.88-.88H1.88z" fill="#fff"></path>
                                                      </svg>
                                                      Login with Facebook
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </form>
                        
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 col-md-8">
                    <div class="contact-info-wrap" style="padding:38px 55px 1px;">
                        <div class="contact-img">
                            <!--<img style="width: 60%;" src="img/images/login-vector.png" alt="">-->
                            <lottie-player src="{{url('img/images/68312-login.json')}}" background="transparent"  speed="1" loop autoplay></lottie-player>
                            <hr>
                            <p>Sign up for a free account at our store. Registration is quick and easy. It allows you to be able to order from our shop. To start shopping click register.</p>
                            
                            <a href="{{route('register')}}" class="btn btn-primary login-btns rounded-btn">{{ __('Register') }}</a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact-area-end -->

@endsection
