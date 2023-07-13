@extends('Admin.layouts.index')
@section('content')
<div class="main-body">
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ti-arrow-left bg-c-blue"></i>
                        <div class="d-inline">
                            <h4>Show All Users</h4>
                            <span class="badge badge-primary text-white">Total Users : {{App\Models\User::all()->count()}} </span>
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
                        <li class="breadcrumb-item"><a href="#!">Users</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">All Users</a>
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
                <h5>Uers table</h5>
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
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Region</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                <td>
                                    @if ($user->gender == 'male')
                                        <img style="max-height: 98px; max-width:128px;"
                                        src="{{asset('backend/assets/images/male.jpg')}}" alt="{{$user->gender}} user">
                                    @else
                                    <img style="max-height: 98px; max-width:128px;"
                                    src="{{asset('backend/assets/images/fmale.png')}}" alt="{{$user->gender}} famle user">
                                    @endif
                                   
                                </td>
                                <td>{{$user->fullName}}</td>
                                <th>
                                   {{$user->email}}
                                </th>
                                <td>
                                    {{$user->phone}}
                                </td>
                                <td>
                                    {{$user->region->name}} <span>/ {{$user->streetId ? \App\Models\Region::where('id' , $user->streetId)->first()->name : " "}}</span>
                                </td>
                                <td class="d-flex">
                                    <p style="cursor: pointer;" data-toggle="modal" data-target="#showuser{{$user->id}}" title="view" class="my-2 text-success">   {{$user->makeComment->count()}} Comments</p>
                                    <a class='btn btn-sm btn-outline-success  p-2 mx-1 ' data-toggle="modal" data-target="#showuser{{$user->id}}" title="view" data-placement = "bottom">Show All Comments</a>
                                </td>

                                
                                {{-- Model Show user --}}

                                <div class="modal fade" id="showuser{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <@php
                                        $comments = \App\Models\user::where('id' ,$user->id)->with('makeComment')->first()->makeComment;
                                    @endphp
                                    
                                    <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="text-transform: capitalize" style="color:var(--dark);" class="modal-title text-center d-block" id="exampleModalLabel">Here you can see all comments for user</h5>
                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($comments as $comment)
                                            @php
                                                $rate = $comment->pivot->rate
                                            @endphp
                                                <div class="card mb-3">
                                                    
                                                    <div class="profile-place">
                                                        <div class="right">
                                                            <img src="{{$comment->image}}" alt="">
                                                        </div>
                                                        <div class="left">
                                                            <div class="left-header row">
                                                                <div class="col place-title">{{$comment->placeName}}</div>
                                                                <div class="col place-rate">
                                                                    @for ($i =  0 ; $i < $rate; $i++)
                                                                        <i class="ti-star"></i>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            <div class="left-body row">
                                                                <div class="col"> <p> <i class="ti-comment"></i> 
                                                                    {{$comment->pivot->content}}</p>
                                                                </div>
                                                                <div class="col comment-time"><p>{{$comment->pivot->created_at ? $comment->pivot->created_at : "undefind" }}</p></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" style="background: var(--secondary); color: white;" class="btn" data-bs-dismiss="modal">Close</button>
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
{{-- <script>
     $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }   
    });
    $('#BtnDelet').click(function (e) {
        var form = $(this).closest('form');
        var dataID = $(this).data('id');
        e.preventDefault();
        alert(dataID);
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true})
                .then((willDelete) => {
                if (willDelete)
                {
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
                url: "{{route('product.status')}}",
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
</script> --}}
@endsection