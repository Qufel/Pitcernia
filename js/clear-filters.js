const clearBtn = document.querySelector("#clear-filters");

console.log(clearBtn);

clearBtn.addEventListener("click", () => {

    console.log(ingridientsCheckboxes, sizeRadios, minInput, maxInput);
    
    ingridientsCheckboxes.forEach((checkbox) => {
        checkbox.checked = false;
    });
    sizeRadios[0].checked = true;
    
    minInput.value = 0;
    minRange.value = 0;

    maxInput.value = 100;
    maxRange.value = 100;

});