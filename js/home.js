const login = document.querySelector('.login');
const btn_login = document.querySelector('.button-login');
const email = document.querySelector('.email');
<<<<<<< HEAD
=======
const nome = document.querySelector('.nome');
>>>>>>> 6581b9c659a9776e3b07169277512c394bdf8aae
const question = document.querySelector('.question');
const social_media = document.querySelector('.social-media');
const botaoLogin = document.querySelector('#login')
const register = document.querySelector('#register')
const registered = document.querySelector('#registered')
    // function cadastrar() {
    //     login.style.height = "20rem";
    //     login.style.margin = "-15rem auto";
    //     btn_login.style.top = "5rem"
    //     email.style.display = "block"
    //     question.style.display = "block"
    //     social_media.style.margin = "15rem auto"
    // }

var x = window.matchMedia("(max-width: 1100px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction)

function cadastrar() {
    if (x.matches) {
        email.style.display = "block"
<<<<<<< HEAD
=======
        nome.style.display = "block"
>>>>>>> 6581b9c659a9776e3b07169277512c394bdf8aae
        question.style.display = "block"
        botaoLogin.style.display = "none";
        register.style.display = "none";
        registered.style.display = "inline-block";
    } else {
        login.style.height = "20rem";
        login.style.margin = "-15rem auto";
        btn_login.style.top = "5rem"
        email.style.display = "block"
<<<<<<< HEAD
=======
        nome.style.display = "block"
>>>>>>> 6581b9c659a9776e3b07169277512c394bdf8aae
        question.style.display = "block"

        social_media.style.margin = "15rem auto"

        botaoLogin.style.display = "none";
        register.style.display = "none";
        registered.style.display = "inline-block";
    }
}

function media_query() {
    login.style.height = "28rem";
    login.style.margin = "-8rem auto";
    btn_login.style.top = "5rem"
}

function myFunction(x) {
    if (x.matches) { // If media query matches
        media_query();
    } else {
        login.style.height = "10rem";
        login.style.margin = "-5rem auto";
        btn_login.style.top = "1rem"

        social_media.style.margin = "5rem auto"

        botaoLogin.style.display = "inline-block";
        register.style.display = "inline-block";
        registered.style.display = "none";
        email.style.display = "none"
<<<<<<< HEAD
=======
        nome.style.display = "none"
>>>>>>> 6581b9c659a9776e3b07169277512c394bdf8aae
        question.style.display = "none"
    }
}