<?php
include 'dbcon.php';
include 'auth.php';
date_default_timezone_set('Asia/Manila');
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Adnat Shifts</title>
  </head>
  <body>
    <h1>Adnat</h1>

    <p>Logged in as <b><?php echo $_SESSION['name']; ?></b>
    <a href="logout.php">Log Out</a>
   </p>

   <?php
   if ($stmt = $con->prepare("SELECT * FROM organisations Where id=?")) {
     $stmt->bind_param("i",  $_SESSION['org_id']);
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
      <h4>Shifts</h3>

      <table class="table">

  <thead>
    <tr>
      <th scope="col">Employee name</th>
      <th scope="col">Shift date</th>
      <th scope="col">Start time</th>
      <th scope="col">Finish time</th>
      <th scope="col">Break length(minutes)</th>
      <th scope="col">Hours worked</th>
      <th scope="col">Shift cost</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <?php //

    if ($stmt = $con->prepare("SELECT s.id, u.name, s.shift_date, s.start, s.finish, s.break_length FROM shifts AS s INNER JOIN users AS u ON s.user_id=u.id WHERE u.organisation_id =?")) {
       $stmt->bind_param("i",  $_SESSION['org_id']);
        $stmt->execute();
        $result = $stmt->get_result();

          if($result->num_rows >  0){
            while ($row = $result->fetch_assoc()) {

                //  $end =  date("H:i", strtotime($_REQUEST['end']));
                  $end2 = date("H:i", strtotime("-".$row['break_length']." minutes", strtotime($row['finish'])));

                  $shift_length = (strtotime($end2) - strtotime($row['start']));
                  $hours_worked = $shift_length/3600;
                  $shift_cost = $hours_worked * $rate;
                echo "  <tbody>
                  <tr>";
              echo "<th>".$row['name']."</th>";
              echo "<th>".$row['shift_date']."</th>";
              echo "<th>".date('h:i a', strtotime($row['start']))."</th>";
              echo "<th>".date('h:i a', strtotime($row['finish']))."</th>";
              echo "<th>".$row['break_length']."</th>";
              echo "<th>".$hours_worked."</th>";
              echo "<th>&#x24; ".$shift_cost."</th>";
              echo "<th><a href='functions.php?did=".$row['id']."'>Delete</a></th>";
                echo "<th><a href='edit_shift.php?eid=".$row['id']."'>Edit</a></th>";
              echo "</tr>
                </tbody>";

            }
          }else {
            echo "  <tbody>
              <tr>";
          echo "<center>
          Empty Record
          </center>";

          echo "</tr>
            </tbody>";
          }
      }
     ?>





<br><br>



<form class="" action="functions.php" method="post">
  <tbody>
  <tr>
  <td><?php echo $row['name']." ".$_SESSION['name']; ?></td>
  <td><input type="date" name="shift" min="2019-01-01" required></td>
  <td><input type="time" name="start"onchange="onTimeChange()" id="timeInput" required/>
</td>
<td><input type="time" name="end" onchange="onTimeChange()" id="timeInput" required/>
</td>
<td><input type="number"  name="break" placeholder="" required></td>

<td><input type="submit" name="createShift" value="Create" required/></td>
<td></td>
  </tr>

  </tbody>
</form>
</table>
  </body>
</html>
<script>
var inputEle = document.getElementById('timeInput');


function onTimeChange() {
var timeSplit = inputEle.value.split(':'),
  hours,
  minutes,
  meridian;
hours = timeSplit[0];
minutes = timeSplit[1];
if (hours > 12) {
  meridian = 'PM';
  hours -= 12;
} else if (hours < 12) {
  meridian = 'AM';
  if (hours == 0) {
    hours = 12;
  }
} else {
  meridian = 'PM';
}
//alert(hours + ':' + minutes + ' ' + meridian);
}
</script>
