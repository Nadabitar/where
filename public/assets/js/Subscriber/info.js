const dropArea = document.querySelector(".drag-image"),
dragText = dropArea.querySelector(".icon"),
button = dropArea.querySelector("button"),
input = document.getElementById("img-place"),
drop_button = document.getElementsByClassName("drop_button");
let file; 
// var from = document.getElementById('from');
// var to = document.getElementById('to');
// var pattern = /^[0-9]+$/;


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

// categoryyyyyyyyyy


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


// Regionnnnnnnnnnnnnnnnnnnnnnn



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
                  html_option += `<option value='`+id+`'>`+name+`</option>`
              }); 
          } else {
              $('#street').addAttr('disabeld');
          }
          $('#street').html(html_option);
        },
    });
}
});



// from.addEventListener("focus", () => {
//   massage = document.querySelector('.time-massege');
//   massage.style.display = "block";
// });

// from.addEventListener("blur", () => {
//   massage = document.querySelector('.time-massege');
//   massage.style.display = "none";
// });

// from.onkeyup  = function () {
//   massage = document.querySelector('.num-from-massege');
//   if(from.value == "  "|| from.value === "" ) {
//     massage.style.display = "none";
//   }else if (!from.value.match(pattern)) {
//     massage.style.display = "block";
//   } 
// }
// to.onkeyup  = function () {
//   massage1 = document.querySelector('.num-to-massege');
//   if(to.value == "  "|| to.value === "" ) {
//     massage1.style.display = "none";
//   }else if (!to.value.match(pattern)) {
//     massage1.style.display = "block";
//   } 
//   massage = document.querySelector('.to-massege');
//   var val1 = from.value;
//   var val2 = to.value;
//   if (val1 > val2) {
//     massage.style.display = "block";
//   }else{
//     massage.style.display = "none";
//   }
//   // massage1 = document.querySelector('.to-massege');
//   // massage2 = document.querySelector('.from-massege');
//   // if(to.val <= from.val) {
//   //    alert('kk');
//   // }
// }