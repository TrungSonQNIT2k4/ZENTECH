document.querySelector('.toggle-button').addEventListener('click', function() {
  const leftInfo = document.querySelector('.left-info');
  
  if (leftInfo.style.maxHeight === '1490px' || leftInfo.style.maxHeight === '') {
      leftInfo.style.maxHeight = 'none'; // Mở rộng nội dung
      this.textContent = 'Thu gọn bài viết'; // Thay đổi văn bản nút
  } else {
      leftInfo.style.maxHeight = '1490px'; // Thu gọn nội dung lại
      this.textContent = 'Xem toàn bộ bài viết'; // Đổi lại văn bản nút
  }
});
