<?php

include 'dbcon.php';

if(isset($_POST['submit'])){

  $firstName = test_input($_POST['name']);
  $password = test_input($_POST['password']);
  $password_co = test_input($_POST['co_password']);
  $email = test_input($_POST['email']);

  $errorEmpty = false;
  $errorFirstName = false;
  $errorPassword = false;
  $errorPassword_co = false;
  $errorConfirm = false;

if(empty($firstName)|| empty($password) || empty($password_co) || empty($email)){

  //if all fields are empty
  $errorEmpty = true;

}else{

  $errorEmpty = false;

}

if(empty($firstName)){

      //First Name has numbers, spech chars
      $errorFirstName = true;

  }else{

      //First Name contains all letters
      $errorFirstName = false;

  }


if(empty($password) && strlen($password) < 8){

    //Password field is not empty and length is less than 8
    $errorPassword = true;

}else{

    $errorPassword = false;

}

if(empty($password_co) && strlen($password_co) < 8){

    //Password field is not empty and length is less than 8
    $errorPassword_co = true;

}else{

    $errorPassword_co = false;

}

if($password_co != $password ){

    //if confirmed password not equal to given password
    $errorConfirm = true;

}else{

    $errorConfirm = false;

}







}//End of isset($_POST['submit'])


?>

<script>

var errorEmpty = "<?php echo $errorEmpty; ?>";
var errorFirstName = "<?php echo $errorFirstName; ?>";
var errorPassword = "<?php echo $errorPassword; ?>";
var errorPassword_co = "<?php echo $errorPassword_co; ?>";
var errorConfirm = "<?php echo $errorConfirm; ?>";


console.log(errorEmpty);


if(errorEmpty == true){

  $("#submitError").html("Please fill out the fields to continue.");
  $("#submitError").show();
  $("#submitSuccess").hide();


}else{

  $("#submitError").hide();

}


if(errorFirstName == true){

  $("#firstNameError").html("*Required");
  $("#firstNameError").show();
  $("#submitSuccess").hide();


}else {

  $("#submitError").hide();


}



if(errorPassword == true){

  $("#passwordError").html("Minimum password length is atleast 8");
  $("#passwordError").show();
  $("#submitSuccess").hide();


}else{

  $("#passwordError").hide();

}

if(errorPassword_co == true){

  $("#errorCo_password").html("Minimum password length is atleast 8");
  $("#errorCo_password").show();
  $("#submitSuccess").hide();


}else{

  $("#errorCo_password").hide();

}

if(errorConfirm == true){

  $("#submitError").html("Confirmed Password does not match given password.");
  $("#submitError").show();
  $("#submitSuccess").hide();

}else{

    $("#submitError").hide();

}


if(!errorEmpty && !errorFirstName && !errorPassword && !errorPassword_co && !errorConfirm){

<?php

if (!$errorEmpty && !$errorFirstName && !$errorPassword && !$errorPassword_co && !$errorConfirm) {
  // code...

$email = $email;
$name =$firstName;
$pass = $password;
$pass_c =$password_co;
$org_id = 0;



                 //echo $email;
                   $password = password_hash($pass_c, PASSWORD_DEFAULT);


                 if ($stmt = $con->prepare("INSERT INTO users (organisation_id, name, email_address, password) VALUES (?, ?, ?, ?)")){


                   $stmt->bind_param('isss',$org_id, $name, $email, $password);
                   $stmt->execute();
                  $last_id =  mysqli_insert_id($con);
                  $_SESSION['name'] = $name;
                  $_SESSION['org_id'] = $org_id;
                  $_SESSION['user_id'] = $last_id;

                 }
              $stmt->close();
}
?>


$("#submitSuccess").html(function myFunction() {
  alert("You successfully created your Account");
  window.location.href = "org.php";
});
$("#submitSuccess").show();



document.getElementById("login-form").reset();






}








</script>
