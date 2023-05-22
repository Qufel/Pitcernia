let logoutBtn = document.querySelector("#logout-btn");
logoutBtn.addEventListener("click", () => {
    sessionStorage.clear();
})