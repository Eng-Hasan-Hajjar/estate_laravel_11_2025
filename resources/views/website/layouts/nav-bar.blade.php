 <div class="container-fluid nav-bar bg-transparent">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
                <a href="{{url('indexproperty')}}" class="navbar-brand d-flex align-items-center text-center">
                    <div class="icon p-2 me-2">
                        <img class="img-fluid" src="{{asset('website/img/icon-deal.png')}}" alt="Icon" style="width: 30px; height: 30px;">
                    </div>
                    <h1 class="m-0 text-primary">Your Property</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto"  style="margin-right:20px">
                        <a href={{url('indexproperty')}} class="nav-item nav-link active">Home</a>
                        <a href="{{ route('search') }}"  class="nav-item nav-link">Search</a>
                        <a href="{{ route('about') }}" class="nav-item nav-link">About</a>
                        <div class="nav-item dropdown">
                            <a href="{{url('property-list-web')}}" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Property</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href={{url('property-list-web')}} class="dropdown-item">Property List</a>
                                <a href={{url('property-type-web')}}  class="dropdown-item">Property Type</a>
                                <a href={{url('property-agent-web')}}  class="dropdown-item">Property Agent</a>
                            </div>
                        </div>
                    </div>
                    @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Dashboard
                            </a>
                            <a href="{{ route('logout') }}" 
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                onclick="event.preventDefault(); 
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }} 
                            </a>
                                <form id="logout-form" action="{{ route('logout') }}" 
                                method="POST" class="d-none">@csrf
                            </form>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif

                


                   
                </div>
            </nav>
        </div>