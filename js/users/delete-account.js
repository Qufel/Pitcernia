window.addEventListener("DOMContentLoaded", () => {

    let form = document.querySelector("#delete-account");

    if (form == null) {
        return;
    }

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        let url = "./users/delete-account.php";

        fetch(url, {
            method: "GET",
        }).then((res) => {
            if (res.ok) {
                return res.text();
            } else {
                throw new Error("User delete failure.");
            }
        }).then((data) => {
            let json = JSON.parse(data);

            if (!json["s"]) {
                let eBox = document.querySelector("#form-error-box");
                eBox.classList.toggle("d-none");
                let eText = document.querySelector("#form-error-text");
                eText.innerText = json['m'];
            } else {
                let urlLogout = "./users/log-out-user.php";

                fetch(urlLogout, {
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
            }
        }).catch((error) => {
            console.error(error);
        })

    });
});