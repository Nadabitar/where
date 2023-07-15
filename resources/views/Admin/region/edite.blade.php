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
                            <h4>Edit  Banners</h4>
                            <span>Here You Can Edite Banner </span>
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
                            <li class="breadcrumb-item"><a href="#!">Banner</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Edit Banner</a>
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
                                <form method="POST" action="{{route('banner.update' , $banner->id)}}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="title"
                                                placeholder="Title" value="{{$banner->title}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <select  class="form-control" name="status" >
                                                            <option value="">--Status--</option>
                                                            <option value="active" {{$banner->status == 'active' ? 'selected' : ' '}}>active</option>
                                                            <option value="unactive" {{$banner->status== 'unactive' ? 'selected' : ' '}}>unActive</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <select  class="form-control" name="condition" >
                                                            <option value="" >--Condition--</option>
                                                            <option value="banner"  {{$banner->condition == 'banner' ? 'selected' : ' '}}>Banner</option>
                                                            <option value="promo" {{$banner->condition == 'promo' ? 'selected' : ' '}}>Promote</option>
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
                                            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$banner->photo}}">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;">

                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <textarea value="{{$banner->desription}}" id="summernote" name="description"  class="form-control" placeholder="Description"></textarea>
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
@endsection