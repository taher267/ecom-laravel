@section('title', 'Product Details')
<main id="main" class="main-site">
    <div class="container">
        {{-- Breadcrumb --}}
        @livewire('breadcrumb-component')
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                <div class="wrap-product-detail">
                    <div class="detail-media">
                        <div class="product-gallery" wire:ignore>
                          <ul class="slides">

                              @if ( $product->images )
                              @foreach(  explode(',' , str_replace(' ', '', $product->images)) as $pro_gallery)
                                @if ($pro_gallery )
                                <li data-thumb="{!! asset('assets/images/products/' . $product->slug .'/' .$pro_gallery) !!}">
                                    <img src="{!! asset('assets/images/products/' . $product->slug .'/' .$pro_gallery) !!}" alt="product thumbnail" />
                                </li>
                                @endif
                                @endforeach
                              @else
                            <li data-thumb="{!! asset('assets/images/products/' . $product->image) !!}">
                                <img src="{!! asset('assets/images/products/' . $product->image) !!}" alt="product thumbnail" />
                            </li>
                            @endif
                          </ul>
                        </div>
                    </div>
                    <div class="detail-info">
                        <div class="product-rating">
                            @php
                                $avgrating = 0;
                            @endphp
                            @foreach ( $product->orderItems->where( 'rstatus', 1 ) as $itemReview )
                                @php
                                    $avgrating = $avgrating + $itemReview->review->rating;
                                @endphp
                            @endforeach
                            @for( $i =1; $i<=5; $i++ )
                                @if ( $i <= $avgrating )
                                    <i class="fa fa-star"></i>
                                @else
                                    <i class="fa fa-star text-secondary"></i>
                                @endif
                            @endfor

                            <a href="#" class="count-review">({{ $product->orderItems->where( 'rstatus', 1 )->count() }} review)</a>
                        </div>
                        <h2 title="{!! $product->category_id !!}" class="product-name text-capitalize">{!! $product->name !!}</h2>
                        <div class="short-desc">
                            {!!$product->short_description!!}
                        </div>
                        <div class="wrap-social">
                            <a class="link-socail" href="#"><img src="{!! asset('assets/images/social-list.png') !!}" alt="{!! $product->name !!}"></a>
                        </div>
                        <div class="wrap-price">
                            <span class="product-price">${!! $product->regular_price !!}</span>
                            @if ($product->sale_price >0)
                            <del class="product-price fz-14">${!! $product->sale_price !!}</del>
                            @endif
                            @if (! empty(Auth::user()) && Auth::user()->utype==='ADM')<a href="{!! route('admin.editproduct', $product->slug) !!}" style="" class="btn btn-secondary">Quick Edit</a>@endif
                        </div>
                        <div class="stock-info in-stock">
                            <p class="availability text-capitalize">Availability: <b>{!! $product->stock_status !!}</b></p>
                        </div>
                        <div class="quantity">
                            <span>Quantity:</span>

                            <div class="quantity-input">
                                <input type="text" name="product-quatity" value="1" data-max="120" pattern="[0-9]*" >

                                <a class="btn btn-reduce" wire:click.prevent="decreaseQty" href="#"></a>
                                <a class="btn btn-increase" wire:click.prevent="increaseQry" href="#"></a>
                            </div>

                        </div>

                        <div class="wrap-butons">
                            @php
                                $wishitems = Cart::instance('wishlist')->content()->pluck('id');
                                $cartitems = Cart::instance('cart')->content()->pluck('id');
                            @endphp

                            @if (Cart::instance('cart')->count() > 0 && $cartitems->contains($product->id))
                                @foreach (Cart::instance('cart')->content() as $citem)
                                    @if ($citem->id == $product->id && $cartitems->contains($product->id))
                                    <a href="#" disabled class="btn add-to-cart already-to-cart" onclick="confirm('Do you want to remove this product from Cart?') || event.stopImmediatePropagation()" wire:click.prevent="removeToCart('{{$citem->rowId}}')">Already To Cart</a>
                                    @endif
                                @endforeach
                                @else
                                    <a href="#" wire:click.prevent="store({{$product->id}}, '{{$product->name}}', {{$product->regular_price}})" class="btn add-to-cart">Add To Cart</a>
                                @endif
                            {{-- <a href="#" wire:click.prevent="store({!! $product->id !!}, '{!! $product->name !!}', {!! $product->regular_price !!})" class="btn add-to-cart">Add to Cart</a> --}}
                            <div class="wrap-btn">
                                <a href="#" class="btn btn-compare">Add Compare</a>
                                <style>
                                    .wrap-product-detail .btn.fill-heart, .wrap-product-detail .wrap-btn .btn.fill-heart::before {
                                        color: red !important;
                                    }
                                </style>
                                {{-- Exists in wishlist or Not --}}
                                @if ( $wishitems->contains( $product->id ) )
                                    {{-- <a href="#" wire:click.prevent="removeFromWishlist({{$product->id}})"><i class="fa fa-heart fill-heart"></i></a> --}}
                                    <a href="#" class="btn btn-wishlist fill-heart fw-bold">Already in Wishlist</a>
                                    @else
                                    <a href="#" wire:click.prevent="addToWishlist({{$product->id}}, '{{$product->name}}', {{$product->regular_price}})" class="btn btn-wishlist">Add Wishlist</a>
                                    @endif

                            </div>
                        </div>
                    </div>
                    <div class="advance-info">
                        @if (Session::has('msg'))
                        <div class="alert alert-info">{{Session::get('msg')}}</div>
                    @endif
                        <div class="tab-control normal">
                            <a href="#description" id="details_desc" class="tab-control-item active">description</a>
                            <a href="#add_infomation" class="tab-control-item">Additional Infomation</a>
                            <a href="#review" id="product_review" value="def" class="tab-control-item
                            {{--@auth @foreach ($is_order_item_added as $item) @if ($item->order->status == 'delivered' && $item->order->user_id == Auth::user()->id && $item->product->slug == $slug && $item->rstatus == false) active @endif @endforeach @endauth--}}
                            ">Reviews</a>
                        </div>
                        <div class="tab-contents">
                            <div class="tab-content-item active" id="description">
                                <p>{!! $product->description !!}</p>
                            </div>
                            <div class="tab-content-item " id="add_infomation">
                                @if ( $product->additional_info != null )
                                {!!$product->additional_info!!}
                                @else
                                <table class="shop_attributes table table-striped">
                                    <h4 class="text-warning">Default additional Info</h4>
                                    <tbody>

                                        <tr>
                                            <th>Weight</th><td class="product_weight">1 kg</td>
                                        </tr>
                                        <tr>
                                            <th>Dimensions</th><td class="product_dimensions">12 x 15 x 23 cm</td>
                                        </tr>
                                        <tr>
                                            <th>Color</th><td><p>Black, Blue, Grey, Violet, Yellow</p></td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif

                            </div>
                            <div class="tab-content-item{{--@auth @foreach ($is_order_item_added as $item) @if ($item->order->status == 'delivered' && $item->order->user_id == Auth::user()->id && $item->product->slug == $slug && $item->rstatus == false) active @endif @endforeach @endauth--}}" id="review">
                                <div class="wrap-review-form">
                                    <div id="comments">
                                        <h2 class="woocommerce-Reviews-title">{{ $product->orderItems->where( 'rstatus', 1 )->count() }} review for <span>{{ $product->name }}</span></h2>
                                        <ol class="commentlist">
                                            @foreach ($product->orderItems->where( 'rstatus', 1 ) as $orderItem)
                                            <style>
                                                .width-{{ $orderItem->review->rating * 20 }}-percent {width: {{ $orderItem->review->rating * 20 }}%;}
                                            </style>
                                                <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
                                                <div id="comment-20" class="comment_container">
                                                    <img alt="" src="{{asset('assets/images/author-avata.jpg')}}" height="80" width="80">
                                                    <div class="comment-text">
                                                        <div class="star-rating">
                                                            <span class="width-{{ $orderItem->review->rating * 20 }}-percent">Rated <strong class="rating">{{ $orderItem->review->rating }}</strong> out of 5</span>
                                                        </div>
                                                        <p class="meta">
                                                            <strong class="woocommerce-review__author">{{$orderItem->order->user->name}}</strong>
                                                            <span class="woocommerce-review__dash">–</span>
                                                            <time class="woocommerce-review__published-date" datetime="2008-02-14 20:00" >{{Carbon\Carbon::parse($orderItem->review->created_at)->format('D, F d, Y g:i A')}}</time>
                                                        </p>
                                                        <div class="description">
                                                            <p>{{$orderItem->review->comment}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach

                                        </ol>
                                    </div><!-- #comments -->

                                    <div id="review_form_wrapper">
                                        <div id="review_form">
                                            <div id="respond" class="comment-respond">
                                                @auth
                                                    @foreach ( $is_order_item_added as $item )
                                                        @if ( $item->order->status == 'delivered' && $item->order->user_id == Auth::user()->id && $item->product->slug == $slug && $item->rstatus == false )
                                                        <div id="comments">
                                                            <h2 class="woocommerce-Reviews-title">Review for <span>{{$item->product->name}}</span></h2>
                                                            {{-- {{$item->product->image}} --}}
                                                            <img src='{{asset("assets/images/products/".$item->product->image)}}' alt="{{$item->product->name}}" width="45" height="45">
                                                        </div>
                                                             <form id="review_field" wire:submit.prevent="addReview({{$item->id}})" id="commentform" class="comment-form" >
                                                                <div class="comment-form-rating">
                                                                    <span>Your rating</span>
                                                                    <p class="stars">
                                                                        <label for="rated-1"></label>
                                                                        <input type="radio" id="rated-1" name="rating" wire:model="rating" value="1">
                                                                        <label for="rated-2"></label>
                                                                        <input type="radio" id="rated-2" name="rating" wire:model="rating" value="2">
                                                                        <label for="rated-3"></label>
                                                                        <input type="radio" id="rated-3" name="rating" wire:model="rating" value="3">
                                                                        <label for="rated-4"></label>
                                                                        <input type="radio" id="rated-4" name="rating" wire:model="rating" value="4">
                                                                        <label for="rated-5"></label>
                                                                        <input type="radio" id="rated-5" name="rating" wire:model="rating" value="5" checked="checked">
                                                                    </p>
                                                                    @error('rating')<p class="text-danger">{{$message}}</p>@enderror
                                                                </div>

                                                                <p class="comment-form-comment">
                                                                    <label for="comment">Your review <span class="required">*</span>
                                                                    </label>
                                                                    <textarea id="comment" name="comment" wire:model="comment" cols="45" rows="8"></textarea>
                                                                </p>
                                                                @error('comment')<p class="text-danger">{{$message}}</p>@enderror
                                                                <p class="form-submit">
                                                                    <input name="submit" type="submit" id="submit" class="submit" value="Submit">
                                                                </p>
                                                            </form>
                                                        @endif
                                                    @endforeach
                                                @endauth

                                            </div><!-- .comment-respond-->
                                        </div><!-- #review_form -->
                                    </div><!-- #review_form_wrapper -->

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div><!--end main products area-->

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                <div class="widget widget-our-services ">
                    <div class="widget-content">
                        <ul class="our-services">

                            <li class="service">
                                <a class="link-to-service" href="#">
                                    <i class="fa fa-truck" aria-hidden="true"></i>
                                    <div class="right-content">
                                        <b class="title">Free Shipping</b>
                                        <span class="subtitle">On Oder Over $99</span>
                                        <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                    </div>
                                </a>
                            </li>

                            <li class="service">
                                <a class="link-to-service" href="#">
                                    <i class="fa fa-gift" aria-hidden="true"></i>
                                    <div class="right-content">
                                        <b class="title">Special Offer</b>
                                        <span class="subtitle">Get a gift!</span>
                                        <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                    </div>
                                </a>
                            </li>

                            <li class="service">
                                <a class="link-to-service" href="#">
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                    <div class="right-content">
                                        <b class="title">Order Return</b>
                                        <span class="subtitle">Return within 7 days</span>
                                        <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div><!-- Categories widget-->

                <div class="widget mercado-widget widget-product">
                    <h2 class="widget-title">Popular Products</h2>
                    <div class="widget-content">
                        <ul class="products">
                            @foreach ($popular_products as $p_product)
                            <li class="product-item">
                                <div class="product product-widget-style">
                                    <div class="thumbnnail">
                                        <a href="{!! route('product.details', $p_product->slug) !!}" title="{!! $p_product->name !!}">
                                            <figure><img src="{!! asset('assets/images/products/' . $p_product->image) !!}" alt="{!! $p_product->name !!}"></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="{!! route('product.details', $p_product->slug) !!}" class="product-name text-capitalize"><span>{!! $p_product->name !!}...</span></a>
                                        <div class="wrap-price"><span class="product-price">${!! $p_product->regular_price !!}</span></div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div><!--end sitebar-->
            @if ($related_products->count() > 0)
            <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="wrap-show-advance-info-box style-1 box-in-site">
                    <h3 class="title-box">Related Products</h3>
                    <div class="wrap-products">
                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-activation="owl-carousel_{{rand()}}" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"{!! $related_products->count() >=2?2 : $related_products->count() !!}"},"768":{"items":"{!! $related_products->count() >=3 ? 3 : $related_products->count() !!}"},"992":{"items":"{!! $related_products->count() >=3 ? 3 : $related_products->count() !!}"},"1200":{ "items":"{!! $related_products->count() >=5 ? 5 : $related_products->count() !!}" } }' >
                            @foreach ($related_products as $r_product)
                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{ route('product.details', $r_product->slug) }}" title="{{ $r_product->name }}">
                                        <figure><img src="{!! asset('assets/images/products/' . $r_product->image) !!}" width="214" height="214" alt="{!! $r_product->name !!}"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">new</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="{!! route('product.details', $r_product->slug) !!}" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="{!! route('product.details', $r_product->slug) !!}" class="product-name text-capitalize"><span>{!! $r_product->name !!}</span></a>
                                    <div class="wrap-price"><span class="product-price">${!! $r_product->regular_price !!}</span></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div><!--End wrap-products-->
                </div>
            </div>
            @endif
        </div><!--end row-->
    </div><!--end container-->
</main>
@push('scripts')
    <script>
        // jQuery(function(){
        //     if($('#review_field').val() == null){
        //         jQuery('#details_desc').addClass('active');
        //         jQuery('#description').addClass('active');
        //     }
        // });
    </script>
@endpush
