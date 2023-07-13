@extends('Admin.index')
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
                            <h4>Add New Category</h4>
                            <span>Here You Can Craete A New Category </span>
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
                            <li class="breadcrumb-item"><a href="#!">Category</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Add Category</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->
        <div class="row">
            <div class="col-md-12">
                @include('Admin.layouts.flash')
            </div>
        </div>

        <!-- Page body start -->
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Basic Form Inputs card start -->
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Enter Basic Information</h4>
                                <form method="POST" action="{{route('category.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="drag-image">
                                                <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                                <h6>Drag & Drop File Here</h6>
                                                <a class="drop_button" href="#"><i class="fa fa-trash"></i></a>  
                                            </div> 
                                        <div class="input-group">
                                            <input  id="img-place" class="form-control" type="file" name="image">
                                        </div>
                                        {{-- <div id="holder" style="margin-top:15px;max-height:100px;"></div>--}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Name" value="{{old('Name')}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label for="isParent">Is_Parent</label>
                                            <input data-val="true" type="checkbox" name="isParent" id="isParent">
                                        </div>
                                        <div class="col-sm-8" >
                                            <select id="parent_cat_id"  class="form-control" name="parentId" disabled>
                                                <option value="">--Parent Id--</option>
                                                @foreach ($categories as $item)
                                                <option value="{{$item->id}}" >{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <select  class="form-control" name="status" >
                                                            <option value="">--Status--</option>
                                                            <option value="active" {{old('status') == 'active' ? 'selected' : ' '}}>active</option>
                                                            <option value="unactive" {{old('status') == 'unactive' ? 'selected' : ' '}}>unActive</option>
                                                        </select>
                                                    </div>
                                    </div>
                                    <div class="form-group row text-right">
                                        <div class="col-sm-12">
                                            <input  style="width: 25%"  type="submit" class="btn btn-primary" value="Save">
                                            <input   style="width: 25%"  type="button" class="btn btn-info" value="Cancel">
                                        </div>   
                                    </div>
                                </form>    
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- Page body end -->
@endsection

@section('script')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>


<script>
    $('#isParent').change(function(){
        var is_active = $(this).prop('checked');
        // alert(is_active);
        if (is_active) {
            $('#parent_cat_id').prop('disabled' , false);
        }else{
            $('#parent_cat_id').prop('disabled' , true);
        }

    })
</script>
@endsection