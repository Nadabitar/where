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
                            <h4>Show new registeed places</h4>
                            <span class="badge badge-primary text-white">Total registered places : {{$notifications->count()}} </span>
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
                        <li class="breadcrumb-item"><a href="#!">Registered Places</a>
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
                                <th>Details</th>
                                <th>Work Time</th>
                                <th>Region</th>
                                <th>Street</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($notifications as $noti)
                            @php
                                $place = \App\Models\places::where('id' , $noti->data['id'])->first();
                            @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <img style="max-height: 98px; max-width:128px;"
                                    src="{{$place->image}}" alt="{{$place->placeName}} photo">
                                </td>
                                <td style="color: var(--primary); font-size: 16px; font-weight: 600; text-transform: capitalize" >{{$place->placeName}}</td>
                                <td>{{$place->details}}</td>
                                <td>{{$place->workTime}}</td> 
                                <td>{{$place->account->region->name}} </td>
                                <td>{{$place->streetId ? $place->account->street->name : 'null'}} </td>
                                <td>{{$place->category->name }} || {{$place->subCtegoryId ? $place->subCtegory->name : 'null' }} </td>
                                <td class="d-flex">
                                    <a href="{{route('Place.accepted' , ['placeId'=> $place->id , 'id' => $noti->id])}}" class='btn  btn-outline-success  p-1 mx-1' style="vertical-align: middle" data-toggle="tooltip" title="edit" data-placement = "bottom">Accept</a>
                                    <form action="{{route('Place.rejected' ,  ['placeId'=> $place->id , 'id' => $noti->id])}}" method="get">
                                    @csrf
                                    @method('delete')
                                    <a id="BtnDelet" class='btn  btn-outline-danger p-1 mx-1' data-id ="{{$place->id}}" data-toggle="tooltip" title="delete" data-placement = "bottom">
                                       Reject
                                    </form>
                                </td>
                                
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