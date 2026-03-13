<?php 
include("../config/config.php");
$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];
$sql = "INSERT INTO contacts(name,email,message) VALUES ('$name','$email','$message')";
$result = mysqli_query($conn, $sql);


?>