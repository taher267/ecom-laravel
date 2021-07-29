<div class="container my-5 py-5">
    <div class="row">
        <div class="col-lg-3">
            <ul>
                <li><a href="{{route('admin.categories')}}">All Category</a></li>
                <li><a href="{{route('admin.addcategory')}}">Add Category</a></li>
                {{-- <li><a href="{{route('admin.editcategory')}}">Edit Category</a></li> --}}
                <li><a href="{{route('admin.products')}}">All Products</a></li>
                <li><a href="{{route('admin.addproduct')}}">Add Products</a></li>
                {{-- <li><a href="{{route('admin.editproduct')}}">Edit Products</a></li> --}}
            </ul>
        </div>
        <div class="col-lg-9">
           <div class="row">
            <h1>All Category</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                       <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td>
                            <a href="{{route('admin.editcategory', $category->slug)}}"><i class="fa fa-edit"></i></a>
                            <a href="{{route('admin.addcategory')}}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
           </div>
        </div>
    </div>
</div>
