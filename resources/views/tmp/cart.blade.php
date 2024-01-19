<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
<section class="h-100" style="background-color: #eee;">
    <div class="container h-100 py-5">
      <div class="row d-flex justify-content-center align-items-center h-100">

        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2  ">
                <img
                  src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img1.webp"
                  class="img-fluid rounded-3" alt="Cotton T-shirt">
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2">Basic T-shirt</p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                
<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg">           <image href="{{ asset('assets/img/dash-square.svg') }}" height="20" width="20" style="font-size: 2em;" />
    </svg>
		</button>

                <input id="form1" min="0" name="quantity" value="2" type="number"
                  class="d-flex text-center form-control form-control-sm" />

                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg">           <image href="{{ asset('assets/img/plus-square.svg') }}" height="20" width="20" style="font-size: 2em;" />
    </svg>

		</button>
              </div>
              <div class=" col-md-3 col-lg-2 col-xl-2 offset-lg-1" style="margin-top:5px;" >
                <h5 class="mb-0">$499.00</h5>
              </div>
            </div>
          </div>
        </div>

<div class="card">
            <div class="card-body">
              <button type="button" class="btn btn-warning btn-block btn-lg">Proceed to Pay</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
