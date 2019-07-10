<?php
 include("functions.php");
 include 'auth.php';
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>ADNAT</title>
   </head>
   <body>
     <h1>Adnat</h1>

     <p>Logged in as <b><?php echo $_SESSION['name']; ?></b>
     <a href="logout.php">Log Out</a>
    </p>

    <?php if($_SESSION['org_id']==0){
      ?>
      <p>
      You aren't a member of any organizations.<br>
      Join an existing one or create a new one.
      </p>
      <h2>Organisations</h2>
      <?php getOrganisations($con); ?>

      <h2>Create Organisations</h2>
      <form class="" action="functions.php" method="post">
        Name :                 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input name="name"  type="text" value = "" >
        <br><br>

        Hourly rate : &#x24;<input type="number" name="hourlyRate" placeholder="">
        <br><br>

        <input type="submit" name="createNJoin" value="Create and Join" />

      </form>
      <?php
    }else if ($_SESSION['org_id']!=0){
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
      ?>
      <h2><?php echo $name; ?></h2>
      <a href="shifts.php?id=<?php echo $_SESSION['org_id']; ?>">View Shifts</a> <a href="edit_org.php?id=<?php echo  $_SESSION['org_id']; ?>">Edit</a> <a href="functions.php?lv=<?php echo $_SESSION['org_id'];  ?>">Leave</a>

      <?php
      //echo "added you to organisation";
    } ?>


   </body>
 </html>
