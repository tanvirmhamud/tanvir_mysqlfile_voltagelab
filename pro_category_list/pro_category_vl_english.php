<?php

$servername = "localhost";
$dbname = "tanvir";
$dbuser = "root";
$dbpassword ="";

$conn = new mysqli($servername, $dbuser, $dbpassword, $dbname);

    if(isset($_GET['api_token'])){
        $response = array();
        if ($conn) {
            $api_token = isset($_GET['api_token']) ? $_GET['api_token'] : die();
            $sqlapi = "SELECT * FROM api_token WHERE token='$api_token'";
            $chack = mysqli_query($conn, $sqlapi);
            $chackrow = mysqli_num_rows($chack);
            if ($chackrow > 0) {
                $sql = "SELECT * FROM pro_category_vl_english";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $checkrows=mysqli_num_rows($result);
                    if ($checkrows > 0) {
                        // header("Content-type: JSON");
                        // $row = mysqli_fetch_assoc($result);
                        // echo json_encode($row, JSON_PRETTY_PRINT);
                        $i = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $response[$i] = $row;
                            // $response[$i]["name"] = $row["name"];
                            // $response[$i]["age"] = $row["age"];
                            // $response[$i]["email"] = $row["email"];
                            // $response[$i]["details"] = $row["details"];
                            $i++;
                        }
                        echo json_encode($response,JSON_PRETTY_PRINT);


                    }else{
                        header('X-PHP-Response-Code: 404', true, 404);
                        echo '{"result" : "category not found"}';
                    }  
                }
            }else{
              header('X-PHP-Response-Code: 404', true, 404);
              echo '{"result" : "category not found"}'; 
            }
        }else{
            echo '{"result" : "database not connect"}';
        }
      
    
     }else{
        echo '{"result" : "inviled api"}';
     }
    



 



?>
