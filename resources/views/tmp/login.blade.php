<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Add CSRF token meta tag -->
  <title>Bootstrap 5 - Login Form</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


</head>
<body class="main-bg">
  <!-- Login Form -->
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card shadow">
          <div class="card-title text-center border-bottom">
            <h2 class="p-3">Login</h2>
          </div>
          <div class="card-body">
            <form method="post" action="/Register">
              @csrf
              <div class="mb-4">
                <label for="username" class="form-label">Username/Email</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}"/>
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" />
              </div>

              <div class="mb-4 d-flex align-items-center justify-content-between">

                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}/>
                  <label for="remember" class="form-check-label">Remember Me</label>
                </div>

                <button id="login" class="btn text-dark main-bg border-secondary-subtle">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div style="z-index:1;position: fixed;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%); " id="error-container"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- Add jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
  $(document).ready(function() {


  function displayErrors(errors) {
      var errorList = '<ul>';
      $.each(errors, function(index, error) {
        errorList += '<li>' + error + '</li>';
      });
      errorList += '</ul>';

      var errorMessage = '<div class="alert alert-danger">' + errorList + '</div>';
      $('#error-container').html(errorMessage);
      setTimeout(function() {
        $('#error-container').fadeOut('slow', function() {
          $(this).remove();
        });
      }, 1500);
    }


    $("#login").click(function(e) {
      e.preventDefault();

      var username = $("#username").val();
      var password = $("#password").val();
      var remember = $("#remember").prop("checked");

      // You can add additional validation if needed

      $.ajax({
        type: "POST",
        url: "/Register", // Update with your actual form URL
        data: {
          username: username,
          password: password,
          remember: remember,
          _token: "{{ csrf_token() }}" // Add CSRF token
        },
        success: function(response) {
          // Handle successful login response
          console.log(response);
	  localStorage.setItem('token', response.token);
        window.location.href = "/Home";
        },
        error: function(error) {
          // Handle login error
          console.log(error);
	  if (error.responseJSON && error.responseJSON.errors) {
            displayErrors(error.responseJSON.errors);
          }
        }
      });
    });
  });
</script>


</body>

</html>
