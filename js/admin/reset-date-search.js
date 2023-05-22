window.addEventListener("DOMContentLoaded", () => {
    let btn = document.querySelector("#reset-date-btn");
    let inp = document.querySelector(`input[type="date"]`);
    btn.addEventListener("click", () => {
        inp.value = "";
        window.location = window.location.href.split("?")[0];
    })
})