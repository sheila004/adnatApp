<?php

if(isset($_SESSION["user_id"])){
    header("Location:org.php");
    exit();
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ADNAT</title>
  </head>
  <body>
    <h1>ADNAT</h1>

    <h2><b>Log in</b></h2>
    <form class="" action="login_validation.php" method="post">

      <input name="email" id="email" type="email" class="form-control" placeholder="Email" value ="<?php if(isset($_COOKIE['email'])){echo $_COOKIE["email"];} ?>"required/>
    <br></br>
      <input name="password" id="password" type="password" class="form-control" placeholder="Password" value ="<?php if(isset($_COOKIE['password'])){echo $_COOKIE["password"];} ?>" required/>
      <br>
      <?php
      if(isset($_GET['msg'])){
        if ($_GET['msg']==1) {
            echo "<font color='red'>Invalid email or password.</font>";
        }

      }
       ?>
      <br></br>
      <input type="checkbox" name="remember" /> Remember me
      <br>
    <input type="submit" name=""class="form-control submit"  value="Login" />

    </form>

    <a href="signup.php">Sign up</a>
    <br>
  
  </body>
</html>
