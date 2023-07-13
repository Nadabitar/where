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
                            <h4>Edit  Category</h4>
                            <span>Here You Can Edite Category </span>
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
                            <li class="breadcrumb-item"><a href="#!">Edit Category</a>
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
                                <h4 class="sub-title">Update  Information</h4>
                                <form method="POST" action="{{route('category.update' , $category->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="drag-image">
                                                @if ($category->svg)
                                                <img src="{{$category->svg}}" alt="image">
                                                <a onClick ="deleteImage()" class="drop_button" href="#"><i class="fa fa-trash"></i></a>
                                                @else
                                                <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                                <h6>Drag & Drop File Here</h6>
                                                <a class="drop_button" href="#"><i class="fa fa-trash"></i></a>  
                                                @endif
                                            </div> 
                                        <div class="input-group">
                                            <input id="img-place" class="form-control" type="file" name="image">
                                        </div>
                                        {{-- <div id="holder" style="margin-top:15px;max-height:100px;"></div>--}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Title" value="{{$category->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label for="isParent">Is_Parent</label>
                                            <input type="checkbox" name="isParent" id="isParent" {{$category->isParent == 'true' ? 'checked' : " "}}>
                                        </div>
                                        <div class="col-sm-8" >
                                            <select id="parent_cat_id"  class="form-control" name="parentId" disabled>
                                                <option >--Parent Id--</option>
                                                <option selected>{{App\Models\Categoris::where('id' , $category->parentId)->value('name')}}</option>
                                                @foreach (App\Models\Categoris::all() as $item)
                                                <option value="{{$item->id}}" >{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <select  class="form-control" name="status" >
                                                            <option value="">--Status--</option>
                                                            <option value="active" {{$category->status == 'active' ? 'selected' : ' '}}>active</option>
                                                            <option value="unactive" {{$category->status== 'unactive' ? 'selected' : ' '}}>unActive</option>
                                                        </select>
                                                    </div>
                                    </div>
                                    <div class="form-group row text-right">
                                        <div class="col-sm-12">
                                            <input  style="width: 25%"  type="submit" class="btn btn-primary" value="update">
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
        $('#lfm').filemanager('image');
</script>
<script>
     $(document).ready(function() {
        $('#summernote').summernote();
});
</script>
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