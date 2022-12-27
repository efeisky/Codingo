<?php
require_once "conn.php";
session_start();
$session_email = $_SESSION["email"];
if($session_email){

}else{
    header("Location: homepage.html");
}
$result = $db->query("SELECT * FROM user_table WHERE email='{$session_email}' ")->fetch(PDO::FETCH_ASSOC);

$user_name = $result["name"];
$user_email = $result["email"];
$user_pass = $result["password"];
$user_picture = $result["profile_picture"];
$user_province = $result["province"];
$education_level = $result["education_level"];
$user_school = $result["school"];
$pyLevel = $result["pyLevel"];
$signType = $result["signType"];
$pictureSituation = "";
$xes = null;

if($pyLevel != ""){
    
}else{
    $pyLevel = null;
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $update = $db->prepare("UPDATE user_table SET
                    name=:user_name,
                    password=:user_pass,
                    province=:user_province,
                    education_level =:education_level,
                    school=:user_school,
                    pyLevel =:pyLevel WHERE email=:last_email
    ");

    $personal_data = array(
        'user_name' => $_POST["name-surname"],
        'user_pass' => $_POST["personalPass"],
        'user_province' => $_POST["province"],
        'education_level' => $_POST["education-level"],
        'user_school' => $_POST["school"],
        'pyLevel' => $_POST["python"],
        'last_email' => $user_email
    );

    $result = $update->execute($personal_data);

    
    
}   


if($user_picture == ""){
    $pictureSrc = "../img/unknown.png";
}else{
    $value = strpos($user_picture,"https");

    if($value === false){
        $pictureSrc = "../img/profilePicture/".$user_picture;
    }else{
        $pictureSrc = $user_picture;
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

    <title>Ayarlar ~ Codingo</title>
    
    <!--Link Tag-->
</head>
<body>
    <form method="GET" action="deletePicture.php" enctype="multipart/form-data">
        <button name="delete" id="delete">Profil fotoğrafı sil</button>
    </form>
    <div class="myPicture">
            <img src="<?php echo $pictureSrc?>" alt="Profil Resmi Görseli" id="picture" name="picture">
    
    </div>
    <a href="newPicture.php">Profil resmi değiştir</a>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
        <input type="text" placeholder="Adınızı ve soyadınızı giriniz" id="name-surname" name="name-surname" value = "<?php echo $user_name?>">
        <div class="emailField" id="emailField">
            <input type="email" placeholder="E - Posta adresinizi giriniz" id="personalEmail" name="personalEmail" value = "<?php echo $user_email?>">
        </div>
        <input type="password" placeholder="Şifrenizi giriniz" id="personalPass" name="personalPass" value = "<?php echo $user_pass?>">
        <select name="education-level" id="education-level" onchange="getEducation()" value = "<?php echo $education_level?>">
            <option value="primary-school">İlkokul</option>
            <option value="secondary-school">Ortaokul</option>
            <option value="high-school">Lise</option>
            <option value="graduate">Mezun</option>
            
        </select>

        <select name="province" id="province" onchange="getProvince()" value = "<?php echo $user_province?>"></select>

        <div class="schoolSelect">
            <select name="school" id="school" onchange="schoolSelect()">
                <option value = "<?php echo $user_school?>"><?php echo $user_school?></option>
            </select>
        </div>
        <div class="py-level" name="py-level">
            <input type="checkbox" name="python" value="bad" id="python">Kötü
            <input type="checkbox" name="python" value="medium" id="python">Orta
            <input type="checkbox" name="python" value="high" id="python">İyi
        </div>

        <button type="submit">Bilgileri Değiştir</button>
    </form>
    <a href="order_list.php">Sıralama</a>
    <a href="setting.php">Ayarlar</a>
    <a href="nots.php">Notlar</a>
    <a href="personal_home.php">Anasayfa</a>
    <form method="POST" action="signOut.php">
        <button name="signOut">Çıkış Yap</button>
    </form>

    <script src="../js/json.js"></script>
    <script src="../js/jquery-3.6.0.slim.min.js"></script>
    <script>
        $(document).on('click', 'input[type="checkbox"]', function(){
    
        $("input[type='checkbox']").not(this).prop('checked', false)
    });
    </script>

    <script>
        const py_levels = document.querySelectorAll("#python")
        const py_value = `<?php echo $pyLevel?>`

        py_levels.forEach(py_element => {
            let value = py_element.value
            
            if(py_value == value){
                py_element.checked = true
            }else{
                return
            }
        });
    </script>
    <script>
        const signType = "<?php echo $signType?>";
        if (signType == "Email-Password") {
            
        } else {
            document.querySelector("#personalPass").style.display = "none"
        }   
    </script>
    <script>
        picture_situation = "<?php echo $pictureSituation?>"
        if (picture_situation == "replace"){
        }else if(picture_situation == "delete"){
            document.querySelector("#picture").setAttribute("src","../img/unknown.png")
        }else{

        }
    </script>
    <script>
        picture_value = '<?php echo $user_picture?>'
        if(picture_value == ""){
            
            document.querySelector("#delete").style.display = "none"
        }else{
            
        }
    </script>
    
</body>
</html>