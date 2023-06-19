const x = document.getElementById("login");
const y = document.getElementById("register");
const z = document.getElementById("btn");

function register() {
    x.style.left = "-450px"
    y.style.left = "50px"
    z.style.left = "110px"
}

function login() {
    x.style.left = "50px"
    y.style.left = "450px"
    z.style.left = "0"
}

// VALIDATION
// document.addEventListener("DOMContetLoaded", () => {
//     "use strict";

//     const form = document.querySelectorAll('#login');
// // const username = getElementById('username');
// // const passwrod = getElementById("password");
// // const usernamereg =  getElementById("usernamereg");
// // const passwordreg = getElementById("passwordeg");
// // const passwordregconfirm = getElementById("passwordregconfirm");

//     form.addEventListener("submit", (even) => {
//         even.preventDefault();
//         console.log("dddd"); 
//     });
// })

document.getElementById('login').addEventListener('submit', prevDef);


function prevDef(event) {
    event.preventDefault()
}


