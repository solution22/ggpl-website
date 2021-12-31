        <div class="header-cart-wrap">
            
            <a href="{{route('cart')}}">
                <i class="flaticon-shopping-basket"></i>
            </a>
            <span class="item-count">
                @if (Cart::isEmpty())
                    0
                @else
                    {!! Cart::getTotalQuantity() !!}
                @endif
            </span>

            <ul class="minicart">
                 

                @if(Cart::getTotalQuantity() > 0)
                    @foreach(Cart::getContent() as $cartItem)

                        <li class="d-flex align-items-start">
                            <div class="cart-img">
                                <a href="">
                                    <img src="{{$cartItem->attributes->product_image}}" alt="">
                                </a>
                            </div>
                            <div class="cart-content">
                                <h4><a href="shop-details.html">{{$cartItem->name}}</a></h4>
                                <div class="cart-price">
                                    <span class="new">
                                        {{setting('default_currency').number_format($cartItem->price,'2','.','')}} X {{$cartItem->quantity}} {{$cartItem->attributes->unit}}
                                    </span><br>
                                    <span>
                                        {{setting('default_currency')}}{{number_format($cartItem->getPriceSum(),'2','.','')}}
                                    </span>
                                </div>
                            </div>
                            <div class="del-icon">
                                <a data-id="{{$cartItem->id}}" onclick="removeItem(this);"><i class="far fa-trash-alt"></i></a>
                            </div>
                        </li>

                    @endforeach
                @endif
                
                <li>
                    <div class="total-price">
                        <span class="f-left">Total:</span>
                        <span class="f-right">
                            @if (Cart::isEmpty())
                                {{setting('default_currency')}}0.00
                            @else
                                {{setting('default_currency')}}{!!number_format(Cart::getTotal(),'2','.','')!!}
                            @endif
                        </span>
                    </div>
                </li>
                
                <li>
                    <div class="checkout-link">
                            <a href="{{route('cart')}}">Shopping Cart</a>
                        @if(Cart::getTotalQuantity() > 0)
                            <a class="black-color" href="{{route('checkout')}}">Checkout</a>
                        @endif
                    </div>
                </li>

            </ul>
        </div>

        <div class="cart-amount">
            @if (Cart::isEmpty())
                {{setting('default_currency')}}0.00
            @else
                {{setting('default_currency')}}{!!number_format(Cart::getTotal(),'2','.','')!!}
            @endif
        </div>
