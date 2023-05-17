var LoadDeleteToppingBtns = function (data) {
    let btns = document.querySelectorAll(".delete-topping-btn");

    btns.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            let pizzaId = Number(e.currentTarget.parentNode.parentNode.parentNode.parentNode.id.replace("pizza-id-", ""));
            let toppingId = Number(e.currentTarget.id.replace("topping-", ""));
            
            let pizzas = data["pizzas"];
            let index = Number(pizzas[pizzaId - 1].toppings.indexOf(pizzas[pizzaId - 1].toppings.filter(t => {
                return t.id == toppingId;
            })[0]));   
            pizzas[pizzaId - 1].toppings.splice(index, 1);

            SaveDataToLS({
                "pizzas": pizzas,
                "toppings": data["toppings"]
            });

            RegenerateFromLS();
        });
    });
}