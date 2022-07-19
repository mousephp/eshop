<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('profile')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Banner
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('file-manager')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Media Manager</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-image"></i>
            <span>Banners</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Banner Options:</h6>
                <a class="collapse-item" href="{{route('banner.index')}}">Banners</a>
                <a class="collapse-item" href="{{route('banner.create')}}">Add Banners</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Manager
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#adminCollapse" aria-expanded="true" aria-controls="adminCollapse">
            <i class="fas fa-users"></i>
            <span>Manager</span>
        </a>
        <div id="adminCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Admin Options:</h6>
                <a class="collapse-item" href="{{route('user.index')}}"> <i class="fas fa-users"></i> User</a>
                <a class="collapse-item" href="{{route('role.index')}}"> <i class="fas fa-user-tag nav-icon text-green"></i> Role</a>
                <a class="collapse-item" href="{{route('permission.index')}}"> <i class="fas fa-sitemap"></i> Permission</a>
                <a class="collapse-item" href="{{route('admin.member.index')}}"> <i class="fa fa-user-plus" aria-hidden="true"></i></i> Member</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#userCollapse" aria-expanded="true" aria-controls="userCollapse">
         <i class="fas fa-users"></i>
          <span>User</span>
        </a>
        <div id="userCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">User Options:</h6>
            <a class="collapse-item" href="{{route('user.index')}}">User</a>
    <a class="collapse-item" href="{{route('user.create')}}">Add user</a>
    </div>
    </div>
    </li>

    <!-- Divider -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#roleCollapse" aria-expanded="true" aria-controls="roleCollapse">
            <i class="fas fa-sitemap"></i>
            <span>Role</span>
        </a>
        <div id="roleCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Role Options:</h6>
                <a class="collapse-item" href="{{route('role.index')}}">Role</a>
                <a class="collapse-item" href="{{route('role.create')}}">Add Role</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#permissionCollapse" aria-expanded="true" aria-controls="permissionCollapse">
            <i class="fas fa-sitemap"></i>
            <span>Permission</span>
        </a>
        <div id="permissionCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Permission Options:</h6>
                <a class="collapse-item" href="{{route('permission.index')}}">Permission</a>
                <a class="collapse-item" href="{{route('permission.create')}}">Add Permission</a>
                <a class="collapse-item" href="{{route('permission.create-template')}}">Add Template Permission</a>
            </div>
        </div>
    </li> --}}

    <!-- Divider -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#customerCollapse" aria-expanded="true" aria-controls="customerCollapse">
         <i class="fas fa-users"></i>
          <span>Customer</span>
        </a>
        <div id="customerCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Customer Options:</h6>
            <a class="collapse-item" href="{{route('customer.index')}}">Customer</a>
    <a class="collapse-item" href="{{route('customer.create')}}">Add Customer</a>
    </div>
    </div>
    </li> --}}




    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Warehouse - Management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#WarehouseCollapse" aria-expanded="true" aria-controls="WarehouseCollapse">
            <i class="fas fa-warehouse"></i>
            <span>Warehouse </span>
        </a>
        <div id="WarehouseCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Warehouse Options:</h6>
                <a href="{{route('admin.warehouse.index')}}" class="collapse-item"><i class="fas fa-warehouse"></i> Warehouse</a>
                <a href="{{route('supplier.index')}}" class="collapse-item"><i class="fab fa-supple"></i> Supplier</a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Shop
    </div>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categoryCollapse" aria-expanded="true" aria-controls="categoryCollapse">
            <i class="fas fa-dolly"></i>
            <span>Ecommerce</span>
        </a>
        <div id="categoryCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Eshop - Ecommerce Options:</h6>
                <a class="collapse-item" href="{{route('category.index')}}"><i class="fas fa-sitemap"></i> Category</a>
                <a class="collapse-item" href="{{route('tags.index')}}"><i class="fas fa-tags fa-folder"></i> Tag</a>
                <a class="collapse-item" href="{{route('color.index')}}"><i class="fas fa-window-minimize"></i> Color</a>
                <a class="collapse-item" href="{{route('size.index')}}"><i class="fas fa-tags fa-folder"></i> Size</a>
                <a class="collapse-item" href="{{route('product.index')}}"><i class="fas fa-cubes"></i> Products</a>
                <a class="collapse-item" href="{{route('product-reject.index')}}"><i class="fas fa-ban"></i> Product Reject</a>
                <a class="collapse-item" href="{{route('brand.index')}}"><i class="fas fa-table"></i> Brands</a>
                <a class="collapse-item" href="{{route('shipping.index')}}"><i class="fas fa-truck"></i> Shipping</a>
                <a class="nav-link" href="{{route('product-review.index')}}"><i class="fas fa-comments"></i><span> Reviews</span></a>
            </div>
        </div>
    </li>





    <!-- Categories -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categoryCollapse" aria-expanded="true" aria-controls="categoryCollapse">
          <i class="fas fa-sitemap"></i>
          <span>Category</span>
        </a>
        <div id="categoryCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Category Options:</h6>
            <a class="collapse-item" href="{{route('category.index')}}">Category</a>
    <a class="collapse-item" href="{{route('category.create')}}">Add Category</a>
    </div>
    </div>
    </li> --}}

    <!-- Tags -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tagCollapse" aria-expanded="true" aria-controls="tagCollapse">
            <i class="fas fa-tags fa-folder"></i>
            <span>Tags</span>
        </a>
        <div id="tagCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tag Options:</h6>
            <a class="collapse-item" href="{{route('tags.index')}}">Tag</a>
    <a class="collapse-item" href="{{route('tags.create')}}">Add Tag</a>
    </div>
    </div>
    </li> --}}

    <!-- Colors -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#colorCollapse" aria-expanded="true" aria-controls="colorCollapse">
            <i class="fas fa-window-minimize"></i>
            <span>Colors</span>
        </a>
        <div id="colorCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Color Options:</h6>
            <a class="collapse-item" href="{{route('color.index')}}">Color</a>
    <a class="collapse-item" href="{{route('color.create')}}">Add Color</a>
    </div>
    </div>
    </li> --}}

    <!-- Sizes -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sizeCollapse" aria-expanded="true" aria-controls="sizeCollapse">
            <i class="fas fa-tags fa-folder"></i>
            <span>Sizes</span>
        </a>
        <div id="sizeCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Size Options:</h6>
            <a class="collapse-item" href="{{route('size.index')}}">Size</a>
    <a class="collapse-item" href="{{route('size.create')}}">Add Size</a>
    </div>
    </div>
    </li> --}}

    {{-- Products --}}
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productCollapse" aria-expanded="true" aria-controls="productCollapse">
          <i class="fas fa-cubes"></i>
          <span>Products</span>
        </a>
        <div id="productCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Product Options:</h6>
            <a class="collapse-item" href="{{route('product.index')}}">Products</a>
    <a class="collapse-item" href="{{route('product.create')}}">Add Product</a>
    </div>
    </div>
    </li> --}}

    {{-- Products Detail--}}
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productDetailCollapse" aria-expanded="true" aria-controls="productDetailCollapse">
          <i class="fas fa-cubes"></i>
          <span>Products Detail</span>
        </a>
        <div id="productDetailCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Product Detail Options:</h6>
            <a class="collapse-item" href="{{route('product-detail.index')}}">Product Detail</a>
    <a class="collapse-item" href="{{route('product-detail.create')}}">Add Product Detail</a>
    </div>
    </div>
    </li> --}}

    {{-- Products Reject--}}
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productRejectCollapse" aria-expanded="true" aria-controls="productRejectCollapse">
          <i class="fas fa-ban"></i>
          <span>Products Reject</span>
        </a>
        <div id="productRejectCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Product Reject Options:</h6>
            <a class="collapse-item" href="{{route('product-reject.index')}}">Product Reject</a>
    <a class="collapse-item" href="{{route('product-reject.create')}}">Add Product Reject</a>
    </div>
    </div>
    </li> --}}

    {{-- Brands --}}
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brandCollapse" aria-expanded="true" aria-controls="brandCollapse">
          <i class="fas fa-table"></i>
          <span>Brands</span>
        </a>
        <div id="brandCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Brand Options:</h6>
            <a class="collapse-item" href="{{route('brand.index')}}">Brands</a>
    <a class="collapse-item" href="{{route('brand.create')}}">Add Brand</a>
    </div>
    </div>
    </li> --}}

    {{-- Shipping --}}
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shippingCollapse" aria-expanded="true" aria-controls="shippingCollapse">
          <i class="fas fa-truck"></i>
          <span>Shipping</span>
        </a>
        <div id="shippingCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Shipping Options:</h6>
            <a class="collapse-item" href="{{route('shipping.index')}}">Shipping</a>
    <a class="collapse-item" href="{{route('shipping.create')}}">Add Shipping</a>
    </div>
    </div>
    </li> --}}


    <!-- Reviews -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{route('product-review.index')}}"><i class="fas fa-comments"></i>
    <span>Reviews</span></a>
    </li> --}}



    <!-- Divider -->
    <hr class="sidebar-divider">


    <!--Orders -->
    <div class="sidebar-heading">
        Orders
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.order.index')}}">
            <i class="fas fa-hammer fa-chart-area"></i><span> Orders</span>
        </a>
    </li>




    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Blog
    </div>



    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCollapse" aria-expanded="true" aria-controls="postCollapse">
            <i class="fas fa-blog"></i>
            <span>Blog</span>
        </a>
        <div id="postCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Blog Options:</h6>
                <a class="collapse-item" href="{{route('cate-post.index')}}"><i class="fas fa-sitemap fa-folder"></i> Category</a>
                <a class="collapse-item" href="{{route('post.index')}}"><i class="fas fa-fw fa-folder"></i> Posts</a>
                <a class="collapse-item" href="{{route('tag-post.index')}}"><i class="fas fa-tags fa-folder"></i> Tag</a>
                <a class="collapse-item" href="{{route('comment.index')}}"><i class="fas fa-comments fa-chart-area"></i><span> Comments</span> </a>
            </div>
        </div>
    </li>




    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Other
    </div>



    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#recruitmentCollapse" aria-expanded="true" aria-controls="recruitmentCollapse">
            <i class="fa fa-hashtag"></i>            
            <span>Other</span>
        </a>
        <div id="recruitmentCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Other Options:</h6>
                <a class="collapse-item"><i class="fas fa-tasks"></i> Recruitment</a>                     
                <a class="collapse-item"><i class="fas fa-ad"></i> Advertisement</a>
                <a class="collapse-item"><i class="fas fa-percent"></i> Promotion</a>
            </div>
        </div>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#recruitmentCollapse" aria-expanded="true" aria-controls="recruitmentCollapse">
            <i class="fas fa-tasks"></i>
            <span>Recruitment</span>
        </a>
        <div id="recruitmentCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Recruitment Options:</h6>
                <a class="collapse-item"> Recruitment</a>
                <a class="collapse-item"> Create</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#advertisementCollapse" aria-expanded="true" aria-controls="advertisementCollapse">
            <i class="fas fa-ad"></i>
            <span>Advertisement</span>
        </a>
        <div id="advertisementCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Advertisement Options:</h6>
                <a class="collapse-item"> Advertisement</a>
                <a class="collapse-item"> Create</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#promotionCollapse" aria-expanded="true" aria-controls="promotionCollapse">
            <i class="fas fa-percent"></i>
            <span>Promotion</span>
        </a>
        <div id="promotionCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Promotion Options:</h6>
                <a class="collapse-item"> Promotion</a>
                <a class="collapse-item"> Create</a>
            </div>
        </div>
    </li> --}}




    {{-- <!-- Posts -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCollapse" aria-expanded="true" aria-controls="postCollapse">
        <i class="fas fa-fw fa-folder"></i>
        <span>Posts</span>
      </a>
      <div id="postCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Post Options:</h6>
          <a class="collapse-item" href="{{route('post.index')}}">Posts</a>
    <a class="collapse-item" href="{{route('post.create')}}">Add Post</a>
    </div>
    </div>
    </li>

    <!-- Category -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCategoryCollapse" aria-expanded="true" aria-controls="postCategoryCollapse">
            <i class="fas fa-sitemap fa-folder"></i>
            <span>Category</span>
        </a>
        <div id="postCategoryCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Category Options:</h6>
                <a class="collapse-item" href="{{route('cate-post.index')}}">Category</a>
                <a class="collapse-item" href="{{route('cate-post.create')}}">Add Category</a>
            </div>
        </div>
    </li>

    <!-- Tags -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tagCollapse" aria-expanded="true" aria-controls="tagCollapse">
            <i class="fas fa-tags fa-folder"></i>
            <span>Tags</span>
        </a>
        <div id="tagCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tag Options:</h6>
                <a class="collapse-item" href="{{route('tag-post.index')}}">Tag</a>
                <a class="collapse-item" href="{{route('tag-post.create')}}">Add Tag</a>
            </div>
        </div>
    </li> --}}

    <!-- Comments -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-comments fa-chart-area"></i>
            <span>Comments</span>
        </a>
      </li> --}}


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Heading -->
    <div class="sidebar-heading">
        General Settings
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{route('coupon.index')}}">
            <i class="fas fa-table"></i>
            <span>Coupons</span></a>
    </li>
    <!-- Users -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-users"></i>
            <span>Users</span></a>
    </li> --}}
    <!-- General backups -->
    <li class="nav-item">
        <a class="nav-link">
            <i class="fas fa-trash-restore"></i><span> Backups</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('contact.admin.index')}}"> 
            <i class="far fa-comment-dots"></i><span> Contact </span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link"> 
            <i class="fas fa-newspaper"></i><span> Newsletter </span>
        </a>
    </li>






    <hr class="sidebar-divider d-none d-md-block">

    <!-- settings -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#settingCollapse" aria-expanded="true" aria-controls="settingCollapse">
            <i class="fas fa-cog"></i>
            <span>Settings</span>
        </a>
        <div id="settingCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Setting Options:</h6>
                <a class="collapse-item" href="{{route('setting.index')}}">Index</a>
                <a class="collapse-item" href="{{route('settings.update')}}">Setting</a>
                <a class="collapse-item" href="{{route('setting.create') . '?type=Text' }}">Add Setting Text</a>
                <a class="collapse-item" href="{{route('setting.create') . '?type=Textarea' }}">Add Setting TextArea</a>
            </div>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
