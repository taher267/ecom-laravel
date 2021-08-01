
@section('title', 'On Sale Setting')
<div class="container pt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6"><h4>Sale Setting</h4></div>
                    <div class="col-md-6">{{--<a class="btn btn-primary pull-right btn-lg" href="{{route('admin.categories')}}"><i class="fa fa-group"></i>*</a>--}}</div>
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
                        <form class="" wire:submit.prevent="updateSaledate">

                            <div class="input-group form-group">
                                <span class="input-group-text f-z-16" id="basic-addon1">Status</span>
                                <select name="status" id="" wire:model="status" class="form-control f-z-16">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="form-group input-group" id="from_group_cat_slug">
                                <span class="input-group-text f-z-16" id="basic-addon1">Sale Date</span>
                                <input  wire:model="sale_date" type="text" name="sale_date" class="form-control fz-16" placeholder="YYYY/MM/DD H:M:S" id="sale_date_time">

                            </div>

                            <div class="form-group">
                                <button type="{{--($slugYes=='avaiable' && ' ' != $slugYes )?'submit': 'button' --}}submit" class="f-z-16 btn btn-primary form-control" {{--($slugYes=='avaiable' && ' ' != $slugYes )? '': 'disabled' --}}><i class="fa fa-plus"></i> Update</button>
                            </div>
                        </form>

                        {{-- @php
                            $time12 = substr('06:02 PM', 0, 5);
                            $timeconv24 = substr('06:02 PM',0,2);
                            $timemid = substr('06:02 PM',2,3);
                            $amORpm = substr('06:02 PM', -2);
                            if ($amORpm =='PM') {
                                echo $timeconv24+12 . $timemid;
                            }else {
                                echo $time12;
                            }
                        @endphp --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        jQuery(function(){
            jQuery('#sale_date_time').datetimepicker({
                format:'Y-MM-dd h:m:s',
            }).on('dp.change', function(ev){
                var data = jQuery('#sale_date_time').val();
                @this.set('sale_date', data);
            });
        });
    </script>
@endpush
