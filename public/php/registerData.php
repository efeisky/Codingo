<?php

require_once("conn.php");

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $pass = $_POST["password"];
        $education_level = $_POST["eduLevel"];
        $province = $_POST["Province"];
        $school = $_POST["School"];
        $pyLevel = $_POST["pyLevel"];
        $lessonNo = 1;
        $score = 0;
        $ppPath = "";
        $signType = "Email-Password";
        $date = date("d/m/Y");

        $check = $db->query("SELECT * FROM user_table WHERE email = '{$email}'")->fetch(PDO::FETCH_ASSOC);
        if ( $check ){
            echo false;
        }else{
            
            $insert = $db -> prepare("INSERT INTO user_table SET 
                    signType =:signType,
                    name =:name,
                    email =:email,
                    password =:password,
                    profile_picture =:profile_picture,
                    score =:score,
                    education_level =:education_level,
                    school =:school,
                    province =:province,
                    pyLevel =:pyLevel,
                    lessonNo =:lessonNo,
                    date =:date
            ");

            $user_data = array(
                "signType" => $signType,
                "name" => $name,
                "email" => $email,
                "password" => $pass,
                "profile_picture" => $ppPath,
                "score" => $score,
                "education_level" => $education_level,
                "school" => $school,
                "province" => $province,
                "pyLevel" => $pyLevel,
                "lessonNo" => $lessonNo,
                "date" => $date
            );

            $result = $insert -> execute($user_data);

            $_SESSION["email"] = $email;
            $_SESSION["name"] = $name;
            $_SESSION["signType"] = $signType;
            echo true;
    }
}
?>