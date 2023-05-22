window.addEventListener("DOMContentLoaded", () => {

    let _name = document.querySelector("#fname_input");
    let surname = document.querySelector("#surname_input");
    let email = document.querySelector("#email_input");
    let phone = document.querySelector("#phone_input");
    let passwd = document.querySelector("#passwd_input");

    document.querySelector("#registration-form").addEventListener("submit", (e) => {
        e.preventDefault();

        let url = "./users/registration.php";
        let formData = new FormData();

        formData.append("name", _name.value);
        formData.append("surname", surname.value);
        formData.append("email", email.value);
        formData.append("phone", phone.value);
        formData.append("passwd", passwd.value);

        if(passwordMessage.length > 0) {
            console.log(passwordMessage);
            passwordMessage = [];
            e.target.reset();
            return;
        }

        fetch(url, {
            method: "POST",
            body: formData
        }).then((res) => {
            if (res.ok) {
                formData = null;
                return res.text();
            } else {
                throw new Error("User registration failure.");
            }
        }).then((data) => {
            let json = JSON.parse(data);

            if (!json["s"]) {
                e.stopImmediatePropagation();
                let eBox = document.querySelector("#form-error-box");
                eBox.classList.toggle("d-none");
                let eText = document.querySelector("#form-error-text");
                eText.innerText = json['m'];
                throw new Error(json['m']);
            } else {
                window.location.href = "./login";
            }
        }).catch((error) => {
            console.error(error);
            passwordMessage = [];
            e.target.reset();
            window.location.reload();
        })

    });

});
