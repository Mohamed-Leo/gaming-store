const container = document.querySelector(".container");
const loginlink = document.querySelector(".login-link");
const registerlink = document.querySelector(".register-link");


registerlink.addEventListener('mousedown' , () => {

    container.classList.add('active');
});


loginlink.addEventListener('mousedown' , () => {

    container.classList.remove('active');
});