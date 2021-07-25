<div>


    <div class="container pt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6"><h4>Edit Category</h4></div>
                        <div class="col-md-6"><a class="btn btn-primary pull-right btn-lg" href="{{route('admin.categories')}}"><i class="fa fa-group"></i> All Category</a></div>
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
                                    <div class="errors_edit d-block" id="errors_edit">
                                        @foreach ($errors->all() as $err)
                                            <div class="alert alert-danger">{{$err}}</div>
                                        @endforeach
                                    </div>
                                @endif
                                @if ( ($slugYes == ' ' || $slugYes != 'avaiable') ) {{--&& ! $errors->any() --}}
                                        <div class="alert alert-danger">Already Exists !</div>
                                    {{-- @else
                                    <div class="alert alert-success">avaiable, you can add it!</div> --}}
                                @endif
                            <form  class="" wire:submit.prevent="updateCategory">

                                <div class="input-group form-group">
                                    <span class="input-group-text f-z-16" id="basic-addon1">Category Name</span>
                                    <input type="text" name="name" id="add_category_name" class="form-control f-z-16" placeholder="Category Name..." aria-describedby="helpId" wire:keyup="generateSlug" wire:model="name" {{--wire:keydown="generateSlug"--}}>
                                </div>

                                <div class="form-group input-group" id="from_group_cat_slug">
                                    <span class="input-group-text f-z-16" id="basic-addon1">Category Slug</span>
                                    <input style="color: {{ ($slugYes=='avaiable' && $slugYes !=' ')?'green': 'red' }}" wire:model="slug" type="text" name="slug" id="category_slug" class="form-control cat_converted_slug f-z-16" placeholder="Category Slug..." aria-describedby="helpId" >

                                </div>
                                <style>
                                    div#from_group_cat_slug::after {
                                    position: absolute;
                                    z-index: 9;
                                    @isset($slugYes)
                                        /* @if($slugYes == ' ' || $slugYes != 'avaiable')
                                        content: 'not avaiable';color:red;
                                        @elseif ($slugYes == 'avaiable' && $slugYes != ' ')
                                        content: 'avaiable';color:green;
                                        @endif */
                                        content:"{{($slugYes=='avaiable' && ' ' != $slugYes )?$slugYes: 'not avaiable' }} ";
                                        color:{{($slugYes=='avaiable' && $slugYes !=' ')?'green': 'red' }};
                                    @endisset
                                    right: 9px;font-size: 16px;top: 5px;

                                }
                                </style>

                                <script>
                                    // function messageHide(){
                                    // setTimeout(function(){
                                    //     document.getElementById('errors_edit').style.display='none';
                                    // }, 5000);
                                // }
                                </script>
                                <div class="form-group">
                                    <button type="{{--($slugYes=='avaiable' && ' ' != $slugYes )?'submit': 'button' --}}" class="f-z-16 btn btn-primary form-control" {{--($slugYes=='avaiable' && ' ' != $slugYes )? '': 'disabled' --}}>Update <i class="fa fa-arrow-up"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
