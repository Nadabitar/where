var fname = document.getElementById('fullName');
var phone = document.getElementById('phone');
var email = document.getElementById('email');
var password = document.getElementById('password');
var password_confirm = document.getElementById('password-confirm');
var region = document.getElementById('region');
var showPassword = document.getElementById('showPassword');
var showPassword1 = document.querySelector('#showPassword1');
var showPassword2 = document.querySelector('#showPassword2');
var letters = /^[A-Za-z]+$/
var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;


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
    }else if(phone.value.match(phoneno)){
        massage.style.display = "none";
    }else if(phone.value == "" || phone.value == " " ){
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
showPassword1.onclick = function(){
    if (password.type == "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }
}
showPassword2.onclick = function(){
 
    if (password.type == "password") {
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


