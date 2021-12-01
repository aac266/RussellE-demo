<?php  
	session_start();
	include_once '../config/url.php';
	if (isset($_SESSION['username'])) {
	  header('location:guest-dashboard.php');
	  exit();
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="RussellE">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login | Russell Guest</title>
  <link rel="stylesheet" href="<?= $assets_url ?>/lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $assets_url ?>/lib/fontawesome/css/all.min.css">
  <style type="text/css">
  html {
    height: 100%;
  }

  body {
    height: 100%;
    width: 100%;
  }

  </style>
</head>

<body class="bg-dark">

  <div class="container h-100">
    <div class="row align-items-center justify-content-center h-100">
      <div class="col-md-5">
        <div class="card">
          <div class="card-header bg-danger">
            <h3 class="m-0 text-white"><i class="fas fa-user-cog"></i>&nbsp;Guest Login</h3>
          </div>
          <div class="card-body">
            <form action="" method="post" class="px-3" id="guest-login-form">
              <div id="guestLoginAlert"></div>
              <div class="form-group">
                <input type="text" name="username" class="form-control form-control-lg rounded-0" placeholder="Username" required autofocus>
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control form-control-lg rounded-0" placeholder="Password" required>
              </div>
              <div class="form-group">
                <input type="submit" name="adminLogin" id="guestLoginBtn" value="Login" class="btn btn-danger btn-block btn-lg rounded-0">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= $assets_url ?>/lib/jquery-3.4.1.min.js"></script>
  <script src="<?= $assets_url ?>/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $("#guestLoginBtn").click(function(e) {
      if ($("#guest-login-form")[0].checkValidity()) {
        e.preventDefault();
        $(this).val('Please Wait...');
        $.ajax({
          url: 'assets/php/guest-action.php',
          method: 'post',
          data: $("#guest-login-form").serialize() + '&action=guestLogin',
          success: function(response) {
            if ($.trim(response) === 'guest_login') {
              window.location = 'guest-dashboard.php';
            } else {
              $("#guestLoginAlert").html(response);
              $("#guestLoginBtn").val('Login');
            }

          }
        });
      }
    });
  });
  </script>
</body>

</html>
