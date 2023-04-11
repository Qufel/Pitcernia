let addBtn = document.querySelector("#add-to-cart-btn");

let pizzaId = Number(document.querySelector("#pizza-id").value);
let pizzaCount = 1;

document.querySelector("#amount-inp").addEventListener("change", () => {
    pizzaCount = Number(document.querySelector("#amount-inp").value);
});


addBtn.addEventListener("click", () => {

    let cartSession = window.sessionStorage.getItem("cart");

    if(cartSession == null) {
        window.sessionStorage.setItem("cart", JSON.stringify([]));
        cartSession = window.sessionStorage.getItem("cart");
    }

    let cart = JSON.parse(cartSession);
    cart.push({pizzaId, pizzaCount});

    window.sessionStorage.setItem("cart", JSON.stringify(cart));
});