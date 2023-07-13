<!-- Required Jquery -->





<script type="text/javascript" src="{{asset("backend/assets/js/jquery/jquery.min.js")}}"></script>
<script type="text/javascript" src="{{asset("backend/assets/js/jquery-ui/jquery-ui.min.js")}}"></script>
<script type="text/javascript" src="{{asset("backend/assets/js/popper.js/popper.min.js")}}"></script>
<script type="text/javascript" src="{{asset("backend/assets/js/bootstrap/js/bootstrap.min.js")}}"></script>

<script src="{{asset("backend/summernote/summernote.js")}}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{asset("backend/assets/js/jquery-slimscroll/jquery.slimscroll.js")}}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{asset("backend/assets/js/modernizr/modernizr.js")}}"></script>
<!-- am chart -->
<script src="{{asset("backend/assets/pages/widget/amchart/amcharts.min.js")}}"></script>
<script src="{{asset("backend/assets/pages/widget/amchart/serial.min.js")}}"></script>
<!-- Todo js -->
<script type="text/javascript " src="{{asset("backend/assets/pages/todo/todo.js")}} "></script>
<!-- Custom js -->
<script type="text/javascript" src="{{asset("backend/assets/pages/dashboard/custom-dashboard.js")}}"></script>
<script type="text/javascript" src="{{asset("backend/assets/js/script.js")}}"></script>
<script type="text/javascript " src="{{asset("backend/assets/js/SmoothScroll.js")}}"></script>
<script src="{{asset("backend/assets/js/pcoded.min.js")}}"></script>
<script src="{{asset("backend/assets/js/demo-12.js")}}"></script>
<script src="{{asset("backend/assets/js/jquery.mCustomScrollbar.concat.min.js")}}"></script>


<script>
var $window = $(window);
var nav = $('.fixed-button');
    $window.scroll(function(){
        if ($window.scrollTop() >= 200) {
         nav.addClass('active');
     }
     else {
         nav.removeClass('active');
     }
 });
</script>

@yield('script')

<script>
    setTimeout(function(){
        $('#alert').slideUp();
    } , 4000);
</script>
{{-- // switch toogle --}}
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
{{-- //sweet alert --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


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
  let validExtensions = ["image/jpeg", "image/jpg", "image/png" , "svg"] ;
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
  dropArea.classList.remove("active");
  dropArea.removeChild(dropArea.firstChild);
  dropArea.removeChild(dropArea.firstChild);
  dropArea.appendChild(dragText);
};
</script>