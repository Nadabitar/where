<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">

        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="ti-menu"></i>
            </a>
            <a class="mobile-search morphsearch-search" href="#">
                <i class="ti-search"></i>
            </a>
            <a href="index.html">
                <img class="img-fluid" src="{{asset('backend/assets/images/logo.png')}}" alt="Theme-Logo" />
            </a>
            <a class="mobile-options">
                <i class="ti-more"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li>
                    <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                </li>

                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="ti-fullscreen"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                <li class="header-notification">
                    <a href="#!">
                        <i class="ti-bell"></i>
                        <span class="badge bg-c-pink"></span>
                    </a>
                    <ul class="show-notification">
                        <li>
                            <h6>Notifications</h6>
                            <a href="{{route('Places.new')}}"><label class="label" style="background-color:var(--primary); cursor: pointer;">Show</label></a> 
                            <label class="label label-danger">New</label>
                        </li>
                        @foreach ($notifications as $notification)
                        <li>
                            <div class="media">
                                @if ($notification->data['image'])
                                <img class="d-flex align-self-center img-radius" src="{{$notification->data['image']}}" alt="Generic placeholder image">
                                @else
                                <img class="d-flex align-self-center img-radius" src="{{asset('backend/assets/images/Default_User.jpg')}}" alt="Generic placeholder image">
                                @endif
                                <div class="media-body">
                                    <h5 class="notification-user">{{$notification->data['name'] ? $notification->data['name'] : "Nada Arab Bitar"}}</h5>
                                    {{-- <p class="notification-msg">{{$notification->data['email']}}</p> --}}
                                    <span class="notification-time">{{ \Carbon\Carbon::parse($notification->created_at)->format('H : s : i') }}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li class="user-profile header-notification">
                    <a href="#!">
                        {{-- @if (auth()->user()->photo)
                        <img src="{{auth()->user()->photo}}" class="img-radius" alt="User-Profile-Image">
                        @else
                        <img src="{{asset('backend/assets/images/Default_User.jpg')}}" class="img-radius" alt="User-Profile-Image">
                        @endif --}}
                     
                        <span>ADMIN</span>
                        <i class="ti-angle-down"></i>
                    </a>
                    <ul class="show-notification profile-notification">
                        <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                <i class="ti-layout-sidebar-left"></i> 
                                {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>