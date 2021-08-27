@section('title', 'Customer Order Details')
<div class="p-3">
    <div class="row mb-4">
        <div class="col-lg-12">
            @if (Session::has('status_msg'))
            <div class="alert alert-success">
                {{Session::get('status_msg')}}
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row alert alert-secondary">
                        <div class="col-lg-4">Order Details</div>
                        <div class="col-lg-4">
                            @if ( $order->status == 'ordered' )
                                <a class="btn btn-warning btn-sm" wire:click.prevent="cancelOrder" href="#">Cancel Order</a>
                            @endif
                        </div>
                        <div class="col-lg-4 text-end">
                            <a class="btn btn-primary  btn-sm" href="{{route('user.orders')}}">My Orders</a>
                        </div>
                    </div>
                </div>
                <div class="panel body">
                    <table class="table">
                        <th>Order ID</th>
                        <td>{{$order->id}}</td>
                        <th>Order Date</th>
                        <td>{{$order->created_at}}</td>
                        <th>Status</th>
                        <td>{{$order->status}}</td>
                        <th>{{$order->status == 'delivered' ? 'Delivery date' : 'Canceled date'}}</th>
                        <td>{{$order->status == 'delivered' ? $order->delivered_date : $order->canceled_date}}</td>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Order Items
                </div>

                <div class="panel-body">
                    <div class="wrap-item-in-cart">
                        <h3 class="box-title">Products Name</h3>
                        <ul class="products-cart">
                            @foreach ($order->orderItems as $item)
                                <li class="pr-cart-item">
                                    <div class="product-image">
                                        <figure><img src="{{asset('assets/images/products/'. $item->product->image)}}" alt="{{$item->product->name}}"></figure>
                                    </div>
                                    <div class="product-name">
                                        <a class="link-to-product" href="{{route('product.details',$item->product->slug)}}">{{$item->product->name}}</a>
                                    </div>
                                    <div class="price-field produtc-price"><p class="price">${{$item->price}}</p></div>
                                    <div class="quantity"><h6 class="fw-bolder">{{ $item->quantity }}</h6></div>
                                    <div class="price-field sub-total"><p class="price">${{$item->price * $item->quantity}}</p></div>
                                    @if ($order->status == 'delivered' && $item->rstatus == false)
                                    <div>
                                        <a class="link-to-product btn btn-dark btn-sm" href="{{route('product.details',$item->product->slug)}}">Write Review</a>
                                        {{-- <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#customerReview">Write Review</button> --}}
                                    </div>
                                    @endif

                                    {{-- Modal --}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="summary">
                        <div class="order-summary">
                            <h4 class="title-box">Order Summary</h4>
                            <p class="summary-info"><span class="title">Subtotal</span><b class="index">${{$order->subtotal}}</b></p>
                            <p class="summary-info"><span class="title">Tax({{config('cart.tax')}}%)</span><b class="index">${{$order->tax}}</b></p>
                            <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>
                            <p class="summary-info total-info "><span class="title">Total({{config('cart.tax')}}% Inclusive Tax)</span><b class="index">${{$order->total}}</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading alert alert-secondary">Builling Details</div>
                <div class="panel-body row">
                        <div class="col-lg-12">
                            <table class="table table-striped">
                                <tr>
                                    <th>Frist Name</th>
                                    <td>{{$order->first_name}}</td>
                                    <th>Last Name</th>
                                    <td>{{$order->last_name}}</td>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    <td>{{$order->mobile}}</td>
                                    <th>Email</th>
                                    <td>{{$order->email}}</td>
                                </tr>
                                <tr>
                                    <th>Line 1</th>
                                    <td>{{$order->line1}}</td>
                                    <th>Line 2</th>
                                    <td>{{$order->line2 ? $order->line2:'------'}}</td>
                                </tr>
                                <tr>
                                    <th>Province</th>
                                    <td>{{$order->province}}</td>
                                    <th>Zipcode</th>
                                    <td>{{$order->zipcode}}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{$order->city}}</td>
                                    <th>Country</th>
                                    <td>{{$order->country}}</td>
                                </tr>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @if ($order->is_shipping_different)
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading alert alert-secondary">Shippting Details</div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <tr>
                                <th>Frist Name</th>
                                <td>{{$order->shipping->first_name}}</td>
                                <th>Last Name</th>
                                <td>{{$order->shipping->last_name}}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>{{$order->shipping->mobile}}</td>
                                <th>Email</th>
                                <td>{{$order->shipping->email}}</td>
                            </tr>
                            <tr>
                                <th>Line 1</th>
                                <td>{{$order->shipping->line1}}</td>
                                <th>Line 2</th>
                                <td>{{$order->shipping->line2 ? $order->shipping->line2:'------'}}</td>
                            </tr>
                            <tr>
                                <th>Province</th>
                                <td>{{$order->shipping->province}}</td>
                                <th>Zipcode</th>
                                <td>{{$order->shipping->zipcode}}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{$order->shipping->city}}</td>
                                <th>Country</th>
                                <td>{{$order->shipping->country}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <style>
                .fa, .fas, .fab{
                    font-size: 25px !important;
                }
                .transaction-body table tr td{
                    border: 0 !important;
                }

            </style>
            <div class="panel panel-default">
                <div class="panel-heading alert-secondary alert">Transaction</div>
                <div class="panel-body">
                    <div class="card text-white bg-dark my-3 mx-auto" style="max-width: 18rem;">
                        <div class="card-header text-center" ><i class="fa fa-paper-plane my-5" style="font-size: 100px !important; color: #ffffff;"></i></div>
                        <div class="card-body transaction-body">
                            <h5 class="card-title"><b><i class="fa fa-user"></i></b> {{$order->user->name}}</h5>
                            <table class="table" style="color: #fff !important;">
                                <tr>
                                    <td><b><i class="fas fa-file-invoice-dollar"></i></b></td>
                                    <td>{{ $order->transaction->mode=='cod' ? 'Cash On Delivery': '' }}</td>
                                </tr>
                                @if (Session::has('msg'))
                                    <tr>
                                        <td colspan="2" class="alert alert-{{substr(Session::get('msg'), -8)=='approved'?'primary': 'danger'}}" >
                                        {{Session::get('msg')}}
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <td><b><i class="fas fa-thermometer-@if($order->transaction->status=='pending')quarter text-danger @elseif($order->transaction->status=='approved')three-quarters text-primary @endif"></i></b></td>
                                    <td class="text-capitalize">{{ $order->transaction->status}}</td>
                                </tr>
                                <tr>
                                    <td><b><i class="fas fa-calendar-alt"></i></b></td>
                                    <td>{{ $order->transaction->created_at}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="customerReview" tabindex="-1" aria-labelledby="customerReviewLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customerReviewLabel">Write your review about {{ $item->product->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form wire:submit.prevent="makeReview">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Rating:</label>
            <input type="number" wire:model="rating" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Comment:</label>
            <textarea class="form-control" wire:model="comment" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send review</button>
      </div>
    </div>
  </div>
</div>
</div>

