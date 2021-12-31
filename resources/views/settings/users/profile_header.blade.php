<div class="col-xl-10 offset-xl-1  mb-3">
    <div class="admin-content row">
    	<div class="col-md-1">
    		<img class="checkout-user" src="{{ asset('img/images/user.png') }}">
    	</div>
    	<div class="col-md-11 text-right">
    		<h4 class="name text-right">Hi, {{ Auth()->user()->name }}</h4>
        	<p class="desc text-right">Welcome to {{ setting('app_name') }}</p>	
    	</div>
    </div>
</div>