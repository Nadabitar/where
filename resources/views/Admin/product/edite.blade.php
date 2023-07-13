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
                            <h4>Edit Products</h4>
                            <span>Here You Can Edite A New Product </span>
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
                            <li class="breadcrumb-item"><a href="#!">Product</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Edit Product</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.flash')
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
                                <form method="POST" action="{{route('product.update' , $product->id)}}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="title"
                                                placeholder="Title" value="{{$product->title}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <select class="form-control" name="vendorId">
                                                <option value="">Vendor</option>
                                                @foreach (\App\Models\User::where('role' , 'vendor')->get() as $item)
                                                    <option value="{{$item->id}}" {{$product->vendorId == $item->id ? 'selected' : ''}}>
                                                        {{$item->fullName}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                            <input value="{{$product->photo}}" id="thumbnail" class="form-control" type="text" name="photo">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label for="description">Description</label>
                                            <textarea  id="description" name="description"  class="form-control" >{{$product->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label for="summary">summary</label>
                                            <textarea id="summary" name="summary"  class="form-control" >{{$product->summary}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input class="form-control" type="number" name="stock" placeholder="stock" value="{{$product->stock}}">
                                        </div>
                                        <div class="col-sm-6">
                                            <select  class="form-control" name="size" >
                                                <option value="" >--Size--</option>
                                                <option value="S" {{$product->size == 'S' ? 'selected' : ' '}}>Small</option>
                                                <option value="M" {{$product->size == 'M' ? 'selected' : ' '}}>Medium</option>
                                                <option value="L" {{$product->size == 'L' ? 'selected' : ' '}}>Large</option>
                                                <option value="X" {{$product->size == 'X' ? 'selected' : ' '}}>xLarge</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input class="form-control" type="number" step="any" name="price" placeholder="Price" value="{{$product->price}}">
                                        </div>                                       
                                        <div class="col-sm-6">
                                            <input class="form-control" step="any" type="number" name="discount" placeholder="Discount" value="{{$product->discount}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <select  class="form-control" name="brandId" >
                                                <option value="">--Brand--</option>
                                                @foreach (\App\Models\Brand::get() as $item)
                                                    <option value="{{$item->id}}" {{$product->brandId == $item->id ? 'selected' : ''}}>{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <select id="cat_id"  class="form-control" name="catId" >
                                                @foreach (\App\Models\Category::where(['status' => 'active' , 'isParent' => 1])->get() as $item)
                                                    <option value="{{$item->id}}" {{$product->catId == $item->id ? 'selected' : ''}}>{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="child_cat_id" id="child_cat_id"  class="form-control" name="status" >
                                                @if ($product->child_cat_id != null)
                                                <option value="{{$product->child_cat_id}}" selected>{{$product->childCategory->title}}</option>
                                                @else
                                                    
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <select  class="form-control" name="status" >
                                                <option value="">--Status--</option>
                                                <option value="active" {{$product->status == 'active' ? 'selected' : ' '}}>active</option>
                                                <option value="unactive" {{$product->status == 'unactive' ? 'selected' : ' '}}>unActive</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select  class="form-control" name="condition" >
                                                <option value="" >--Condition--</option>
                                                <option value="new"  {{$product->condition == 'new' ? 'selected' : ' '}}>New</option>
                                                <option value="popular" {{$product->condition == 'popular' ? 'selected' : ' '}}>Popular</option>
                                                <option value="winter" {{$product->condition == 'winter' ? 'selected' : ' '}}>Winter</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row text-right">
                                        <div class="col-sm-12">
                                            <input  style="width: 25%"  type="submit" class="btn btn-primary" value="Update">
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
        $('#description').summernote();
    });
</script>
<script>
    $(document).ready(function() {
        $('#summary').summernote();
    });
</script>

<script>
    $('#cat_id').change(function(){
        var html_option = `<option value="">--Child Category--</option>`;
        var cat_id = $(this).val();
        // alert(cat_id);
        if(cat_id != null){
            $.ajax({
                url : "/admin/category/"+cat_id+"/child",
                type : "Post" ,
                data : {
                    _token : "{{csrf_token()}}",
                    id:cat_id,
                },
                success:function(response) {
                    if (response.status) {
                        $('#child_cat_id').removeClass('d-none');
                        $.each(response.data , function(id , title){
                            html_option += `<option value='`+id+`'>`+title+`</option>`
                        });
                       
                    } else {
                        $('#child_cat_id').addClass('d-none');
                       ;
                    }
                    $('#child_cat_id').html(html_option);
                }
            });
        }
    })
</script>
@endsection