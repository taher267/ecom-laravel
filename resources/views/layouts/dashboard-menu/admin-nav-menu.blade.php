    {{-- Category Menu --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#adminCategory"
            aria-expanded="true" aria-controls="adminCategory">
            <i class="fas fa-fw fa-object-group"></i>
            <span>Categories</span>
        </a>
        <div id="adminCategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('admin.categories')}}">All Categories</a>
                <a class="collapse-item" href="{{route('admin.addcategory')}}">Add Category</a>
            </div>
        </div>
    </li>

    {{-- Product Menu --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#adminProduct"
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
    </li>

    {{-- Order Menu --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.orders')}}" data-toggle="collapse" data-target="#adminOrders"
            aria-expanded="true" aria-controls="adminOrders">
            <i class="fas fa-fw fa-hand-rock"></i>
            <span>Orders</span>
        </a>
        <div id="adminOrders" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('admin.orders')}}">All Orders</a>
                {{-- <a class="collapse-item" href="{{route('admin.addproduct')}}">Add product</a> --}}
            </div>
        </div>
    </li>
