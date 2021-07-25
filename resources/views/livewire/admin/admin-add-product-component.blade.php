<div>
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6"><h4>Add New Product</h4></div>
                        <div class="col-md-6"><a class="btn btn-primary pull-right btn-lg" href="{{route('admin.products')}}"><i class="fa fa-group"></i> All Product</a></div>
                        </div>
                    </div>
                    <div class="panel-body row">
                        <div class="col-lg-8 col-md-8 mx-auto">
                            @if (Session::has('msg'))
                                <div class="alert alert-success">
                                    {{Session::get('msg')}}
                                </div>
                            @endif

                                @if ($errors->any())
                                    @foreach ($errors->all() as $err)
                                <div class="alert alert-danger">{{$err}}</div>
                                    @endforeach
                                @endif
                            <form class="" wire:submit.prevent="storeProduct">

                                <div class="input-group form-group">
                                    <span class="input-group-text f-z-16" id="basic-addon1">Product Name<sup class="text-danger">*</sup></span>
                                    <input type="text" name="name" id="add_product_name" class="form-control f-z-16" placeholder="Product Name..."  wire:keyup="generateSlug" wire:model="name" {{--wire:keydown="generateSlug"--}}>
                                </div>

                                <div class="form-group input-group" id="from_group_pro_slug">
                                    <span class="input-group-text f-z-16" id="basic-addon1">Product Slug<sup class="text-danger">*</sup></span>
                                    <input style="color: {{($checkSlug=='avaiable' && $checkSlug !=' ')?'green': 'red' }}" wire:model="slug" type="text" name="slug" id="Product_slug" class="form-control cat_converted_slug f-z-16" placeholder="Product Slug..."  >
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-text f-z-16" id="basic-addon1">Short Description<sup class="text-primary">*</sup></span>
                                    <textarea wire:model="short_description" rows="3" type="text" name="short_description" class="form-control f-z-16" placeholder="Product Short Description..."   > </textarea>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-text f-z-16 text-danger" id="basic-addon1">Description<sup class="text-danger">*</sup></span>
                                    <textarea rows="6" wire:model="description" type="text" name="description" class="form-control f-z-16" placeholder="Product Description..................." ></textarea>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-text f-z-16" id="basic-addon1">Regular Price<sup class="text-danger">*</sup></span>
                                    <input type="number" name="regular_price" class="form-control f-z-16" placeholder="Product regular price..."  wire:model="regular_price">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-text f-z-16" id="basic-addon1">Sale Price<sup class="text-primary">*</sup></span>
                                    <input type="number" name="sale_price" class="form-control f-z-16" placeholder="Product Sale price..."  wire:model="sale_price">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-text f-z-16" id="basic-addon1">SKU<sup class="text-danger">*</sup></span>
                                    <input type="text" name="SKU" wire:model="SKU" class="form-control f-z-16" placeholder="Product SKU...">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-text f-z-16" id="basic-addon1">Stock Status<sup class="text-danger">*</sup></span>
                                    <select name="stock_status" wire:model="stock_status" class="form-control f-z-16">
                                            <option value="0">In Stock</option>
                                            <option value="outofstock">Out of Stock</option>
                                    </select>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-text f-z-16" id="basic-addon1">Featured<sup class="text-danger">*</sup></span>
                                    <select name="featured" wire:model="featured" class="form-control f-z-16">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-text f-z-16" id="basic-addon1">Quantity<sup class="text-danger">*</sup></span>
                                    <input type="number" name="quantity" wire:model="quantity" class="form-control f-z-16" placeholder="Product Quantity...">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-text f-z-16" id="basic-addon1">Image<sup class="text-primary">*</sup></span>
                                    <input type="file" name="image" wire:model="image" class="form-control f-z-16" placeholder="Product Image...">
                                </div>
                                @if ($image)
                                    <img class="" src="{{$image->temporaryUrl()}}" width="120">
                                @endif

                                <div class="form-group input-group">
                                    <span class="input-group-text f-z-16" id="basic-addon1">Category<sup class="text-danger">*</sup></span>
                                    <select name="category_id" wire:model="category_id" class="form-control f-z-16 text-capitalize">
                                        <option value="0">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <style>
                                    div#from_group_pro_slug::after {
                                    position: absolute;
                                    z-index: 9;
                                    @isset($checkSlug)
                                        content:"{{($checkSlug=='avaiable' && ' ' != $checkSlug )?$checkSlug: 'not avaiable' }} ";
                                        color:{{($checkSlug=='avaiable' && $checkSlug !=' ')?'green': 'red' }};
                                    @endisset
                                    right: 9px;font-size: 16px;top: 5px;

                                }
                                </style>

                                {{-- <span class="avaiable_or_not">avaiable_or_not</span> --}}
                                {{-- <input type="hidden" class="slug_exist_or_not" value="{{($confirmSlug)? $confirmSlug :'no'}}"> --}}
                                <div class="form-group">
                                    <button type="{{--($checkSlug=='avaiable' && ' ' != $checkSlug )?'submit': 'button' --}}submit" class="f-z-16 btn btn-primary form-control" {{--($checkSlug=='avaiable' && ' ' != $checkSlug )? '': 'disabled' --}}><i class="fa fa-plus"></i> Add Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
