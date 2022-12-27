<?php
require_once("conn.php");
require_once 'config.php';

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
  
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();

}

    $email = $google_account_info["email"];
    $profile_picture = $google_account_info["picture"];
    $name = $google_account_info["givenName"];

    $education_level = "";
    $pass = "";
    $province = "";
    $school = "";
    $pyLevel = "";
    $lessonNo = 1;
    $score = 0;
    $signType = "Google";
    $date = date("d/m/Y");

    session_start();

    $check = $db->query("SELECT * FROM user_table WHERE email = '{$email}' AND signType = '{$signType}'")->fetch(PDO::FETCH_ASSOC);
        if ( $check ){
            $_SESSION["email"] = $email;
            $_SESSION["profile_picture"] = $profile_picture;
            $_SESSION["name"] = $name;
            $_SESSION["signType"] = "Google";

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
            "profile_picture" => $profile_picture,
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
        $_SESSION["profile_picture"] = $profile_picture;
        $_SESSION["name"] = $name;
        $_SESSION["signType"] = "Google";
        }
    header("Location: personal_home.php");
?>