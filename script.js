document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const relateBox = document.getElementById('relateBox');

    // Lắng nghe sự kiện input
    searchInput.addEventListener('input', () => {
        const query = searchInput.value.trim();
        if (query.length > 0) {
            fetchResults(query);
        } else {
            relateBox.style.display = 'none';
        }
    });

    // Hàm gửi Ajax yêu cầu và hiển thị kết quả
    function fetchResults(query) {
        fetch('headerA.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `query=${encodeURIComponent(query)}`,
        })
        .then(response => response.json())
        .then(data => {
            relateBox.innerHTML = ''; // Xóa kết quả cũ
            if (data.length > 0) {
                data.forEach(product => {
                    const p = document.createElement('p');
                    p.textContent = `${product.name}: ${product.description}`;
                    relateBox.appendChild(p);
                });
                relateBox.style.display = 'block';
            } else {
                relateBox.style.display = 'none';
            }
        })
        .catch(error => console.error('Lỗi:', error));
    }
});
