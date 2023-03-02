document.querySelector("#edit-user-btn").onclick = function(){
    document.cookie = "edit=1";
    location.reload();
}