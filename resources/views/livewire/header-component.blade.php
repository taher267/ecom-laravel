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
                                <a title="Hotline: {{$setting->phone}}" href="#" > <span class="icon label-before fa fa-mobile"></span>Hotline: {{$setting->phone}}</a>
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
                                <a href="{!! route('aboutus') !!}" class="link-term mercado-item-title {{(Request::is('about-us*'))?'nav_active': ''}}">About Us</a>
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
                                <a href="{{route('contactus')}}" class="link-term mercado-item-title {{(Request::is('contact-us*'))?'nav_active': ''}}">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
