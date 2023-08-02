@extends('subscriber.app')

@section('header')
<link href="{{asset('assets/css/subscriber/profile.css')}}" rel="stylesheet">
@endsection
@section('content')
    
          
<section id="info-page">
    <div class="info">
        <div class="row p-0 m-0">
            <div class="col-md-12">
                    <div class="container">
                        <div class="drag-image mt-5">
                            {{-- <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <h6>Drag & Drop File Here</h6> --}}
                            <img src="{{$place->image}}" alt="image">
                        </div>
                        {{-- PLace inpuuuuuuuut --}}
                        <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="checkbox-form" dir="rtl">						
                                        <h3>تعديل تفاصيل المكان</h3>
                                        <div class="row">

                                            <div class="col-md-12 checkbox-line ">
                                                <div class="checkout-form-list">
                                                    <form action="{{ route('Profile.update.Image')}}" method="GET">
                                                        <div class="row">
                                                            <div class="col-10">
                                                                <label>image</label>
                                                                <input  type="file" name="image" id="img-place">
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="Edit-button">
                                                                    <input type="submit" value="تعديل الصورة" value="{{ $place->image }}" />
                                                                </div>		
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>  
                                                
                                            </div>

                                            <div class="col-md-12 checkbox-line ">
                                                <div class="checkout-form-list">
                                                    <form action="{{ route('Profile.update.category')}}" method="GET" >
                                                        <div class="row">
                                                            <div class="col-10">
                                                                <label>الصنف التابع له المكان <span class="required">*</span></label>
                                                                <select id="category" name="categoryId">
                                                                    @foreach (\App\Models\Categoris::where( 'isParent' ,true)->get() as $item)
                                                                        <option value="{{$item->id}}"  {{$item->id == $place->categoryId ? 'selected' : ' '}}>{{$item->name}}</option>
                                                                    @endforeach
                                                                </select> 
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="Edit-button">
                                                                    <input type="submit" value="تعديل الصنف الرئيسي" />
                                                                </div>		
                                                            </div>
                                                        </div>
                                                    </form>										
                                                </div>
                                            </div>

                                            <div id="sub-category-box" class="col-md-12 checkbox-line">
                                                <form action="{{ route('Profile.update.subCategory')}}" method="GET"  >
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <div class="country-select">
                                                                <label>الصنف الفرعي <span class="required">*</span></label>
                                                                <select  id="sub-category" name="subCategoryId">
                                                                    @foreach (\App\Models\Categoris::where('parentId' , $place->categoryId)->get() as $item)
                                                                        <option value="{{$item->id}}"  {{$item->id == $place->subCategoryId ? 'selected' : ' '}}>{{$item->name}}</option>
                                                                    @endforeach
                                                                </select> 										
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="Edit-button">
                                                                <input type="submit" value="تعديل الصنف الفرعي" />
                                                            </div>		
                                                        </div>
                                                    </div>
                                                </form>		
                                            </div>

                                            <div class="col-md-12 checkbox-line ">
                                                <div class="checkout-form-list">
                                                    <form action="{{ route('Profile.update.placeName')}}" method="GET"  >
                                                        <div class="row">
                                                            <div class="col-10">
                                                                <label>اسم المكان</label>
                                                                <input name="placeName" type="text" placeholder="اسم المكان" value="{{ $place->placeName }}" />
                                                                @error('placeName')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="Edit-button">
                                                                    <input type="submit" value="تعديل اسم المكان" />
                                                                </div>		
                                                            </div>
                                                        </div>
                                                    </form>		
                                                </div>
                                            </div>

                                            <div class="col-md-12 checkbox-line ">
                                                <div class="checkout-form-list">
                                                    <form action="{{ route('Profile.update.phoneNumber')}}" method="GET"  >
                                                        <div class="row">
                                                            <div class="col-10">
                                                                <label>رقم الهاتف <span class="required">*</span></label>
                                                                <input type="text" placeholder="رقم الهاتف" name="phoneNumber"  value="{{ $place->phone}}"/>
                                                                <input style="margin: 15px 8px" type="text" name="addtionalPhone" placeholder="هل هناك رقم تواصل أخر!!" />
                                                                @error('phoneNumber')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror										
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="Edit-button">
                                                                    <input type="submit" value="تعديل رقم الهاتف" />
                                                                </div>		
                                                            </div>
                                                        </div>
                                                    </form>		
                                                </div>
                                            </div>
    
                                            <div class="col-md-12 checkbox-line" >
                                                <div class="checkout-form-list">
                                                    <form action="{{ route('Profile.update.workTime')}}" method="GET"  >
                                                        <div class="row">
                                                            <div class="col-10">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <label>وقت العمل <span class="required">*</span></label> 
                                                                        {{-- <span style="display: none" class="from-massege text-danger">وقت الافتتاح يجب أن يكون قبل وقت الإغلاق </span> --}}
                                                                        <span style="display: none"  class="time-massege text-info">أدخل الوقت بنظام الإثنى عشر ساعة </span>
                                                                        <input  id="from" type="text" placeholder="من" name="from"  value="{{ $place->workTime }}"/>
                                                                        <span style="display: none"  class="num-from-massege text-danger">فقط أرقام لا يسمح بالأحرف</span>
                                                                        @error('from')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label>وقت العمل <span class="required">*</span></label>								
                                                                        <input id="to" type="text" placeholder="إلى" name="to" value="{{ $place->workTime }}" />
                                                                        <span style="display: none" class="to-massege text-danger"> وقت الإغلاق يجب أن يكون بعد وقت الافتتاح</span>
                                                                        <span style="display: none"  class="num-to-massege text-danger">فقط أرقام لا يسمح بالأحرف</span>
                                                                        @error('to')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="Edit-button">
                                                                    <input type="submit" value="تعديل اوقات الدوام" />
                                                                </div>		
                                                            </div>
                                                        </div>
                                                    </form>		
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-12 checkbox-line" >
                                                <div class="checkout-form-list">
                                                    <form action="{{ route('Profile.update.links')}}" method="GET"  >
                                                        <div class="row">
                                                            <div class="col-10">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label> الواتس آب</label>										
                                                                        <input name="whats" type="text" placeholder="  آب/رابط مجموعة"  value="{{ $place->links['whats'] }}"/>
                                                                        @error('whats')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>فيسبوك </label>										
                                                                        <input name="facebook" type="text" placeholder="فيسبوك " value="{{ $place->links['facebook'] }}" />
                                                                        @error('facebook')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>انستغرام</label>										
                                                                        <input name="instagram" type="text" placeholder="انستغرام" value="{{ $place->links['instagram'] }}" />
                                                                        @error('instagram')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="Edit-button">
                                                                    <input type="submit" value="تعديل روابط التواصل" />
                                                                </div>		
                                                            </div>
                                                        </div>
                                                    </form>		
                                                </div>
                                            </div>

                                            <div class="col-md-12 checkbox-line" >
                                                <div class="checkout-form-list">	
                                                    <form action="{{ route('Profile.update.Details')}}" method="GET"  >
                                                        <div class="row">
                                                            <div class="col-10">
                                                                <div class="country-select">
                                                                    <label> تفاصيل  <span class="required">*</span></label>								
                                                                    <input type="text" placeholder="تفاصيل" name="details"  value="{{ $place->details }}"/>
                                                                    @error('details')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror										
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="Edit-button">
                                                                    <input type="submit" value="تعديل الوصف عن المكان" />
                                                                </div>		
                                                            </div>
                                                        </div>
                                                    </form>		
                                                </div>
                                            </div>
                                        </div>											
                                    </div>
                                </div>	
                        </div>

                        <div class="row" style="margin: 20px" dir="rtl">
                            <div class="col-md-12" >
                                <div class="checkout-form-list">
                                    <form action="{{ route('Profile.add.location')}}" method="GET"  >
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label>خط الطول </label> 
                                                        <input id="lng" type="text" placeholder="خط الطول" name="lng" value="{{ $place->latitud ? $place->latitud : ' ' }}" />
                                                    </div>
                                                    <div class="col-6">
                                                        <label>خط العرض</label>								
                                                        <input id="lat" type="text" placeholder="خط العرض" name="lat" value="{{ $place->longitude ? $place->longitude : ' ' }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="Edit-button">
                                                    <input type="submit" value="حفظ العنوان" />
                                                </div>		
                                            </div>
                                        </div>
                                    </form>		
                                </div>
                            </div>
                        
                            <div class="col-md-12 ">
                                <div id="map" style='height:400px'></div>
        
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
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_qDiT4MyM7IxaGPbQyLnMjVUsJck02N0"></script>
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
    </script> --}}
    <script type="text/javascript">
        // Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see the error "The Geolocation service
// failed.", it means you probably did not give permission for the browser to
// locate you.
let map, infoWindow;

        function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 36.2021, lng: 37.1343 },
            zoom: 10,
        });
        infoWindow = new google.maps.InfoWindow();

        const locationButton = document.createElement("button");

        locationButton.textContent = "Pan to Current Location";
        locationButton.classList.add("custom-map-control-button");
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
        locationButton.addEventListener("click", () => {
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                document.getElementById("lat").value = pos['lat'];
                document.getElementById("lng").value = pos['lng'];
                infoWindow.setPosition(pos);
                infoWindow.setContent("Location found.");
                infoWindow.open(map);
                map.setCenter(pos);
                },
                () => {
                handleLocationError(true, infoWindow, map.getCenter());
                },
            );
            } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
            }
        });
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(
            browserHasGeolocation
            ? "Error: The Geolocation service failed."
            : "Error: Your browser doesn't support geolocation.",
        );
        infoWindow.open(map);
        }

        window.initMap = initMap;
    </script>
    
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
    
    
  <script src="{{asset('assets/js/Subscriber/info.js')}}"></script>   

@endsection