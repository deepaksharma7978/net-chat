const container = document.querySelector(".main-container");
const LoginLink = document.querySelector(".signInLink");
const RegisterLink = document.querySelector(".signUpLink");
RegisterLink.addEventListener('click',()=>{
    container.classList.add('active');
})
LoginLink.addEventListener('click',()=>{
    container.classList.remove('active');
})