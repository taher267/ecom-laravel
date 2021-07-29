<div class="container pt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6"><h4>All Sliders</h4></div>
                    <div class="col-md-6"><a class="btn btn-primary pull-right btn-lg" href="{{route('admin.addhomeslide')}}"><i class="fa fa-plus"></i> Add New</a></div>
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
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Price</th>
                                <th>Link</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($homeSlides as $slide)
                            <tr>
                                <td>{{$slide->title}}</td>
                                <td class="text-capitalize">{{$slide->subtitle}}</td>
                                <td>{{$slide->price}}</td>
                                <td>{{$slide->link }}</td>
                                <td>{{1 == $slide->status ? 'Active': 'Inactive'}}</td>
                                <td> <img src="{{asset('assets/images/home-slider/'. $slide->image)}}" alt="Slider" width="120"> </td>
                                <td class="text-center">
                                    <a href="{{route('admin.edithomeslide', $slide->id)}}" class="mx-3"><i class="fa fa-edit fa-2x"></i></a>
                                    <a href="#" wire:click.prevent="deleteCategory({{$slide->id}})" class="text-danger"><i class="fa fa-trash fa-2x"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$homeSlides->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
