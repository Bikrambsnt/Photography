<?php
include("connection.php");
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $first_name = $_POST["fullName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    

 $email_check_sql = "SELECT * FROM login WHERE email = '$email'";
    $result = $conn->query($email_check_sql);

    if ($result->num_rows > 0) {
        echo "Registration Failed: Email already exists. Choose a different email.";
    } else {
     
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO login (name ,email ,password)
                VALUES ('$first_name', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration Successful";
        } else {
            echo "Registration Failed: " . $sql . " " . $conn->error;
        }
    }
}

$conn->close();
?>
