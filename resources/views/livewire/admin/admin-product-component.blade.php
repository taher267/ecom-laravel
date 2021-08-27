<div>

    <div class="container pt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row mb-3">
                            <div class="col-md-6"><h4>All Product</h4></div>
                        <div class="col-md-6 text-right"><a class="btn btn-primary pull-right" href="{{route('admin.addproduct')}}"><i class="fa fa-plus"></i> Add New</a></div>
                        </div>
                    </div>
                    @if (Session::has('msg'))
                                <div class="alert alert-success">
                                    {{Session::get('msg')}}
                                </div>
                            @endif
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead class="" style="border-bottom: 1px solid !important; {{--border-color:transparent !important;--}}">
                                <tr class="text-uppercase text-center">
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Short Description</th>
                                    <th>Description</th>
                                    <th>Regular Price</th>
                                    <th>Sale Price</th>
                                    <th>SKU</th>
                                    <th>Status</th>
                                    <th>Featured</th>
                                    <th>Qry</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td class="text-capitalize">{{$product->name}}</td>
                                    <td>{!! $product->short_description !!}</td>
                                    <td>{!! $product->description !!}</td>
                                    <td>{{$product->regular_price}}</td>
                                    <td>{{$product->sale_price}}</td>
                                    <td>{{$product->SKU}}</td>
                                    <td>{{$product->stock_status}}</td>
                                    <td>{{($product->featured) ? 'Yes': 'No'}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td><img class="thumbnail" src="{{asset('assets/images/products/'. $product->image)}}" alt=""></td>
                                    <td>{{$product->category->name}}</td>
                                    <td class="text-center">
                                        <a href="{{route('product.details', $product->slug)}}" class="mx-3"><i class="fa fa-eye fa-2x"></i></a>
                                        <a href="{{route('admin.editproduct', $product->slug)}}" class="mx-3"><i class="fa fa-edit fa-2x"></i></a>
                                        <a href="#" onclick="confirm('Are you Sure, to delete this product?') || event.stopImmediatePropagation()" wire:click.prevent="deleteproduct({{$product->id}})" class="text-danger"><i class="fa fa-trash fa-2x"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$products->links()}}
                    </div>
                </div>
            </div>
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
