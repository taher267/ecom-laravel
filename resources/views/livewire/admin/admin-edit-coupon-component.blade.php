<div>
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6"><h4>Edit coupon</h4></div>
                        <div class="col-md-6"><a class="btn btn-primary pull-right btn-lg" href="{{route('admin.coupons')}}"><i class="fa fa-group"></i> All Coupons</a></div>
                        </div>
                    </div>
                    <div class="panel-body row">
                        <div class="col-lg-8 col-md-8 mx-auto">
                            @if (Session::has('msg'))
                                <div class="fz-14 alert alert-{{substr(Session::get('msg'), -3) =='!!!' ? 'warning' : 'success'}}">
                                    {{Session::get('msg')}}
                                </div>
                            @endif
                            <form class="" wire:submit.prevent="storeCoupon">

                                <div class="input-group form-group field reqrd">
                                    <span class="spanWidth input-group-text" id="basic-addon1">Coupon Code</span>
                                    <input type="text" name="code" class="form-control valClass" placeholder="Coupon Code..." wire:model="code" required>
                                </div>
                                @error('code')<div class="alert alert-danger">{{$message}}</div>@enderror

                                <div class="input-group form-group field reqrd">
                                    <span class="spanWidth input-group-text" id="basic-addon1">Coupon Type</span>
                                    <select name="type" class="form-control valClass" required wire:model="type">
                                        <option value="">Select Type...</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percent">Percent</option>
                                    </select>
                                </div>
                                @error('type')<div class="alert alert-danger">{{$message}}</div>@enderror

                                  <div class="input-group form-group field reqrd" id="from_group_cat_slug">
                                    <span class="spanWidth input-group-text" id="basic-addon1">Coupon Value</span>
                                    <input  wire:model="value" type="text" name="value" class="form-control valClass" placeholder="Coupon value..." required>
                                </div>
                                @error('value')<div class="alert alert-danger">{{$message}}</div>@enderror

                                  <div class="input-group form-group field reqrd" id="from_group_cat_slug">
                                    <span class="spanWidth input-group-text" id="basic-addon1">Cart Value</span>
                                    <input  wire:model="cart_value" type="text" name="cart_value" class="form-control valClass" placeholder="Cart value..." required>
                                </div>
                                <div class="form-group">@error('cart_value') <div class="alert alert-danger">{{$message}}</div> @enderror </div>
                                <div class="input-group form-group field reqrd" wire:ignore>
                                    <span class="input-group-text" id="basic-addon1">Expiry Date</span>
                                    <input  wire:model="expiry_date" type="date" id="coupon_expiry_date" name="expiry_date" class="form-control valClass" placeholder="Expiry Date..." required>
                                </div>
                                <div class="form-group">@error('expiry_date') <div class="alert alert-danger">{{$message}}</div> @enderror </div>

                                <div class="form-group actions">
                                    <button id="add_coupon_update" type="{{ ( !$errors->any()  && $code   && $type && $value && $cart_value ) ?'submit': 'button' }}"  class="btttt btn btn-primary form-control" {{ ( !$errors->any()  && $code   && $type && $value && $cart_value ) ? '': 'disabled'}} >Update <i class="fa fa-arrow-up"></i></button>
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


// var count = $('.spanWidth').length;

//         $(document).ready(function(){
//    alert($(".spanWidth").width());
// })


// $(window).load(function() {
// var makeArray = [];
// var classLen = $('.spanWidth').length ;
// for(i=0; i<= classLen; i++){
//     makeArray[i] = $(this).width();
// }
// alert(makeArray);
// $('.spanWidth').each(function() {
//    var arr =  $($(this).width()).split('|')
//     alert( arr );
// makeArray =$(this).width();
    // if ($(this).val().length == 0 ) {
    //     $('button#add_coupon_save').attr('disabled', true);
    // }

    // else{
    //     $('button#add_coupon_save').removeAttr('disabled');
    // }
// });
// alert(makeArray);
});
    </script>
@endpush
