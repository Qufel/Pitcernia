const form = document.querySelector("form");
const passwords = document.querySelectorAll('input[type="password"]');
const phone = document.querySelector('input[type="tel"]');

var passwordMessage = [];
var phoneMessage = [];

form.addEventListener("submit", (e) => {
    passwordMessage = [];
    phoneMessage = []
    
    if(passwords[0].value.length > 20) {
        passwordMessage.push("Hasło musi być krótsze niż 20 znaków.");
    }
    
    if(passwords[0].value.length < 8) {
        passwordMessage.push("Hasło musi mieć co najmniej 8 znaków.");
    }

    if(passwords[0].value !== passwords[1].value) {
        passwordMessage.push("Hasła nie są identyczne.");
    }

    if(passwordMessage.length > 0 || phoneMessage.length > 0) {

        e.preventDefault();

        if(passwordMessage.length > 0) {
            document.querySelector("#passwd-error-box").classList.remove("d-none");
            document.querySelector("#passwd-error-text").innerText = passwordMessage.join(' ');
        }
        if(phoneMessage.length > 0) {
            let r = /(?:(?:(?:\+|00)?48)|(?:\(\+?48\)))?(?:1[2-8]|2[2-69]|3[2-49]|4[1-8]|5[0-9]|6[0-35-9]|[7-8][1-9]|9[145])\d{7}/;
            
        }

    } else {
        document.querySelector("#form-error-box").classList.toggle("d-none");
    }

});