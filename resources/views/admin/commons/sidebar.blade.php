 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pr-0" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">WebProg.ir</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{route('admin.dashboard')}}">
        <i class="fa-thin fa-gauge-high fa-lg"></i>
        <span> داشبورد </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      لورم ایپسوم
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
        aria-controls="collapseTwo">
        <i class="fa-duotone fa-gear-complex fa-spin fa-lg"></i>
        <span> کامپونت ها </span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header"> کامپونت سفارشی : </h6>
          <a class="collapse-item" href="#">Buttons</a>
          <a class="collapse-item" href="#">Cards</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fa-solid fa-wrench fa-lg"></i>
        <span> ابزار ها </span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header"> لورم ایپسوم </h6>
          <a class="collapse-item" href="#">Colors</a>
          <a class="collapse-item" href="#">Borders</a>
          <a class="collapse-item" href="#">Animations</a>
          <a class="collapse-item" href="#">Other</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      صفحات
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsebrans" aria-expanded="true"
          aria-controls="collapsePages">
          <i class="fa-solid fa-folder fa-lg"></i>
          <i class="fa-solid fa-folder-open fa-lg"></i>
          <span> برند ها </span>
        </a>
        <div id="collapsebrans" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"> صفحات برند ها : </h6>
            <a class="collapse-item" href="{{route('admin.brands.index')}}"> نمایش برند ها </a>
            <a class="collapse-item" href="{{route('admin.brands.create')}}"> ایجاد برند جدید </a>
          </div>
        </div>
      </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseattributes" aria-expanded="true"
          aria-controls="collapsePages">
          <i class="fa-solid fa-folder fa-lg"></i>
          <i class="fa-solid fa-folder-open fa-lg"></i>
          <span>ویژگی ها</span>
        </a>
        <div id="collapseattributes" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"> صفحات برند ها : </h6>
            <a class="collapse-item" href="{{route('admin.attributes.index')}}"> نمایش ویژگی ها </a>
            <a class="collapse-item" href="{{route('admin.attributes.create')}}"> ایجاد ویژگی جدید </a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecategoies" aria-expanded="true"
          aria-controls="collapsePages">
          <i class="fa-solid fa-folder fa-lg"></i>
          <i class="fa-solid fa-folder-open fa-lg"></i>
          <span>دسته بندی ها</span>
        </a>
        <div id="collapsecategoies" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">صفحات دسته بندی</h6>
            <a class="collapse-item" href="{{route('admin.categories.index')}}"> نمایش دسته بندی ها </a>
            <a class="collapse-item" href="{{route('admin.categories.create')}}"> ایجاد دسته بندی جدید </a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsetags" aria-expanded="true"
          aria-controls="collapsePages">
          <i class="fa-solid fa-folder fa-lg"></i>
          <i class="fa-solid fa-folder-open fa-lg"></i>
          <span>تگ ها</span>
        </a>
        <div id="collapsetags" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">صفحات دسته بندی</h6>
            <a class="collapse-item" href="{{route('admin.tags.index')}}"> نمایش تگ ها </a>
            <a class="collapse-item" href="{{route('admin.tags.create')}}"> ایجاد تگ جدید </a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseproducts" aria-expanded="true"
          aria-controls="collapsePages">
          <i class="fa-solid fa-folder fa-lg"></i>
          <i class="fa-solid fa-folder-open fa-lg"></i>
          <span>محصولات</span>
        </a>
        <div id="collapseproducts" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">صفحات دسته بندی</h6>
            <a class="collapse-item" href="{{route('admin.products.index')}}"> نمایش  محصولات </a>
            <a class="collapse-item" href="{{route('admin.products.create')}}"> ایجاد محصولات جدید </a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsebanner" aria-expanded="true"
          aria-controls="collapsePages">
          <i class="fa-solid fa-folder fa-lg"></i>
          <i class="fa-solid fa-folder-open fa-lg"></i>
          <span>بنر ها</span>
        </a>
        <div id="collapsebanner" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">صفحات بنر ها</h6>
            <a class="collapse-item" href="{{route('admin.banner.index')}}"> نمایش  بنر ها </a>
            <a class="collapse-item" href="{{route('admin.banner.create')}}"> ایجاد بنر جدید </a>
          </div>
        </div>
      </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->
