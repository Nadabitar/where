@extends('subscriber.app')

@section('content')
@include('subscriber.partial.navbar', ['place'=>$place ,
'promo' => $promo])

        <!-- Search Start -->
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <div class="row g-2">
                    <h1 class="add-service-text">إضافة خدمة جديدة</h1>
                </div>
            </div>
        </div>
        <!-- Search End -->
        @include('subscriber.partial.flash')
<section class="add-service-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="col-12 animated fadeIn" id="file-result">
                    <div  class="owl-carousel header-carousel">
                            <div  class="owl-carousel-item">
                                <img id="img-output" class="img-fluid" src="{{asset('assets/img/Subscriber/1.jpg')}}" alt="">
                            </div>
                            <div class="owl-carousel-item">
                                <img id="img-output" class="img-fluid" src="{{asset('assets/img/Subscriber/2.jpg')}}" alt="">
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="add-service">
                    <form enctype="multipart/form-data"  action="{{route('Service.store' , $place->id)}}"  method="POST" >
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <input id="service-imag"  class="form-control" type="file" name="image[]" multiple>
                                {{-- <span>يمكنك إضافة أربعة صور فقط</span> --}}
                            </div>
                            
                            </div>
                            <div class="col-md-12">
                                <div class="add-form">
                                    <input name="title" placeholder="عنوان*" type="text">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-details">
                                    <textarea name="content" placeholder="*وصف الخدمة"></textarea>
                                    <button class="submit" type="submit">حفظ المعلومات</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script src="{{asset('assets/js/Subscriber/vendor/jquery-1.12.0.min.js')}}"></script>
<script src="{{asset('assets/js/Subscriber/vendor/modernizr-2.8.3.min.js')}}"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>

<script src="{{asset('assets/js/Subscriber/service.js')}}"></script>   
@endsection