<main id="main" class="main-site">
		<div class="container">
			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">home</a></li>
					<li class="item-link"><span>Cart</span></li>
				</ul>
			</div>
			<div class="main-content-area">
				<div class="wrap-item-in-cart">
					@if (Session::has('success_msg'))
						<div class="aldet alert-success">
							<strong>{{Session::get('success_msg')}}</strong>
						</div>
					@endif
					@if ( Cart::instance('cart')->count() > 0 )
					<h3 class="box-title">Products Name</h3>
					<ul class="products-cart">
						@foreach (Cart::instance('cart')->content() as $item)
						<li class="pr-cart-item">
							<div class="product-image">
								<figure><img src="{{asset('assets/images/products/'. $item->model->image)}}" alt="{{$item->model->name}}"></figure>
							</div>
							<div class="product-name">
								<a class="link-to-product" href="{{route('product.details', $item->model->slug)}}">{{$item->model->name}}</a>
							</div>
							<div class="price-field produtc-price"><p class="price">${{$item->model->regular_price}}</p></div>
							<div class="quantity">
								<div class="quantity-input">
									<input type="text" name="product-quatity" value="{{$item->qty}}" data-max="120" pattern="[0-9]*" >
									<a class="btn btn-increase" href="#" wire:click.prevent="increseQuantity('{{$item->rowId}}')"></a>
									<a class="btn btn-reduce" href="#" wire:click.prevent="decreseQuantity('{{$item->rowId}}')"></a>
								</div>
                                <p class="text-center btn-secondary"><a class="btn fz-14" href="#" wire:click.prevent="switchProduct('{{$item->rowId}}','cart', 'saveforlater')">Save For Later</a></p>
							</div>
							<div class="price-field sub-total"><p class="price">${{$item->subtotal}}</p></div>
                            <div class="movetoWishlist delete">
                                <a href="#" wire:click.prevent="moveCartToWishlist('{{$item->rowId}}',{{$item->model->id}}, '{{$item->model->name}}', {{$item->price}}, 'cart', 'wishlist')" class="btn btn-secondary" title="{{$item->model->name}}">
                                    Move
								</a>
                            </div>
							<div class="delete">
								<a href="#" class="btn btn-delete" title="{{$item->model->name}}">
									<span>Delete from your cart</span>
									<i class="fa fa-times-circle" wire:click.prevent="removeToCart('{{$item->rowId}}', 'cart')"></i>
								</a>
							</div>
						</li>
						@endforeach

					</ul>
					@else
                    <div style="height:35em; background:url('{{asset('assets/images/empty-cart.png')}}') no-repeat center top; background-size:;" class="bg-cover bg-no-repeat wishlist_empty_wrap d-flex justify-content-center align-items-center">
                        <div class="mt-5 pt-5">
                            <h4 class="text-alert">Empty Cart</h4>
                        {{-- <a class="btn btn-primary fz-14 fw-bold" style="color:" href="{!! route('shop') !!}">Shopping  now</a> --}}
                        </div>
                    </div>
					@endif
				</div>

				<div class="summary">
					<div class="order-summary">
						<h4 class="title-box">Order Summary</h4>
						<p class="summary-info"><span class="title">Subtotal</span><b class="index">${{Cart::instance('cart')->subtotal()}}</b></p>
						<p class="summary-info"><span class="title">Tax</span><b class="index">${{Cart::instance('cart')->tax()}}</b></p>
						<p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>
						<p class="summary-info total-info "><span class="title">Total</span><b class="index">${{Cart::instance('cart')->total()}}</b></p>
					</div>
					<div class="checkout-info">
						<label class="checkbox-field">
							<input class="frm-input " name="have-code" id="have-code" value="" type="checkbox"><span>I have promo code</span>
						</label>
						<a class="btn btn-checkout" href="checkout.html">Check out</a>
						<a class="link-to-shop" href="shop.html">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
					</div>
					<div class="update-clear">
						<a class="btn btn-clear" href="#" wire:click.prevent="removeAllCart()">Clear Shopping Cart</a>
						<a class="btn btn-update" href="#">Update Shopping Cart</a>
					</div>

				</div>
                {{-- Save for latar --}}
                <div class="main-content-area save_for_later">
                    <h3 style="border-bottom:1px solid #000; padding-bottom:15px; margin-bottom:15px;">Save for Later</h3>
                    <div class="wrap-item-in-cart">
                        @if ( Cart::instance('saveforlater')->count() > 0 )
                        <h3 class="box-title">Products Name</h3>
                        <ul class="products-cart">
                            @foreach ( Cart::instance('saveforlater')->content() as $item )
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <figure><img src="{{asset('assets/images/products/'. $item->model->image)}}" alt="{{$item->model->name}}"></figure>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product" href="{{route('product.details', $item->model->slug)}}">{{$item->model->name}}</a>
                                </div>
                                <div class="price-field produtc-price"><p class="price">${{$item->model->regular_price}}</p></div>
                                <div class="quantity">
                                    {{-- <div class="quantity-input">
                                        <input type="text" name="product-quatity" value="{{$item->qty}}" data-max="120" pattern="[0-9]*" >
                                        <a class="btn btn-increase" href="#" wire:click.prevent="increseQuantity('{{$item->rowId}}')"></a>
                                        <a class="btn btn-reduce" href="#" wire:click.prevent="decreseQuantity('{{$item->rowId}}')"></a>
                                    </div> --}}
                                    <p class="text-center btn-secondary"><a class="btn fz-14" href="#" wire:click.prevent="switchProduct('{{$item->rowId}}', 'saveforlater', 'cart')">Switch In Cart</a></p>
                                </div>
                                <div class="price-field sub-total"><p class="price">${{$item->subtotal}}</p></div>
                                <div class="movetoWishlist delete">
                                    <a href="#" wire:click.prevent="moveCartToWishlist('{{$item->rowId}}',{{$item->model->id}}, '{{$item->model->name}}', {{$item->price}}, 'saveforlater', 'wishlist')" class="btn btn-secondary" title="{{$item->model->name}}">
                                        Move to wishlist
                                    </a>
                                </div>
                                <div class="delete">
                                    <a href="#" class="btn btn-delete" title="{{$item->model->name}}">
                                        <span>Delete from your cart</span>
                                        <i class="fa fa-times-circle" wire:click.prevent="removeToCart('{{$item->rowId}}', 'saveforlater')"></i>
                                    </a>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                        @else
                        <div style="height:35em; background:url('{{asset('assets/images/empty-cart.png')}}') no-repeat center top; background-size:;" class="bg-cover bg-no-repeat wishlist_empty_wrap d-flex justify-content-center align-items-center">
                            <div class="mt-5 pt-5">
                                <h4 class="text-alert">Empty Cart</h4>
                            {{-- <a class="btn btn-primary fz-14 fw-bold" style="color:" href="{!! route('shop') !!}">Shopping  now</a> --}}
                            </div>
                        </div>
                        @endif
                </div>
                    {{-- Save for Latar End --}}
				<div class="wrap-show-advance-info-box style-1 box-in-site">
					<h3 class="title-box">Most Viewed Products</h3>
					<div class="wrap-products">
						<div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_4.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item new-label">new</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><span class="product-price">$250.00</span></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_17.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item sale-label">sale</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_15.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item new-label">new</span>
										<span class="flash-item sale-label">sale</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_1.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item bestseller-label">Bestseller</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><span class="product-price">$250.00</span></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_21.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><span class="product-price">$250.00</span></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_03.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item sale-label">sale</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_04.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item new-label">new</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><span class="product-price">$250.00</span></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_05.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item bestseller-label">Bestseller</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><span class="product-price">$250.00</span></div>
								</div>
							</div>
						</div>
					</div><!--End wrap-products-->
				</div>

			</div><!--end main content area-->
		</div><!--end container-->
	</main>
