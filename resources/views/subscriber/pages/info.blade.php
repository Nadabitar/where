@extends('subscriber.app')

@section('header')
<link href="{{asset('assets/css/subscriber/profile.css')}}" rel="stylesheet">
@endsection
@section('content')

@include('subscriber.partial.flash')
    <section id="info-page">
        <div class="info">
            <div class="row p-0 m-0">
                <div class="col-md-7">
                        <div class="container">
                            <div class="drag-image mt-5">
                                <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <h6>Drag & Drop File Here</h6>
                            </div>
                            {{-- PLace inpuuuuuuuut --}}
                            <div class="row">
                                <form enctype="multipart/form-data"   action="{{route('Place.store')}}" method="post">
                                    @csrf
                                    <div class="col-lg-12 col-md-12">
                                        <div class="checkbox-form" dir="rtl">						
                                            <h3>إضافة تفاصيل المكان</h3>
                                            <div class="row">
                                                <div class="col-md-12 checkbox-line ">
                                                    <div class="checkout-form-list">
                                                        <label>image</label>
                                                        <input  type="file" name="image" id="img-place">
                                                    </div>  
                                                </div>
                                                <div class="col-md-12 checkbox-line ">
                                                    <div class="checkout-form-list">
                                                        <label>الصنف التابع له المكان <span class="required">*</span></label>
                                                        <select id="category" name="categoryId">
                                                            @foreach (\App\Models\Categoris::where( 'isParent' ,true)->get() as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select> 										
                                                    </div>
                                                </div>
                                                <div id="sub-category-box" class="col-md-12 checkbox-line   d-none">
                                                    <div class="country-select">
                                                        <label>الصنف الفرعي <span class="required">*</span></label>
                                                        <select  id="sub-category" name="subCategoryId">
                                                            
                                                        </select> 										
                                                    </div>
                                                </div>
                                                <div class="col-md-12 checkbox-line ">
                                                    <div class="checkout-form-list">
                                                        <label>اسم المكان</label>
                                                        <input name="placeName" type="text" placeholder="اسم المكان" />
                                                        @error('placeName')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 checkbox-line ">
                                                    <div class="checkout-form-list">
                                                        <label>رقم الهاتف <span class="required">*</span></label>
                                                        <input type="text" placeholder="رقم الهاتف" name="phoneNumber" />
                                                        <input style="margin: 15px 8px" type="text" name="addtionalPhone" placeholder="هل هناك رقم تواصل أخر!!" />
                                                        @error('phoneNumber')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
    	
                                                <div class="col-md-6 checkbox-line" >
                                                    <div class="checkout-form-list">
                                                        <label>وقت العمل <span class="required">*</span></label> 
                                                        {{-- <span style="display: none" class="from-massege text-danger">وقت الافتتاح يجب أن يكون قبل وقت الإغلاق </span> --}}
                                                        <span style="display: none"  class="time-massege text-info">أدخل الوقت بنظام الإثنى عشر ساعة </span>
                                                        <input  id="from" type="text" placeholder="من" name="from" />
                                                        <span style="display: none"  class="num-from-massege text-danger">فقط أرقام لا يسمح بالأحرف</span>
                                                        @error('from')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 checkbox-line" >
                                                    <div class="checkout-form-list">	
                                                        <label>وقت العمل <span class="required">*</span></label>								
                                                        <input id="to" type="text" placeholder="إلى" name="to" />
                                                        <span style="display: none" class="to-massege text-danger"> وقت الإغلاق يجب أن يكون بعد وقت الافتتاح</span>
                                                        <span style="display: none"  class="num-to-massege text-danger">فقط أرقام لا يسمح بالأحرف</span>
                                                        @error('to')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 checkbox-line" >
                                                    <div class="checkout-form-list">
                                                        <label> الواتس آب</label>										
                                                        <input name="whats" type="text" placeholder="  آب/رابط مجموعة" />
                                                        @error('whats')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 checkbox-line" >
                                                    <div class="checkout-form-list">
                                                        <label>فيسبوك </label>										
                                                        <input name="facebook" type="text" placeholder="فيسبوك " />
                                                        @error('facebook')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 checkbox-line" >
                                                    <div class="checkout-form-list">
                                                        <label>انستغرام</label>										
                                                        <input name="instagram" type="text" placeholder="انستغرام" />
                                                        @error('instagram')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 checkbox-line" >
                                                    <div class="checkout-form-list">	
                                                        <label> تفاصيل  <span class="required">*</span></label>								
                                                        <input type="text" placeholder="تفاصيل" name="details" />
                                                        @error('details')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>											
                                        </div>
                                    </div>	
                                    <div class="save-button">
                                        <input type="submit" value="حفظ" />
                                    </div>		
                                </form>
                            </div>
    
                        </div>
                </div>


                {{-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx --}}
                <div class="col-md-5 p-0">
                    <div class="background-page">
                        <div class="row">
                            <div class="box-info mt-5">
                                <h4>
                                    إدارة تفاصيل المشترك
                                </h4>
                                <p>   يساعد تطبيقنا  للمشترك في تعديل (ارقام - عنوان - بريد الكتروني)
                                    في حال أراد المشترك إضافة أو حذف أو تعديل بياناته الخاصة به في بطاقة المعلومات
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="box-info ">
                                <h4>رؤية التقييمات للمشترك</h4>
                                <p>
                                    يمكن للمشترك رؤية معدل التقييم الخاص به من قبل المستخدمين من خمس نجوم. كما يمكنه استعراض كافة تعليقات المستخدمين 
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="box-info">
                                <h4>إدارة الخدمات</h4>
                                <p>
                                    يتيح تطبيقنا بإدارة الخدمات 
                                    (حذف-تعديل-إضافة) 
                                    .الخاصة بالمشترك في بطاقة المعلومات
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <!-- google map api -->
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_qDiT4MyM7IxaGPbQyLnMjVUsJck02N0"></script>
    <script>
        var myCenter=new google.maps.LatLng(30.249796, -97.754667);
        function initialize()
        {
            var mapProp = {
                center:myCenter,
                scrollwheel: false,
                zoom:15,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            var map=new google.maps.Map(document.getElementById("hastech"),mapProp);
            var marker=new google.maps.Marker({
                position:myCenter,
                animation:google.maps.Animation.BOUNCE,
                icon:'assets/img/map-marker.png',
                map: map,
            });
            var styles = [
                {
                    stylers: [
                        { hue: "#c5c5c5" },
                        { saturation: -100 }
                    ]
                },
            ];
            map.setOptions({styles: styles});
            marker.setMap(map);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <script src="{{asset('assets/js/Subscriber/info.js')}}"></script>   
@endsection
