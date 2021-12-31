        <li class="sub-total">
            <span>Subtotal</span> 
            @if (Cart::isEmpty())
                {!!setting('default_currency')!!}0.0
            @else
                {!!setting('default_currency')!!}{{ number_format(Cart::getSubTotal(),'2','.','') }}
            @endif
        </li>

        @if(Cart::getConditionsByType('coupon')) 
           @foreach(Cart::getConditionsByType('coupon') as $coupon)         

                <li class="sub-total">
                    <span>
                        Discount {{$coupon->getAttributes()['discount']}}
                        <br><br>
                        <span class="uc-code">{{$coupon->getName()}}</span>
                        &nbsp;&nbsp;
                        <a onclick="removeCoupon();" class="text-danger"><i class="far fa-trash-alt"></i></a>

                    </span> 

                    @if (Cart::isEmpty())
                        {!!setting('default_currency')!!}0.0
                    @else
                        {!!setting('default_currency')!!}{{ number_format($coupon->parsedRawValue,'2','.','') }}
                    @endif
                </li>

            @endforeach
        @endif


        @if(Cart::getConditionsByType('redeem')) 
           @foreach(Cart::getConditionsByType('redeem') as $redeem)         
                
                <li class="sub-total">
                    <span>
                        {{$redeem->getName()}} {{$redeem->getAttributes()['redeem_points']}}
                        &nbsp;&nbsp;&nbsp;
                        <a onclick="removeRedeem();" class="text-danger"><i class="far fa-trash-alt"></i></a>
                    </span>
                    -{!!setting('default_currency')!!}{{number_format($redeem->parsedRawValue,'2','.','') }}
                </li>
            @endforeach
        @endif

        @if(Cart::getConditionsByType('delivery')) 
           @foreach(Cart::getConditionsByType('delivery') as $delivery)

                <li class="sub-total">
                    <span>
                        {{$delivery->getName()}}<br> ( Deliver in {{$delivery->getAttributes()['duration']}} )
                    </span>
                    {!!setting('default_currency')!!}{{ number_format($delivery->parsedRawValue,'2','.','') }}
                </li>

            @endforeach
        @endif
        
        @if(Cart::getConditionsByType('contribution')) 
           @foreach(Cart::getConditionsByType('contribution') as $contribution)         

                <li class="sub-total">
                    <span>
                        <img src="{{asset('img/images/charity-donation.jpg')}}" width="30" />
                        Charity Contribution 
                        &nbsp;&nbsp; 
                        <a onclick="removeContribution();" class="text-danger"><i class="far fa-trash-alt"></i></a>
                        <br>
                        <small>({!!setting('default_currency')!!}{!!setting('app_charity_contribution')!!} per item has been added)</small>
                    </span> 

                    @if (Cart::isEmpty())
                        {!!setting('default_currency')!!}0.0
                    @else
                        {!!setting('default_currency')!!}{{ number_format($contribution->parsedRawValue,'2','.','') }}
                    @endif
                </li>

            @endforeach
        @endif

        <li class="cart-total-amount"><span>Total Price</span> 
            @if (Cart::isEmpty())
                <span class="amount">
                    {!!setting('default_currency')!!}0.0
                </span>
            @else 
                <span class="amount">
                    {!!setting('default_currency')!!}{{ number_format(Cart::getTotal(),'2','.','') }}
                </span>
            @endif
        </li>