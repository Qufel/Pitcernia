window.addEventListener("DOMContentLoaded", () => {

    let btn = document.querySelector("#logout-btn");

    if(btn == null) {
        return;
    }

    btn.addEventListener("click", (e) => {

        let url = "./users/log-out-user.php";

        fetch(url, {
            method: "GET",
        }).then((res) => {
            if (res.ok) {
                return res.text();
            } else {
                throw new Error("Log out failure.");
            }
        }).then((data) => {
            window.location.href = "./";
        }).catch((error) => {
            console.error(error);
        })

    });
});