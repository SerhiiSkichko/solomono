let currentCategory = null;
let currentSort = null;

function loadProducts() {
    fetch(`api.php?action=getProducts&category_id=${currentCategory || ""}&sort=${currentSort || ""}`)
        .then(res => res.json())
        .then(data => {
            let html = "";
            data.forEach(p => {
                html += `
                  <div class="col-4 mb-3">
                    <div class="card">
                      <div class="card-body">
                        <h5>${p.name}</h5>
                        <p>Ціна: ${p.price} грн</p>
                        <button class="btn btn-primary buy" data-name="${p.name}" data-price="${p.price}">Купити</button>
                      </div>
                    </div>
                  </div>`;
            });
            document.querySelector("#products").innerHTML = html;
        });
}

document.addEventListener("click", function(e) {
    if (e.target.classList.contains("category")) {
        currentCategory = e.target.dataset.id;
        history.pushState({}, "", "?category=" + currentCategory);
        loadProducts();
    }

    if (e.target.classList.contains("buy")) {
        document.querySelector("#modalTitle").textContent = e.target.dataset.name;
        document.querySelector("#modalBody").textContent = "Ціна: " + e.target.dataset.price + " грн";

        let modalEl = document.getElementById('productModal');
        let modal = new bootstrap.Modal(modalEl);
        modal.show();
    }
});

document.getElementById("sort").addEventListener("change", function() {
    currentSort = this.value;
    let url = "?";
    if (currentCategory) url += "category=" + currentCategory + "&";
    if (currentSort) url += "sort=" + currentSort;
    history.pushState({}, "", url);
    loadProducts();
});

// Завантаження при першому відкритті
document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    currentCategory = urlParams.get("category");
    currentSort = urlParams.get("sort");
    if (currentSort) document.getElementById("sort").value = currentSort;
    loadProducts();
});
