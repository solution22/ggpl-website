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
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                
                @include('flash::message')
                

                {!! Form::model(auth()->user(), ['route' => ['users.update', auth()->id()], 'class' => 'eflux-login-form', 'method' => 'patch']) !!}
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <div class="form-group mt-10">
                                {!! Form::label('name', "Name") !!}
                                {!! Form::text('name', Auth()->user()->name, ['class' => 'form-control','placeholder'=> "Your Name"]) !!}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mt-10">
                                {!! Form::label('email', "Email Address") !!}
                                {!! Form::text('email', Auth()->user()->email, ['class' => 'form-control','placeholder'=> "Email Address"]) !!}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mt-10">
                                {!! Form::label('date_of_birth', "Date of Birth") !!}
                                {!! Form::text('date_of_birth', date('d-m-Y',strtotime(Auth()->user()->date_of_birth)), ['placeholder'=> "Date of Birth", 'class' => 'datepicker form-control']) !!}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mt-10">
                                {!! Form::label('gender', "Gender") !!}
                                {!! Form::select('gender', [null => 'Please Select', 'male' => 'Male', 'female' => 'Female', 'others' => 'Others'], null, ['class' => 'select2 form-control']) !!}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mt-10">
                                {!! Form::label('address_line_1', "Address Line 1") !!}
                                {!! Form::text('address_line_1', Auth()->user()->address_line_1, ['class' => 'form-control','placeholder'=> "Address Line 1"]) !!}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mt-10">
                                {!! Form::label('address_line_2', "Address Line 2") !!}
                                {!! Form::text('address_line_2', Auth()->user()->address_line_2, ['class' => 'form-control','placeholder'=> "Address Line 2"]) !!}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mt-10">
                                {!! Form::label('city', "City") !!}
                                {!! Form::text('city', Auth()->user()->city, ['class' => 'form-control','placeholder'=> "City"]) !!}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mt-10">
                                {!! Form::label('state', "State") !!}
                                {!! Form::text('state', Auth()->user()->state, ['class' => 'form-control','placeholder'=> "State"]) !!}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mt-10">
                                {!! Form::label('pincode', "Pincode") !!}
                                {!! Form::text('pincode', Auth()->user()->pincode, ['class' => 'form-control','placeholder'=> "Pincode"]) !!}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mt-10">
                                {!! Form::label('mobile', "Mobile Number") !!}
                                {!! Form::text('mobile', Auth()->user()->mobile, ['class' => 'form-control','placeholder'=> "Mobile Number"]) !!}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mt-10">
                                {!! Form::label('password', "New Password") !!}
                                {!! Form::password('password', ['class' => 'form-control','placeholder'=> "New password"]) !!}
                            </div>
                        </div>

                    </div>

                    <div class="form-group mt-20">
                        <button type="submit" class="btn btn-primary rounded btn-sm">Save Changes</button>
                    </div>

                {!! Form::close() !!}

            </div>


        </div>
    </div>
    

	
@endsection