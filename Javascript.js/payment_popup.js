document.getElementById("confirm_button").addEventListener("click", function () {
  const selectedPayment = document.querySelector('input[name="choice_payment"]:checked');
  if (!selectedPayment) {
      alert("Vui lòng chọn phương thức thanh toán!");
      return;
  }

  // Gửi lựa chọn tới server
  fetch("update_payment.php", {
      method: "POST",
      headers: {
          "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "payment_method=" + encodeURIComponent(selectedPayment.value),
  })
      .then((response) => response.text())
      .then((data) => {
          alert("Phương thức thanh toán đã được cập nhật: " + selectedPayment.value);
          // Ẩn popup sau khi cập nhật
          document.getElementById("payment_popup").style.display = "none";
      })
      .catch((error) => {
          console.error("Lỗi khi gửi dữ liệu:", error);
      });
});

// Đóng popup khi nhấn nút hủy
document.getElementById("cancel_button").addEventListener("click", function () {
  document.getElementById("payment_popup").style.display = "none";
});

// Đóng popup khi nhấn nút X
document.getElementById("close_button_payment").addEventListener("click", function () {
  document.getElementById("payment_popup").style.display = "none";
});