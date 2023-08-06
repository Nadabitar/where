@extends('Admin.index' , ['notifications' => $notifications])
@section('content')
<div class="main-body">
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <a href="{{route('region.Add')}}"> <i class="ti-plus bg-c-blue"></i></a>
                        <div class="d-inline">
                            <h4>Show All Region and Street</h4>
                            <span class="badge badge-primary text-white">Total Regions : {{App\Models\Region::all()->count()}} </span>
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
                        <li class="breadcrumb-item"><a href="#!">Region</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">All Regions</a>
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
                <h5>Regions table</h5>
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
                                <th>Name</th>
                                <th>is_Parent</th>
                                <th>Parent</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($regions as $region)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                <td>{{$region->name}}</td>
                                <td>{{$region->isParent}}</td>
                                <td>
                                    {{$region->parentId ? App\Models\Region::where('id' , $region->parentId)->first()->name : 'null'}}
                                </td>
                                <td>
                                        <input value="{{$region->id}}" name="toggle" type="checkbox" data-toggle="toggle" data-on="Active" data-off="unActive" data-onstyle="success" data-offstyle="danger" data-size='xs' {{$region->status == true ? 'checked' : ' '}} ></td>
                                <td class="d-flex">
                                    <a href="{{route('region.edit' , $region->id)}}" class='btn btn-sm btn-outline-warning  p-2 mx-1 ' data-toggle="tooltip" title="edit" data-placement = "bottom"><i class="ti-pencil "></i></a>
                                    <form action="{{route('region.delete' , $region->id)}}" method="get">
                                    @csrf
                                    @method('delete')
                                    <a id="BtnDelet" class='btn btn-sm btn-outline-danger p-2 mx-1' data-id ="{{$region->id}}" data-toggle="tooltip" title="delete" data-placement = "bottom">
                                        <i class="ti-trash"></i></a>
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
            // alert('kk');
            var mode = $(this).prop('checked');
            var id  = $(this).val();
            // alert(id);
            $.ajax({
                url: "{{route('region.status')}}",
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