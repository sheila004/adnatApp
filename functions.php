<?php
include 'dbcon.php';

if (isset($_REQUEST['createNJoin'])) {
    $name = $_REQUEST['name'];
    $rate = $_REQUEST['hourlyRate'];
    if ($stmt = $con->prepare("INSERT INTO organisations (name, hourly_rate) VALUES (?, ?)")){

     $stmt->bind_param('si',$name, $rate);
     $stmt->execute();
     $last_id =  mysqli_insert_id($con);
   }
  //$stmt->close();

  if ($stmt = $con->prepare("UPDATE users SET organisation_id = ? WHERE id=?")){
    $stmt->bind_param('ii',$last_id,$_SESSION['user_id']);
    $stmt->execute();
  }
    $stmt->close();
    $_SESSION['org_id']=$last_id;
    header("Location: org.php?id=".$last_id);
}




if (isset($_REQUEST['update'])) {
    $name = $_REQUEST['name'];
    $rate = $_REQUEST['hourlyRate'];
    if ($stmt = $con->prepare("UPDATE organisations SET name = ?, hourly_rate = ? WHERE id=?")){

     $stmt->bind_param('sii',$name, $rate, $_GET['id']);
     $stmt->execute();
       //$last_id =  mysqli_insert_id($con);
   }
  //$stmt->close();

    header("Location: org.php");
}





if (isset($_REQUEST['delete'])) {
  $name = $_REQUEST['name'];
  $rate = $_REQUEST['hourlyRate'];
  if ($stmt = $con->prepare("DELETE FROM organisations WHERE id = ?")){

   $stmt->bind_param('i',$_GET['id']);
   $stmt->execute();
     //$last_id =  mysqli_insert_id($con);
 }
$_SESSION['org_id']=0;
  $stmt->close();
  header("Location: org.php");
}




if (isset($_GET['join'])) {
  if ($stmt = $con->prepare("UPDATE users SET organisation_id = ? WHERE id=?")){
    $stmt->bind_param('ii',$_GET['join'],$_SESSION['user_id']);
   $stmt->execute();
    $last_id =  mysqli_insert_id($con);
  }

  $_SESSION['org_id']=$_GET['join'];
  header("Location: org.php?id=".$_GET['join']);
}




if (isset($_GET['lv'])) {
  if ($stmt = $con->prepare("UPDATE users SET organisation_id = ? WHERE id=?")){
    $org_id=0;
    $stmt->bind_param('ii',$org_id,$_SESSION['user_id']);
   $stmt->execute();
    $last_id =  mysqli_insert_id($con);
  }

  $_SESSION['org_id']=$org_id;
  header("Location: org.php");
}




if (isset($_REQUEST['createShift'])) {

  if ($stmt = $con->prepare("SELECT * FROM organisations Where id=?")) {
    $stmt->bind_param("i", $_SESSION['org_id']);
      $stmt->execute();
      $result = $stmt->get_result();

        if($result->num_rows >  0){
          while ($row = $result->fetch_assoc()) {
            $name=$row['name'];
            $rate = $row['hourly_rate'];
          }
        }
    }

    $end =  date("H:i", strtotime($_REQUEST['end']));
    $end2 = date("H:i", strtotime("-".$_REQUEST['break']." minutes", strtotime($end)));
    $start = date("H:i", strtotime($_REQUEST['start']));

    $shift_length = (strtotime($end2) - strtotime($start));
    $hours_worked = $shift_length/3600;
    $shift_cost = $hours_worked * $rate;

//  echo $shift_length." ";
//  echo $hours_worked." ";
//  echo $shift_cost;
  //echo $shift_cost;
  if ($stmt = $con->prepare("INSERT INTO shifts (user_id, shift_date, start, finish, break_length) VALUES (?, ?, ?, ?, ?)")){

   $stmt->bind_param('isssi',$_SESSION['user_id'], $_REQUEST['shift'], $start,$end,$_REQUEST['break']);
   $stmt->execute();
   //$last_id =  mysqli_insert_id($con);
   header("Location: shifts.php");
 }


}

if (isset($_REQUEST['forgot_password'])) {

  if ($stmt = $con->prepare("SELECT * FROM users Where email_address=?")) {
    $stmt->bind_param("s", $_REQUEST['email']);
      $stmt->execute();
      $result = $stmt->get_result();

        if($result->num_rows >  0){
          $_SESSION['email']=$_REQUEST['email'];
           header("Location: reset_password.php");
         }else {
           $error = 1;
            header("Location: forgot_password.php?msg=".$error);
         }
        }
    }



if (isset($_REQUEST['did'])) {

      if ($stmt = $con->prepare("DELETE FROM shifts WHERE id = ?")){

       $stmt->bind_param('i',$_GET['did']);
       $stmt->execute();
         //$last_id =  mysqli_insert_id($con);
     }

      header("Location: shifts.php");
    }





if (isset($_REQUEST['update_shift'])) {

  $end =  date("H:i", strtotime($_REQUEST['end']));
  $end2 = date("H:i", strtotime("-".$_REQUEST['break']." minutes", strtotime($end)));
  $start = date("H:i", strtotime($_REQUEST['start']));

  if (isset($_GET['eid'])) {
    if ($stmt = $con->prepare("UPDATE shifts SET shift_date = ?, start=?, finish=?, break_length=?  WHERE id=?")){

      //$org_id=0;
      $stmt->bind_param('ssssi',$_REQUEST['shift'],$start,$end,$_REQUEST['break'],$_GET['eid']);
     $stmt->execute();
      $last_id =  mysqli_insert_id($con);
    }

    //$_SESSION['org_id']=$org_id;
    header("Location: org.php");
  }


}
//functions
function getOrganisations($con){
  if ($stmt = $con->prepare("SELECT * FROM organisations")) {
    $stmt->execute();
    $result = $stmt->get_result();

      if($result->num_rows >  0){
        while ($row = $result->fetch_assoc()) {
          echo '
          <ul style="list-style-type:disc;">
          <li>'.$row['name'].' <a href="edit_org.php?id='.$row['id'].'">Edit</a> <a href="functions.php?join='.$row['id'].'">Join</a></li>
          </ul>  ';
        }
      }else {
        echo "<font color='red'>No Existing Organisation.</font>";
      }
  }
}

function getOrgId($con,$id){
  if ($stmt = $con->prepare("SELECT * FROM organisations Where id=?")) {
    $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();

        if($result->num_rows >  0){
          while ($row = $result->fetch_assoc()) {
            $name=$row['name'];
            $rate = $row['hourly_rate'];
          }
        }
    }
}
 ?>
