@extends('subscriber.app')

@section('content')
@include('subscriber.partial.navbar', ['place'=>$place ,
'promo' => $promo])

        <!-- Search Start -->
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <div class="row g-2">
                    <h1 class="add-service-text"> إضافة إعلان جديد </h1>
                </div>
            </div>
        </div>
        <!-- Search End -->
    @include('subscriber.partial.flash')
<section class="add-service-section">
    <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="wrapper">
                        <div class="image">
                            <img class="adv-image" src="" alt="">
                        </div>
                        <div class="content">
                            <div class="icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="text">
                                No file chosen, yet!
                            </div>
                        </div>
                        <div id="cancel-btn">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="file-name">
                            <a href="">File name here</a>
                        </div>
                    </div>
                    <form enctype="multipart/form-data" method="POST" action="{{route('Advertising.save' , $place->id)}}" class="adv-box" >
                        @csrf
                        <div class="adv-box-content">
                            <input name="image" id="default-btn" type="file">
                            <input name="content" type="text" placeholder="أدخل تفصيلاً لهذا الإعلان">
                        </div>
                        <button type="submit" onclick="defaultBtnActive()" id="custom-btn">نشر الإعلان</button>
                    </form>
                </div>
            </div>
    </div>
</section>

<hr>
<section id="gallery" >
    <div class="container">
       <div class="gallery-content">
            @forelse ($Gallery as $gallery)
                <div class="card" style="width: 32%;">
                    <img src="{{$gallery->url}}" class="card-img-top  w-100" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$gallery->service->content}}</h5>
                    </div>
                    <div class="card-body">
                        <a href="#" class="card-link">Card link</a>
                        <a  href="{{route('Advertising.drop' , $gallery->service->id)}}" class="card-link">حذف هذا الإعلان</a>
                    </div>
                </div>
            @empty
                
            @endforelse
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
<script>
    const wrapper = document.querySelector(".wrapper");
    const fileName = document.querySelector(".file-name");
    const defaultBtn = document.querySelector("#default-btn");
    const customBtn = document.querySelector("#custom-btn");
    const cancelBtn = document.querySelector("#cancel-btn i");
    const img = document.querySelector(".adv-image");
    let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
    defaultBtn.addEventListener("change", function(){
    const file = this.files[0];
    if(file){
            const reader = new FileReader();
            reader.onload = function(){
            const result = reader.result;
            img.src = result;
            wrapper.classList.add("active");
        }
        cancelBtn.addEventListener("click", function(){
            img.src = "";
            wrapper.classList.remove("active");
            defaultBtn.value = "";
        })
        reader.readAsDataURL(file);
    }
    if(this.value){
        let valueStore = this.value.match(regExp);
        fileName.textContent = valueStore;
    }
    });
</script>


<script>

</script>
@endsection