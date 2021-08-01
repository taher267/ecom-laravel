@section('title', 'Home')
<main id="main">
		<div class="container">

			<!--MAIN SLIDE-->
			<div class="wrap-main-slide">
				<div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
					@foreach ($slider as $slide)
                    <div class="item-slide">
						<img src="{{asset('assets/images/home-slider/'. $slide->image)}}" alt="" class="img-slide">
						<div class="slide-info slide-1">
							<h2 class="f-title">{{$slide->title}}</h2>
							@if($slide->subtitle) <span class="subtitle">{{$slide->subtitle}}</span> @endif
							@if($slide->price)<p class="sale-info">Only price: <span class="price">${{$slide->price}}</span></p> @endif
							@if($slide->link)<a href="{{$slide->link}}" class="btn-link">Shop Now</a> @endif
						</div>
					</div>
                    @endforeach
				</div>
			</div>

			<!--BANNER-->
			<div class="wrap-banner style-twin-default">
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="assets/images/home-1-banner-1.jpg" alt="" width="580" height="190"></figure>
					</a>
				</div>
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="assets/images/home-1-banner-2.jpg" alt="" width="580" height="190"></figure>
					</a>
				</div>
			</div>

			<!--On Sale-->
            @if ($s_products->count()>0 && $onsale->status ==1 && $onsale->sale_date > Carbon\Carbon::now())
			<div class="wrap-show-advance-info-box style-1 has-countdown">
				<h3 class="title-box">On Sale</h3>
				<div class="wrap-countdown mercado-countdown" data-expire="{{Carbon\Carbon::parse($onsale->sale_date)->setTimezone('Asia/dhaka')->format('Y/m/d h:i:s')}}"></div>
				<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"{{$s_products->count()>=2? 2:$s_products->count()}}"},"768":{"items":"{{$s_products->count()>=3? 2:$s_products->count()}}"},"992":{"items":"{{$s_products->count()>=4? 4 : $s_products->count()}}"},"1200":{"items":"{{$s_products->count()>=5? 5:$s_products->count()}}"}}'>
                    @foreach ($s_products as $key => $sproduct)
                    <div class="product product-style-2 equal-elem ">
						<div class="product-thumnail" >
							<a href="{{route('product.details', $sproduct->slug)}}" title="{{$sproduct->name}}">
								<figure><img src="{{asset('assets/images/products/'.$sproduct->image)}}" width="800" height="800" alt="{{$sproduct->name}}"></figure>
							</a>
							<div class="group-flash">
								<span class="flash-item sale-label">sale</span>
							</div>
							<div class="wrap-btn">
								<a href="{{route('product.details', $sproduct->slug)}}" class="function-link">quick view</a>
								@if (! empty(Auth::user()) && Auth::user()->utype==='ADM')<a href="{{route('admin.editproduct', $sproduct->slug)}}" class="function-link mx-1">quick Edit</a>

                                @endif
							</div>
						</div>
						<div class="product-info">
							<a href="{{route('product.details', $sproduct->slug)}}" class="product-name"><span>{{$sproduct->name}}</span></a>
							<div class="wrap-price"><ins><p class="product-price">${{$sproduct->sale_price}}</p></ins> <del><p class="product-price">${{$sproduct->regular_price}}</p></del></div>
						</div>
					</div>
                    @endforeach
				</div>
			</div>
            @endif
			<!--Latest Products-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Latest Products</h3>
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure><img src="assets/images/digital-electronic-banner.jpg" width="1170" height="240" alt=""></figure>
					</a>
				</div>
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">
						<div class="tab-contents">
							<div class="tab-content-item active" id="digital_1a">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                                    @foreach ($latest_product as $l_product)
                                        <div class="product product-style-2 equal-elem ">
                                            <div class="product-thumnail">
                                                <a href="{{route('product.details', $l_product->slug)}}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                                    <figure><img src="{{asset('assets/images/products/'. $l_product->image)}}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                                </a>
                                                <div class="group-flash">
                                                    <span class="flash-item new-label">new</span>
                                                </div>
                                                <div class="wrap-btn">
                                                    <a href="{{route('product.details', $l_product->slug)}}" class="function-link">quick view</a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <a href="{{route('product.details', $l_product->slug)}}" class="product-name"><span>{{$l_product->name}}</span></a>
                                                <div class="wrap-price"><span class="product-price">${{$l_product->regular_price}}</span></div>
                                            </div>
                                        </div>
                                    @endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--Product Categories-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Product Categories</h3>
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure><img src="assets/images/fashion-accesories-banner.jpg" width="1170" height="240" alt=""></figure>
					</a>
				</div>

				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">
						<div class="tab-control">
                            @foreach ($categories->sortBy('name') as $key=> $category)
                            <a href="#category_{{$category->id}}" class="tab-control-item {{$categories->sortBy('name')->first()->name == $category->name? 'active':''}}{{--$key==0? 'active': ''--}}">{{$category->name}}</a>
                            @endforeach
						<div class="tab-contents">
                            @foreach ($categories->sortBy('name') as $key=> $category)
							<div class="tab-content-item {{$categories->sortBy('name')->first()->name == $category->name? 'active':''}}"   id="category_{{$category->id}}">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                                    @foreach ($c_products->where('category_id', $category->id)->take(8)->sortBy("category->name") as $cProduct)
                                        <div class="product product-style-2 equal-elem ">
                                            <div class="product-thumnail">
                                                <a href="{{route('product.details', $cProduct->slug)}}" title="{{$cProduct->name}}?Cat={{$cProduct->category->id}}">
                                                    <figure><img src="{{asset('assets/images/products/'. $cProduct->image)}}" width="800" height="800" alt="{{$cProduct->name}}"></figure>
                                                </a>
                                                <div class="group-flash">
                                                    <span class="flash-item new-label">new</span>
                                                </div>
                                                <div class="wrap-btn">
                                                    <a href="{{route('product.details', $cProduct->slug)}}" class="function-link">quick view</a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                {{-- <h1>{{$cProduct->category_id}}</h1> --}}
                                                <a href="{{route('product.details', $cProduct->slug)}}" class="product-name"><span>{{$cProduct->name}}</span></a>
                                                <div class="wrap-price"><span class="product-price">${{$cProduct->regular_price}}</span></div>
                                            </div>
                                        </div>
                                     @endforeach
								</div>
							</div>
                            {{-- @endforeach --}}
                            @endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
