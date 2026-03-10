<?php
include("../config/config.php");
$name = $_POST["name"];
$description = $_POST["description"];
$category = $_POST["category"];
$price = $_POST["price"];
$discount_price = $_POST["discount_price"];

$quantity = $_POST["quantity"];
$image = $_FILES["image"]["name"];
$tmp = $_FILES["image"]["tmp_name"];

$new_image = time() . "_" . $image;


$upload_path = "../uploads/" . $new_image;

move_uploaded_file($tmp, $upload_path);
$sql = "INSERT INTO products 
(name, description, category, price, discount_price, quantity, image) 
VALUES 
('$name','$description','$category','$price','$discount_price','$quantity','$new_image')";

mysqli_query($conn,$sql);
header("Location: ../admin/dashboard.php");
exit();

?>