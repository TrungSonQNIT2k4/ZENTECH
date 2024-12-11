
const popupAddress = document.querySelector(".address_popup");
const closeBtnAddress = document.querySelector(".close_button_address");

function showPopupAddress() {
  popupAddress.style.display = "flex";
}

closeBtnAddress.addEventListener("click", () => {
  popupAddress.style.display = "none";
});

window.addEventListener("click", (e) => {
  if (e.target === popupAddress) {
    popupAddress.style.display = "none";
  }
});