window.addEventListener("DOMContentLoaded", () => {

    let btns = document.querySelectorAll(".finalize-order-btn");

    btns.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            let order_id = Number(e.currentTarget.getAttribute("data-order-id"));
            let value = e.currentTarget.getAttribute("data-order-value");

            SendData(order_id, value);
        });
    });

});

function SendData(order_id, value) {
    
    let formData = new FormData();
    formData.append("id", order_id);
    formData.append("state", value);

    fetch("./admin/order-finalization.php", {
        method: 'POST',
        body: formData
    }).then((res) => {
        if(res.ok) {
            formData = null;
        } else {
            throw new Error ("Order finalization failure.");
        }
    }).catch(error => {
        console.error("Error:", error);
    });
}