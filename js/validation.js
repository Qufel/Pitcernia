const form = document.querySelector("form");
const passwords = document.querySelectorAll('input[type="password"]');
const phone = document.querySelector('input[type="tel"]');

form.addEventListener("submit", (e) => {

    let passwordMessage = [];
    let phoneMessage = [];

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

        }

    } else {
        document.querySelector("#error-box").classList.add("d-none");
    }

});