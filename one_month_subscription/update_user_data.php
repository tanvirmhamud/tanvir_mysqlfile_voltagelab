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
                $email = isset($_GET['email']) ? $_GET['email'] : die();
                $types = isset($_GET['types']) ? $_GET['types'] : die();
                $sql = "SELECT * FROM subscription_one_month WHERE email='$email'AND types='$types'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $checkrows=mysqli_num_rows($result);
                    if ($checkrows > 0) {
                        if ($jsondata['status'] == null) {
                            
                        $remaining = $jsondata['remaining'];
                        $sqldata = "UPDATE subscription_one_month SET remaining='$remaining' WHERE email='$email' AND types='$types'";
                        if (mysqli_query($conn, $sqldata)) {
                            echo '{"result" : "success"}';
                        }else{
                            header('X-PHP-Response-Code: 404', true, 404);
                            echo '{"result" : "sql error"}';
                        }
                        }else{
                            $status = $jsondata['status'];
                            $remaining = $jsondata['remaining'];
                            $sqldata = "UPDATE subscription_one_month SET status='$status',remaining='$remaining' WHERE email='$email' AND types='$types'";
                          if (mysqli_query($conn, $sqldata)) {
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
