var LoadAddToppingBtns = function (data) {
    let btns = document.querySelectorAll(".topping-btn");
    btns.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            let tr = e.currentTarget.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
            let pizzaId = Number(tr.id.replace("pizza-id-", ""));
            let topping = e.currentTarget.innerText;

            let pizza = data['pizzas'].filter(pizza => {
                return pizza.id == pizzaId;
            })[0];

            let toppingId = Number(data["toppings"].filter(t => {
                return t.topping == topping;
            })[0].id);

            if(!pizza.toppings.filter(t => {
                return t.topping == topping;
            }).length > 0){
                data['pizzas'][data['pizzas'].indexOf(pizza)].toppings.push({"id": toppingId, "topping": topping});
            } else {
                console.log(`Pizza already contains: ${topping}`);
            }

            SaveDataToLS(data);

            RegenerateFromLS();

        })
    });
}