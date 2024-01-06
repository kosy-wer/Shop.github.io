<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel jQuery Pagination</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
        #paginationLinks a {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 5px;
            border: 1px solid #ccc;
            text-decoration: none;
            color: #333;
        }
        #paginationLinks a.active {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
    </style>
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
                pagination.empty(); // Bersihkan tautan paginasi sebelum menambah yang baru

                // Tambahkan tautan paginasi
                if (response.prev_page_url != null) {
                    pagination.append('<a href="#" class="prev" data-page="' + (response.current_page - 1) + '">Previous</a>');
                }

                for (var i = 1; i <= response.last_page; i++) {
                    pagination.append('<a href="#" class="page" data-page="' + i + '">' + i + '</a>');
                }

                if (response.next_page_url != null) {
                    pagination.append('<a href="#" class="next" data-page="' + (response.current_page + 1) + '">Next</a>');
                }

                // Tautan paginasi diklik
                pagination.find('a').on('click', function (event) {
                    event.preventDefault();
                    var page = $(this).data('page');
                    loadProducts(page);
                });
            }

            loadProducts();
        });
    </script>
</body>
</html>

