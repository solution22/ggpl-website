	<div class="row">
	    <div class="col-md-12">
	        <div style="margin: 20px 0px 0px 0px; background: #fff; border-radius: 5px;" id="card-element"></div>
	        <br>
	        <span class="payment-errors" id="card-errors" style="color: red; text-align: center;"></span>
	        <br>    
	    </div>
	</div>

	@push('scripts_lib')
	<script src="https://js.stripe.com/v3/"></script>
	<script>
	    
	    var style = {
	        base: {
	            color: '#32325d',
	            lineHeight: '18px',
	            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
	            fontSmoothing: 'antialiased',
	            fontSize: '16px',
	            '::placeholder': {
	                color: '#aab7c4'
	            }
	        },
	        invalid: {
	            color: '#fa755a',
	            iconColor: '#fa755a'
	        }
	    };

	    const stripe = Stripe("{{setting('stripe_key')}}", { locale: 'en' }); // Create a Stripe client.
	    const elements = stripe.elements(); // Create an instance of Elements.
	    const card = elements.create('card', { style: style }); // Create an instance of the card Element.

	    card.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

	    card.on('change', function(event) {
	        
	        var displayError = document.getElementById('card-errors');
	        //console.log(event);
	        /*if (event.brand === 'amex') {
	            $('.checkout-btn').prop("disabled", true);
	            displayError.textContent = 'American Express cards are not supported.';
	        } else {*/
	        if (event.error) {
	            displayError.textContent = event.error.message;
	        } else {
	            displayError.textContent = '';
	            $('.checkout-btn').prop("disabled", false);
	        }
	        /*}*/
	    });

	    // Handle form submission.
	    var form = document.getElementById('order-checkout');

	    var form = document.getElementById('order-checkout');
	    form.addEventListener('submit', function(event) {
	        event.preventDefault();

	        //if($('#order-checkout').valid()) { 
	        $('.checkout-btn').html('<i class="fas fa-spinner fa-spin"></i> Processing Payment Please Wait..');
	        $('.checkout-btn').prop("disabled", true); 
	        
	        var payment_type = $("input[name='payment_type']:checked").val();
	        
	        if(payment_type=='CARD') {
	            stripe.createToken(card).then(function(result) {
	                if (result.error) {
	                    // Inform the user if there was an error.
	                    var errorElement = document.getElementById('card-errors');
	                    errorElement.textContent = result.error.message;

	                    $('.checkout-btn').html('Place Order');
	                    $('.checkout-btn').prop("disabled", false);

	                } else {
	                    // Send the token to your server.
	                    stripeTokenHandler(result.token);
	                }
	            });
	        } else {
	        	stripeTokenHandler('CASH');
	        }
	        //}
	        
	    });

	    // Submit the form with the token ID.
	    function stripeTokenHandler(token) {
	        // Insert the token ID into the form so it gets submitted to the server
	        var form = document.getElementById('order-checkout');
	        var hiddenInput = document.createElement('input');
	        hiddenInput.setAttribute('type', 'hidden');
	        hiddenInput.setAttribute('name', 'stripeToken');
	        hiddenInput.setAttribute('value', token.id);
	        form.appendChild(hiddenInput);
	        // Submit the form
	        form.submit();
	    }

	</script>
	@endpush

