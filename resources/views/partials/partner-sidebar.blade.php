<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
      with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Partners
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.partners.add')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.partners')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View List</p>
                            </a>
                        </li>
                    </ul>
                </li>


                  

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Menus Category
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.menu.add')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.menu')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View List</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Events
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.event.add')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.event')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View List</p>
                            </a>
                        </li>
                    </ul>
                </li>





            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<div>
	@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

<!-- this is for validation errors -->
@if ($errors->any())
<?php var_dump($errors); ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Please check the form below for errors
    </div>
@endif
</div>
