<?php
require_once("conn.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $update = $db->prepare("UPDATE user_table SET
        name=:user_name,
        province=:user_province,
        education_level =:education_level,
        school=:user_school WHERE email=:email
    ");

    $personal_data = array(
        'user_name' => $_POST["nameSurname"],
        'user_province' => $_POST["ourProvince"],
        'education_level' => $_POST["eduLevel"],
        'user_school' => $_POST["ourSchool"],
        'email' => $_POST["ourEmail"]
    );

    $check = $update->execute($personal_data);
    
}   

?>