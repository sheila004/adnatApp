<?php
session_start();

include 'config.php';
class dbconn{


         var $conn = '';


         function getConnection($dbhost,$dbuser,$dbpass,$dbname){
           $this->conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

           if(! $this->conn ) {
              die('Could not connect: ' . mysql_error());

           }
           //echo 'Connected successfully<br />';


           return $this->conn;
         }

}
$dbconn = new  SimpleXMLElement($xmlstr);
$dbhost = $dbconn->dbconnects[0]->dbhost;
$dbuser = $dbconn->dbconnects[0]->dbuser;
$dbpass = $dbconn->dbconnects[0]->dbpass;
$dbname = $dbconn->dbconnects[0]->dbname;
$conn = new dbconn();
$con=$conn->getConnection($dbhost,$dbuser,$dbpass,$dbname);

//SQL injection
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data, ENT_QUOTES);
  return $data;
}
 ?>
