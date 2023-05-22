window.addEventListener('DOMContentLoaded', function() {
    var hash = window.location.hash;
    if (hash) {
        var element = document.querySelector(hash);
        if (element) {
            element.classList.add("selected");
            element.scrollIntoView();
        }
    }
});