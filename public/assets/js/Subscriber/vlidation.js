var fname = document.getElementById('fullName');
var phone = document.getElementById('phone');
var email = document.getElementById('email');
var password = document.getElementById('password');
var password_confirm = document.getElementById('password-confirm');
var region = document.getElementById('region');
var showPassword = document.getElementById('showPassword');
var letters = /^[A-Za-z]+$/

fname.onkeyup  = function () {
    massage = document.querySelector('.name-massege');
    if(fname.value.match(letters) ) {
        massage.style.display = "none";
    }else if(fname.value == "" || fname.value === " " ){
        massage.style.display = "none";
    }else{
        massage.style.display = "block";
    }
}

phone.onkeyup  = function () {
    massage = document.querySelector('.phone-massege');

    if(phone.value.match(letters) ) {
        massage.style.display = "block";
    }else if(phone.value == ""){
        massage.style.display = "none";
    }else if ( !phone.value.startsWith(" ") || !phone.value.startsWith("0") || !phone.value.startsWith("09") || !phone.value.startsWith("00963") || !phone.value.startsWith("+963")){
        massage.style.display = "block";
    }else{
        massage.style.display = "none";
    }
}

showPassword.onclick = function(){
    if (password.type === "password") {
        password.type = "text";
      } else {
        password.type = "password";
      }
}
// email.onkeyup =  function(){
//     const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     massage = document.querySelector('.email-massege');
//     if (!emailRegex.test(email.value)) {
//         massage.style.display = "block";
//     } else {
//         massage.style.display = "none";
//     }
// }


