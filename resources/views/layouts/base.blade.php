<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'Home')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon.ico')}}">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/nouislider/nouislider.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap5.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/flexslider.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/chosen.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/color-01.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.min.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.7.0/nouislider.min.css" integrity="sha512-40vN6DdyQoxRJCw0klEUwZfTTlcwkOLKpP8K8125hy9iF4fi8gPpWZp60qKC6MYAFaond8yQds7cTMVU8eMbgA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

<style>
    .nav_active {
    background: #FF2832;
}
</style>

	@livewireStyles
</head>
<body class="home-page home-01 ">

	<!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>

	<!--header-->
	<header id="header" class="header header-style-1">
		<div class="container-fluid">
			<div class="row">
				<div class="topbar-menu-area">
					<div class="container">
						<div class="topbar-menu left-menu">
							<ul>
                                @if( Route::has('login') )
									@auth
                                        <li class="menu-item" >
                                            <a title="dashboard" href="@if ( Auth::user()->utype === 'ADM' ){{route('admin.dashboard')}} @elseif(Auth::user()->utype === 'USR' ) {{route('user.dashboard')}} @endif" ><span class="icon label-before fa fa-dashboard"></span>Dashboard </a>
                                        </li>
                                    @endauth
                                @endif
								<li class="menu-item mx-1">
									<a title="Hotline: (+123) 456 789" href="#" > <span class="icon label-before fa fa-mobile"></span>Hotline: (+123) 456 789</a>
								</li>
							</ul>
						</div>
						<div class="topbar-menu right-menu">
							<ul>
								<li class="menu-item lang-menu menu-item-has-children parent">
									<a title="English" href="#"><span class="img label-before"><img src="{{asset('assets/images/lang-en.png')}}" alt="lang-en"></span>English<i class="fa fa-angle-down" aria-hidden="true"></i></a>
									<ul class="submenu lang" >
										<li class="menu-item" ><a title="hungary" href="#"><span class="img label-before"><img src="{{asset('assets/images/lang-hun.png')}}" alt="lang-hun"></span>Hungary</a></li>
										<li class="menu-item" ><a title="german" href="#"><span class="img label-before"><img src="{{asset('assets/images/lang-ger.png')}}" alt="lang-ger" ></span>German</a></li>
										<li class="menu-item" ><a title="french" href="#"><span class="img label-before"><img src="{{asset('assets/images/lang-fra.png')}}" alt="lang-fre"></span>French</a></li>
										<li class="menu-item" ><a title="canada" href="#"><span class="img label-before"><img src="{{asset('assets/images/lang-can.png')}}" alt="lang-can"></span>Canada</a></li>
									</ul>
								</li>
									@if( Route::has('login') )
										@auth
											@if (Auth::user()->utype === 'ADM')
												<li class="menu-item menu-item-has-children parent" >
													<a title="My Account" href="#">My Account ({{ Auth::user()->name }})<i class="fa fa-angle-down" aria-hidden="true"></i></a>
													<ul class="submenu curency" >
														<li class="menu-item" >
															<a title="Dashboard" href="{{route('admin.dashboard')}}">Dashboard</a>
														</li>
														<li class="menu-item" >
															<a title="All Category" href="{{route('admin.categories')}}">categories</a>
														</li>
                                                        <li class="menu-item" >
															<a title="All Product" href="{{route('admin.products')}}">products</a>
														</li>
                                                        <li class="menu-item" >
															<a title="manage home slider" href="{{route('admin.homeslider')}}">manage home slider</a>
														</li>
                                                        <li class="menu-item" >
															<a title="manage product category" href="{{route('admin.homecategory')}}">manage product Category</a>
														</li>
                                                        <li class="menu-item" >
															<a title="sale Setting" href="{{route('admin.onsale')}}">Sale Setting</a>
														</li>
                                                        <li class="menu-item" >
															<a title="All coupons" href="{{route('admin.coupons')}}">All Coupons</a>
														</li>
                                                        <li class="menu-item" >
															<a title="Settings" href="{{route('admin.settings')}}">Settings</a>
														</li>

                                                        {{-- LOGOUT --}}
														<li class="menu-item" >
															<form action="{{route('logout')}}" method="post">
																@csrf
															<button style="border: none; background:transparent;" type="submit" title="Logout" >logout</button>
															</form>
														</li>
													</ul>
												</li>
											@else
												<li class="menu-item menu-item-has-children parent" >
													<a title="My Account" href="#">My Account ({{ Auth::user()->name }})<i class="fa fa-angle-down" aria-hidden="true"></i></a>
													<ul class="submenu curency" >
														<li class="menu-item" >
															<a title="Dashboard" href="{{route('user.dashboard')}}">Dashboard</a>
															<li class="menu-item" >
																<a {{route('logout')}} onclick="event.preventDefault(); document.querySelector('#logut-form').submit();" title="Logout">logout</a>
															</li>
															<form id="logut-form" action="{{route('logout')}}" method="post">
																@csrf
															</form>
														</li>
													</ul>
												</li>
											@endif
										@else
											<li class="menu-item" ><a title="Register or Login" href="{{route('login')}}">Login</a></li>
											<li class="menu-item" ><a title="Register or Login" href="{{route('register')}}">Register</a></li>
										@endif
									@endif
							</ul>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="mid-section main-info-area">
						<div class="wrap-logo-top left-section">
							<a href="{{route('home')}}" class="link-to-home"><img src="{{asset('assets/images/logo-top-1.png')}}" alt="mercado"></a>
						</div>
						@livewire('header-search-component')
						<div class="wrap-icon right-section">
                            {{-- Wishlist area --}}
							@livewire('wishlist-count-component')
                            {{-- Cart area --}}
							@livewire('cart-count-component')

							<div class="wrap-icon-section show-up-after-1024">
								<a href="#" class="mobile-navigation">
									<span></span>
									<span></span>
									<span></span>
								</a>
							</div>
						</div>

					</div>
				</div>

				<div class="nav-section header-sticky">
					<div class="header-nav-section">
						<div class="container">
							<ul class="nav menu-nav clone-main-menu" id="mercado_haead_menu" data-menuname="Sale Info" >
								<li class="menu-item"><a href="#" class="link-term">Weekly Featured</a><span class="nav-label hot-label">hot</span></li>
								<li class="menu-item"><a href="#" class="link-term">Hot Sale items</a><span class="nav-label hot-label">hot</span></li>
								<li class="menu-item"><a href="#" class="link-term">Top new items</a><span class="nav-label hot-label">hot</span></li>
								<li class="menu-item"><a href="#" class="link-term">Top Selling</a><span class="nav-label hot-label">hot</span></li>
								<li class="menu-item"><a href="#" class="link-term">Top rated items</a><span class="nav-label hot-label">hot</span></li>
							</ul>
						</div>
					</div>

					<div class="primary-nav-section">
						<div class="container">
							<ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu" >
								<li class="menu-item home-icon">
									<a href="{{route('home')}}" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
								</li>
								<li class="menu-item">
									<a href="about-us.html" class="link-term mercado-item-title">About Us</a>
								</li>
								<li class="menu-item">
									<a href="{{route('shop')}}" class="link-term mercado-item-title
									{{(Request::is('shop*'))?'nav_active': ''}}">Shop</a>
								</li>
								<li class="menu-item">
									<a href="{{route('product.cart')}}" class="link-term mercado-item-title {{(Request::is('cart*'))?'nav_active': ''}}">Cart</a>
								</li>
								<li class="menu-item">
									<a href="{{route('checkout')}}" class="link-term mercado-item-title {{(Request::is('checkout*'))?'nav_active': ''}}">Checkout</a>
								</li>
								<li class="menu-item">
									<a href="contact-us.html" class="link-term mercado-item-title {{(Request::is('contactus*'))?'nav_active': ''}}">Contact Us</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

		{{$slot}}

	<footer id="footer">
		<div class="wrap-footer-content footer-style-1">

			<div class="wrap-function-info">
				<div class="container">
					<ul>
						<li class="fc-info-item">
							<i class="fa fa-truck" aria-hidden="true"></i>
							<div class="wrap-left-info">
								<h4 class="fc-name">Free Shipping</h4>
								<p class="fc-desc">Free On Oder Over $99</p>
							</div>

						</li>
						<li class="fc-info-item">
							<i class="fa fa-recycle" aria-hidden="true"></i>
							<div class="wrap-left-info">
								<h4 class="fc-name">Guarantee</h4>
								<p class="fc-desc">30 Days Money Back</p>
							</div>

						</li>
						<li class="fc-info-item">
							<i class="fa fa-credit-card-alt" aria-hidden="true"></i>
							<div class="wrap-left-info">
								<h4 class="fc-name">Safe Payment</h4>
								<p class="fc-desc">Safe your online payment</p>
							</div>

						</li>
						<li class="fc-info-item">
							<i class="fa fa-life-ring" aria-hidden="true"></i>
							<div class="wrap-left-info">
								<h4 class="fc-name">Online Suport</h4>
								<p class="fc-desc">We Have Support 24/7</p>
							</div>

						</li>
					</ul>
				</div>
			</div>
			<!--End function info-->

			<div class="main-footer-content">

				<div class="container">

					<div class="row">

						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
							<div class="wrap-footer-item">
								<h3 class="item-header">Contact Details</h3>
								<div class="item-content">
									<div class="wrap-contact-detail">
										<ul>
											<li>
												<i class="fa fa-map-marker" aria-hidden="true"></i>
												<p class="contact-txt">45 Grand Central Terminal New York,NY 1017 United State USA</p>
											</li>
											<li>
												<i class="fa fa-phone" aria-hidden="true"></i>
												<p class="contact-txt">(+123) 456 789 - (+123) 666 888</p>
											</li>
											<li>
												<i class="fa fa-envelope" aria-hidden="true"></i>
												<p class="contact-txt">Contact@yourcompany.com</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">

							<div class="wrap-footer-item">
								<h3 class="item-header">Hot Line</h3>
								<div class="item-content">
									<div class="wrap-hotline-footer">
										<span class="desc">Call Us toll Free</span>
										<b class="phone-number">(+123) 456 789 - (+123) 666 888</b>
									</div>
								</div>
							</div>

							<div class="wrap-footer-item footer-item-second">
								<h3 class="item-header">Sign up for newsletter</h3>
								<div class="item-content">
									<div class="wrap-newletter-footer">
										<form action="#" class="frm-newletter" id="frm-newletter">
											<input type="email" class="input-email" name="email" value="" placeholder="Enter your email address">
											<button class="btn-submit">Subscribe</button>
										</form>
									</div>
								</div>
							</div>

						</div>

						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 box-twin-content ">
							<div class="row">
								<div class="wrap-footer-item twin-item">
									<h3 class="item-header">My Account</h3>
									<div class="item-content">
										<div class="wrap-vertical-nav">
											<ul>
												<li class="menu-item"><a href="#" class="link-term">My Account</a></li>
												<li class="menu-item"><a href="#" class="link-term">Brands</a></li>
												<li class="menu-item"><a href="#" class="link-term">Gift Certificates</a></li>
												<li class="menu-item"><a href="#" class="link-term">Affiliates</a></li>
												<li class="menu-item"><a href="#" class="link-term">Wish list</a></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="wrap-footer-item twin-item">
									<h3 class="item-header">Infomation</h3>
									<div class="item-content">
										<div class="wrap-vertical-nav">
											<ul>
												<li class="menu-item"><a href="#" class="link-term">Contact Us</a></li>
												<li class="menu-item"><a href="#" class="link-term">Returns</a></li>
												<li class="menu-item"><a href="#" class="link-term">Site Map</a></li>
												<li class="menu-item"><a href="#" class="link-term">Specials</a></li>
												<li class="menu-item"><a href="#" class="link-term">Order History</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>

					<div class="row">

						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
							<div class="wrap-footer-item">
								<h3 class="item-header">We Using Safe Payments:</h3>
								<div class="item-content">
									<div class="wrap-list-item wrap-gallery">
										<img src="{{asset('assets/images/payment.png')}}" style="max-width: 260px;">
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
							<div class="wrap-footer-item">
								<h3 class="item-header">Social network</h3>
								<div class="item-content">
									<div class="wrap-list-item social-network">
										<ul>
											<li><a href="#" class="link-to-item" title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
											<li><a href="#" class="link-to-item" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
											<li><a href="#" class="link-to-item" title="pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
											<li><a href="#" class="link-to-item" title="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
											<li><a href="#" class="link-to-item" title="vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
							<div class="wrap-footer-item">
								<h3 class="item-header">Dowload App</h3>
								<div class="item-content">
									<div class="wrap-list-item apps-list">
										<ul>
											<li><a href="#" class="link-to-item" title="our application on apple store"><figure><img src="{{asset('assets/images/brands/apple-store.png')}}" alt="apple store" width="128" height="36"></figure></a></li>
											<li><a href="#" class="link-to-item" title="our application on google play store"><figure><img src="{{asset('assets/images/brands/google-play-store.png')}}" alt="google play store" width="128" height="36"></figure></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="wrap-back-link">
					<div class="container">
						<div class="back-link-box">
							<h3 class="backlink-title">Quick Links</h3>
							<div class="back-link-row">
								<ul class="list-back-link" >
									<li><span class="row-title">Mobiles:</span></li>
									<li><a href="#" class="redirect-back-link" title="mobile">Mobiles</a></li>
									<li><a href="#" class="redirect-back-link" title="yphones">YPhones</a></li>
									<li><a href="#" class="redirect-back-link" title="Gianee Mobiles GL">Gianee Mobiles GL</a></li>
									<li><a href="#" class="redirect-back-link" title="Mobiles Karbonn">Mobiles Karbonn</a></li>
									<li><a href="#" class="redirect-back-link" title="Mobiles Viva">Mobiles Viva</a></li>
									<li><a href="#" class="redirect-back-link" title="Mobiles Intex">Mobiles Intex</a></li>
									<li><a href="#" class="redirect-back-link" title="Mobiles Micrumex">Mobiles Micrumex</a></li>
									<li><a href="#" class="redirect-back-link" title="Mobiles Bsus">Mobiles Bsus</a></li>
									<li><a href="#" class="redirect-back-link" title="Mobiles Samsyng">Mobiles Samsyng</a></li>
									<li><a href="#" class="redirect-back-link" title="Mobiles Lenova">Mobiles Lenova</a></li>
								</ul>

								<ul class="list-back-link" >
									<li><span class="row-title">Tablets:</span></li>
									<li><a href="#" class="redirect-back-link" title="Plesc YPads">Plesc YPads</a></li>
									<li><a href="#" class="redirect-back-link" title="Samsyng Tablets" >Samsyng Tablets</a></li>
									<li><a href="#" class="redirect-back-link" title="Qindows Tablets" >Qindows Tablets</a></li>
									<li><a href="#" class="redirect-back-link" title="Calling Tablets" >Calling Tablets</a></li>
									<li><a href="#" class="redirect-back-link" title="Micrumex Tablets" >Micrumex Tablets</a></li>
									<li><a href="#" class="redirect-back-link" title="Lenova Tablets Bsus" >Lenova Tablets Bsus</a></li>
									<li><a href="#" class="redirect-back-link" title="Tablets iBall" >Tablets iBall</a></li>
									<li><a href="#" class="redirect-back-link" title="Tablets Swipe" >Tablets Swipe</a></li>
									<li><a href="#" class="redirect-back-link" title="Tablets TVs, Audio" >Tablets TVs, Audio</a></li>
								</ul>

								<ul class="list-back-link" >
									<li><span class="row-title">Fashion:</span></li>
									<li><a href="#" class="redirect-back-link" title="Sarees Silk" >Sarees Silk</a></li>
									<li><a href="#" class="redirect-back-link" title="sarees Salwar" >sarees Salwar</a></li>
									<li><a href="#" class="redirect-back-link" title="Suits Lehengas" >Suits Lehengas</a></li>
									<li><a href="#" class="redirect-back-link" title="Biba Jewellery" >Biba Jewellery</a></li>
									<li><a href="#" class="redirect-back-link" title="Rings Earrings" >Rings Earrings</a></li>
									<li><a href="#" class="redirect-back-link" title="Diamond Rings" >Diamond Rings</a></li>
									<li><a href="#" class="redirect-back-link" title="Loose Diamond Shoes" >Loose Diamond Shoes</a></li>
									<li><a href="#" class="redirect-back-link" title="BootsMen Watches" >BootsMen Watches</a></li>
									<li><a href="#" class="redirect-back-link" title="Women Watches" >Women Watches</a></li>
								</ul>

							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="coppy-right-box">
				<div class="container">
					<div class="coppy-right-item item-left">
						<p class="coppy-right-text">Copyright © 2020 Surfside Media. All rights reserved</p>
					</div>
					<div class="coppy-right-item item-right">
						<div class="wrap-nav horizontal-nav">
							<ul>
								<li class="menu-item"><a href="about-us.html" class="link-term">About us</a></li>
								<li class="menu-item"><a href="privacy-policy.html" class="link-term">Privacy Policy</a></li>
								<li class="menu-item"><a href="terms-conditions.html" class="link-term">Terms & Conditions</a></li>
								<li class="menu-item"><a href="return-policy.html" class="link-term">Return Policy</a></li>
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</footer>

	<script src="{{asset('assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
	<script src="{{asset('assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/nouislider/nouislider.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery.flexslider.js')}}"></script>
	<!-- <script src="{{asset('assets/js/chosen.jquery.min.js')}}"></script> -->
	<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery.countdown.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery.sticky.js')}}"></script>
	<script src="{{asset('assets/js/functions.js')}}"></script>
    <script src="{{asset('assets/js/select2.min.js')}}"></script>

    {{-- <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> --}}
    <script src="{{asset('assets/js/jquery-1.7.2.min.js')}}"></script>
    {{-- <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.0.0/js/bootstrap-datetimepicker.min.js"></script> --}}

	<script src="https://cdn.tiny.cloud/1/kkzm7aotubmkrvxqfvo82szskkhwzcqh9wd4vt5jjqqir1q2/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.7.0/nouislider.min.js" integrity="sha512-jWNpWAWx86B/GZV4Qsce63q5jxx/rpWnw812vh0RE+SBIo/mmepwOSQkY2eVQnMuE28pzUEO7ux0a5sJX91g8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- <script src="{!! asset("assets/tinymce/tinymce.min.js") !!}"></script> --}}

	@livewireScripts
    @stack('scripts')
</body>
</html>
