<div class="container pt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6"><h4>Edit Slide</h4></div>
                    <div class="col-md-6"><a class="btn btn-primary pull-right btn-lg" href="{{route('admin.homeslider')}}"><i class="fa fa-group"></i> All Slides</a></div>
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
                        <form class="form" wire:submit.prevent="updateSlide">
                            <div class="input-group form-group">
                                <span class="input-group-text f-z-16" id="basic-addon1">Slide Title<sup class="text-danger">*</sup></span>
                                <input type="text" name="title" id="slide_title" class="form-control f-z-16" placeholder="Slide Title..." wire:model="title" >
                            </div>
                            @error('title')<p class="text-warning">{{$message}}</p>@enderror
                            <div class="input-group form-group">
                                <span class="input-group-text f-z-16" id="basic-addon1">Slide Subtitle<sup class="text-primary">*</sup></span>
                                <input type="text" name="subtitle" id="add_Slide_name" class="form-control f-z-16" placeholder="Slide Subtitle..."   wire:model="subtitle">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-text f-z-16" id="basic-addon1">Price<sup class="text-primary">*</sup></span>
                                <input wire:model="price" rows="3" type="text" name="price" class="form-control f-z-16" placeholder="Slide Price..."   >
                            </div>
                            @error('price')<p class="text-warning">{{$message}}</p>@enderror
                            <div class="form-group input-group">
                                <span class="input-group-text f-z-16" id="basic-addon1">Link<sup class="text-primary">*</sup></span>
                                <input wire:model="link" rows="3" type="text" name="link" class="form-control f-z-16" placeholder="Slide Link..."   >
                            </div>
                            @error('link')<p class="text-warning">{{$message}}</p>@enderror
                            <div class="form-group input-group">
                                <span class="input-group-text f-z-16" id="basic-addon1">Status<sup class="text-primary">*</sup></span>
                                <select name="status" wire:model="status" class="form-control f-z-16">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            {{-- <input type="" disabled name="slide_id" wire:model="slide_id" > --}}
                            @error('status')<p class="text-warning">{{$message}}</p>@enderror
                            <div class="form-group input-group">
                                <span class="input-group-text f-z-16" id="basic-addon1">Image<sup class="text-primary">*</sup></span>
                                <input type="file" name="newimage" wire:model="newimage" class="form-control f-z-16" placeholder="Slide Image...">
                            </div>
                            @error('image')<p class="text-warning">{{$message}}</p>@enderror
                            @if ($newimage)
                                <img class="" src="{{$newimage->temporaryUrl()}}" width="120">
                            @else
                                <img class="" src="{{asset('assets/images/home-slider/'. $image)}}" width="120">
                            @endif
                            <div class="form-group">
                                <button type="{{--($checkSlug=='avaiable' && ' ' != $checkSlug )?'submit': 'button' --}}submit" class="f-z-16 btn btn-primary form-control" {{--($checkSlug=='avaiable' && ' ' != $checkSlug )? '': 'disabled' --}}><i class="fa fa-plus"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
