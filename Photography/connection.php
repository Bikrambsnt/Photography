<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "photography";
    $conn = new mysqli($servername, $username, $password, $db_name);
    if($conn->connect_error){
        die("Connect".$conn->connect_error);
    }
    echo "";
?>