<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$servername = "localhost";
$dbname = "tanvir";
$dbuser = "root";
$dbpassword ="";

$conn = new mysqli($servername, $dbuser, $dbpassword, $dbname);



 if(isset($_GET['api_token'])){
    if ($conn) {
        $email = isset($_GET['email']) ? $_GET['email'] : die();
        $passwords = isset($_GET['passwords']) ? $_GET['passwords'] : die();
        $api_token = isset($_GET['api_token']) ? $_GET['api_token'] : die();
        $sqlapi = "SELECT * FROM api_token WHERE token='$api_token'";
        $chack = mysqli_query($conn, $sqlapi);
        $chackrow = mysqli_num_rows($chack);
        if ($chackrow > 0) {
            $sql = "SELECT * FROM fromlogininformation WHERE email='$email'AND passwords='$passwords'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $checkrows=mysqli_num_rows($result);
                if ($checkrows > 0) {
                    $row = mysqli_fetch_assoc($result);
                    echo json_encode($row, JSON_PRETTY_PRINT);
                }else{
                    header('X-PHP-Response-Code: 404', true, 404);
                    echo '{"result" : "user not found"}';
                }  
            }
        }else{
          header('X-PHP-Response-Code: 404', true, 404);
          echo '{"result" : "user not found"}'; 
        }
    }else{
        echo '{"result" : "database not connect"}';
    }
  

 }else{
    echo '{"result" : "invalid api token"}';
 }

  


?>