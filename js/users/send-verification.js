window.addEventListener("DOMContentLoaded", () => {

    let email = document.querySelector("#email");

    let form = document.querySelector("#send-verification") ?? null;

    if(form == null) {
        return;
    }

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        let url = "./users/send-verification.php";
        let inp = document.querySelector("#verification-email-inp");
        let formData = new FormData();
        
        formData.append("email", inp.value);

        fetch(url, {
            method: "POST",
            body: formData
        }).then((res) => {
            if (res.ok) {
                formData = null;
                return res.text();
            } else {
                throw new Error("Send verification failure.");
            }
        }).then((data) => {
            let json = JSON.parse(data);

            if (!json["s"]) {
                let eBox = document.querySelector("#form-error-box");
                eBox.classList.toggle("d-none");
                let eText = document.querySelector("#form-error-text");
                eText.innerText = json['m'];
            } else {
                window.location.href = "./";
            }

            window.location.href = "./";
        }).catch((error) => {
            console.error(error);
        })

    });

});