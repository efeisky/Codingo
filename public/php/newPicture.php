<?php
require_once "conn.php";
session_start();
$session_email = $_SESSION["email"];
$check = $db->query("SELECT * FROM user_table WHERE email = '{$_SESSION["email"]}'")->fetch(PDO::FETCH_ASSOC);
$download_file = "../img/profilePicture/";

if($check["profile_picture"]){
    unlink($download_file.$check["profile_picture"]);
}

$tmp_name = $_FILES["file"]["tmp_name"];
    
$name = $_FILES['file']['name'];
$sub = substr($name,-4,4);
$randomNumber1 = rand(10000,50000);
$randomNumber2 = rand(10000,50000);
$pictureName = time().$randomNumber1.$randomNumber2.$sub;
    
    
move_uploaded_file($tmp_name,"$download_file/$pictureName");

$update = $db->prepare("UPDATE user_table SET
profile_picture = '$pictureName' WHERE email='$session_email'
");

$result = $update->execute();

?>