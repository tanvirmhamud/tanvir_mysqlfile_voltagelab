<?php

// $servername = "localhost";
// $dbname = "tanvir";
// $dbuser = "root";
// $dbpassword ="";




$servername = "db5005028278.hosting-data.io";
$dbname = "dbs4203476";
$dbuser = "dbu2425027";
$dbpassword ="il0vey0uma@@@";

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
            $bkash_phone_number = $jsondata['bkash_phone_number'];
            $bkash_transaction_id = $jsondata['bkash_transaction_id'];
            $rocket_phone_number = $jsondata['rocket_phone_number'];
            $rocket_transaction_id = $jsondata['rocket_transaction_id'];
            $nagad_phone_number = $jsondata['nagad_phone_number'];
            $nagad_transaction_id = $jsondata['nagad_transaction_id'];
            $start_date = $jsondata['start_date'];
            $end_date = $jsondata['end_date'];
            $status = $jsondata['status'];
            $types = $jsondata['types'];
            $subscription_pack = $jsondata['subscription_pack'];
            $remaining = $jsondata['remaining']

            $check=mysqli_query($conn,"select * from subscription_one_month where email='$email'");
            $checkrows=mysqli_num_rows($check);

            if($checkrows > 0){
                header('X-PHP-Response-Code: 404', true, 404);
                echo "customer exists"; 
            }else{
               
                $sql1 = "INSERT INTO subscription_one_month(fullname, email, bkash_phone_number, bkash_transaction_id, rocket_phone_number, rocket_transaction_id, nagad_phone_number, nagad_transaction_id, start_date, end_date, status, types, subscription_pack, remaining) VALUES ('$fullname','$email','$bkash_phone_number','$bkash_transaction_id','$rocket_phone_number','$rocket_transaction_id','$nagad_phone_number','$nagad_transaction_id','$start_date','$end_date','$status','$types','$subscription_pack','$remaining')";
        
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