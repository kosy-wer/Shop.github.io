<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel jQuery Pagination</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Product List</h1>
    <ul id="productList"></ul>
    <div id="paginationLinks"></div>

    <script>
        $(document).ready(function () {
            function loadProducts(page = 1) {
                $.ajax({
                    url: '/get-products?page=' + page,
                    type: 'GET',
                    success: function (response) {
                        displayProducts(response);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }

            function displayProducts(response) {
                var productList = $('#productList');
                productList.empty();

                $.each(response.data, function (key, product) {
                    productList.append('<li>' + product.Price + '</li>'); // Sesuaikan dengan atribut yang ingin ditampilkan
                });

                var pagination = $('#paginationLinks');
                pagination.html(response.links);

                $('#paginationLinks a').on('click', function (event) {
                    event.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    loadProducts(page);
                });
            }

            loadProducts();
        });
    </script>
</body>
</html>

