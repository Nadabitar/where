@extends('Admin.index' , ['notifications' => $notifications])
@section('content')
<div class="main-body">
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <a href="{{route('Place.Add')}}"> <i class="ti-plus bg-c-blue"></i></a>
                        <div class="d-inline">
                            <h4>Show All Places</h4>
                            <span class="badge badge-primary text-white">Total Places : {{App\Models\Places::all()->count()}} </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                       <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin')}}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Places</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">All Places</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <!-- Page-body start -->
    <div class="page-body">
        <!-- Hover table card start -->
        <div class="card">
            <div class="card-header">
                <h5>Products table</h5>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="icofont icofont-simple-left "></i></li>        
                        <li><i class="icofont icofont-maximize full-card"></i></li>        
                        <li><i class="icofont icofont-minus minimize-card"></i></li>        
                        <li><i class="icofont icofont-refresh reload-card"></i></li>        
                    </ul>
                </div>
            </div>
            <div class="card-block table-border-style">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Photo</th>
                                <th>Place Name</th>
                                <th>Saved</th>
                                <th>Comments</th>
                                <th>Joining at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($places as $place)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <img style="max-height: 98px; max-width:128px;"
                                    src="{{$place->image}}" alt="{{$place->placeName}} photo">
                                </td>
                                <td style="color: var(--primary); font-size: 16px; font-weight: 600; text-transform: capitalize" >{{$place->placeName}}</td>
                                <td>{{$place->saved ? $place->saved->count() : 0}}</td>
                                <td>{{$place->comment ? $place->comment->count() : 0}}</th>      {{-- {{$place->region->name}}  --}}
                                <td>
                                    <span style="color: var(--primary)" class="badge p-2">{{$place->created_at}}</span>
                                </td>
                                <td class="d-flex">
                                    @if ($place->accountId == null)
                                    <a href="{{route('Place.edit' , $place->id)}}" class='btn btn-sm btn-outline-warning  p-1 mx-1' data-toggle="tooltip" title="edit" data-placement = "bottom"><i class="ti-pencil "></i></a>
                                    @endif
                                    <a class='btn btn-sm btn-outline-success  p-1 mx-1' data-toggle="modal" data-target="#showProduct{{$place->id}}" title="view" data-placement = "bottom"><i class="ti-eye"></i></a>
                                    <form action="{{route('Place.delete' , $place->id)}}" method="get">
                                    @csrf
                                    @method('delete')
                                    <a id="BtnDelet" class='btn btn-sm btn-outline-danger p-1 mx-1' data-id ="{{$place->id}}" data-toggle="tooltip" title="delete" data-placement = "bottom">
                                        <i class="ti-trash"></i></a>
                                    </form>
                                </td>
                                
                                {{-- Model Show Product --}}

                                <div class="modal fade" id="showProduct{{$place->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <@php
                                        $place = \App\Models\Places::where('id' ,$place->id)->first();
                                        $cat = new  \App\Models\Categoris();
                                    @endphp
                                    <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="wrapper">
                                          
                                            <div class="profile-card js-profile-card">
                                                <div class="profile-card__img">
                                                    <img src="{{$place->image}}" alt="profile card">
                                                </div>
                                            
                                                <div class="profile-card__cnt js-profile-cnt">
                                                    <div class="profile-card__name">{{$place->placeName}}</div>
                                                    <div class="profile-card__txt"> {{$place->details ? $place->details : 'No Details'}}</div>
                                                    <div class="profile-card-loc">
                                                    <span class="profile-card-loc__icon">
                                                        <i class="ti-location-pin icon"></i>
                                                    </span>
                                            
                                                    <span class="profile-card-loc__txt">
                                                        {{$place->accountId != null ? $place->account->region->name : $place->region->name}} 
                                                    </span>
                                                    </div>
                                            
                                                    <div class="profile-card-inf">
                                                    <div class="profile-card-inf__item">
                                                        <div class="profile-card-inf__title">{{$place->category->name}}</div>
                                                        <div class="profile-card-inf__txt">Category</div>
                                                    </div>
                                            
                                                    <div class="profile-card-inf__item">
                                                        <div class="profile-card-inf__title">
                                                            @foreach ($cat->getAllChildByParent($place->category->id) as $item)
                                                              <span>  {{$item->name}}  </span> <Span class="sprator"> / </Span>
                                                            @endforeach

                                                        </div>
                                                        <div class="profile-card-inf__txt">Sub Category</div>
                                                    </div>
                                            
                                                    <div class="profile-card-inf__item">
                                                        <div class="profile-card-inf__title">{{$place->phone}}</div>
                                                        <div class="profile-card-inf__txt">Phone Number</div>
                                                    </div>
                                            

                                                    <div class="profile-card-inf__item">
                                                        <div class="profile-card-inf__title">{{$place->workTime}}</div>
                                                        <div class="profile-card-inf__txt">Work Time</div>
                                                    </div>
                                                    </div>
                                            
                                                    <div class="profile-card-social">
                                                        <a href="" class="profile-card-social__item facebook" target="_blank">
                                                            <span class="icon-font">
                                                                <i class="ti-facebook icon"><use xlink:href="#icon-facebook"></use></i>
                                                            </span>
                                                        </a>
                                                        
                                                        <a href="" class="profile-card-social__item whts" target="_blank">
                                                            <span class="icon-font">
                                                                <i class="ti-skype icon"><use xlink:href="#icon-link"></use></i>
                                                            </span>
                                                        </a>
                                                        <a href="" class="profile-card-social__item instagram" target="_blank">
                                                            <span class="icon-font">
                                                                <i class="ti-instagram icon"><use xlink:href="#icon-link"></use></i>
                                                            </span>
                                                        </a>
                                            
                                                    </div>
                                            
                                                    <div class="profile-card-ctr">
                                                        <button class="profile-card__button button--blue js-message-btn">Message</button>
                                                        <button class="profile-card__button button--orange">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
             
            </div>
        </div>
        <!-- Hover table card end -->
    </div>
    <!-- Page-body end -->

@endsection

@section('script')
<script>
     $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }   
    });
    $('#BtnDelet').click(function (e) {
        var form = $(this).closest('form');
        var dataID = $(this).data('id');
        e.preventDefault();
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true})
                .then((willDelete) => {
                if (willDelete)
                {
                    alert(dataID);
                    form.submit();
                    swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success"});
                } 
                else
                {
                    swal("Your imaginary file is safe!");
                }
        });
        });
</script>


<script>
        $('input[name=toggle]').change(function(){
            var mode = $(this).prop('checked');
            var id  = $(this).val();
            // alert(id);
            $.ajax({
                url: "{{route('Place.status')}}",
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