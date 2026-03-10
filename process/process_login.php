<?php

session_start();
include("../config/config.php");

$email = $_POST["email"];
$password = $_POST["password"];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){

    $user = mysqli_fetch_assoc($result);

    if(password_verify($password, $user["password"])){

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];
        $_SESSION["role"] = $user["role"];

        if($user["role"] == "admin"){
            header("Location: ../admin/dashboard.php");
        }else{
            header("Location: ../index.php");
        }

        exit();

    }else{

        header("Location: ../login.php?error=password");
        exit();

    }

}else{

    header("Location: ../login.php?error=email");
    exit();

}

?>