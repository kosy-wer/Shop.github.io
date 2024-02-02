<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Bootstrap demo</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>
    <body>
        <div class="border-0 d-flex justify-content-center">
            <div class="d-flex justify-content-center align-items-center card border-0" style="width: 100%; height: 100%">
@if ($product)

	    <a href="{{ route('Shop') }}" class="btn text-white" style="position: absolute; top: 0; left: 0; width: 5em; font-size: 2em;">
  <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg">
    <image href="{{ asset('assets/img/backspace-fill.svg') }}" height="50" width="50" style="font-size: 5em;" />
  </svg>
</a>

                <img style="height:50%; width:80%;" 
                    src="{{ asset('assets/img/' . $product->Product_Name . '.webp') }}"

		    class="card-img-top border-0 "
                    alt="alt="{{ $product->Product_Name }}" "
                />
                <div class="card-body row d-flex justify-content-center align-items-center ">
                    <p id="product"  style="font-size: 3em" class="card-text">{{ $product->Product_Name }} </p>
                    <p
                        style="font-size: 2rem; font-weight: bold"
                        class="card-text"
                    >
                        {{ $product->Price }}
                    </p>
                    <div
                        class="input-group rounded-4"
                        style="width: 80%; height: 20%; "
                    >
                        <button
                            style="width: 2.5em; font-size: 2em"
                            class="btn btn-outline-secondary bg-success text-white"
                            type="button"
                            id="subtract"
                        >
                            -
                        </button>
                        <input
                            style=""
                            type="text"
                            class="text-center form-control"
                            value="1"
                            id="quantity"
                        />
                        <button
                            style="width: 2.5em; font-size: 2em"
                            class="btn btn-outline-secondary bg-success text-white"
                            type="button"
                            id="add"
                        >
                            +
                        </button>
                    </div>
                    <div
                        style="margin-top: 5%; width: 80%"
                        class="d-flex justify-content-between"
                    >
                    <button style="width: 2.5em; font-size: 2em" class="btn btn-outline-secondary bg-success text-white" type="button" id="subtract">
    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg">
        <image href="{{ asset('assets/img/money-bill-wave-solid.svg') }}" height="20" width="20" style="font-size: 2em;" />
    </svg>
</button>

<button style="width: 2.5em; font-size: 2em" class="btn btn-outline-secondary bg-success text-white" type="button" id="addToWishlist">
    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg">
        <image href="{{ asset('assets/img/cart-plus.svg') }}" height="20" width="20" style="font-size: 2em;" />
    </svg>
</button>

		    </div>
                </div>
@else
        <p>Product not found</p>
    @endif

            </div>
        </div>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"
        ></script>
        <script>


	   document.getElementById('addToWishlist').addEventListener('click', function() {
  // Dapatkan nilai atau data yang diperlukan dari elemen atau tempat yang sesuai.
  let productId = document.getElementById('product').innerText;

alert(productId);

  //Kirim data ke endpoint di Laravel menggunakan fetch atau metode lainnya.
  fetch('/api/add-to-wishlist', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    },
    body: JSON.stringify({
      product_id: productId,
    }),
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    // Tanggapan dari endpoint
    console.log(data);
    // Lakukan hal lain setelah mendapatkan tanggapan
  })
  .catch(error => {
    console.log('There has been a problem with your fetch operation: ' + error);
  });


});




            let quantityInput = document.getElementById("quantity");
            let addButton = document.getElementById("add");
            let subtractButton = document.getElementById("subtract");

            addButton.addEventListener("click", function () {
                quantityInput.value = parseInt(quantityInput.value) + 1;
            });

            subtractButton.addEventListener("click", function () {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });
        </script>
    </body>
</html>
