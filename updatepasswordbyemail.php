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

// $email = isset($_GET['email']) ? $_GET['email'] : die();
// $types = isset($_GET['types']) ? $_GET['types'] : die();
$jsondata = json_decode(file_get_contents('php://input'),true);

//  if ($conn) {


    
//     $sql = "SELECT * FROM user_information WHERE email='$email'AND types='$types'";
//     $result = mysqli_query($conn, $sql);
//     if ($result) {
//         $checkrows=mysqli_num_rows($result);
//         if ($checkrows > 0) {
//             $passwords = $jsondata['passwords'];
//             $sqldata = "UPDATE user_information SET passwords='$passwords' WHERE email='$email' AND types='$types'";
//             if (mysqli_query($conn, $sqldata)) {
//                 echo '{"result" : "success"}';
//             }else{
//                 header('X-PHP-Response-Code: 404', true, 404);
//                 echo '{"result" : "sql error"}';
//             }
            
//         }else{
//             header('X-PHP-Response-Code: 404', true, 404);
//             echo "User Not found"; 
//         }  
//     }
//  }







 if(isset($_GET['api_token'])){
    if ($conn) {
        
        $api_token = isset($_GET['api_token']) ? $_GET['api_token'] : die();
        $sqlapi = "SELECT * FROM api_token WHERE token='$api_token'";
        $chack = mysqli_query($conn, $sqlapi);
        $apichackrow = mysqli_num_rows($chack);
        if ($apichackrow > 0) {
            $email = isset($_GET['email']) ? $_GET['email'] : die();
            $types = isset($_GET['types']) ? $_GET['types'] : die();
            $sql = "SELECT * FROM user_information WHERE email='$email'AND types='$types'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $checkrows=mysqli_num_rows($result);
                if ($checkrows > 0) {
                    $passwords = $jsondata['passwords'];
                    $sqldata = "UPDATE user_information SET passwords='$passwords' WHERE email='$email' AND types='$types'";
                    if (mysqli_query($conn, $sqldata)) {
                        echo '{"result" : "success"}';
                    }else{
                        header('X-PHP-Response-Code: 404', true, 404);
                        echo '{"result" : "sql error"}';
                    }
                    
                }else{
                    header('X-PHP-Response-Code: 404', true, 404);
                    echo "User Not found"; 
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