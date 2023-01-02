<?php 
require_once "conn.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $check = $db->query("SELECT * FROM user_table WHERE email = '{$_POST["ourEmail"]}'")->fetch(PDO::FETCH_ASSOC);
    $emailValue = $_POST["ourEmail"];
    $passValue = $_POST["newPass"];
    $update = $db->prepare("UPDATE user_table SET
        password= '$passValue' WHERE email='$emailValue'
    ");
    $check = $update->execute();
}

?>