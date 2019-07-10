<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign up</title>
    <!-- js file-->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="js/submit.js"></script>
    <!-- Validate Signup Form -->
<script>

  $(document).ready(function() {
      $("form").submit(function(event) {

          event.preventDefault();
          var name = $("#signup-name").val();
          var email = $("#signup-email").val();
					var password = $("#signup-password").val();
					var co_password = $("#signup-password_c").val();
          var submit = $("#signup-submit").val();



          $(".form-message").load("sign_up_validation.php", {
                name: name,
                email: email,
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

    <h2>Sign up</h2>
          <form id="login-form" method="post" action="sign_up_validation.php">

              <input name="name" id="signup-name" type="text" class="form-control" value = "" placeholder="Name" required>
                  <span id = "firstNameError" style ="color:red" ></span>

<br>
<br>
              <input name="email" id="signup-email" type="email" class="form-control" placeholder="Email" value = "" required>


<br><br>
              <input name="password" id="signup-password" type="password" class="form-control" placeholder="Password" value = "" title="Must contain at least 8 characters or more" >

                  <span id = "passwordError" style ="color:red"></span>

<br><br>
              <input name="password_c" value = "" id="signup-password_c" type="password" class="form-control" placeholder="Confirm Password" title="Must contain at least 8 characters or more" >
                  <span id = "errorCo_password" style ="color:red"></span>
<br><br>
                  <span id = "submitError" style ="color:red"></span>
                  <span id = "submitSuccess" style ="color:green"></span>



              <input type="submit" class="form-control submit" name="signup-submit"  value="Sign Up" id="signup-submit"/>
               <p class ="form-message"></p>
            </form>

            <a href="index.php">Login</a>
  </body>
</html>
