const rangeInput = document.querySelectorAll(".range-input input");
const priceInput = document.querySelectorAll(".price-input input");
progress = document.querySelector(".slider .progress"); 

let priceGap = 10; 

priceInput.forEach(input => {
    input.addEventListener("input", e => {

        let minVal = parseInt(priceInput[0].value);
        let maxVal = parseInt(priceInput[1].value);

        if((maxVal - minVal >= priceGap) && (maxVal <= rangeInput[0].max)){

            if(e.target.classList.contains("input-min")){

                rangeInput[0].value = minVal;

                priceInput[1].min = minVal + priceGap;
                priceInput[0].max = maxVal - priceGap;

                let left = (minVal / rangeInput[0].max) * 100;
                progress.style.left = left + "%";

            }else{
                
                rangeInput[1].value = maxVal;

                priceInput[1].min = minVal + priceGap;
                priceInput[0].max = maxVal - priceGap;

                let right = 100 - (maxVal / rangeInput[1].max) * 100;
                progress.style.right = right + "%";
                
            }
        }
    });
});

rangeInput.forEach(input => {
    input.addEventListener("input", e => {
        let minVal = parseInt(rangeInput[0].value);
        let maxVal = parseInt(rangeInput[1].value);

        if(maxVal - minVal < priceGap){
            if(e.target.className === "range-min"){
                rangeInput[0].value = maxVal - priceGap;
            }else{
                rangeInput[1].value = minVal + priceGap;
            }
        }else{
            let left = (minVal / rangeInput[0].max) * 100;
            let right = 100 - (maxVal / rangeInput[1].max) * 100;
    
            progress.style.left = left + "%";
            progress.style.right = right + "%";

            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            
            priceInput[1].min = minVal + priceGap;
            priceInput[0].max = maxVal - priceGap;
        }
    });
});