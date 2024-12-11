
const popup = document.querySelector(".return_popup");
const closeBtn = document.querySelector(".close_button");

function showPopup() {
  popup.style.display = "flex";
}

closeBtn.addEventListener("click", () => {
  popup.style.display = "none";
});

window.addEventListener("click", (e) => {
  if (e.target === popup) {
    popup.style.display = "none";
  }
});
