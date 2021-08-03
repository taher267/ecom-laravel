<div>
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6"><h4>All Category</h4></div>
                        <div class="col-md-6"><a class="btn btn-primary pull-right btn-lg" href="{{route('admin.addcategory')}}"><i class="fa fa-plus"></i> Add New</a></div>
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
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td class="text-capitalize">{{$category->name}}</td>
                                    <td>{{$category->slug}}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin.editcategory', $category->slug)}}" class="mx-3"><i class="fa fa-edit fa-2x"></i></a>
                                        <a href="#" onclick="confirm('Are you Sure, to delete this product?') || event.stopImmediatePropagation()" wire:click.prevent="deleteCategory({{$category->id}})" class="text-danger"><i class="fa fa-trash fa-2x"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
