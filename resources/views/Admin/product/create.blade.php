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
                            <h4>Add New Place</h4>
                            <span>Here You Can Craete A New Place </span>
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
                            <li class="breadcrumb-item"><a href="#!">Place</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Add Place</a>
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
                                <form enctype="multipart/form-data"  method="POST" action="{{route('Place.store')}}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="drag-image mt-5">
                                            <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                            <h6>Drag & Drop File Here</h6>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                        <div>
                                            <input class="form-control" type="file" name="image" id="img-place">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="placeName"
                                                placeholder="Place Name" value="{{old('placeName')}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label for="description">Description</label>
                                            <textarea id="description" name="Details"  class="form-control" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <select id="category" name="categoryId" class="form-control">
                                                @foreach (\App\Models\Categoris::where( 'isParent' ,true)->get() as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select> 	
                                        </div>
                                        <div class="col-sm-6">
                                            <div id="sub-category-box" class="col-md-12 checkbox-line">
                                                <div class="country-select">
                                                    <select  id="sub-category" name="subCategoryId" class="form-control">
                                                        
                                                    </select> 										
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" step="any" name="from" placeholder="Work Time From" value="{{old('price')}}">
                                        </div>                                       
                                        <div class="col-sm-6">
                                            <input class="form-control" step="any" type="text" name="to" placeholder="Work Time To" value="{{old('discount')}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="phoneNumber"
                                                placeholder="Phone Number" value="{{old('phoneNumber')}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <select class="form-control" id="region" name="regionId">
                                                <option>العنوان</option>
                                                @foreach (App\Models\Region::get() as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select> 	
                                        </div>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="street" name="streetId" disabled>
                                                <option>الشارع</option>
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
        $('#lfm').filemanager('image');
</script>
<script>
     $(document).ready(function() {
        $('#description').summernote();});
</script>
<script>
    $(document).ready(function() {
       $('#summary').summernote();
});
</script>

<script>
$('#category').change(function(){

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
var html_option = `<option value="">الصنف الفرعي</option>`;
var cat_id = $(this).val();
//   alert(cat_id);
if(cat_id != null){
  $.ajax({
      url : '/subscriber/category/'+cat_id,
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
        "_token":"{{csrf_token()}}",
        id: cat_id,
      },
      success: function(response) {
        console.log(response.data);
        if (response.success) {
          console.log(response.data );
            $('#sub-category-box').removeClass('d-none');
            $.each(response.data , function(id , name){
              console.log(id);
                html_option += `<option value='`+name.id+`'>`+name.name+`</option>`
            }); 
        } else {
            $('#sub-category-box').addClass('d-none');
        }
        $('#sub-category').html(html_option);
      },
  });
}
});
// REgion=====================================


$('#region').change(function(){

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
var html_option = `<option value="">--Street--</option>`;
var rg_id = $(this).val();
//   alert(cat_id);
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
        console.log(response.data);
        if (response.success) {
          // alert('jj');
            $('#street').prop('disabled' , false);
            $.each(response.data , function(id , name){
                html_option += `<option value='`+name.id+`'>`+name.name+`</option>`
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

<script>
    const dropArea = document.querySelector(".drag-image"),
dragText = dropArea.querySelector(".icon"),
button = dropArea.querySelector("button"),
input = document.getElementById("img-place"),
drop_button = document.getElementsByClassName("drop_button");
let file; 


// button.onclick = ()=>{
//   input.click(); 
// }

input.addEventListener("change", function(){
  file = this.files[0];
  console.log(input.value);
  dropArea.classList.add("active");
  viewfile();
  
});

function viewfile(){
  let fileType = file.type; 
  let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
  if(validExtensions.includes(fileType)){ 
    let fileReader = new FileReader(); 
    fileReader.onload = ()=>{
      let fileURL = fileReader.result; 
       let imgTag = `<img src="${fileURL}" alt="image">`;
       let drop_button = `<a onClick ="deleteImage()" class="drop_button" href="#"><i class="fa fa-trash"></i></a>`;
      dropArea.innerHTML = imgTag; 
      dropArea.innerHTML += drop_button; 
    }
    fileReader.readAsDataURL(file);
  }else{
    alert("This is not an Image File!");
    dropArea.classList.remove("active");
    dragText.textContent = "Drag & Drop to Upload File";
  }
}

function  deleteImage() {
  input.value = null;
  console.log('kkk');
  dropArea.classList.remove("active");
  dropArea.removeChild(dropArea.firstChild);
  dropArea.removeChild(dropArea.firstChild);
  dropArea.appendChild(dragText);
};

</script>
@endsection