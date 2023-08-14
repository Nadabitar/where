<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.header')
</head>

<body>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            @include('admin.layouts.nav' , ['notifications' => $notifications])
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    @include('admin.layouts.sidebar')

                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
                {{-- <div class="fixed-button">
                    <a href="https://codedthemes.com/item/guru-able-admin-template/" target="_blank" class="btn btn-md btn-primary">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Upgrade To Pro
                    </a>
                </div> --}}
            </div>
    </div>


    @include('admin.layouts.footer')
</body>

</html>
