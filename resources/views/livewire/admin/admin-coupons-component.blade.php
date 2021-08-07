<div>
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6"><h4>All Coupons</h4></div>
                        <div class="col-md-6"><a class="btn btn-primary pull-right btn-lg" href="{{route('admin.addcoupon')}}"><i class="fa fa-plus"></i> Add New</a></div>
                        </div>
                    </div>
                    @if (Session::has('msg'))
                                <div class="alert alert-success">
                                    {{Session::get('msg')}}
                                </div>
                            @endif
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead style="border-bottom: 1px solid !important; {{--border-color:transparent !important;--}}">
                                <tr>
                                    <th>Id</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Coupon Value</th>
                                    <th>Cart Value</th>
                                    <th>Expiry Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{$coupon->id}}</td>
                                    <td class="text-capitalize">{{$coupon->code}}</td>
                                    <td class="text-capitalize">{{$coupon->type}}</td>
                                    <td>{{$coupon->type =='fixed' ? '$'. $coupon->value : $coupon->value . '%'}}</td>
                                    <td>{{$coupon->cart_value}}</td>
                                    <td>{{$coupon->expiry_date}}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin.editcoupon', $coupon->id)}}" class="mx-3"><i class="fa fa-edit fa-2x"></i></a>
                                        <a href="#" onclick="confirm('Are you Sure, to delete this coupon?') || event.stopImmediatePropagation()" wire:click.prevent="deleteCoupon({{$coupon->id}})" class="text-danger"><i class="fa fa-trash fa-2x"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$coupons->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
