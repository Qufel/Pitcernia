let pizzas;
let pizzasToDisplay = [];

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

displayPizza(filterPizzas([],25,0,100));

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

minInput.addEventListener("change",filter);
maxInput.addEventListener("change",filter);

minRange.addEventListener("change",filter);
maxRange.addEventListener("change",filter);

function filter(e) {
    
    var ingridients = [];

    ingridientsCheckboxes.forEach((checkbox) => {
        if(checkbox.checked){
            ingridients.push(checkbox.value);
        }
    });

    var size = 0;
    
    sizeRadios.forEach((radio) => {
        if(radio.checked){
            size = radio.value;
        }
    });

    let minPrice = Number(minInput.value);
    let maxPrice = Number(maxInput.value);

    pizzasToDisplay = filterPizzas(ingridients,size,minPrice,maxPrice);

}

function filterPizzas(ingridients,size,min,max) {

    let matchingToppings = pizzas.filter((pizza) => {
        ids = pizza.toppings.map(t => t.id);
        return ingridients.every(i => ids.includes(Number(i)));
    });
    let matchingSize = pizzas.filter((pizza) => {
        return pizza.size == size;
    });
    let matchingPrice = pizzas.filter((pizza) => {
        return (pizza.price >= min && pizza.price <= max);
    });

    let matching = commonElementsOfArray(matchingToppings,matchingPrice,matchingSize);

    document.querySelector(".found-count").innerHTML = matching.length;

    return matching;

}

searchBtn = document.querySelector("#search");
searchBtn.addEventListener("click", () => {
    displayPizza(pizzasToDisplay);
});


function displayPizza(p = []) {

    const pizzaGrid = document.querySelector(".pizza-grid");

    pizzaGrid.innerHTML = "";

    p.forEach(element => {
        
        pizzaGrid.innerHTML +=
        `
        <div class="pizza-card card bg-light text-dark">
			<img src="./assets/${element.img_src}" alt="Zdjęcie pizzy ${element.name}" class="card-img-top pizza-image">
			<div class="card-body d-flex flex-column">
				<div class="card-title">
					<div class="d-inline-flex align-items-center w-100">
						<h4 class="align-middle col-6">Pizza ${element.name}</h4>
						<div class="col-6 d-flex justify-content-end">
							<h4 class="align-middle price-badge">${element.price} zł</h4>
						</div>
					</div>
				</div>
				<div class="align-middle">
					<h6>Składniki</h6>
					<p>${element.toppings.map(t => t.topping).join(', ')}</p>
                    <h6>Rozmiar</h6>
					<p>${element.size} cm</p>
				</div>
				<div class="d-inline-flex">
					<button class="btn btn-primary fw-bold">Zamów</button>
				</div>
			</div>
		</div>
        `;

    });

}

function commonElementsOfArray(...arrays) {
    const size = arrays.length;
    const map = new Map();
    
    arrays.forEach(arr => {
      arr.forEach(entry => {
        if (!map.has(entry)) {
          map.set(entry, 1);
        } else {
          let timesSeen = map.get(entry);
          map.set(entry, ++timesSeen);
        }
      });
    });
  
    const commonElements = [];
    map.forEach((count, key) => {
      if (count === size) {
        commonElements.push(key);
      }
    });
  
    return commonElements;
  }