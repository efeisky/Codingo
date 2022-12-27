<?php
require_once("conn.php");

if($_POST){
    $score = $_POST["score"];
    $email = $_POST["email"];

    $check = $db->query("SELECT * FROM user_table WHERE email = '$email'")->fetch(PDO::FETCH_ASSOC);
    $last_score = $check["score"];
    $lessonNo = $check["pylesson"];

    $newLesson = $lessonNo+1;
    $new_score = $score+$last_score;

    $update = $db->prepare("UPDATE user_table SET
    score = '$new_score', 
    pylesson = '$newLesson' WHERE email='$email'
    ");

    $result = $update->execute();
}

?>