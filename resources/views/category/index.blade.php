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
                                    <li class="breadcrumb-item"><a href="{{route('products')}}">Products</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$category_name}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb-area-end -->

        <!-- shop-area -->
        <section class="shop--area pt-90 pb-90">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-3 order-2 order-lg-0">
                        <aside class="shop-sidebar">
                            <div class="widget shop-widget">
                                <div class="shop-widget-title">
                                    <h6 class="title">Product Categories</h6>
                                </div>
                                <div class="shop-cat-list">
                                    <ul>

                                        @if(count(Config::get('app.categories')) > 0)
                                            @foreach(Config::get('app.categories') as $category)
                                                <li><a href="{{ route('showCategoryProduct',[$category->id,strtolower(str_replace(' ','_',$category->name))]) }}">{{$category->name}} <span>+</span></a></li>
                                            @endforeach
                                        @endif

                                    </ul>
                                </div>
                            </div>
                            <div class="widget shop-widget">
                                <div class="shop-widget-title">
                                    <h6 class="title">Filter By Price</h6>
                                </div>
                                <div class="price_filter">
                                    <div id="slider-range"></div>
                                    {!! Form::open(['method' => 'GET']) !!}
                                        <div class="price_slider_amount">
                                            <span>Price :</span>
                                            <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                            <button class="btn btn-primary btn-xs float-right">Filter</button>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <!-- <div class="widget shop-widget">
                                <div class="shop-widget-title">
                                    <h6 class="title">NEW PRODUCT</h6>
                                </div>
                                <div class="sidebar-product-list">
                                    <ul>
                                        <li>
                                            <div class="sidebar-product-thumb">
                                                <a href="shop-details.html"><img src="img/product/sidebar_product01.jpg" alt=""></a>
                                            </div>
                                            <div class="sidebar-product-content">
                                                <div class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <h5><a href="shop-details.html">Uncle Bens Vanla</a></h5>
                                                <span>$39.00</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-product-thumb">
                                                <a href="shop-details.html"><img src="img/product/sidebar_product02.jpg" alt=""></a>
                                            </div>
                                            <div class="sidebar-product-content">
                                                <div class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <h5><a href="shop-details.html">Dannon Max</a></h5>
                                                <span>$29.00</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-product-thumb">
                                                <a href="shop-details.html"><img src="img/product/sidebar_product03.jpg" alt=""></a>
                                            </div>
                                            <div class="sidebar-product-content">
                                                <div class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <h5><a href="shop-details.html">Vanla Greek Pice</a></h5>
                                                <span>$35.00</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                            <!-- <div class="widget shop-widget">
                                <div class="shop-widget-title">
                                    <h6 class="title">BRANDS</h6>
                                </div>
                                <div class="shop-cat-list">
                                    <ul>
                                        <li><a href="shop.html">Adara <span>+</span></a></li>
                                        <li><a href="shop.html">Carnation <span>+</span></a></li>
                                        <li><a href="shop.html">We Beyond <span>+</span></a></li>
                                        <li><a href="shop.html">Agrifram <span>+</span></a></li>
                                    </ul>
                                </div>
                            </div> -->
                            <!--<div class="widget">
                                <div class="shop-widget-banner text-center">
                                    <a href=""><img src="../../img/product/sidebar_shop_ad.jpg" alt=""></a>
                                </div>
                            </div>-->
                        </aside>
                    </div>

                    <div class="col-9">
                        <!-- <div class="shop-discount-area">
                            <div class="discount-content shop-discount-content">
                                <span>healthy food</span>
                                <h4 class="title"><a href="shop.html">organic farm for ganic</a></h4>
                                <p>Super Offer TO 50% OFF</p>
                                <a href="shop.html" class="btn rounded-btn">shop now</a>
                            </div>
                        </div> -->
                        <div class="shop-top-meta mb-30">
                            <div class="row">
                                <div class="col-md-6 col-sm-7">
                                    <div class="shop-top-left">
                                        <ul>
                                            <li><a href="#"><i class="fas fa-bars"></i> FILTER</a></li>
                                            <li>Showing {{$products->firstItem()}}–{{$products->lastItem()}} of {{$products->total()}} results</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-5">
                                    <div class="shop-top-right">
                                        <!--<form action="#">
                                            <select name="select">
                                                <option value="">Sort by newness</option>
                                                <option>Free Shipping</option>
                                                <option>Best Match</option>
                                                <option>Newest Item</option>
                                                <option>Size A - Z</option>
                                            </select>
                                        </form>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shop-products-wrap">
                            <div class="row justify-content-center">
                        
                            @if(count($products) > 0)
                                @foreach($products as $product)    

                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="sp-product-item">
                                        <div class="sp-product-thumb">
                                            
                                            @if($product->discount_price > 0)
                                                @php
                                                    $price = $product->price;
                                                    $discount = $product->discount_price;
                                                    $dis_percent = number_format((($price - $discount)*100) / $price,0);
                                                @endphp
                                                <span class="batch discount">{{$dis_percent}}%</span>
                                            @endif

                                            <a href="{{ route('showProduct',[$product->id,strtolower(str_replace(' ','_',$product->name))]) }}">
                                                @if($product->hasMedia('image'))
                                                    <img src="{{$product->getFirstMediaUrl('image')}}" alt="">
                                                @else
                                                    <img src="{{asset('img/product/sp_products09.png')}}" alt="">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="sp-product-content">
                                            <div class="rating">
                                                @for($i=0; $i<$product->productReviewsSum(); $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                            </div>
                                            <h6 class="title">
                                                <a href="{{ route('showProduct',[$product->id,strtolower(str_replace(' ','_',$product->name))]) }}">{{$product->name}}</a>
                                            </h6>
                                            <!-- <span class="product-status">IN Stock</span> -->

                                            {!! Form::open(['id' => 'addToCartForm'.$product->id, 'class' => 'addToCartForm']) !!}
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                <input type="hidden" name="type" value="1">
                                                
                                                <div class="sp-cart-wrap">
                                                    <div class="cart-plus-minus">
                                                        <input type="text" name="quantity" value="1">
                                                    </div>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <select class="unit-select" id="variation" name="variation">
                                                        <option value="{{$product->unit}}">{{$product->unit}}</option>
                                                        @if($product->alternative_unit > 0)
                                                            <option value="{{$product->secondary_unit}}">{{$product->secondary_unit}}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <p><b> 
                                                    @if($product->discount_price > 0 && $product->discount_price < $product->price)    
                                                        <del>
                                                            {!!setting('default_currency')!!}
                                                            <span class="pro-price">{{number_format($product->price,'2','.','')}}</span>
                                                        </del>
                                                        
                                                        &nbsp;&nbsp;
                                                        
                                                        {!!setting('default_currency')!!}
                                                        <span class="pro-dis-price">{{number_format($product->discount_price,'2','.','')}}</span>
                                                    @endif

                                                </b></p>        
                                                <button data-id="{{$product->id}}" type="button" class="cart-btn btn btn-primary btn-sm"> 
                                                    <i class="flaticon-shopping-basket"></i> Add to Cart
                                                </button>

                                            {!! Form::close() !!}



                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            @else    

                            	<p>No Products Found</p>

                            @endif



                            </div>
                        </div>
                        <div class="pagination-wrap">
                            {!!$products->links()!!} 
                            <!-- <ul>
                                <li class="prev"><a href="shop.html">Prev</a></li>
                                <li><a href="shop.html">1</a></li>
                                <li class="active"><a href="shop.html">2</a></li>
                                <li><a href="shop.html">3</a></li>
                                <li><a href="shop.html">4</a></li>
                                <li><a href="shop.html">...</a></li>
                                <li><a href="shop.html">10</a></li>
                                <li class="next"><a href="shop.html">Next</a></li>
                            </ul> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- shop-area-end -->

        @push('scripts_lib')

            <script>
                /*=============================================
                    =        Slider Range Active             =
                =============================================*/
                $("#slider-range").slider({
                    range: true,
                    min: {!!$min_price!!},
                    max: {!!$max_price!!},
                    @if(isset($_GET['price']))
                        @php
                            $datas = explode('-',$_GET['price']);
                        @endphp
                        values: [{!!$datas[0]!!}, {!!$datas[1]!!}],
                    @endif
                    slide: function (event, ui) {
                        $("#amount").val(ui.values[0] +'-'+ ui.values[1]);
                    }
                });
                $("#amount").val($("#slider-range").slider("values", 0) +'-'+ $("#slider-range").slider("values", 1));
            </script>

        @endpush


@endsection