
const popupShip = document.querySelector(".ship_popup");
const closeBtnShip = document.querySelector(".close_button_ship");

function showShipPopup() {
  popupShip.style.display = "flex";
}

closeBtnShip.addEventListener("click", () => {
  popupShip.style.display = "none";
});
window.addEventListener("click", (e) => {
  if (e.target === popupShip) {
    popupShip.style.display = "none";
  }
});