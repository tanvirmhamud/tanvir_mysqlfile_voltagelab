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
            $fullname = $jsondata['fullname'];
            $email = $jsondata['email'];
            $phone_num = $jsondata['phone_num'];
            $transactionid = $jsondata['transactionid'];
            $start_date = $jsondata['start_date'];
            $end_date = $jsondata['end_date'];
            $status = $jsondata['status'];
            $remaining = $jsondata['remaining'];
            $subscription_pack = $jsondata['subscription_pack'];
            $payment_type = $jsondata['payment_type'];
            $login_type = $jsondata['login_type'];

            $check=mysqli_query($conn,"select * from subscription_package where email='$email'");
            $checkrows=mysqli_num_rows($check);

            if($checkrows > 0){
                $sql2 = "UPDATE subscription_package SET phone_num='$phone_num', transactionid= '$transactionid', start_date ='$start_date', end_date= '$end_date', status = '$status', remaining ='$remaining', subscription_pack ='$subscription_pack', payment_type= '$payment_type', login_type='$login_type' WHERE email='$email'";
                
                if (mysqli_query($conn, $sql2)) {
                    echo '{"result" : "Update successfull"}';
                }else{
                    header('X-PHP-Response-Code: 404', true, 404);
                    echo '{"result" : "sql error"}';
                }
            }else{
               
                $sql1 = "INSERT INTO subscription_package(fullname, email, phone_num, transactionid, start_date, end_date, status, remaining, subscription_pack, payment_type, login_type) VALUES ('$fullname','$email','$phone_num','$transactionid','$start_date','$end_date','$status','$remaining','$subscription_pack','$payment_type','$login_type')";
        
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