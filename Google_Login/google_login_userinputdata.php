<?php

$servername = "localhost";
$dbname = "tanvir";
$dbuser = "root";
$dbpassword ="";

$conn = new mysqli($servername, $dbuser, $dbpassword, $dbname);

$jsondata = json_decode(file_get_contents('php://input'),true);


if(isset($_GET['api_token'])){
    if ($conn) {
        $api_token = isset($_GET['api_token']) ? $_GET['api_token'] : die();
        $sqlapi = "SELECT * FROM api_token WHERE token='$api_token'";
        $chack = mysqli_query($conn, $sqlapi);
        $chackrow = mysqli_num_rows($chack);
        if ($chackrow > 0) {
          
        $full_name = $jsondata['full_name'];
        $email = $jsondata['email'];
        $photo_url = $jsondata['photo_url'];
        $account_id = $jsondata['account_id'];
        $type = $jsondata['type'];

        $checkfrom=mysqli_query($conn,"select * from fromlogininformation where email='$email'");
        $checkgoogle = mysqli_query($conn,"select * from google_login where email='$email'");
        $checkfromrows=mysqli_num_rows($checkfrom);
        $checkgooglerow = mysqli_num_rows($checkgoogle);

        if($checkfromrows > 0 || $checkgooglerow > 0){
           header('X-PHP-Response-Code: 404', true, 404);
           echo '{"result" : "This email allready use"}';
        }else{
       
        $sql1 = "INSERT INTO google_login (full_name, email, photo_url, account_id, type) VALUES ('$full_name','$email','$photo_url','$account_id','$type')";

        if (mysqli_query($conn, $sql1)) {
            
            echo '{"result" : "success"}';
        }else{
            header('X-PHP-Response-Code: 404', true, 404);
            echo '{"result" : "sql error"}';
        }
    }
        }else{
          header('X-PHP-Response-Code: 404', true, 404);
          echo "User Not found"; 
        }
    }else{
        echo "databse not connect";
    }
  

 }else{
     echo "invelid api token";
 }



?>