var pizzas;
var pizzasToDisplay = [];

var ingridientsCheckboxes = document.querySelectorAll(".ingridient-check");
var sizeRadios = document.querySelectorAll(".size-check");

var minInput = document.querySelector(".input-min");
var maxInput = document.querySelector(".input-max");

var minRange = document.querySelector(".range-min");
var maxRange = document.querySelector(".range-max");

var rawFile = new XMLHttpRequest();

rawFile.open("POST", "./pizzas.php", false);
rawFile.onreadystatechange = function ()
{
    if(rawFile.readyState === 4)
    {
        if(rawFile.status === 200 || rawFile.status == 0)
        {
            pizzas = JSON.parse(rawFile.responseText)["pizzas"];
        }
    }
}
rawFile.send(null);

pizzasToDisplay = GetPizzas([],25,0,100);

DisplayPizza(pizzasToDisplay);

ingridientsCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener("input",Filter);
});

sizeRadios.forEach((radio) => {
    radio.addEventListener("input",Filter);
});

minInput.addEventListener("change",Filter);
maxInput.addEventListener("change",Filter);

minRange.addEventListener("change",Filter);
maxRange.addEventListener("change",Filter);

function Filter(e) {
    
    var ingridients = [];

    ingridientsCheckboxes.forEach((checkbox) => {
        if(checkbox.checked){
            ingridients.push(checkbox.value);
        }
    });

    console.log("Ingridients:",ingridients);

    var size = 0;
    
    sizeRadios.forEach((radio) => {
        if(radio.checked){
            size = radio.value;
        }
    });

    var minPrice = Number(minInput.value);
    var maxPrice = Number(maxInput.value);

    pizzasToDisplay = GetPizzas(ingridients,size,minPrice,maxPrice);

}

function GetPizzas(ingridients,size,min,max) {

    var matchingToppings = pizzas.filter((pizza) => {
        ids = pizza.toppings.map(t => t.id);
        return ingridients.every(i => ids.includes(Number(i)));
    });
    var matchingSize = pizzas.filter((pizza) => {
        return pizza.size == size;
    });
    var matchingPrice = pizzas.filter((pizza) => {
        return (pizza.price >= min && pizza.price <= max);
    });

    var matching = CommonElementsOfArray(matchingToppings,matchingPrice,matchingSize);

    document.querySelector(".found-count").innerHTML = matching.length;

    return matching;

}

searchBtn = document.querySelector("#search");
searchBtn.addEventListener("click", () => {
    if(pizzasToDisplay == false) {
        //display "no pizzas" text
    }
    DisplayPizza(pizzasToDisplay);
});


function DisplayPizza(p = []) {

    const pizzaGrid = document.querySelector(".pizza-grid");

    pizzaGrid.innerHTML = "";

    p.forEach(element => {
        
        var pizza_uri =  `pizza?id=${element.id}`;
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
				<div class="align-middle flex-fill">
					<h6>Składniki</h6>
					<p>${element.toppings.map(t => t.topping).join(', ')}</p>
                    <h6>Rozmiar</h6>
					<p>${element.size} cm</p>
				</div>
				<div class="d-flex">
					<a href="${pizza_uri}" class="pizza-btn btn btn-primary"><i class="bi bi-cart-plus-fill"></i> Dodaj do koszyka</a>
				</div>
			</div>
		</div>
        `;

    });

}

var clearBtn = document.querySelector("#clear-filters");
var progress = document.querySelector(".progress");

clearBtn.addEventListener("click", () => {
    
    ingridientsCheckboxes.forEach((checkbox) => {
        checkbox.checked = false;
    });
    sizeRadios[0].checked = true;
    
    progress.style.left = "0%";
    progress.style.right = "0%";

    minInput.value = 0;
    minRange.value = 0;

    maxInput.value = 100;
    maxRange.value = 100;
    
    pizzasToDisplay = GetPizzas([],25,0,100);
    DisplayPizza(pizzasToDisplay);
});

function CommonElementsOfArray(...arrays) {
    const size = arrays.length;
    const map = new Map();
    
    arrays.forEach(arr => {
      arr.forEach(entry => {
        if (!map.has(entry)) {
          map.set(entry, 1);
        } else {
          var timesSeen = map.get(entry);
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