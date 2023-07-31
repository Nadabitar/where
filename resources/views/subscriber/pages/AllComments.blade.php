@extends('subscriber.app')

@section('content')
@include('subscriber.partial.navbar', ['place'=>$place ,
'promo' => $promo])

            <!-- Search Start -->
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
            <form action="{{route('Comments.search')}}" method="POST">
                @csrf
                @method('POST')
                <div class="row g-2">
                        <div class="col-md-10">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input name="name" dir="rtl" type="text" class="form-control border-0 py-3" placeholder="ابحث عن طريق اسم المستخدم">
                                </div>
                                <div class="col-md-6">
                                    <input name="date" dir="rtl" type="date" class="form-control border-0 py-3" placeholder="ابحث عن طريق التاريخ النشر">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-dark border-0 w-100 py-3">ابحث</button>
                        </div>
                </div>
            </form>
            </div>
        </div>

        
@include('subscriber.partial.flash')
        <!-- Search End -->
        <section class="service-section">
            <div class="container">
                <div class="row">
                <h1 class="add-service-text">عرض كافة التعليقات</h1>
                    <div class="col-md-12">
                        <div class="table-wrap">
                            @if ($comments->count() != 0)
                                <table class="table table-responsive-xl">
                                <thead>
                                    <tr>
                                    <th>صورة</th>
                                    <th>اسم المستخدم</th>
                                    <th>التعليق</th>
                                    <th>التقييم</th>
                                    <th>تاريخ النشر</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{$comments->comment}} --}}
                                    @foreach ($comments as $comment)
                                    <tr class="alert" role="alert">
                                        <td>
                                            @if ($comment->gender == 'male')
                                            <img style="max-height: 98px; max-width:128px;"
                                            src="{{asset('backend/assets/images/male.jpg')}}" alt="{{$comment->gender}} user">
                                            @else
                                            <img style="max-height: 98px; max-width:128px;"
                                            src="{{asset('backend/assets/images/fmale.png')}}" alt="{{$comment->gender}} famle user">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="pl-3 email">
                                                <span>{{$comment->fullName}}</span>
                                                <span>البريد الالكتروني: {{$comment->email}}</span>
                                            </div>
                                        </td>
                                        <td>{{$comment->pivot->content}}</td>
                                        <td>
                                            @for ($i = 0; $i < $comment->pivot->rate; $i++)
                                                <i class="fa fa-star text-warning"></i>
                                            @endfor
                                        </td>
                                        <td>{{$comment->pivot->created_at}}</td>
                                    @endforeach
                                </tbody>
                                </table>    
                            @else
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
                                </div>
                                </section>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>




@endsection

@section('scripts')
<script>
  $('input[name=toggle]').change(function(){
      var mode = $(this).prop('checked');
      var id  = $(this).val();
      $.ajax({
          url: "{{route('category.status')}}",
          type : 'post' ,
          data : {
              _token : '{{csrf_token()}}',
              mode : mode,
              id : id,
          },
          success:function(response){
              if(response.status){
              alert(response.msg);
              }else{
                  alert('Please Try Again');
              }
          }
      });
  })
</script>
@endsection