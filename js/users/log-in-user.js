window.addEventListener("DOMContentLoaded", () => {

    let email = document.querySelector('[name="email"]');
    let passwd = document.querySelector('[name="passwd"]');

    document.querySelector("#log-in-user").addEventListener("submit", (e) => {
        e.preventDefault();

        let url = "./users/log-in-user.php";
        let formData = new FormData();

        formData.append("email", email.value);
        formData.append("passwd", passwd.value);

        fetch(url, {
            method: "POST",
            body: formData
        }).then((res) => {
            if(res.ok) {
                return res.text();
            } else {
                throw new Error ("User log on failure.");
            }
        }).then((data) => {
            let json = JSON.parse(data);
    
            if(!json["s"]) {
                let eBox = document.querySelector("#form-error-box");
                eBox.classList.toggle("d-none");
                let eText = document.querySelector("#form-error-text");
                eText.innerText = json['m'];
            } else {
                window.location.href = "./";   
            }
            
        }).catch((error) => {
            console.error(error);
            
        });

    });

});