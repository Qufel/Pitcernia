var modal = document.querySelector("#error-modal");
var bs_modal = new bootstrap.Modal(modal);
if(window.location.href.indexOf('?s=false') != -1) {
   console.log(bs_modal);
   bs_modal.show(); 
}