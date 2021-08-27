<div class="wrap-breadcrumb">
    <ul>
        <li class="item-link"><a href="/" class="link">home</a></li>
        <li class="item-link"><span>
            {{Request::is('wishlist') ? 'wishlist' :'' }}
            {{Request::is('product*') ? 'details' :'' }}
            {{Request::is('product-category*') ? 'category' :'' }}
            {{Request::is('about-us') ? 'about us' :'' }}
            {{Request::is('shop') ? 'shop' :'' }}
            {{Request::is('cart') ? 'cart' :'' }}
            {{Request::is('checkout') ? 'checkout' :'' }}
            {{Request::is('contact-us') ? 'contact us' :'' }}
            {{Request::is('thank-you') ? 'thank you' :'' }}
            {{Request::is('forgot-password') ? 'forgot password' :'' }}
            {{Request::is('login') ? 'login' :'' }}
            {{Request::is('reset-password*') ? 'Reset Password' :'' }}
        </span></li>
        @if (Request::is('product-category*'))
            <li class="item-link"><span>
                {{ $category_name}}
        </span></li>
        @endif
    </ul>
</div>
