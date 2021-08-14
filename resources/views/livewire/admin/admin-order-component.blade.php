<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
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
                        <th>View</th>
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
                        <th>View</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{!! $order->id!!}</td>
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
                        <td><a href="{!!route('admin.orderdetails', $order->id)!!}"><i class="fa fa-eye btn-lg"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        jQuery(function(){
            jQuery('.navbar-nav.bg-gradient-primary.sidebar.sidebar-dark.accordion').addClass('toggled');
        });
    </script>
@endpush
