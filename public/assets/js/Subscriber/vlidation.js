var fname = document.getElementById('fullName');
var email = document.getElementById('email');
var password = document.getElementById('password');
var password_confirm = document.getElementById('password-confirm');
var region = document.getElementById('region');
var showPassword = document.getElementById('showPassword');
var showPassword1 = document.getElementById('showPassword1');
var showPassword2 = document.getElementById('showPassword2');
const signUpBtn = document.getElementById("signUp");
const signInBtn = document.getElementById("signIn");
const container = document.querySelector(".warrper");
var letters = /^[a-zA-Z\u0600-\u06FF,-\s\d][\s\d\a-zA-Z\u0600-\u06FF,-]*$/i 
var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;


// fname.onkeyup  = function () {
//     console.log(fname.value.match(letters));
//     massage = document.querySelector('.name-massege');
//     if(fname.value.match(letters) ) {
//         massage.style.display = "none";
//     }else if(fname.value == "" || fname.value === " " ){
//         massage.style.display = "none";
//     }else{
//         massage.style.display = "block";
//     }
// }



// showPassword.onclick = function(){
//     if (password.type === "password") {
//         password.type = "text";
//     } else {
//         password.type = "password";
//     }
// }
// showPassword1.onclick = function(){
//     var password = document.getElementById('subsPassword');
//     if (password.type == "password") {
//         password.type = "text";
//     } else {
//         password.type = "password";
//     }
// }
// showPassword2.onclick = function(){
//     var password = document.getElementById('adminPassword');
//     if (password.type == "password") {
//         password.type = "text";
//     } else {
//         password.type = "password";
//     }
// }

signInBtn.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});
signUpBtn.addEventListener("click", () => {
    container.classList.remove("right-panel-active");
  });

