@section('title', 'Order Details')
<div class="">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="row">
                    <div class="col-lg-6"><div class="panel-heading alert"><h4 class="">Order Items</h4></div></div>
                    <div class="col-lg-6  text-end"><a class="btn btn-primary" href="{{route('admin.orders')}}">All Orders</a></div>
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
                            {{-- <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4 fw-bold">First Name</div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 col-8">{{$order->first_name}}</div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4 fw-bold">Last Name</div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 col-8">{{$order->last_name}}</div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4 fw-bold">Moblie</div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 col-8">{{$order->mobile}}</div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4 fw-bold">Email</div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 col-8">{{$order->email}}</div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4 fw-bold">Line 1</div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 col-8">{{$order->line1}}</div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4 fw-bold">Line 2</div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 col-8">{{$order->line2 ? $order->line2 :'-------'}}</div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4 fw-bold">Province</div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 col-8">{{$order->province}}</div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4 fw-bold">Zip-code</div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 col-8">{{$order->zipcode}}</div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4 fw-bold">City</div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 col-8">{{$order->city}}</div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4 fw-bold">Country</div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 col-8">{{$order->country}}</div> --}}

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
                        <div class="card-header text-center" style="font-size: 100px; color: #2F56C8"><i class="fa fa-paper-plane"></i></div>
                        <div class="card-body transaction-body">
                          <h5 class="card-title"><b><i class="fa fa-user"></i></b> {{$order->user->name}}</h5>
                          {{-- {{$order->transaction->id}} --}}
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
                                  <td><b><i wire:click.prevent="changeStatus('{{$order->transaction->status=='pending' ? 'approved': 'pending'}}',{{$order->transaction->id}})" class="fas fa-thermometer-@if($order->transaction->status=='pending')quarter text-danger @elseif($order->transaction->status=='approved')three-quarters text-primary @endif"></i></b></td>
                                  <td class="text-capitalize">{{ $order->transaction->status}}</td>
                                  <td>
                                      <form class="" wire:submit.prevent="changeStatus('{{$status}}', {{$order->transaction->id}})">

                                        <select id="order_status_change" class="btn-sm text-capitalize " style="" name="status" wire:model="status">
                                            @php
                                                $options=[
                                                    'approved', 'pending', 'declined', 'refunded'
                                                ];
                                            @endphp
                                            @foreach ($options as $option)
                                                @if ($option == $order->transaction->status)
                                                    <option disabled class="bg-danger" selected value="{{$option}}">{{$option}}</option>
                                                @else
                                                    <option value="{{$option}}">{{$option}}</option>
                                                @endif
                                            @endforeach
                                          </select>
                                          <button id="change_btn" type="submit" class="btn btn-info btn-sm mt-2">Submit</button>
                                      </form>
                                  </td>
                              </tr>
                              <tr>
                                  <td><b><i class="fas fa-calendar-alt"></i></b></td>
                                  <td>{{ $order->transaction->created_at}}</td>
                              </tr>
                          </table>

                        </div>
                    </div>

            </div>
            <i class="fas fa-thermometer-three-quarters"></i>
            <i class="fas fa-file-invoice-dollar"></i>
            <i class="far fa-money-bill-alt"></i>
            <i class="fas fa-money-bill-alt"></i>
            <i class="fas fa-money-bill-wave"></i>
            <i class="fas fa-thermometer-quarter"></i>
            <i class="fab fa-intercom"></i>
            <i class="fas fa-calendar-alt"></i>
        </div>
    </div>

</div>
@push('scripts')
    <script>
        jQuery(function(){
            jQuery('.navbar-nav.bg-gradient-primary.sidebar.sidebar-dark.accordion').addClass('toggled');
            jQuery('#change_btn').css('display','none');
            jQuery('#order_status_change').on('change', function(){
                var option = $('option:selected', this).val();
                if( option != '{{$order->transaction->status}}'){
                    jQuery('#change_btn').css('display','block');
                }else{
                    jQuery('#change_btn').css('display','none');
                }
            });
        });
    </script>
@endpush
