<?php

$servername = "localhost";
$dbname = "tanvir";
$dbuser = "root";
$dbpassword ="";

$conn = new mysqli($servername, $dbuser, $dbpassword, $dbname);
$response = array();
  if($conn){
   $sql = "SELECT * FROM user_information";
   $result = mysqli_query($conn, $sql);

   if($result){
     header("Content-type : JSON");

    $i= 0;
     while($row = mysqli_fetch_assoc($result)){
           $response[$i]['id'] = $row['id'];
           $response[$i]['full_name'] = $row['full_name'];
           $response[$i]['email'] = $row['email'];
           $response[$i]['passwords'] = $row['passwords'];
           $response[$i]['photo_url'] = $row['photo_url'];
           $response[$i]['account_id'] = $row['account_id'];
           $response[$i]['types'] = $row['types'];


         $i++;
     }
     echo json_encode($response, JSON_PRETTY_PRINT);

   }


  } 








//   if(isset($_GET['api_token'])){
//     $response = array();
//     if ($conn) {
//         $api_token = isset($_GET['api_token']) ? $_GET['api_token'] : die();
//         $sqlapi = "SELECT * FROM api_token WHERE token='$api_token'";
//         $chack = mysqli_query($conn, $sqlapi);
//         $chackrow = mysqli_num_rows($chack);
//         if ($chackrow > 0) {
//           $sql = "SELECT * FROM user_information";
//           $result = mysqli_query($conn, $sql);
       
//           if($result){
//             header("Content-type : JSON");
       
//            $i= 0;
//             while($row = mysqli_fetch_assoc($result)){
//                   $response[$i]['id'] = $row['id'];
//                   $response[$i]['full_name'] = $row['full_name'];
//                   $response[$i]['email'] = $row['email'];
//                   $response[$i]['passwords'] = $row['passwords'];
//                   $response[$i]['photo_url'] = $row['photo_url'];
//                   $response[$i]['account_id'] = $row['account_id'];
//                   $response[$i]['types'] = $row['types'];
       
       
//                 $i++;
//             }
//             echo json_encode($response, JSON_PRETTY_PRINT);
       
//           }
//         }else{
//           header('X-PHP-Response-Code: 404', true, 404);
//           echo "User Not found"; 
//         }
//     }else{
//         echo "databse not connect";
//     }
  

//  }else{
//      echo "invelid api token";
//  }



?>