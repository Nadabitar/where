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
    <link rel="stylesheet" href="{{asset('assets/css/subscriber/style.css')}}">
    {{-- <script src="{{asset('assets/js/subscriber/vendor/modernizr-2.8.3.min.js')}}"></script> --}}

</head>
<body>
    <main>
        <div class="warrper">
            <div class="img-map"></div>
            <div class="sing-up-container">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <h1 class="text-header">Create Account</h1>
                                <div class="social-links">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <p>or use your email for registration</p>
                                <div class="row">
                                    <div class="col-6">
                                        <input id="fullName" class="@error('fullName') is-invalid @enderror" name="fullName" type="text" placeholder="Name" required>
                                        <span style="display: none" class="name-massege text-danger"> الاسم يجب أن يحتوي فقط على أحرف *</span>
                                        @error('fullName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
            
                                    </div>
                                    <div class="col-6"> 
                                        <input id="email" name="email" class="@error('email') is-invalid @enderror" type="email" placeholder="Email" required>
                                        <span style="display: none" class="email-massege text-danger">xxx@gmail.com أدخل البريد الألكتروني بالشكل*</span>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
    
                                    <div class="col-6"> 
                                        <select id="region" name="regionId">
                                            <option value="hhh">select your region</option>
                                            @foreach (App\Models\Region::get() as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('regionId')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
    
                                    <div class="col-6"> 
                                        <select id="street" name="streetId" disabled>
                                            <option value="hhh">select your street</option>
                                        </select>
                                        @error('streetId')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror	
                                    </div>
    
                                    <div class="col-6"> 
                                        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" id="password" placeholder="{{ __('password') }}" required >
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
    
                                    <div class="col-6"> 
                                        <input id="password-confirm" type="password"  name="password_confirmation" required placeholder="Confirm Password">
                                        <span style="display: none" class="password_confirmation-massege text-danger"> كلمة المرور غير متطابقة *</span>
                                    </div>
                                </div>
    
                                <button class="form_btn">Sign Up</button>
                            </form>
            </div>
            <div class="sing-in-container">
                            <form method="POST" action="{{ route('login') }}" >
                                @csrf
                                <h1 class="text-header">Sing In</h1>
                                <div class="social-links">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-gmail"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <p>or use your email for registration</p>
                                <div class="row">
                                    <div class="col-12"> 
                                        <input name="email" type="email" placeholder="Email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
    
                                    <div class="col-12"> 
                                        <input name="password" type="password" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
    
                                </div>
    
                                <button class="form_btn">Sign In</button>
                            </form>
            </div>
            <div class="overlay-container">
                <div class="overlay-left">
                    <ul class="nav">
                        <li>
                            <img src="{{asset('assets/img/Subscriber/logo.png')}}" alt="logo">
                        </li>
                        <li>
                            <a id="isAdmin" href="#" data-toggle="modal" data-target="#loginadmin">Control Panel</a>
                        </li>
                    </ul>
                    <h1>Welocmr Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button id="signIn" class="overlay_btn">Sign In</button>
                </div>
                <div class="overlay-right">
                    <ul class="nav">
                        <li>
                            <img src="{{asset('assets/img/Subscriber/logo.png')}}" alt="logo">
                        </li>
                        <li>
                            <a id="isAdmin" href="#" >Control Panel</a>
                        </li>
                    </ul>
                    <h1>Hello, Friend</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button id="signUp" class="overlay_btn">Sign Up</button>
                </div>
            </div>
        </div>
    </main>




    {{-- fontawesom icons --}}
    <script src="https://kit.fontawesome.com/623b650a09.js" crossorigin="anonymous"></script>
    {{-- Jquery --}}
    <script src="{{asset('assets/js/Subscriber/vendor/jquery-1.12.0.min.js')}}"></script>
    {{-- bootstrap src --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    {{-- javascript file --}}
    <script src="{{asset('assets/js/Subscriber/vlidation.js')}}"></script>

    <script src="{{asset('assets/js/Subscriber/bootstrap.min.js')}}"></script>

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
</body>
</html>
