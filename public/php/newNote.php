<?php
require_once("conn.php");

if($_POST){
    $note = $_POST["note"];
    $email = $_POST["email"];
    $date = $_POST["date"];;

    $insert = $db -> prepare("INSERT INTO nots SET 
                    not_user=:not_user,
                    not_subject=:not_subject,
                    not_date=:not_date
    ");

    $data = array(
        "not_user" => $email,
        "not_subject" =>  $note,
        "not_date" => $date,
    );

    $insert -> execute($data);

    $result["hata"] = "okey";

    }

?>