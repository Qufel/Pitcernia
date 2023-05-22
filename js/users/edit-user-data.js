var _name = document.querySelector('[name="name"]');
var surname = document.querySelector('[name="surname"]');
var phone = document.querySelector('[name="phone"]');
var email = document.querySelector('[name="email"]');

document.querySelector("#edit-user-btn").addEventListener("click", (e) => {

    document.querySelector("#edit-btns-group").classList.toggle("d-none");
    document.querySelector("#edit-user-btn").classList.toggle("d-none");
    _name.readOnly = false;
    surname.readOnly = false;
    phone.readOnly = false;
    email.readOnly = false;

})

document.querySelector("#save-data-btn").addEventListener("click", (e) => {

    document.querySelector("#edit-user-data").addEventListener("submit", (e) => {
        e.preventDefault();

        let url = "./users/edit-user-data.php";
        let formData = new FormData();

        formData.append("name", _name.value);
        formData.append("surname", surname.value);
        formData.append("phone", phone.value);
        formData.append("email", email.value);

        fetch(url, {
            method: "POST",
            body: formData
        }).then((res) => {
            if (res.ok) {
                formData = null;
                return res.text();
            } else {
                formData = null;
                throw new Error("User data editing failure.");
            }
        }).then((data) => {
            let json = JSON.parse(data);
            if (!json["s"]) {
                let eBox = document.querySelector("#form-error-box");
                eBox.classList.toggle("d-none");
                let eText = document.querySelector("#form-error-text");
                eText.innerText = json['m'];
            } else {
                document.querySelector("#edit-btns-group").classList.toggle("d-none");
                document.querySelector("#edit-user-btn").classList.toggle("d-none");
                _name.readOnly = true;
                surname.readOnly = true;
                phone.readOnly = true;
                email.readOnly = true;
            }
        }).catch((error) => {
            console.error(error);
            document.querySelector("#edit-btns-group").classList.toggle("d-none");
            document.querySelector("#edit-user-btn").classList.toggle("d-none");
  
            _name.readOnly = true;
            surname.readOnly = true;
            phone.readOnly = true;
            email.readOnly = true;
        })

    });

});