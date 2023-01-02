<?php
require_once("conn.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = $_POST["ourEmail"];
    $password = $_POST["ourPassword"];

    $check = $db->query("SELECT * FROM user_table WHERE email = '{$email}' AND password = '{$password}'")->fetch(PDO::FETCH_ASSOC);
    
    session_start();
    if($check){
        $_SESSION["email"] = $email;
        $_SESSION["signType"] = "Email-Password";
        echo true;
    }else{
        echo false;
    }
    
        
}

?>