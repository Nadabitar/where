@extends('subscriber.app')
@section('content')
    
            {{-- @include('subscriber.partial.top') --}}
                <!-- breadcrumb start -->
                <div class="breadcrumb-area" id="profile-enter">
                    <div class="container-fluid text-center">
                        <div class="breadcrumb-stye gray-bg ptb-100">
                            <label for="images" class="drop-container">
                                <span class="drop-title">Drop files here</span>
                                or
                                <input id="place-image" type="file" name="image"  accept="image/jpeg, image/png, image/jpg" required>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- breadcrumb end -->
                <!-- contact-area start -->
                <div class="contact-area ptb-100">
                    <div class="container-fluid map-contact">
                        <div class="row">
                            <div class="col-lg-7 col-md-7 col-sm-12 text-center">
                                <div class="contact-from gray-bg">
                                    <form id="contact-form" action="mail.php" method="post">
                                        <input name="placeName" type="text" placeholder="Brand Name">
                                        <input name="phoneNumber" type="email" placeholder="Phone Number">
                                        <input name="workTime" type="text" placeholder="Work Time">
                                        <textarea name="details" placeholder="Your message"></textarea>
                                    </form>
                                    <p class="form-messege"></p>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <div class="communication contact-from">
                                    <form action="" method="post">
                                        <div class="single-communication">
                                        <div class="communication-icon">
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </div>
                                        <div class="communication-text">
                                            <!-- <h3>Facebook:</h3> -->
                                            <input type="url" placeholder="Facebook">
                                        </div>
                                        </div>
                                        <div class="single-communication">
                                            <div class="communication-icon">
                                                <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                            </div>
                                            <div class="communication-text">
                                                <!-- <h3>What's up:</h3> -->
                                                <input type="url" placeholder="What's Up">
                                            </div>
                                        </div>
                                        <div class="single-communication">
                                            <div class="communication-icon">
                                                <i class="fa fa-instagram" aria-hidden="true"></i>
                                            </div>
                                            <div class="communication-text">
                                                <!-- <h3>Instagram</h3> -->
                                                <input type="url" placeholder="Instagram">
                                            </div>
                                        </div>
                                        <div class="single-communication">
                                            <div class="communication-icon">
                                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="communication-text">
                                                <!-- <h3>Gmail:</h3> -->
                                                <input type="url" placeholder="Gmail">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
    
                        <div class="row put-margin">
                            <div class="col-lg-7 col-md-7 col-sm-12 text-center">
                                <div class="contact-from gray-bg">
                                    <form id="contact-form" action="mail.php" method="post">
                                        <select class="form-control">
                                            <option class="hidden"  selected disabled>Region</option>
                                            <option>What is your Birthdate?</option>
                                            <option>What is Your old Phone Number</option>
                                            <option>What is your Pet Name?</option>
                                        </select>
    
                                        <select class="form-control">
                                            <option class="hidden"  selected disabled>Street</option>
                                            <option>What is your Birthdate?</option>
                                            <option>What is Your old Phone Number</option>
                                            <option>What is your Pet Name?</option>
                                        </select>
                                    </form>
                                    <p class="form-messege"></p>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <div class="communication contact-from">
                                    <form action="" method="post">
                                        <select class="form-control">
                                            <option class="hidden"  selected disabled>Category</option>
                                            <option>What is your Birthdate?</option>
                                            <option>What is Your old Phone Number</option>
                                            <option>What is your Pet Name?</option>
                                        </select>
    
                                        <select class="form-control">
                                            <option class="hidden"  selected disabled>Sub Category</option>
                                            <option>What is your Birthdate?</option>
                                            <option>What is Your old Phone Number</option>
                                            <option>What is your Pet Name?</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
    
                        <!-- <div class="row put-margin">
                            <div class="col">
                                <div class="contact-from gray-bg">
                                    <form id="contact-form" action="mail.php" method="post">
                                        <select class="form-control">
                                            <option class="hidden"  selected disabled>Category</option>
                                            <option>What is your Birthdate?</option>
                                            <option>What is Your old Phone Number</option>
                                            <option>What is your Pet Name?</option>
                                        </select>
                                        <select class="form-control">
                                            <option class="hidden"  selected disabled>Sub Category</option>
                                            <option>What is your Birthdate?</option>
                                            <option>What is Your old Phone Number</option>
                                            <option>What is your Pet Name?</option>
                                        </select>
    
                                        <select class="form-control">
                                            <option class="hidden"  selected disabled>Please select your Sequrity Question</option>
                                            <option>What is your Birthdate?</option>
                                            <option>What is Your old Phone Number</option>
                                            <option>What is your Pet Name?</option>
                                        </select>
    
                                        <select class="form-control">
                                            <option class="hidden"  selected disabled>Please select your Sequrity Question</option>
                                            <option>What is your Birthdate?</option>
                                            <option>What is Your old Phone Number</option>
                                            <option>What is your Pet Name?</option>
                                        </select>
                                    </form>
                                    <p class="form-messege"></p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="contact-map pb-100">
                    <div id="hastech">Mappppppps</div>
                </div>
    
                <div  class="breadcrumb-area">
                    <button class="submit" type="submit">Send Information</button>
                </div>
                <!-- contact-area end -->

        
        </div>
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
    <script src="{{asset('assets/js/Subscriber/profile.js')}}"></script>   

@endsection