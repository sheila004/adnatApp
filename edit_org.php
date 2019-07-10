<?php
include 'dbcon.php';
include 'auth.php';
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <h1>Adnat</h1>

     <p>Logged in as <b><?php echo $_SESSION['name']; ?></b>
     <a href="logout.php">Log Out</a>
    </p>

    <?php

    if ($stmt = $con->prepare("SELECT * FROM organisations Where id=?")) {
      $stmt->bind_param("i", $_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();

          if($result->num_rows >  0){
            while ($row = $result->fetch_assoc()) {
              $name=$row['name'];
              $rate = $row['hourly_rate'];
            }
          }
      } ?>

      <form class="" action="functions.php?id=<?php echo $_GET['id']; ?>" method="post">
        <h2>Edit Organisation</h2>
        <form class="" action="functions.php" method="post">
          Name :                 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
          <input name="name"  type="text" value = "<?php echo $name; ?>" >
          <br><br>
          Hourly rate : &#x24;<input type="number" value = "<?php echo $rate; ?>" name="hourlyRate" placeholder=""> per hour
      <br><br>
      <input type="submit" name="update" value="Update" />

      </form>
      <form class="" action="functions.php?id=<?php echo $_GET['id']; ?>" method="post">
          <input type="submit" name="delete" value="Delete" />
      </form>
   </body>
 </html>
