var cart = JSON.parse(sessionStorage.getItem("cart"));
var amount = cart.reduce((acc, pizza) => acc + pizza.pizzaCount, 0);

var amountDisplay = document.querySelector("#cart-items-amount");

if(amount > 0) {
    amountDisplay.innerHTML = amount;
}

let UpdateNav = (count) => {
    if(count > 0) {
        amountDisplay.innerHTML = count;
    }
}