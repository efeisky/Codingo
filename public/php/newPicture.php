<?php
require_once "conn.php";
session_start();
$session_email = $_SESSION["email"];

if(isset($_POST["replace"])){
    $download_file = "../img/profilePicture/";
    $tmp_name = $_FILES["file"]["tmp_name"];
    
    $name = $_FILES['file']['name'];
    $size = $_FILES["file"]["size"];
    $type = $_FILES["file"]["type"];
    $sub = substr($name,-4,4);
    $randomNumber1 = rand(10000,50000);
    $randomNumber2 = rand(10000,50000);
    $pictureName = $randomNumber1.$randomNumber2.$sub;
    
    if(strlen($name) == 0){
        echo "Bir dosya seçiniz";
        exit();
    }
    if($size > (1024*1024*6)){
        echo "Dosya boyutu çok fazla";
        exit();
    }
    if($type != "image/jpeg" && $type != "image/png" && $sub != ".jpg"){
        echo "yalnızca jpeg veya png formatında olabilir";
        exit();
    }
    move_uploaded_file($tmp_name,"$download_file/$pictureName");

    $update = $db->prepare("UPDATE user_table SET
    profile_picture = '$pictureName' WHERE email='$session_email'
    ");

    $result = $update->execute();

    header("Location: setting.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" enctype="multipart/form-data">
        <input type="file" name="file" id="fileUpload" accept="image/png, image/jpeg">
        <button name="replace" id="replace">Profil fotoğrafı değiştir</button>
    </form>

</body>
</html>