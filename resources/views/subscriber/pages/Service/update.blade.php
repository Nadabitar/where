@extends('subscriber.app')

@section('content')
@include('subscriber.partial.navbar', ['place'=>$place , 'services' => []])

        <!-- Search Start -->
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <div class="row g-2">
                    <h1 class="add-service-text">تعديل الخدمة </h1>
                </div>
            </div>
        </div>
        <!-- Search End -->
        @include('subscriber.partial.flash')
<section class="add-service-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="owl-carousel header-carousel">
                    <div class="owl-carousel-item">
                        {{-- <img id="holder" style="margin-top:15px;max-height:100px;"> --}}
                        <img class="img-fluid" src="{{$service->gallery[0]->url}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="add-service">
                    <form action="{{route('Service.update' , $service->id)}}"  method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-5 w-90 p-0">
                                    {{-- <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span> --}}
                                    <input id="thumbnail" class="form-control" type="file" name="image" value="{{$service->gallery[0]->url}}" multiple>
                                </div>
                            
                            </div>
                            <div class="col-md-12">
                                <div class="add-form">
                                    <input name="title" placeholder="عنوان*" type="text" value="{{$service->title}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-details">
                                    <textarea name="content" placeholder="*وصف الخدمة">{{$service->content}}</textarea>
                                    <button class="submit" type="submit">تعديل المعلومات</button>
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
@endsection