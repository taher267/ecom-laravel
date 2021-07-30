<div class="container pt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6"><h4>Add Product Category</h4></div>
                    <div class="col-md-6"><a class="btn btn-primary pull-right btn-lg" href="{{--route('admin.categories')--}}"><i class="fa fa-group"></i> All Category</a></div>
                    </div>
                </div>
                <div class="panel-body row">
                    <div class="col-lg-8 col-md-8 mx-auto">
                        @if (Session::has('msg'))
                            <div class="alert alert-success">
                                {{Session::get('msg')}}
                            </div>
                        @endif

                            {{-- @if ($errors->any())
                                @foreach ($errors->all() as $err)
                            <div class="alert alert-danger">{{$err}}</div>
                                @endforeach
                            @endif --}}
                        <form class="" wire:submit.prevent="updateHomeCategory">
                            <div class="input-group form-group" wire:ignore>
                                <span class="input-group-text f-z-16" id="basic-addon1">Choose Categories</span>
                                <select name="selected_categories[]" required wire:model="selected_categories" class="f-z-16 text-capitalize sel_categories"  multiple="multiple">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" name="name" id="add_category_name" class="form-control f-z-16" placeholder="Category Name..." aria-describedby="helpId" wire:keyup="generateSlug" wire:model="name" wire:keydown="generateSlug"> --}}
                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-text f-z-16" id="basic-addon1">Product</span>
                                {{-- <select name="no_of_products" required wire:model="no_of_products" class="form-control text-capitalize f-z-16">
                                    <option>Select Product</option>
                                    @foreach ($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select> --}}
                                <input type="number" name="no_of_products" required wire:model="numberofproducts" class="form-control text-capitalize f-z-16">
                            </div>
                            {{-- @error('no_of_products') {{$message}} @enderror --}}

                            {{-- @error('sel_categories') {{$message}} @enderror --}}
                            <div class="form-group">
                                <button type="{{--($slugYes=='avaiable' && ' ' != $slugYes )?'submit': 'button' --}}submit" class="f-z-16 btn btn-primary form-control" {{--($slugYes=='avaiable' && ' ' != $slugYes )? '': 'disabled' --}}><i class="fa fa-plus"></i> Add New Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>

        $(document).ready(function(){
        $('.sel_categories').select2();

        $('.sel_categories').on('change', function(e){
            const data = $('.sel_categories').select2("val");
            @this.set('selected_categories', data);
        });
        // $('.select2-container').addClass('form-control p-0 f-z-16');
    });
    </script>
@endpush

