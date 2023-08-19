<!DOCTYPE html>
<html lang="en">
<head>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="assets/css/signin.css" rel="stylesheet">
	<link rel="icon" href="assets/img/logo.jpg">

	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <link href="/css/login.css" rel="stylesheet" />

  <title>{{$title ?? "Login"}}</title>
</head>
<body>
  <div class="container mt-5">
    <script>
      let msg = '{{Session::get('alert')}}';
      let exist = '{{Session::has('alert')}}';
      if(exist){
        alert(msg);
      }
    </script>
    <div class="container" style="margin-top: 2rem;">
      <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6 text-center mx-auto">
                <a href="#" class="active" id="login-form-link">Login</a>
              </div>
              <div class="col-xs-6 text-center mx-auto">
                <a href="#" id="register-form-link">Register</a>
              </div>
            </div>
            <hr>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <form id="login-form" action="/login-user" method="post" role="form" style="display: block;">
                  <div class="form-group">
                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="login" id="login" tabindex="4" class="form-control btn btn-primary" value="Log In">
                      </div>
                    </div>
                  </div>
                
                </form>
                <form id="register-form" action="/register" method="post" role="form" enctype="multipart/form-data" style="display: none;">
                  <div class="form-group">
                    <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Name" required>
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                    <input type="text" name="address" id="address" tabindex="1" class="form-control" placeholder="Address" required>
                  </div>
                  <div class="form-group">
                    <input type="number" min="17" name="age" id="age" tabindex="1" class="form-control" placeholder="Age" required>
                  </div>
                  <div class="form-group">
                    <input type="number" min="1" name="id_card_number" id="id_card_number" tabindex="1" class="form-control" placeholder="ID Card Number " required>
                  </div>
                  <div class="form-group">
                    <label for="profile_photo" style="font-weight:normal">Photo profile</label>
                    <input type="file" name="profile_photo" id="profile_photo" tabindex="1" class="form-control"required>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <input type="password" name="passwordConfirm" id="passwordConfirm" tabindex="2" class="form-control" placeholder="Confirm Password" required>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="register" id="register" tabindex="4" class="form-control btn btn-primary" value="Register Now">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</body>
<script>
  $(function() {

     $('#login-form-link').click(function(e) {
     $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
     $('#register-form-link').removeClass('active');
     $(this).addClass('active');
     e.preventDefault();
     });
     $('#register-form-link').click(function(e) {
     $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
     $('#login-form-link').removeClass('active');
     $(this).addClass('active');
     e.preventDefault();
     });

  });

</script>
@include('layouts.partials.footer_script')
</html>
