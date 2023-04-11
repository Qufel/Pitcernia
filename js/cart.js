var cart = JSON.parse(window.sessionStorage.getItem("cart"));
var cartValue = [];

var rawFile = new XMLHttpRequest();

rawFile.open("POST", "./pizzas.txt", false);
rawFile.onreadystatechange = function ()
{
    if(rawFile.readyState === 4)
    {
        if(rawFile.status === 200 || rawFile.status == 0)
        {
            pizzas = JSON.parse(rawFile.responseText);
        }
    }
}
rawFile.send(null);

DisplayCartItems(GetPizzasInCart(pizzas, cart));

function DisplayCartItems ( items = [] ) {
    var pizzaGrid = document.querySelector("#cart-grid");

    if(items.length == 0) {
        pizzaGrid.innerHTML = 
        `<div class="text-center card p-3">
            <h3>Koszyk jest pusty</h3>
            <span>Na chwilę obecną twój koszyk jest pusty, udaj się do <span><a href="/pitcernia/">Menu</a></span> i wybierz pizze które chcesz zamówić.</span>
        </div>`;
        return;
    }

    pizzaGrid.innerHTML = "";
    items.forEach((item) => {
        var index = items.indexOf(item);

        var totalPrice = Math.round((item.pizza.price * item.count) * 100) / 100;

        var toppings = item.pizza.toppings.map((t) => t.topping).join(', ');

        var html = 
        `<div class="cart-item d-flex flex-column flex-md-row align-items-md-center p-2 gap-2">
            <img src="./assets/${item.pizza.img_src}" alt="${item.pizza.img_src}" class="cart-item-img d-none d-md-block">
            <div class="cart-item-separator d-none d-md-block"></div>
            <div class="flex-md-fill text-md-start d-flex flex-column">
                <span class="cart-item-name"><a href="pizza?id= ${item.pizza.id}" class="h6 text-dark text-decoration-none">Pizza ${item.pizza.name}</a></span>
                <div>
                    <span>Rozmiar: <span class="cart-item-size">${item.pizza.size}</span>cm</span>
                    <span>Składniki: <span class="cart-item-toppings">${toppings}</span></span>
                </div>
            </div>
            <div class="cart-item-separator d-none d-md-block"></div>
            <div class="d-flex align-items-center justify-content-evenly gap-2">
                <span class="cart-item-price flex-fill order-1 order-md-0 text-md-center text-end text-md-start h6"><span class="price-badge-bellow-md"><span class="cart-item-total-price">${totalPrice}</span> zł</span></span>
                <div class="cart-item-separator d-none d-md-block"></div>
                <div class="cart-item-amount d-flex flex-fill gap-2 text-center text-md-start h6">
                    <button type="button" class="dec-amount-btn text-light" data-name="${index}"><i class="bi bi-dash-lg"></i></button>
                    <span class="amount-display">${item.count}</span>
                    <button type="button" class="inc-amount-btn text-light" data-name="${index}"><i class="bi bi-plus-lg"></i></button>
                </div>
            </div>
        </div>`;
        pizzaGrid.innerHTML += html;

        var incBtns = document.querySelectorAll(".inc-amount-btn");

        incBtns.forEach((btn, index) => {

            if(items[index].count >= 99) {
                btn.className += "disabled";
                return;
            }

            btn.addEventListener("click", (e) => {
                AddPizza(e.currentTarget.dataset.name);
            })
        })

        var decBtns = document.querySelectorAll(".dec-amount-btn");

        decBtns.forEach((btn, index) => {

            if(items[index].count == 1) {
                btn.innerHTML = `<i class="bi bi-trash3-fill"></i>`;
            }

            btn.addEventListener("click", (e) => {
                RemovePizza(e.currentTarget.dataset.name);
            })
        })

    });
}

function GetPizzasInCart (pizzas = [], items = []) {
    var res = [];
    
    if(items == null) {
        return res;
    }

    items.forEach((item) => {
        pizzas.forEach((pizza) => {
            if(item.pizzaId == pizza.id) {
                var count = item.pizzaCount;
                res.push({pizza, count});
            }
        });
    });
    return res;
}

function AddPizza (id = -1) {
    var item = cart[id];
    item.pizzaCount++;
    Update();
}

function RemovePizza (id = -1) {
    var item = cart[id];
    item.pizzaCount--;
    if(item.pizzaCount == 0) {
        cart.splice(cart.indexOf(item),1);
    }
    Update();
}

function UpdateSession () {
    sessionStorage.setItem("cart", JSON.stringify(cart));
}

function UpdateDisplay () {
    DisplayCartItems(GetPizzasInCart(pizzas, cart));
}

function Update () {
    
    var count = cart.reduce((acc, pizza) => acc + pizza.pizzaCount, 0);

    UpdateDisplay();
    UpdateSession();

    UpdateNav(count);
}