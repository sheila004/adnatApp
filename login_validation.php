<?php

   include("dbcon.php");

if(!empty($_POST["remember"])) {
	setcookie ("email",$_POST["email"],time()+ 3600);
	setcookie ("password",$_POST["password"],time()+ 3600);
} else {
	setcookie("email","");
	setcookie("password","");
}

if(!isset($_REQUEST['email'], $_REQUEST['password'])){
  // Could not get the data that should have been sent.
	     die ('Email or password does not exist!');
}

   if ($stmt = $con->prepare("SELECT * FROM users WHERE email_address=?")) {

     $stmt->bind_param("s", $_REQUEST['email']);
     $stmt->execute();
     $result = $stmt->get_result();

     if ($result->num_rows >  0) {
       while($row = $result->fetch_assoc()){//get result
          $email = $row['email_address'];
          $password = $row['password'];
          $org_id = $row['organisation_id'];
          $name = $row['name'];
          $user_id= $row['id'];
       }//end of (while)get result

        if (password_verify($_REQUEST['password'],$password)  && $_REQUEST['email'] == $email) {
          $_SESSION['name'] = $name;
          $_SESSION['org_id'] = $org_id;
          $_SESSION['user_id'] = $user_id;

          header('Location: org.php');

        }else {
          $error=1;
          header('Location: index.php?msg='.$error);
        }


     }else {
       $error="<font color='red'>Invalid email or password.</font>" ;
      header('Location: index.php?msg='.$error);
     }
   }else {
     echo "no connect";
   }



 ?>
