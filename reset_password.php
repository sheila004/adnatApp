<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Forgot Password</title>
    <!-- js file-->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="js/submit.js"></script>
    <!-- Validate Signup Form -->
<script>

  $(document).ready(function() {
      $("form").submit(function(event) {

          event.preventDefault();
          var password = $("#signup-password").val();
          var co_password = $("#signup-password_c").val();
          var submit = $("#signup-submit").val();



          $(".form-message").load("forgot_password_validation.php", {
                password: password,
                co_password:co_password,
                submit:submit

          });

      });

  });
</script>
  </head>
  <body>
    <h1>ADNAT</h1>

    <h3>Forgot Password</h3>


    <form id="login-form" action="forgot_password_validation.php" method="post">

      <input name="password" id="signup-password" type="password" class="form-control" placeholder="Password" value = "" title="Must contain at least 8 characters or more" >
      <span id = "passwordError" style ="color:red"></span>

      <br><br>
      <input name="password_c" value = "" id="signup-password_c" type="password" class="form-control" placeholder="Confirm Password" title="Must contain at least 8 characters or more" >
      <span id = "errorCo_password" style ="color:red"></span>

      <br><br>
      <span id = "submitError" style ="color:red"></span>
      <span id = "submitSuccess" style ="color:green"></span>

      <input type="submit" class="form-control submit" name="signup-submit"  value="Proceed" id="signup-submit"/>
       <p class ="form-message"></p>

    </form>

  </body>
</html>
