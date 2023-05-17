var table = document.querySelector("#pizza-list tbody");
var resetBtn = document.querySelector("#reset-btn");

fetch("./pizzas.php").then(
    res => {
        return res.json();
    }
).then((data) => {
    if(localStorage.getItem("ueData") == null) {
        localStorage.setItem("ueData", JSON.stringify({
            "pizzas": data["pizzas"],
            "toppings": data["toppings"]
        }));
    }
    GenerateTable(data);
    resetBtn.addEventListener("click", (e) => {
        let uneditedData = JSON.parse(localStorage.getItem("ueData"));
        SaveDataToLS(uneditedData);
        GenerateTable(uneditedData);
    });
}).catch((error) => {
    console.error(`Fetch error: ${error}`);
});


function GenerateTable(data) {
    table.innerHTML = "";
    data["pizzas"].forEach(d => {
        table.append(ConstructRow(d, data["toppings"]));
    });
    LoadDeleteToppingBtns(data);    
    LoadAddToppingBtns(data);
    LoadDataChangeEvents(data);
}

var RegenerateFromLS = function () {
    let data = JSON.parse(localStorage.getItem("data"));
    GenerateTable(data);
}

function ConstructRow(pizza, all_toppings) {

    var id = Number(pizza.id);
    var name = pizza.name;
    var size = Number(pizza.size);
    var price = Number(pizza.price);
    var toppings = pizza.toppings;
    var img_src = pizza.img_src;

    let row = document.createElement("tr");
    row.id = `pizza-id-${id}`;

    //Image
    let img_col = document.createElement("td");

    //content div
    let content = document.createElement("div");
    content.classList.add("img-input");

    //image
    let img = document.createElement("img");
    img.classList.add("pizza-img");
    img.src = `./assets/${img_src}`;
    img.alt = `Pizza ${name}`;

    //input
    let img_input = document.createElement("input");
    img_input.id = `img-inp-${id}`;
    img_input.type = "file";
    img_input.accept = "image/webp";

    //label
    let img_lbl = document.createElement("label");
    img_lbl.classList.add("img-inp-btn");
    img_lbl.htmlFor = img_input.id;

    let icon = document.createElement("i");
    icon.classList.add("bi", "bi-pencil-square");

    img_lbl.append(icon);

    content.append(img,img_input,img_lbl);

    img_col.append(content);

    //Name
    let name_col = document.createElement("td");

    let name_content = document.createElement("div");
    name_content.classList.add("input-group");

    let name_span = document.createElement("span");
    name_span.classList.add("input-group-text");
    name_span.innerText = "Pizza";

    let name_inp = document.createElement("input");
    name_inp.type = "text";
    name_inp.placeholder = "Nazwa";
    name_inp.value = name;
    name_inp.classList.add("form-control", "name-inp");

    name_content.innerHTML = "";
    name_content.append(name_span, name_inp);

    name_col.append(name_content);

    //Size
    let size_col = document.createElement("td");

    let size_content = document.createElement("div");
    size_content.className = "";
    size_content.classList.add("input-group");

    let size_span = document.createElement("span");
    size_span.classList.add("input-group-text");
    size_span.innerText = "cm";

    let size_inp = document.createElement("input");
    size_inp.type = "number";
    size_inp.placeholder = "Rozmiar";
    size_inp.min = 0;
    size_inp.value = size;
    size_inp.classList.add("form-control", "size-inp");

    size_content.innerHTML = "";
    size_content.append(size_inp, size_span);

    size_col.append(size_content);

    //Toppings
    let toppings_col = document.createElement("td");

    let list = document.createElement("ul");
    list.classList.add("list-group");

    toppings.forEach((t) => {

        let li = document.createElement("li");
        li.classList.add("list-group-item", "d-flex", "align-items-center");

        let t_span = document.createElement("span");
        t_span.innerHTML = t.topping;

        let btn = document.createElement("button");
        btn.classList.add("btn", "btn-primary", "delete-topping-btn");
        btn.type = "button";
        btn.id = "topping-" + t.id;
        btn.innerHTML = `<i class="bi bi-dash-lg"></i>`;

        li.append(t_span, btn);

        list.append(li);
    });

    let add_topping_li = document.createElement("li");
    add_topping_li.classList.add("list-group-item");

    let dropdown = document.createElement("div");
    dropdown.classList.add("dropdown");

    let dd_btn = document.createElement("a");
    dd_btn.href = "#";
    dd_btn.classList.add("btn", "btn-primary", "dropdown-toggle");
    dd_btn.setAttribute("data-bs-toggle", "dropdown");
    dd_btn.ariaExpanded = "false";
    dd_btn.innerHTML = "Dodaj składnik";

    let dropdown_menu = document.createElement("ul");
    dropdown_menu.classList.add("dropdown-menu");
    all_toppings.forEach(t => {
        let li = document.createElement("li");
        let a = document.createElement("a");
        a.classList.add("topping-btn", "dropdown-item");
        a.href = "#";
        a.role = "button";
        a.innerText = t.topping;

        li.append(a);
        dropdown_menu.append(li);
    });

    dropdown.append(dd_btn, dropdown_menu);

    add_topping_li.append(dropdown);

    list.append(add_topping_li);
    toppings_col.append(list);

    //Price
    let price_col = document.createElement("td");

    let price_content = document.createElement("div")
    price_content.classList.add("input-group");

    let price_span = document.createElement("span");
    price_span.classList.add("input-group-text")
    price_span.innerText = "zł";

    let price_inp = document.createElement("input");
    price_inp.type = "number";
    price_inp.placeholder = "Cena";
    price_inp.min = 0;
    price_inp.step = ".01";
    price_inp.value = price;
    price_inp.classList.add("form-control", "price-inp");

    price_content.append(price_inp, price_span);

    price_col.append(price_content);

    row.append(img_col, name_col, size_col, toppings_col, price_col);

    return row;
}

var SaveDataToLS = function (data) {
    localStorage.setItem("data", JSON.stringify({
        "pizzas": data["pizzas"],
        "toppings": data["toppings"]
    }));
}