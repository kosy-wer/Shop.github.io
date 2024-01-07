$(document).ready(function () {
    var currentData = [];
    var currentSortBy = 'default';
    var currentPage = 1;

    function loadProducts(page = 1) {
        $.ajax({
            url: '/get-products?page=' + page,
            type: 'GET',
            success: function (response) {
                currentData = response.data;
                displayProducts(currentData);
                currentPage = page;
                displayPagination(response);
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
            productList.append(

`
<div class="col-md-4">
    <div class="card mb-4 product-wap rounded-0">
        <div class="card rounded-0">
            <img class="card-img rounded-0 img-fluid" src="assets/img/shop_01.jpg">
            <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                <ul class="list-unstyled">
                    <li><a class="btn btn-success text-white" href="shop-single.html"><i class="far fa-heart"></i></a></li>
                    <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i class="far fa-eye"></i></a></li>
                    <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i class="fas fa-cart-plus"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <a href="shop-single.html" class="h3 text-decoration-none">${product.Price}</a>
            <p class="text-center mb-0">$250.00</p>
        </div>
    </div>
</div>


`

	    ); 
        });
    }

    function displayPagination(response) {
        var pagination = $('#paginationLinks');
        pagination.empty();

        if (response.prev_page_url != null) {
            pagination.append(`




<li class="page-item">
                            <a data-page="' + (response.current_page - 1) + '" class="prev page-link rounded-0 shadow-sm border-top-0 border-left-0 text-dark" href="#">preveus</a>
                        </li>




		    `);
        }

	for (var i = 1; i <= response.last_page; i++) {
    pagination.append(`
        <li class="page-item">
            <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="#" data-page="${i}">${i}</a>
        </li>
    `);
}



        if (response.next_page_url != null) {
            pagination.append(`


<li class="page-item">
            <a class="next rounded-0 mr-3 shadow-sm border-
top-0 border-left-0 text-dark" href="#" data-page="' + (resp
onse.current_page + 1) + '">next</a
>
        </li>
		    `);


        }

        pagination.find('a').on('click', function (event) {
            event.preventDefault();
            var page = $(this).data('page');
            loadProducts(page);
        });
    }

    function sortProducts(sortBy) {
        currentSortBy = sortBy;
        // Lakukan sorting di sini

        // Contoh sorting (dapat disesuaikan dengan kebutuhan)
        if (sortBy === 'nameAsc') {
            currentData.sort((a, b) => a.Product_Name.localeCompare(b.Product_Name));
        } else if (sortBy === 'nameDesc') {
            currentData.sort((a, b) => b.Product_Name.localeCompare(a.Product_Name));
        } else if (sortBy === 'priceAsc') {
            currentData.sort((a, b) => a.Price - b.Price);
        } else if (sortBy === 'priceDesc') {
            currentData.sort((a, b) => b.Price - a.Price);
        }

        displayProducts(currentData);
    }

    $('#sortOptions').on('change', function () {
        var sortBy = $(this).val();
        sortProducts(sortBy);
    });

    loadProducts();
});

