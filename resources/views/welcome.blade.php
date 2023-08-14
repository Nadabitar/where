<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>SIGN UP</title>
    <!-- CSS Style Sheet -->

        <!-- Bootstrab Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <!-- all css here -->
    <link rel="stylesheet" href="{{asset('assets/css/subscriber/bootstrap.min1.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/subscriber/style.css')}}">
    <script src="{{asset('assets/js/subscriber/vendor/modernizr-2.8.3.min.js')}}"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <section id="login" >
        <div class="row">
            <div class="col-md-7  left">
                @include('subscriber.partial.flash')
                    <div class="content">
                        <form method="POST" action="{{ route('register') }}" dir="rtl">
                            @csrf
                            <h3 dir="rtl"> <i class="fa fa-map"></i>
                            إنشاء حساب جديد
                            </h3>
                            <input  type="text" name="fullName" class="@error('fullName') is-invalid @enderror" id="fullName" placeholder="{{ __('الاشم الكامل') }} " required autofocus>
                            <span style="display: none" class="name-massege text-danger"> الاسم يجب أن يحتوي فقط على أحرف *</span>
                            @error('fullName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                                    {{-- <label>العنوان <span class="required">*</span></label> --}}
                                    <select id="region" id="region" name="regionId">
                                        <option>العنوان</option>
                                        @foreach (App\Models\Region::get() as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select> 	
                                    @error('regionId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                
                
                            
                                    {{-- <label>الشارع <span class="required">*</span></label>								 --}}
                                    <select  id="street" name="streetId" disabled>
                                        <option>الشارع</option>
                                    </select> 
                                    @error('streetId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror	
                                

                            
                            <input class=" @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="{{ __('البريد الإلكتروني xxx@gmail.com') }}"required >
                            <span style="display: none" class="email-massege text-danger">xxx@gmail.com أدخل البريد الألكتروني بالشكل*</span>
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
    
                            <input  type="password" class="@error('password') is-invalid @enderror" name="password" id="password" placeholder="{{ __('كلمة المرور') }}" required >
                            <label  for="showPassword"> <input type="checkbox" name="" id="showPassword"></label>
                            <span style="display: none" class="password-massege text-danger"> الاسم يجب أن يحتوي فقط على أحرف *</span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input  id="password-confirm" type="password"  name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('تأكيد كلمة المرور') }}">
                            <span style="display: none" class="password_confirmation-massege text-danger"> كلمة المرور غير متطابقة *</span>
                            
                            <button type="submit">تسجل الحساب</button>
                            <div class="login-content">
                                <p class="already">
                                    <a id="#showlogin" href="#" data-toggle="modal" data-target="#loginModal">تسجيل دخول!</a>
                                </p>
                                <p class="already">
                                    <a id="isAdmin" href="#" data-toggle="modal" data-target="#loginadmin">الدخول إلى لوحة التحكم!</a>
                                </p>
                            </div>
                        </form>
                    </div>
            </div>
            <div class="col-md-5 p-0">
                <div class=" right">
                    <div class="where-img">
                        <h1>دليل حلب الشامل</h1>
                        <img src="{{asset('assets/img/Subscriber/syria.png')}}" alt="sorry">
                        <h2>لكافة الخدمات </h2>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
        <!-- loginModal end -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div >
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                </div>
                <div class="modal-body">
                    <div class="login">
                        <div class="login-form-container">
                            <div class="login-text">
                                <h2>login</h2>
                                <span>Please login using account detail bellow.</span>
                            </div>
                            <div class="login-form">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <input type="text" name="email" placeholder="Email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    <input id="subsPassword" class="@error('password') is-invalid @enderror" type="password" name="password" placeholder="PASSWORD" required autocomplete="current-password">
                                    <label  for="showPassword1"> <input type="checkbox" id="showPassword1"></label>
                                        
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    <div class="button-box">
                                        <button type="submit" class="default-btn ">Login</button>
                                        <div class="login-toggle-btn">
                                            <!-- <input type="checkbox" id="remember">
                                            <label for="remember">Remember me</label> -->
                                            <a href="#">Forgot Password?</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- loginModal  -->

            <!-- loginModal end -->
            <div class="modal fade" id="loginadmin" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div >
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="login">
                                <div class="login-form-container">
                                    <div class="login-text">
                                        <h2>الدخول إلى لوحة التحكم</h2>
                                        <span>الرجاء إدخال الكود الخاص بك للتأكد من أن لك صلاحيات الدخول</span>
                                    </div>
                                    <div class="login-form">
                                        <form method="POST" action="{{ route('adminLoginPost') }}">
                                            @csrf
                                            <input type="text" name="email" placeholder="البريد الإلكتروني" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            <input id="adminPassword" class="@error('password') is-invalid @enderror" type="password" name="password" placeholder="كلمة المرور" required autocomplete="current-password">
                                            <label  for="showPassword2"> <input type="checkbox" name="" id="showPassword2"></label>                                                
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            <div class="button-box">
                                                <button type="submit" class="default-btn ">تسجيل الدخول</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- loginModal  -->


    <script src="{{asset('assets/js/Subscriber/vendor/jquery-1.12.0.min.js')}}"></script>
    <script src="{{asset('assets/js/Subscriber/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/Subscriber/vlidation.js')}}"></script>
<script>
        $('#region').change(function(){

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var html_option = `<option value=""> شارع </option>`;
        var rg_id = $(this).val();
        //   alert(rg_id);
        if( rg_id != null){
        $.ajax({
            url : '/subscriber/region/'+ rg_id,
            type : "POST" ,
            dataType: 'json',
            CORS: true ,
            contentType:'application/json',
            secure: true,
            headers: {
            'Access-Control-Allow-Origin': '*',
            },
            beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Basic " + btoa(""));
            },
            data : {
                "_token":"{{ csrf_token() }}",
                id: rg_id,
            },
            success: function(response) {
                if (response.success) {
                    $('#street').prop('disabled' , false);
                    // alert(response.data);
                    $.each(response.data , function(name , id){
                        html_option += `<option value='`+id+`'> `+name+`</option>`
                    }); 
                } else {
                    $('#street').addAttr('disabeld');
                }
                $('#street').html(html_option);
            },
        });
        }
        });

</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
