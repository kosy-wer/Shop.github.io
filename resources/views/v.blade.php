<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Product List</h1>
    <div>
        <button id="sortPriceDesc">Sort Price (High to Low)</button>
        <button id="sortPriceAsc">Sort Price (Low to High)</button>
        <button id="sortNameAsc">Sort Name (A to Z)</button>
        <button id="sortNameDesc">Sort Name (Z to A)</button>
    </div>
    <ul id="productList"></ul>

    <script>
        $(document).ready(function () {
            var currentData = []; // Variabel untuk menyimpan data yang didapat dari server
            var currentSortBy = 'Product_ID';
            var currentSortDirection = 'asc';

            function loadProducts(sortBy = 'Product_ID', sortDirection = 'asc') {
                $.ajax({
                    url: '/get-products',
                    type: 'GET',
                    success: function (response) {
                        currentData = response.data; // Simpan data dari server ke variabel lokal
                        displayProducts(currentData);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }

            function displayProducts(products) {
                var productList = $('#productList');
                productList.empty();

                $.each(products, function (key, product) {
                    productList.append('<li>' + product.Product_Name + ' - Price: ' + product.Price + '</li>'); // Sesuaikan dengan atribut yang ingin ditampilkan
                });
            }

            function sortProducts(sortBy, sortDirection) {
                currentSortBy = sortBy;
                currentSortDirection = sortDirection;

                // Lakukan pengurutan pada variabel lokal tanpa permintaan ke server
                var sortedData = currentData.slice().sort(function(a, b) {
                    if (sortBy === 'Price') {
                        return sortDirection === 'asc' ? a.Price - b.Price : b.Price - a.Price;
                    } else {
                        var nameA = a.Product_Name.toUpperCase();
                        var nameB = b.Product_Name.toUpperCase();
                        if (sortDirection === 'asc') {
                            return nameA.localeCompare(nameB);
                        } else {
                            return nameB.localeCompare(nameA);
                        }
                    }
                });

                displayProducts(sortedData);
            }

            $('#sortPriceDesc').on('click', function () {
                sortProducts('Price', 'desc');
            });

            $('#sortPriceAsc').on('click', function () {
                sortProducts('Price', 'asc');
            });

            $('#sortNameAsc').on('click', function () {
                sortProducts('Product_Name', 'asc');
            });

            $('#sortNameDesc').on('click', function () {
                sortProducts('Product_Name', 'desc');
            });

            loadProducts();
        });
    </script>
</body>
</html>

