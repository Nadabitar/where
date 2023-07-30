@extends('subscriber.app')

@section('content')

        @include('subscriber.partial.navbar', ['place'=>$place ,
                                                'promo' => $promo])

        <!-- Search Start -->
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control border-0 py-3" placeholder="Search Keyword">
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0 py-3">
                                    <option selected>Service Type</option>
                                    <option value="1">New Service</option>
                                    <option value="2">Old Service</option>
                                    <option value="3">Un-Active  Service</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0 py-3">
                                    <option selected>Coments</option>
                                    <option value="1">Location 1</option>
                                    <option value="2">Location 2</option>
                                    <option value="3">Location 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark border-0 w-100 py-3">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search End -->


        <!-- Category Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">بعض إحصائيات الموقع</h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="cat-item d-block bg-light text-center rounded p-3" href="{{route('Service.all')}}">
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="{{asset('assets/img/Subscriber/service.ico')}}" alt="Icon">
                                </div>
                                <h6>خدمات</h6>
                                <span>{{count($services)}}</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                        <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="{{asset('assets/img/Subscriber/advertising.ico')}}" alt="Icon">
                                </div>
                                <h6>إعلانات</h6>
                                <span>{{count($promo)}}</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="{{asset('assets/img/Subscriber/comments.ico')}}" alt="Icon">
                                </div>
                                <h6>تعليقات</h6>
                                <span>{{$comments->count()}}</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="{{asset('assets/img/Subscriber/visit.ico')}}" alt="Icon">
                                </div>
                                <h6>عدد المتابعين</h6>
                                <span>{{$users->count()}}</span>
                            </div>
                        </a>
                    </div>
            </div>
        </div>
        <!-- Category End -->


        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="{{count($popularService->gallery) != 0 ? $popularService->gallery[0] : asset('assets/img/subscriber/noImage.jpg') }}">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <div class="mb-4">
                            <h1 class="mb-3">الخدمة الأكثر انتشاراً بين الزبائن</h1>
                            <h3> {{$popularService->title}}</h3>
                            <p>{{$popularService->content}}</p>
                        </div>
                        <a href="" class="btn btn-primary py-3 px-4 me-2"><i class="fa fa-eye me-2"></i>عرض المستخدمين</a>
                        <a href="{{route('Service.all')}}" class="btn btn-dark py-3 px-4"><i class="fa fa-comments me-2"></i>عرض كافة الخدمات</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Property List Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-6">
                        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                            <h1 class="mb-3">خدمات</h1>
                            <p>الخدمات التي تم نشرها من قبلكم يمكنك  عرض الخدمات حسب التصنيفات الجانبية المعروضة</p>
                        </div>
                    </div>
                    <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                        <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                            <li class="nav-item me-2">
                                <a  id="newService" class="btn btn-outline-primary active" data-id="{{$place->id}}" href="#" >جديد</a>
                            </li>
                            <li class="nav-item me-2">
                                <a id="unActiveService"  class="btn btn-outline-primary" data-id="{{$place->id}}" data-bs-toggle="pill" href="#tab-3">غير فعال</a>
                            </li>
                            <li class="nav-item me-0" >
                                <a id="activeService"  style="background-color: var(--secondary);
                                color: white;" class="btn"  data-bs-toggle="pill"  href="{{route('Service.all')}}">عرض كافة الخدمات</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4 mySpace">
                            @forelse ($services as $service)
                                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="property-item rounded overflow-hidden">
                                        <div class="position-relative overflow-hidden"
                                        style="width: 350px;
                                        height: 240px;" 
                                        >
                                            <a href=""><img class="img-fluid w-100 postion-center" src="{{count($service->gallery) != 0 ? $service->gallery[0]->url :  asset('assets/img/subscriber/noImage.jpg')  }}" alt=""></a>
                                            {{-- <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{$services->isAd == true? إعلان : خدمة}}</div> --}}
                                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3"></div>
                                        </div>
                                        <div class="p-4 pb-0">
                                            <h5 class="text-primary mb-3"> <small > Service Title:</small>{{$service->title}}</h5>
                                            <a class="d-block h5 mb-2" href="">{{$service->content}}</a>
                                            <p><i class="fas fa-calendar-alt text-primary me-2"></i>{{$service->created_at}}</p>
                                        </div>
                                        <div class="d-flex border-top">
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-heart text-primary me-2"></i>{{$service->isSaved->count()}} saved</small>
                                            <small class="flex-fill text-center border-end py-2"><i class="far fa-bell text-primary me-2"></i> status: {{$service->status ? "Active" : "unActive" }}</small>
                                        </div>
                                    </div>
                                </div>
                            @empty            
                                <div class="col-12">
                                    <section class="hero is-fullheight is-info">          
                                        <div class="hero-body">
                                            <h3 class="title ">
                                            <a href="">
                                                <i class="fa fa-map-signs" aria-hidden="true"></i> <strong>عذراً</strong>
                                            </a>
                                            </h3>
                                            <h4 class="subtitle">
                                            لا يوجد خدمات ليتم عرضها
                                            </h4>
                                            <a class="go-to" href="{{route('Service.show')}}">إضافة خدمة</a>
                                        </div>
                                    </section>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Property List End -->

        <!-- Testimonial Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">ماذا يقول عملائكم عنكم</h1>
                    <p>سيتم عرض بعض الأراءالتي تم نشرها من قبل عملائكم عن الخدمات المقدمة من قبلكم</p>
                    <a href="{{route('Comments.All' , $place->id )}}">عرض كافة التعليقات</a>
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                    @forelse ($comments as $comment)
                        <div class="testimonial-item bg-light rounded p-3">
                            <div class="bg-white border rounded p-4">
                                <p style="display: inline-block">{{$comment->pivot->content}}</p>
                                {{-- <p style="display: inline-block;
                                text-align: end;
                                float: right;">{{$comment->pivot->created_at}}</p> --}}
                                <div class="d-flex align-items-center">
                                    @if ($comment->gender == "male")
                                    <img class="img-fluid flex-shrink-0 rounded comment" src="{{asset('backend/assets/images/male.jpg')}}" style="width: 45px; height: 45px;">
                                    @else
                                    <img class="img-fluid flex-shrink-0 rounded comment" src="{{asset('backend/assets/images/fmale.png')}}" style="width: 45px; height: 45px;">
                                    @endif
                                    <div class="ps-3">
                                        <h6 class="fw-bold mb-1">{{$comment->fullName}} </h6>
                                        <small>
                                            @for ($i = 0; $i < $comment->pivot->rate; $i++)
                                                <i class="fa fa-star text-warning"></i>
                                            @endfor
                                    </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <section class="hero is-fullheight is-info">          
                                <div class="hero-body">
                                    <h3 class="title ">
                                    <a href="">
                                        <i class="fa fa-map-signs" aria-hidden="true"></i> <strong>عذراً</strong>
                                    </a>
                                    </h3>
                                    <h4 class="subtitle">
                                    لا يوجد تعليقات ليتم عرضها
                                    </h4>
                                    <a class="go-to" href="{{route('Service.show')}}">إضافة خدمة</a>
                                </div>
                            </section>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
        

@endsection

@section('script')
    <!-- google map api -->
    
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_qDiT4MyM7IxaGPbQyLnMjVUsJck02N0"></script> --}}
    <script src="{{asset('assets/js/Subscriber/service.js')}}"></script>   

@endsection
