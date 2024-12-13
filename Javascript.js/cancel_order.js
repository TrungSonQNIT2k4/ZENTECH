function cancelOrder() {
    if (confirm("Bạn chắc chắn muốn hủy không?")) {
        alert("Đã hủy thành công!"); 
        window.history.back();
    } else {
        window.history.back();
    }
}