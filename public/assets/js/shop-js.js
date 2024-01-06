$(document).ready(function () {
    var currentData = [];
    var currentSortBy = 'default';

    function loadProducts(sortBy = 'default') {
        $.ajax({
            url: '/get-products',
            type: 'GET',
            success: function (response) {
                currentData = response.data;
                displayProducts(currentData);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function displayProducts(products) {
        var productList = $('#productList');
        var Plist = $('#Plist');
        productList.empty();
	Plist.empty();

        $.each(products, function (key, product) {
            productList.append('<li>' + product.Product_Name + ' - Price: ' + product.Price + '</li>');


      Plist.append(`




<div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">                                                                                                    <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="assets/img/shop_01.jpg">                                                                      <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">                                                                                                                       <li><a class="btn btn-success text-white" href="shop-single.html"><i class="far fa-heart"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i class="far fa-eye"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i class="fas fa-cart-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="shop-single.html" class="h3 text-decoration-none">${product.Product_Name}</a>
                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <li>M/L/X/XL</li>
                                    <li class="pt-2">
                                        <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>                                                        <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>                                                   </li>
                                </ul>                                                                                                                                        <ul class="list-unstyled d-flex justify-content-center mb-1">
                                    <li>                                                                                                                                             <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                    </li>
                                </ul>
                                <p class="text-center mb-0">${product.Price}</p>
                            </div>
                        </div>
                    </div>






	      `);


        });
    }

    function sortProducts(sortBy) {
        currentSortBy = sortBy;

        var sortedData;

        switch (sortBy) {
            case 'nameAsc':
                sortedData = currentData.slice().sort(function(a, b) {
                    return a.Product_Name.localeCompare(b.Product_Name);
                });
                break;
            case 'nameDesc':
                sortedData = currentData.slice().sort(function(a, b) {
                    return b.Product_Name.localeCompare(a.Product_Name);
                });
                break;
            case 'priceDesc':
                sortedData = currentData.slice().sort(function(a, b) {
                    return b.Price - a.Price;
                });
                break;
            case 'priceAsc':
                sortedData = currentData.slice().sort(function(a, b) {
                    return a.Price - b.Price;
                });
                break;
            default:
                sortedData = currentData;
                break;
        }

        displayProducts(sortedData);
    }

    $('#sortOptions').on('change', function () {
        var sortBy = $(this).val();
        sortProducts(sortBy);
    });

    loadProducts();
});

