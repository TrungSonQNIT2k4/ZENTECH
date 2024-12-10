function loadContent(id, file) {
    fetch(file)
        .then(response => response.text())
        .then(data => document.getElementById(id).innerHTML = data)
        .catch(err => console.error("Error loading file:", err));
}

document.addEventListener("DOMContentLoaded", () => {
    loadContent("header-placeholder", "header.html");
    loadContent("container-placeholder", "container.html");
    loadContent("footer-placeholder", "footer.html");
});
