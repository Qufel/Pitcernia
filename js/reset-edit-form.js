document.querySelector('#reset_edit_form').onclick = function () {
    document.cookie = "edit=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
    location.reload();
};