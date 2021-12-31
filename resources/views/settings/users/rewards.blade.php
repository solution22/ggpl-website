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
                                <li class="breadcrumb-item active" aria-current="page">Rewards</li>
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
                
                <div class="row">
                    <div class="col-lg-6">
                        <p>Share the link and Invite your Friends and get 1000 Ground Points Rewards!!</p>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" name="referral_link" id="referral_link" value="{{ url('/invite/'.Auth()->user()->affiliate_id) }}">
                    </div>
                    <div class="col-xl-2">
                        <button onclick="copyLink()" class="copy-button btn btn-primary btn-xs">Copy Link</button>    
                    </div>
                </div>

                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Reward type</th>
                                <th>Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($rewards)) 
                                @foreach($rewards as $reward)
                                    <tr>
                                        <td>{{date('d M Y',strtotime($reward->created_at))}}</td>
                                        <td>{{ucfirst($reward->point_type)}}</td>
                                        <td>{{$reward->points}}</td>
                                    </tr>
                                @endforeach
                            @else 
                            <tr>
                                <td colspan="3" class="text-center">No Rewards Found!!</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>    

            </div>


        </div>
    </div>
    

	
@endsection

@push('scripts_lib')

    <script>
       function copyLink() {
          /* Get the text field */
          var copyText = document.getElementById("referral_link");
          /* Select the text field */
          copyText.select();
          /* Copy the text inside the text field */
          document.execCommand("copy");
          copyText.blur(); 
          /* Alert the copied text */
          $('.copy-button').fadeOut();
          $('.copy-button').html('Copied!!');
          $('.copy-button').fadeIn();
      }     
    </script>

@endpush