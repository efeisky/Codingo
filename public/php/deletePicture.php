<?php 
require_once "conn.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $check = $db->query("SELECT * FROM user_table WHERE email = '{$_POST["ourEmail"]}'")->fetch(PDO::FETCH_ASSOC);
    $download_file = "../img/profilePicture/";
    unlink($download_file.$check["profile_picture"]);

    $emailValue = $_POST["ourEmail"];
    $update = $db->prepare("UPDATE user_table SET
        profile_picture = '' WHERE email='$emailValue'
    ");
    $check = $update->execute();
}

?>