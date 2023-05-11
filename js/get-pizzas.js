var pizzas;
var rawFile = new XMLHttpRequest();

rawFile.open("POST", "./pizzas.php", false);
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
var json = JSON.stringify(pizzas);
document.cookie = `pizzas=${json}`;


