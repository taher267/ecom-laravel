<div>
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a
        href="#">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <form wire:submit.prevent="ordersStatusesUpdate">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-lg-2">
                    <h6 class="m-0 font-weight-bold text-primary">All Orders</h6>
                </div>
                <div class="col-lg-3">
                    <select name="status_value" class="form-control" wire:model="status_value" id="">
                        <option value="delivered">Delivered</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </div>
                <div class="col-lg-5">
                    @if (Session::has('msg'))
                        <div class="alert alert-success">
                            {{Session::get('msg')}}
                        </div>
                    @endif
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>OrderId</th>
                            <th>Subtotal</th>
                            <th>Discount</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>F Name</th>
                            <th>L Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Zipcode</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>OrderId</th>
                            <th>Subtotal</th>
                            <th>Discount</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>F Name</th>
                            <th>L Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Zipcode</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{!! $order->id!!} <input type="checkbox" name="ordersstatus" wire:model="ordersstatus" value="{!! $order->id!!} "></td>
                            <td>{!! $order->subtotal!!}</td>
                            <td>{!! $order->discount!!}</td>
                            <td>{!! $order->tax!!}</td>
                            <td>{!! $order->total!!}</td>
                            <td>{!! $order->first_name!!}</td>
                            <td>{!! $order->last_name!!}</td>
                            <td>{!! $order->mobile!!}</td>
                            <td>{!! $order->email!!}</td>
                            <td>{!! $order->zipcode!!}</td>
                            <td>{!! $order->status!!}</td>
                            <td>{!! $order->created_at!!}</td>
                            <td>
                                <a href="{!!route('admin.orderdetails', $order->id)!!}"><i class="fa fa-eye btn-lg"></i></a>
                                <a href="#" wire:click.prevent="deleteOrder({!! $order->id !!})"><i class="fa fa-trash btn-sm text-danger"></i></a>
                                <div class="dropdown">
                                    <button class="btn btn-success btn-sm drowdown-toggle" type="submit" data-toggle="dropdown">Status <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li class="form-control border-0"><a href="#" wire:click.prevent="updateOrderStatus({{$order->id}},'delivered')">Delivered</a></li>
                                        <li class="form-control border-0"><a href="#" wire:click.prevent="updateOrderStatus({!!$order->id!!},'canceled')">Canceled</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>

</div>
@push('scripts')
    <script>
        jQuery(function(){
            jQuery('.navbar-nav.bg-gradient-primary.sidebar.sidebar-dark.accordion').addClass('toggled');
        });
    </script>
@endpush
