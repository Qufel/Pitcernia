const MAX_FILE_SIZE = 1 * 1024 * 1024;
var uploadedImgs = [];

var LoadDataChangeEvents = function (data) {

    //img
    let imgs = document.querySelectorAll(`.img-input`);

    imgs.forEach(img => {

        let id = Number(img.parentNode.parentNode.id.replace("pizza-id-", "")); 
        let pizza = data['pizzas'].filter((pizza) => {
            return pizza.id == id;
        })[0];

        let inp = img.querySelector("input");
        let imgPreview = img.querySelector("img")
        inp.addEventListener("change", (e) => {
            let file = inp.files[0];
            if(file.size > MAX_FILE_SIZE) {
                inp.value = '';
                return;
            }
            if(file) {
                let reader = new FileReader();
                reader.addEventListener("load", () => {
                    imgPreview.src = reader.result;
                });
                reader.readAsDataURL(file);
            }

            uploadedImgs.push(file);
            
        })
    });

    //name
    let nameInps = document.querySelectorAll(".name-inp");
    nameInps.forEach(inp => {

        let id = Number(inp.parentNode.parentNode.parentNode.id.replace("pizza-id-", ""));

        inp.addEventListener("change", (e) => {
            let pizza = data['pizzas'].indexOf(data['pizzas'].filter((pizza) => {
                return pizza.id == id;
            })[0]);
            data['pizzas'][pizza].name = inp.value;
            SaveDataToLS(data);
            RegenerateFromLS();
        });
    });

    //size
    let sizeInps = document.querySelectorAll(".size-inp");
    sizeInps.forEach(inp => {

        let id = Number(inp.parentNode.parentNode.parentNode.id.replace("pizza-id-", ""));

        inp.addEventListener("change", (e) => {
            let pizza = data['pizzas'].indexOf(data['pizzas'].filter((pizza) => {
                return pizza.id == id;
            })[0]);
            data['pizzas'][pizza].size = inp.value;
            SaveDataToLS(data);
            RegenerateFromLS();
        });
    });

    //price
    let priceInps = document.querySelectorAll(".price-inp");
    priceInps.forEach(inp => {

        let id = Number(inp.parentNode.parentNode.parentNode.id.replace("pizza-id-", ""));

        inp.addEventListener("change", (e) => {
            let pizza = data['pizzas'].indexOf(data['pizzas'].filter((pizza) => {
                return pizza.id == id;
            })[0]);
            data['pizzas'][pizza].price = inp.value;
            SaveDataToLS(data);
            RegenerateFromLS();
        });
    });

    //form
    let form = document.querySelector("#pizzas-form");
    form.addEventListener("submit", (e) => {
        let formData = new FormData();
        formData.append("data", JSON.stringify(data));
        
        uploadedImgs.forEach((img) => {
            formData.append("imgs[]", img);
        });

        fetch("pitcernia/admin/save-pizzas.php", {
            method: 'POST',
            body: formData,
        }).then((res) => {
            if(res.ok) {
                console.log("Upload successful.");
            } else {
                throw new Error ("Upload failure.");
            }
        }).catch(error => {
            console.error("Error:", error);
        });
    });
}