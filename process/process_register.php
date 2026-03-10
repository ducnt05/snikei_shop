<?php
include("../config/config.php");

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];


$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$check = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn,$check);

if(mysqli_num_rows($result) > 0){

    header("Location: ../register.php?error=email_exist");
    exit();

}else{

    $sql = "INSERT INTO users(name,email,password)
            VALUES('$name','$email','$hashed_password')";

    mysqli_query($conn,$sql);

    header("Location: ../login.php");
    exit();

}
?>