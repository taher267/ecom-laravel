    {{-- Category Menu --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('user.orders')}}" data-toggle="collapse" data-target="#userOrders"
            aria-expanded="true" aria-controls="userOrders">
            <i class="fas fa-fw fa-object-group"></i>
            <span>All Orders</span>
        </a>
        <div id="userOrders" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('user.orders')}}">All Orders</a>
            </div>
        </div>
    </li>

    {{-- Category Menu --}}
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.categories')}}" data-toggle="collapse" data-target="#adminProduct"
            aria-expanded="true" aria-controls="adminProduct">
            <i class="fas fa-fw fa-layer-group"></i>
            <span>Products</span>
        </a>
        <div id="adminProduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('admin.products')}}">All products</a>
                <a class="collapse-item" href="{{route('admin.addproduct')}}">Add product</a>
            </div>
        </div>
    </li> --}}

    {{-- Category Menu --}}
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.orders')}}" data-toggle="collapse" data-target="#adminOrders"
            aria-expanded="true" aria-controls="adminOrders">
            <i class="fas fa-fw fa-hand-rock"></i>
            <span>Orders</span>
        </a>
        <div id="adminOrders" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('admin.orders')}}">All Orders</a>
            </div>
        </div>
    </li> --}}
