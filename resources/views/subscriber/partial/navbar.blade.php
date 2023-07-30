
        <!-- Navbar Start -->
        <div class="container-fluid nav-bar bg-transparent">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
                <a href="index.html" class="navbar-brand d-flex align-items-center text-center">
                    <div class="icon p-2 me-2">
                        <img class="img-fluid" src="{{asset('assets/img/Subscriber/icons8_place_marker.ico')}}" alt="Icon" style="width: 30px; height: 30px;">
                    </div>
                    <h1 class="m-0 text-primary">{{$place->placeName}}</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="{{route('subscriber.dashboard')}}" class="nav-item nav-link active">الصفحة الرئيسية</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">خدمات</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{route('Service.show')}}" class="dropdown-item">إضافة خدمة</a>
                                <a href="{{route('Advertising')}}" class="dropdown-item">إضافة إعلان</a>
                                <a href="{{route('Service.all')}}" class="dropdown-item">إضافة عرض</a>
                                <a href="{{route('Service.all')}}" class="dropdown-item">عرض كافة الخدمات</a>
                                {{-- <a href="property-agent.html" class="dropdown-item">Property Agent</a> --}}
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">الملف الشخصي</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{route('Profile.show')}}" class="dropdown-item">تعديل الملف الشخصي</a>
                                <a href="{{route('logout')}}" class="dropdown-item">تسجيل الخروح</a>
                            </div>
                        </div>
                        <a href="about.html" class="nav-item nav-link">كافة التعليقات</a>
                        <a href="contact.html" class="nav-item nav-link">تواصل</a>
                    </div>
                    <a href="{{route('Service.show')}}" class="btn btn-primary px-3 d-none d-lg-flex">إضافة خدمة</a>
                </div>
            </nav>
        </div>


            <!-- Navbar End -->
            <!-- Header Start -->
            <div class="container-fluid header bg-white p-0">
                <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                    <div class="col-12 animated fadeIn">
                        <div class="owl-carousel header-carousel">
                                @forelse ($promo as $item)
                                <div class="owl-carousel-item">
                                    @if (count($item->gallery) != 0)
                                        <img class="img-fluid" src=" {{$item->gallery[0]->url}}" alt="">
                                    @else
                                        <img class="img-fluid" src=" {{asset('assets/img/subscriber/1.jpg')}}" alt="">
                                    @endif
                                
                                </div>
                                @empty
                                <div class="owl-carousel-item">
                                    @if ($place->image)
                                        <img class="img-fluid" src="{{$place->image}}" alt="">
                                    @else
                                        <img class="img-fluid" src="{{asset('assets/img/Subscriber/noimage.png')}}" alt="">
                                    @endif
                                </div>
                                @endforelse
                        </div>
                    </div>
                </div>
            </div>
        <!-- Header End -->
        {{-- {{$place}} --}}