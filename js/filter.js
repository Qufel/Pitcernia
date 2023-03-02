var pizzas;
var pizzasToDisplay;

let rawFile = new XMLHttpRequest();

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

const ingridientsCheckboxes = document.querySelectorAll(".ingridient-check");
const sizeRadios = document.querySelectorAll(".size-check");

const minInput = document.querySelector(".input-min");
const maxInput = document.querySelector(".input-max");

const minRange = document.querySelector(".range-min");
const maxRange = document.querySelector(".range-max");

ingridientsCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener("input",filter);
});

sizeRadios.forEach((radio) => {
    radio.addEventListener("input",filter);
});

minInput.addEventListener("input",filter);
maxInput.addEventListener("input",filter);

minRange.addEventListener("input",filter);
maxRange.addEventListener("input",filter);

function filter(e) {
    
    let ingridients = [];

    ingridientsCheckboxes.forEach((checkbox) => {
        if(checkbox.checked){
            ingridients.push(checkbox.value);
        }
    });

    let size = 0;
    
    sizeRadios.forEach((radio) => {
        if(radio.checked){
            size = radio.value;
        }
    });

    let minPrice = minInput.value;
    let maxPrice = maxInput.value;

    pizzasToDisplay = filterPizzas(ingridients,size,minPrice,maxPrice);

    console.log(pizzasToDisplay);
    
}

const searchBtn = document.querySelector("#search");
searchBtn.addEventListener("click", displayPizza(pizzasToDisplay));

function filterPizzas(ingridients,size,min,max) {

    //return pizza.toppings.split(',').every(t => ingridients.includes(t));
    let matchingToppings = pizzas.filter((pizza) => {
        toppings = pizza.toppings.split(',');
        return ingridients.every(i => toppings.includes(i));
    }).map(pizza => {return pizza.id;});
    let matchingSize = pizzas.filter((pizza) => {
        return pizza.size == size;
    }).map(pizza => {return pizza.id;});
    let matchingPrice = pizzas.filter((pizza) => {
        return (pizza.price > min && pizza.price < max);
    }).map(pizza => {return pizza.id;});

    let matching = matchingToppings.filter((m) => {
        return matchingSize.includes(m);
    }).filter((m) => {
        return matchingPrice.includes(m);
    });

    let res = [];

    matching.forEach((i) => {
        res.push(pizzas[i]);
    });

    document.querySelector(".found-count").innerHTML = matching.length;

    return res;

}

function displayPizza(p = []) {

    const pizzaGrid = document.querySelector(".pizza-grid");

    p.forEach(element => {
        
        pizzaGrid.innerHTML +=
        `
        <div class="pizza-card card bg-light text-dark">
			<img src="./assets/${p.img_src}" alt="Zdjęcie pizzy ${p.name}" class="card-img-top">
			<div class="card-body d-flex flex-column">
				<div class="card-title">
					<div class="d-inline-flex align-items-center w-100">
						<h4 class="align-middle col-6">Pizza ${p.name}</h4>
						<div class="col-6 d-flex justify-content-end">
							<h4 class="align-middle price-badge">${p.price} zł</h4>
						</div>
					</div>
				</div>
				<div class="align-middle">
					<h6>Składniki</h6>
					<p></p>
				</div>
				<div class="d-inline-flex">
					<button class="btn btn-primary fw-bold">Zamów</button>
				</div>
			</div>
		</div>
        `;

    });

}