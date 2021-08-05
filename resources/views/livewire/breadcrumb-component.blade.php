<div class="wrap-breadcrumb">
    <ul>
        <li class="item-link"><a href="/" class="link">home</a></li>
        <li class="item-link"><span>
            {{Request::is('wishlist') ? 'wishlist' :'' }}
            {{Request::is('product*') ? 'details' :'' }}
            {{Request::is('product-category*') ? 'category' :'' }}
            {{Request::is('shop') ? 'shop' :'' }}
            {{Request::is('cart') ? 'cart' :'' }}
            {{Request::is('checkout') ? 'checkout' :'' }}
        </span></li>
        @if (Request::is('product-category*'))
            <li class="item-link"><span>
                {{ $category_name}}
        </span></li>
        @endif
    </ul>
</div>
