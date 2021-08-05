@section('title', 'Wishlist')
<main id="main" class="main-site left-sidebar">
    <style>
        .product_wish{
            position: absolute; top: 10%; left: 0; z-index: 99;right: 30px; text-align: right; padding-top: 0;
        }
        .product_wish i.fa-heart{
            color: #ddd; font-size: 32px; transition: 0.4s all ease-in-out;
        }
        .product_wish i.fa-heart:hover{ color: #FF2832; }
        .product_wish i.fill-heart{ color: #FF2832; }
    </style>
    <div class="container">
        @livewire('breadcrumb-component')
    <div class="row">
        {{-- @php
           $wishitems = Cart::instance('wishlist')->content()->pluck('id');
           $cartitems = Cart::instance('cart')->content()->pluck('id');
        @endphp --}}
        @if (Cart::instance('wishlist')->content()->count() > 0)
        <ul class="product-list grid-products equal-container">
            @foreach (Cart::instance('wishlist')->content() as $item)
                <li class="col-lg-3 col-md-4 col-sm-6 col-xs-6 ">
                <div class="product product-style-3 equal-elem ">
                    <div class="product-thumnail">
                        <a href="{{route('product.details', $item->model->slug)}}" title="{{$item->model->name}}">
                            <figure><img src="{{asset('assets/images/products/'. $item->model->image)}}" alt="{{$item->model->name}}"></figure>
                        </a>
                    </div>
                    <div class="product-info">
                        <a href="{{route('product.details', $item->model->slug)}}" class="product-name text-capitalize"><span>{{$item->model->name}}</span></a>
                        <div class="wrap-price"><span class="product-price">${{$item->model->regular_price}}</span></div>
                        <a href="#" wire:click.prevent="moveWishlistToCart('{{$item->rowId}}')" class="btn add-to-cart"> Move to Cart</a>
                        {{-- @if (Cart::instance('cart')->count() > 0 && $cartitems->contains($item->model->id))
                        @foreach (Cart::instance('cart')->content() as $citem)
                            @if ($citem->id == $item->model->id && $cartitems->contains($item->model->id))
                            <a href="#" class="btn add-to-cart already-to-cart" wire:click.prevent="removeToCart('{{$citem->rowId}}')">Already To Cart</a>
                            @endif
                        @endforeach
                        @else
                            <a href="#" wire:click.prevent="store({{$item->model->id}}, '{{$item->model->name}}', {{$item->model->regular_price}})" class="btn add-to-cart">Add To Cart</a>
                        @endif --}}
                        <div class="product_wish">
                            <a href="#" wire:click.prevent="removeFromWishlist({{$item->model->id}})"><i class="fa fa-heart fill-heart"></i></a>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        @else
        <div style="height:35em; background:url('{{asset('assets/images/empty-wishlist.png')}}') no-repeat center top; background-size:;" class="bg-cover bg-no-repeat wishlist_empty_wrap d-flex justify-content-center align-items-center">
            <div class="mt-5 pt-5">
                <h4 class="text-alert">Empty wishlist</h4>
            <a class="btn btn-primary fz-14 fw-bold" style="color:" href="{!! route('shop') !!}">Shopping  now</a>
            </div>
        </div>

        @endif
    </div>
</div>
</main>
