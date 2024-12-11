
const popupPayment = document.querySelector(".payment_popup");
const closeBtnPayment = document.querySelector(".close_button_payment");

function showPaymentPopup() {
  popupPayment.style.display = "flex";
}

closeBtnPayment.addEventListener("click", () => {
  popupPayment.style.display = "none";
});
window.addEventListener("click", (e) => {
  if (e.target === popupPayment) {
    popupPayment.style.display = "none";
  }
});