<?php 
require_once "conn.php";
session_start();
$session_email = $_SESSION["email"];
$result = $db->query("SELECT * FROM user_table WHERE email='{$session_email}' ")->fetch(PDO::FETCH_ASSOC);
$user_picture = $result["profile_picture"];



if(isset($_GET["delete"])){
    $pictureSituation = "delete";
    $update = $db->prepare("UPDATE user_table SET
                    profile_picture = '' WHERE email='$session_email'
    ");

    $result = $update->execute();
    $value = strpos($user_picture,"https");
    if($value === false){
        $pictureSrc = "../img/profilePicture/".$user_picture;
        unlink($pictureSrc);
    }else{
        $pictureSrc = $user_picture;
    }

    header("Location: setting.php");
}
?>