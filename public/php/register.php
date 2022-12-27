<?php
require_once("conn.php");
include("reCaptcha.php");

require_once '../../vendor/autoload.php';
require_once 'config.php';

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name-surname"];
    $email = $_POST["personalEmail"];
    $pass = $_POST["personalPass"];
    $education_level = $_POST["education-level"];
    $province = $_POST["province"];
    $school = $_POST["school"];
    $pyLevel = $_POST["python"];
    $lessonNo = 1;
    $score = 0;
    $ppPath = "";
    $signType = "Email-Password";
    $date = date("d/m/Y");

    if($result == true)
    {

        $check = $db->query("SELECT * FROM user_table WHERE email = '{$email}'")->fetch(PDO::FETCH_ASSOC);
        if ( $check ){
            echo "Zaten böyle bir kullanıcı var";
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

            header("Location: personal_home.php");
            }
    }
    else
    {
        return;
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

    <title>Codingo ~ Kayıt Ol</title>
    
    <!--Link Tag-->
    
    <link rel="stylesheet" href="">
</head>
<body>
    <a href="login.php">Zaten üye misiniz hemen giriş yapın</a>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
        <input type="text" placeholder="Adınızı ve soyadınızı giriniz" id="name-surname" name="name-surname" >
        <input type="email" placeholder="E - Posta adresinizi giriniz" id="personalEmail" name="personalEmail" >
        <input type="password" placeholder="Şifrenizi giriniz" id="personalPass" name="personalPass" >
        <select name="education-level" id="education-level" onchange="getEducation()" >
            <option value="primary-school">İlkokul</option>
            <option value="secondary-school">Ortaokul</option>
            <option value="high-school">Lise</option>
            <option value="graduate">Mezun</option>
            
        </select>

        <select name="province" id="province" onchange="getProvince()" ></select>

        <div class="schoolSelect">
            <select name="school" id="school" >
            
            </select>
        </div>
        <div class="py-level">
            <input type="checkbox" name="python" value="bad">Kötü
            <input type="checkbox" name="python" value="medium">Orta
            <input type="checkbox" name="python" value="high">İyi
        </div>
        <div class="g-recaptcha" data-sitekey="6LdliGMjAAAAAA0GgvCDe_o0xiDWKhjYaYsTGyLP"></div>
        <button type="submit">Kayıt Ol</button>
        
    </form>
    
    <a href="<?php echo $client->createAuthUrl()?>"><button>Google İle Kayıt Ol</button></a>
    
    
    <script src="../js/json.js"></script>
    <script src="../js/jquery-3.6.0.slim.min.js"></script>
    <script>
        $(document).on('click', 'input[type="checkbox"]', function(){
    
        $("input[type='checkbox']").not(this).prop('checked', false)
    });
    </script>

    <script src="https://www.google.com/recaptcha/api.js?hl=tr" async defer></script>
</body>
</html>