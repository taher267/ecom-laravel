<div>
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6"><h4>Add New Category</h4></div>
                        <div class="col-md-6"><a class="btn btn-primary pull-right btn-lg" href="{{route('admin.coupons')}}"><i class="fa fa-group"></i> All Coupons</a></div>
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
                            <form class="" wire:submit.prevent="storeCoupon">

                                <div class="input-group form-group field reqrd">
                                    <span class="input-group-text" id="basic-addon1">Coupon Code</span>
                                    <input type="text" name="code" class="form-control valClass" placeholder="Coupon Code..." wire:model="code" required>
                                </div>
                                @error('code')<div class="alert alert-danger">{{$message}}</div>@enderror

                                <div class="input-group form-group field reqrd">
                                    <span class="input-group-text" id="basic-addon1">Coupon Type</span>
                                    <select name="type" class="form-control valClass" required wire:model="type">
                                        <option value="">Select Type...</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percent">Percent</option>
                                    </select>
                                </div>
                                @error('type')<div class="alert alert-danger">{{$message}}</div>@enderror

                                  <div class="input-group form-group field reqrd" id="from_group_cat_slug">
                                    <span class="input-group-text" id="basic-addon1">Coupon Value</span>
                                    <input  wire:model="value" type="text" name="value" class="form-control valClass" placeholder="Coupon value..." required>
                                </div>
                                @error('value')<div class="alert alert-danger">{{$message}}</div>@enderror

                                  <div class="input-group form-group field reqrd" id="from_group_cat_slug">
                                    <span class="input-group-text" id="basic-addon1">Cart Value</span>
                                    <input  wire:model="cart_value" type="text" name="cart_value" class="form-control valClass" placeholder="Cart value..." required>
                                </div>
                                <div class="form-group">@error('cart_value') <div class="alert alert-danger">{{$message}}</div> @enderror </div>

                                <div class="form-group actions">
                                    <button id="add_coupon_save" type="{{ ( !$errors->any()  && $code   && $type && $value && $cart_value ) ?'submit': 'button' }}"  class="btttt btn btn-primary form-control" {{ ( !$errors->any()  && $code   && $type && $value && $cart_value ) ? '': 'disabled'}} ><i class="fa fa-plus"></i> Save</button>
                                    <div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>

$(document).ready(function() {
    // $('button#add_coupon_save').attr('disabled', true);
  $('.field .valClass').on('change keyup',function() {

    var empty = false;
    $('.field .valClass').each(function() {

        if ($(this).val().length == 0 ) {
            $('button#add_coupon_save').attr('disabled', true);
        }

        else{
            $('button#add_coupon_save').removeAttr('disabled');
        }
    });
  });
});

</script>

@endpush
