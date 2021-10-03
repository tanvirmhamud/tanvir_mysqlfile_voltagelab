<?php
$servername = "localhost";
$dbname = "tanvir";
$dbuser = "root";
$dbpassword ="";

$conn = new mysqli($servername, $dbuser, $dbpassword, $dbname);
  if ($conn -> connect_error) {
    echo "error";
  }else{
    echo "success";
}
