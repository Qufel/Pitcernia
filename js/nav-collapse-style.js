const container = document.querySelector("#navbar-container");
const toggler = document.querySelector(".navbar-toggler");

toggler.addEventListener("click", () => {

    if(!container.classList.contains("navbar-shown")){
        container.classList.add("navbar-shown");
    }else{
        container.classList.remove("navbar-shown");
    }

});