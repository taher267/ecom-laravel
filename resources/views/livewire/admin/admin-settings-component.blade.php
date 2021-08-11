
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6"><h4>Settings</h4></div>
                        <div class="col-md-6"><a class="btn btn-primary pull-right btn-lg" href="{{--route('admin.categories')--}}"><i class="fa fa-group"></i></a></div>
                        </div>
                    </div>
                    <div class="panel-body row">
                        <div class="col-lg-8 col-md-8 mx-auto">
                            @if (Session::has('msg'))
                                <div class="alert alert-success">
                                    {{Session::get('msg')}}
                                </div>
                            @endif

                            <form wire:submit.prevent="saveSettings">

                                <div class="input-group form-group">
                                    <span class="input-group-text" id="basic-addon1">Email</span>
                                    <input type="email" name="email" id="" class="form-control" placeholder="Email..." wire:model="email">
                                </div>
                                @error('email')<div class="text-danger">{{$message}}</div>@enderror

                                <div class="input-group form-group">
                                    <span class="input-group-text" id="basic-addon1">Phone</span>
                                    <input type="number" name="phone" id="" class="form-control" placeholder="Phone..." wire:model="phone">
                                </div>
                                @error('phone')<div class="text-danger">{{$message}}</div>@enderror

                                <div class="input-group form-group">
                                    <span class="input-group-text" id="basic-addon1">Phone 2</span>
                                    <input type="number" name="phone2" id="" class="form-control" placeholder="Phone2..." wire:model="phone2">
                                </div>
                                @error('phone2')<div class="text-danger">{{$message}}</div>@enderror

                                <div class="input-group form-group">
                                    <span class="input-group-text" id="basic-addon1">Address</span>
                                    <textarea type="text" name="address" id="" class="form-control" wire:model="address">Address here..</textarea>
                                </div>
                                @error('address')<div class="text-danger">{{$message}}</div>@enderror

                                <div class="input-group form-group">
                                    <span class="input-group-text" id="basic-addon1">Map</span>
                                    <input type="text" name="map" id="" class="form-control" placeholder="Map..." wire:model="map">
                                </div>
                                @error('map')<div class="text-danger">{{$message}}</div>@enderror

                                <div class="input-group form-group">
                                    <span class="input-group-text" id="basic-addon1">Twitter</span>
                                    <input type="text" name="twitter" id="" class="form-control" placeholder="Twitter..." wire:model="twitter">
                                </div>
                                @error('twitter')<div class="text-danger">{{$message}}</div>@enderror

                                <div class="input-group form-group">
                                    <span class="input-group-text" id="basic-addon1">Facebook</span>
                                    <input type="text" name="facebook" id="" class="form-control" placeholder="facebook..." wire:model="facebook">
                                </div>
                                @error('facebook')<div class="text-danger">{{$message}}</div>@enderror

                                <div class="input-group form-group">
                                    <span class="input-group-text" id="basic-addon1">Instagram</span>
                                    <input type="text" name="instagram" id="" class="form-control" placeholder="Instagram..." wire:model="instagram">
                                </div>
                                @error('instagram')<div class="text-danger">{{$message}}</div>@enderror

                                <div class="input-group form-group">
                                    <span class="input-group-text" id="basic-addon1">Youtube</span>
                                    <input type="text" name="youtube" id="" class="form-control" placeholder="youtube..." wire:model="youtube">
                                </div>
                                @error('youtube')<div class="text-danger">{{$message}}</div>@enderror

                                <div class="form-group input-group">
                                    <span class="input-group-text bg-transparant border-0" style="width: 120px;"></span>
                                    <button type="{{$errors->any()?'button': 'submit' }}" class="btn btn-primary form-control" {{$errors->any() ? 'disabled': '' }}><i class="fa fa-plus"></i> Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
