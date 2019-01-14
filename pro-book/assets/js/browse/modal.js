// Modal
var modal = document.getElementsByClassName('modal')[0];
var layout = document.getElementsByClassName('modal-layout')[0];
var orderId = document.getElementById('order-id')

function openModal(orderID){
  modal.style.visibility = "visible";
  layout.style.visibility = "visible";

  orderId.innerHTML = orderID
}

function closeModal(){
  modal.style.visibility = "hidden";
  layout.style.visibility = "hidden";
}
var browse_tab = document.getElementById("browse_tab");
browse_tab.className = "header_app_content orange-background hover_lightOrange";