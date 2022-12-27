<?php
require_once("conn.php");
require_once '../../vendor/autoload.php';
require_once 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["personalEmail"];
    $password = $_POST["personalPass"];
    $signType = 'Email-Password';

    $check = $db->query("SELECT * FROM user_table WHERE email = '{$email}' AND password = '{$password}' AND signType = '{$signType}'")->fetch(PDO::FETCH_ASSOC);
    
    session_start();


    if($check){
        print_r($check);

        $_SESSION["email"] = $email;
        $_SESSION["signType"] = "Email-Password";
        header("Location: personal_home.php");
        
    }else{
        echo "böyle kullanıcı yok ne girişi git kayıt ol";
    }
    
        
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-language" content="tr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="Matematik ve Python Eğitimi" content="Matematik ve Python eğitimi yapmak için bir site">
    <meta name="Author" content="efeisky, isik.efe017@gmail.com"> 
    <meta name="Copyright" content="Sitenin tüm telif hakları efeisky'ye aittir.">
    <meta name="rating" content="adult-child" />
    <!--Title Tag-->

    <title>Codingo ~ Giriş Yap</title>
    
    <!--Link Tag-->
    
    <link rel="stylesheet" href="">
</head>
<body>
    <a href="register.php">Üye değil misiniz hemen üye olun</a>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
        <input type="email" placeholder="E - Posta adresinizi giriniz" id="personalEmail" name="personalEmail" >
        <input type="password" placeholder="Şifrenizi giriniz" id="personalPass" name="personalPass" >

        <button type="submit">Giriş Yap</button>
        
    </form>
    
    <a href="<?php echo $client->createAuthUrl()?>"><button>Google İle Giriş Yap</button></a>

</body>
</html>