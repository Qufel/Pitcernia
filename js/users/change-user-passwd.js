window.addEventListener("DOMContentLoaded", () => {

    let oldPasswd = document.querySelector("#old-passwd");
    let oldPasswdR = document.querySelector("#old-passwd-repeat");
    let newPasswd = document.querySelector("#new-passwd");

    document.querySelector("#ch-passwd").addEventListener("submit", (e) => {
        e.preventDefault();

        let url = "./users/change-user-passwd.php";
        let formData = new FormData();

        formData.append("old-passwd", oldPasswd.value);
        formData.append("old-r-passwd", oldPasswdR.value);
        formData.append("new-passwd", newPasswd.value);

        fetch(url, {
            method: "POST",
            body: formData
        }).then((res) => {
            if (res.ok) {
                formData = null;
                return res.text();
            } else {
                throw new Error("User password change failure.");
            }
        }).then((data) => {
            let json = JSON.parse(data);

            if (!json["s"]) {
                let eBox = document.querySelector("#form-error-box");
                eBox.classList.toggle("d-none");
                let eText = document.querySelector("#form-error-text");
                eText.innerText = json['m'];
            } else {
                window.location.reload();
            }
        }).catch((error) => {
            console.error(error);
        })

    });

});