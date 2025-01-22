



<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"> Estates System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-6 pb-6 mb-6 d-flex">
       



        <div class="info">


          <a href="#" class="d-block">{{ auth()->user()->name }} || Role: {{ auth()->user()->getRoleNames()->first() }}</a>
          <span class="text-muted"></span>
          <!-- صلاحيات المستخدم -->
         


        
        </div>










      </div>


   




      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>home</p>
                </a>
              </li>
        
              <li class="nav-item">
                <a  href="{{ route('locations.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>locations</p>
                </a>
              </li>
              <li class="nav-item">
                <a  href="{{ route('properties.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>properties</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./users" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./roles" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./permissions" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>permissions</p>
                </a>
              </li>
              <li class="nav-item">
                <a  href="/" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>website</p>
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