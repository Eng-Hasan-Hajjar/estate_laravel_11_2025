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
      <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{ route('properties.index') }}" class="nav-link">
          <p>properties</p>
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
  
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    
    </ul>
  </nav>