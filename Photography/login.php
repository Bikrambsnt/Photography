<?php
include("connection.php");
if(isset($_POST['submit'])){
$username =$_POST['email'];
$password =$_POST['password'];

$sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if($count == 1){
    header("Location:upload.php");
}
else{
    echo '<script>
    window.location.href = "login.php";
    alert("login failed.");

    </script>';
}
}


?>
