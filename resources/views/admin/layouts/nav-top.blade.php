    @if(auth()->user()->hasRole('admin')|| auth()->user()->hasRole('manager'))
        <nav class="main-header navbar navbar-expand navbar-dark">
          @else  
          <nav class="main-header navbar navbar-expand navbar-light">
    @endif
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{ route('properties.index') }}" class="nav-link">
          <p>properties</p>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a  href="/" class="nav-link">
          <p>website</p>
        </a>
      </li>
    @if(auth()->user()->hasRole('admin')|| auth()->user()->hasRole('manager'))
      <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{ route('locations.index') }}" class="nav-link">
          <p>locations</p>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{ route('regions.index') }}" class="nav-link">
          <p>regions</p>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{ route('property-types.index') }}" class="nav-link">
          <p>property types</p>
        </a>
      </li>

    @endif

    @if(auth()->user()->hasRole('admin'))
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./permissions" class="nav-link">
          <p>permissions</p>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./roles" class="nav-link ">
          <p>roles</p>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./users" class="nav-link">
          <p>users</p>
        </a>
      </li>
    @endif




      <li class="nav-item d-none d-sm-inline-block" >
        <a class="nav-link" href="{{ route('logout') }}" 
            onclick="event.preventDefault(); 
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }} 
        </a>
         <form id="logout-form" action="{{ route('logout') }}" 
         method="POST" class="d-none">@csrf
        </form>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    
    </ul>
  </nav>