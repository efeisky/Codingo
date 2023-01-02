<?php

require_once("conn.php");
session_start();

$loginType =  $_SESSION["signType"];
if($loginType){

}else{
    header("Location: homepage.html");
}

$check = $db->query("SELECT * FROM user_table WHERE email = '{$_SESSION["email"]}'")->fetch(PDO::FETCH_ASSOC);
$user_email = $check["email"];
$currentEducate = $check["education_level"];
$userArray = [];
if($currentEducate != "graduate")
    {   
        $mySchool = $check["school"];
        $header = $mySchool." "."Okulu Sıralamam";
        $school_order = $db ->query("SELECT * FROM user_table WHERE school = '{$mySchool}' ORDER BY score DESC");
        foreach ($school_order as $user) {
            $user_name = $user["name"];
            $user_picture = $user["profile_picture"];
            $user_score = $user["score"];
            $userEmailInfo = $user["email"];
            if ($user_picture == ""){
                $user_picture = "../img/unknown.png";
            }else{
                $user_picture = "../img/profilePicture/".$user_picture;
            }
            if($userEmailInfo === $user_email){
                $myInfo = true;
            }else{
                $myInfo = false;
            }
            $userDetail=array(
                "userName" => $user_name,
                "userPicture" => $user_picture,
                "userScore" => $user_score,
                "myInfo" =>  $myInfo
            );
            array_push($userArray,$userDetail);
        }
}else{
    $myProvince = $check["province"];
    $header = $myProvince." "."Sıralamam";
    $province_order = $db ->query("SELECT * FROM user_table WHERE province = '{$myProvince}' ORDER BY score DESC");
        foreach ($province_order as $user) {
            $user_name = $user["name"];
            $user_picture = $user["profile_picture"];
            $user_score = $user["score"];
            $userEmailInfo = $user["email"];
            if ($user_picture == ""){
                $user_picture = "../img/unknown.png";
            }else{
                $user_picture = "../img/profilePicture/".$user_picture;
            }
            if($userEmailInfo === $user_email){
                $myInfo = true;
            }else{
                $myInfo = false;
            }
            $userDetail=array(
                "userName" => $user_name,
                "userPicture" => $user_picture,
                "userScore" => $user_score,
                "myInfo" =>  $myInfo
            );
            array_push($userArray,$userDetail);
        }
}

$listUser = json_encode($userArray);
//-----------
//Header PHP
$current_Education = $check["education_level"];
$current_Score = $check["score"];
$user_picture = $check["profile_picture"];
$user_name = $check["name"];
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
//------------
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
    <link rel="shorcut icon" href="../img/Codingo_Title.png" />
    <title>Sıralamam ~ Codingo</title>
    
    <!--Link Tag-->
    <link rel="stylesheet" href="../css/reset.css" type="text/css">
    <link rel="stylesheet" href="../css/header.css" type="text/css">
    <link rel="stylesheet" href="../css/order.css" type="text/css">
</head>
<body>
    <div class="header">
            <div class="flexColumn">
                <div class="logo">
                    <img id="headerLogo" src="" alt="Eğitim Seviyesi">
                </div>
                <div class="score">
                    <div class="scoreAlign">
                        <img id="scoreSvg" src="../img/Score.svg" alt="Kullanıcı Skoru">
                        <div class="scoreText"></div>
                    </div>
                </div>
            </div>
            
            <div class="menu">
                <div class="picture">
                    <img id="userPicture" src="" alt="Kullanıcı Profil Fotoğrafı" title="Profil Fotoğrafı" width="50px" height="50px">
                    <span class="textPicture"></span>
                </div>
                <div class="menu-clickArea">
                    <div class="userName"></div>
                    <div class="arrow">
                        <svg  width="20" height="20" id="arrowSvg" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.72468 6.64137C3.94657 6.41948 4.29379 6.39931 4.53847 6.58086L4.60857 6.64137L9.99996 12.0325L15.3914 6.64137C15.6132 6.41948 15.9605 6.39931 16.2051 6.58086L16.2752 6.64137C16.4971 6.86326 16.5173 7.21048 16.3357 7.45516L16.2752 7.52525L10.4419 13.3586C10.22 13.5805 9.87279 13.6006 9.62812 13.4191L9.55802 13.3586L3.72468 7.52525C3.48061 7.28118 3.48061 6.88545 3.72468 6.64137Z" fill="black"/>
                        </svg>
                    </div>
                </div>
                <div class="header-menu">
                    <div class="headContent">
                        <svg id="closePopup" width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M30 15.0044C30 15.8454 29.487 16.5404 28.8214 16.6504L28.6364 16.6655L4.66545 16.6642L13.3254 27.1702C13.8591 27.8175 13.861 28.8692 13.3296 29.5193C12.8465 30.1103 12.089 30.1659 11.5543 29.6848L11.4011 29.5244L0.401115 16.1824C0.330767 16.0971 0.269667 16.0047 0.217808 15.9072C0.203161 15.8779 0.188251 15.8478 0.174116 15.8172C0.161114 15.7909 0.149366 15.7637 0.138283 15.7361C0.122889 15.696 0.107847 15.6546 0.0941906 15.6123C0.0830956 15.5797 0.0738297 15.548 0.0653801 15.516C0.0553322 15.4764 0.0455723 15.4342 0.0371742 15.3913C0.0309334 15.3613 0.0259895 15.3325 0.021677 15.3036C0.0156136 15.2606 0.0104523 15.216 0.00676918 15.171C0.00358772 15.1366 0.00167465 15.1025 0.000616074 15.0685C0.000343323 15.0478 0 15.0262 0 15.0044L0.000682831 14.9401C0.00172806 14.9075 0.0035553 14.8749 0.00616837 14.8424L0 15.0044C0 14.8996 0.0079689 14.797 0.0232124 14.6976C0.0267487 14.6738 0.0309601 14.6495 0.0356255 14.6252C0.045311 14.5752 0.0565052 14.527 0.0693951 14.4798C0.0757217 14.4564 0.0830917 14.4313 0.0909691 14.4064C0.106905 14.3565 0.124226 14.3088 0.14328 14.2624C0.152132 14.2406 0.162045 14.2177 0.172426 14.1951C0.189468 14.1582 0.207024 14.1232 0.225586 14.089C0.238684 14.0648 0.253187 14.0396 0.268332 14.0148L0.280132 13.9957C0.316872 13.9372 0.356728 13.8818 0.399399 13.8298L0.401035 13.8283L11.401 0.484097C11.9347 -0.16326 12.7981 -0.161083 13.3295 0.48896C13.8126 1.07991 13.8551 2.00285 13.4579 2.65214L13.3255 2.83811L4.66909 13.342L28.6364 13.3433C29.3895 13.3433 30 14.087 30 15.0044Z" fill="black"/>
                        </svg>
                        <div class="subject">Codingo</div>
                    </div>
                    <div class="mainPage link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.15722 20.7714V17.7047C9.1572 16.9246 9.79312 16.2908 10.581 16.2856H13.4671C14.2587 16.2856 14.9005 16.9209 14.9005 17.7047V17.7047V20.7809C14.9003 21.4432 15.4343 21.9845 16.103 22H18.0271C19.9451 22 21.5 20.4607 21.5 18.5618V18.5618V9.83784C21.4898 9.09083 21.1355 8.38935 20.538 7.93303L13.9577 2.6853C12.8049 1.77157 11.1662 1.77157 10.0134 2.6853L3.46203 7.94256C2.86226 8.39702 2.50739 9.09967 2.5 9.84736V18.5618C2.5 20.4607 4.05488 22 5.97291 22H7.89696C8.58235 22 9.13797 21.4499 9.13797 20.7714V20.7714" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <a href="personal_home.php">Anasayfa</a>
                    </div>
                    <div class="settingPage link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2673 2.00049C12.9833 2.00049 13.6793 2.29449 14.1783 2.80549C14.6763 3.31949 14.9513 4.02449 14.9303 4.73949C14.9323 4.90049 14.9853 5.08649 15.0813 5.24949C15.2403 5.51949 15.4913 5.70949 15.7893 5.78749C16.0873 5.86149 16.3993 5.82149 16.6643 5.66449C17.9443 4.93349 19.5733 5.37149 20.3043 6.64149L20.9273 7.72049C20.9433 7.74949 20.9573 7.77749 20.9693 7.80649C21.6313 9.05749 21.1893 10.6325 19.9593 11.3515C19.7803 11.4545 19.6353 11.5985 19.5353 11.7725C19.3803 12.0415 19.3373 12.3615 19.4153 12.6555C19.4953 12.9555 19.6863 13.2045 19.9553 13.3585C20.5623 13.7075 21.0153 14.2955 21.1963 14.9745C21.3773 15.6525 21.2783 16.3885 20.9253 16.9955L20.2613 18.1015C19.5303 19.3575 17.9013 19.7925 16.6343 19.0605C16.4653 18.9635 16.2703 18.9105 16.0763 18.9055H16.0703C15.7813 18.9055 15.4843 19.0285 15.2683 19.2435C15.0493 19.4625 14.9293 19.7545 14.9313 20.0645C14.9243 21.5335 13.7293 22.7215 12.2673 22.7215H11.0143C9.54532 22.7215 8.35032 21.5275 8.35032 20.0585C8.34832 19.8775 8.29632 19.6895 8.19932 19.5265C8.04232 19.2525 7.78832 19.0565 7.49532 18.9785C7.20432 18.9005 6.88532 18.9435 6.62332 19.0955C5.99532 19.4455 5.25632 19.5305 4.58032 19.3405C3.90532 19.1495 3.32232 18.6855 2.98032 18.0705L2.35532 16.9935C1.62432 15.7255 2.05932 14.1005 3.32532 13.3685C3.68432 13.1615 3.90732 12.7755 3.90732 12.3615C3.90732 11.9475 3.68432 11.5605 3.32532 11.3535C2.05832 10.6175 1.62432 8.98849 2.35432 7.72049L3.03232 6.60749C3.75332 5.35349 5.38332 4.91149 6.65432 5.64149C6.82732 5.74449 7.01532 5.79649 7.20632 5.79849C7.82932 5.79849 8.35032 5.28449 8.36032 4.65249C8.35632 3.95549 8.63132 3.28649 9.13232 2.78149C9.63532 2.27749 10.3033 2.00049 11.0143 2.00049H12.2673ZM12.2673 3.50049H11.0143C10.7043 3.50049 10.4143 3.62149 10.1953 3.83949C9.97732 4.05849 9.85832 4.34949 9.86032 4.65949C9.83932 6.12149 8.64432 7.29849 7.19732 7.29849C6.73332 7.29349 6.28632 7.16849 5.89832 6.93649C5.35332 6.62649 4.64132 6.81749 4.32232 7.37249L3.64532 8.48549C3.33532 9.02349 3.52532 9.73449 4.07732 10.0555C4.89632 10.5295 5.40732 11.4135 5.40732 12.3615C5.40732 13.3095 4.89632 14.1925 4.07532 14.6675C3.52632 14.9855 3.33632 15.6925 3.65432 16.2425L4.28532 17.3305C4.44132 17.6115 4.69632 17.8145 4.99132 17.8975C5.28532 17.9795 5.60932 17.9445 5.87932 17.7945C6.27632 17.5615 6.73832 17.4405 7.20232 17.4405C7.43132 17.4405 7.66032 17.4695 7.88432 17.5295C8.56032 17.7115 9.14732 18.1635 9.49532 18.7705C9.72132 19.1515 9.84632 19.5965 9.85032 20.0505C9.85032 20.7005 10.3723 21.2215 11.0143 21.2215H12.2673C12.9063 21.2215 13.4283 20.7035 13.4313 20.0645C13.4273 19.3585 13.7033 18.6875 14.2083 18.1825C14.7063 17.6845 15.4023 17.3855 16.0983 17.4055C16.5543 17.4165 16.9933 17.5395 17.3803 17.7595C17.9373 18.0785 18.6483 17.8885 18.9703 17.3385L19.6343 16.2315C19.7823 15.9765 19.8253 15.6565 19.7463 15.3615C19.6683 15.0665 19.4723 14.8105 19.2083 14.6595C18.5903 14.3035 18.1493 13.7295 17.9663 13.0415C17.7853 12.3665 17.8843 11.6295 18.2373 11.0225C18.4673 10.6225 18.8043 10.2855 19.2083 10.0535C19.7503 9.73649 19.9403 9.02749 19.6253 8.47549C19.6123 8.45349 19.6003 8.43049 19.5903 8.40649L19.0043 7.39049C18.6853 6.83549 17.9753 6.64449 17.4183 6.96149C16.8163 7.31749 16.1003 7.41949 15.4123 7.23849C14.7253 7.06049 14.1493 6.62549 13.7903 6.01149C13.5603 5.62749 13.4353 5.18049 13.4313 4.72549C13.4403 4.38349 13.3203 4.07649 13.1023 3.85149C12.8853 3.62749 12.5803 3.50049 12.2673 3.50049ZM11.6452 8.97459C13.5122 8.97459 15.0312 10.4946 15.0312 12.3616C15.0312 14.2286 13.5122 15.7466 11.6452 15.7466C9.77822 15.7466 8.25922 14.2286 8.25922 12.3616C8.25922 10.4946 9.77822 8.97459 11.6452 8.97459ZM11.6452 10.4746C10.6052 10.4746 9.75922 11.3216 9.75922 12.3616C9.75922 13.4016 10.6052 14.2466 11.6452 14.2466C12.6852 14.2466 13.5312 13.4016 13.5312 12.3616C13.5312 11.3216 12.6852 10.4746 11.6452 10.4746Z" fill="black"/>
                        </svg>
                        <a href="setting.php">Ayarlar</a>
                    </div>
                    <div class="notsPage link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.9088 2C19.0528 2 21.1648 4.153 21.1648 7.357V16.553C21.1648 19.785 19.1178 21.887 15.9498 21.907L8.25676 21.91C5.11276 21.91 2.99976 19.757 2.99976 16.553V7.357C2.99976 4.124 5.04676 2.023 8.21476 2.004L15.9078 2H15.9088ZM15.9088 3.5L8.21976 3.504C5.89176 3.518 4.49976 4.958 4.49976 7.357V16.553C4.49976 18.968 5.90476 20.41 8.25576 20.41L15.9448 20.407C18.2728 20.393 19.6648 18.951 19.6648 16.553V7.357C19.6648 4.942 18.2608 3.5 15.9088 3.5ZM15.7159 15.4737C16.1299 15.4737 16.4659 15.8097 16.4659 16.2237C16.4659 16.6377 16.1299 16.9737 15.7159 16.9737H8.49586C8.08186 16.9737 7.74586 16.6377 7.74586 16.2237C7.74586 15.8097 8.08186 15.4737 8.49586 15.4737H15.7159ZM15.7159 11.2872C16.1299 11.2872 16.4659 11.6232 16.4659 12.0372C16.4659 12.4512 16.1299 12.7872 15.7159 12.7872H8.49586C8.08186 12.7872 7.74586 12.4512 7.74586 12.0372C7.74586 11.6232 8.08186 11.2872 8.49586 11.2872H15.7159ZM11.2506 7.1104C11.6646 7.1104 12.0006 7.4464 12.0006 7.8604C12.0006 8.2744 11.6646 8.6104 11.2506 8.6104H8.49556C8.08156 8.6104 7.74556 8.2744 7.74556 7.8604C7.74556 7.4464 8.08156 7.1104 8.49556 7.1104H11.2506Z" fill="black"/>
                        </svg>
                        <a href="nots.php">Notlar</a>
                    </div>
                    <div class="orderPage link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.436 1C20.063 1 22.5 3.546 22.5 7.335V16.165C22.5 19.954 20.063 22.5 16.436 22.5H7.064C3.437 22.5 1 19.954 1 16.165V7.335C1 3.546 3.437 1 7.064 1H16.436ZM16.436 2.5H7.064C4.292 2.5 2.5 4.397 2.5 7.335V16.165C2.5 19.103 4.292 21 7.064 21H16.436C19.209 21 21 19.103 21 16.165V7.335C21 4.397 19.209 2.5 16.436 2.5ZM7.1211 9.2025C7.5351 9.2025 7.8711 9.5385 7.8711 9.9525V16.8125C7.8711 17.2265 7.5351 17.5625 7.1211 17.5625C6.7071 17.5625 6.3711 17.2265 6.3711 16.8125V9.9525C6.3711 9.5385 6.7071 9.2025 7.1211 9.2025ZM11.7881 5.9185C12.2021 5.9185 12.5381 6.2545 12.5381 6.6685V16.8115C12.5381 17.2255 12.2021 17.5615 11.7881 17.5615C11.3741 17.5615 11.0381 17.2255 11.0381 16.8115V6.6685C11.0381 6.2545 11.3741 5.9185 11.7881 5.9185ZM16.3784 12.8275C16.7924 12.8275 17.1284 13.1635 17.1284 13.5775V16.8115C17.1284 17.2255 16.7924 17.5615 16.3784 17.5615C15.9644 17.5615 15.6284 17.2255 15.6284 16.8115V13.5775C15.6284 13.1635 15.9644 12.8275 16.3784 12.8275Z" fill="black"/>
                        </svg>
                        <a href="order_list.php">Sıralama</a>
                    </div>
                    <div class="temaMode link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_58_860)">
                            <path d="M12 5.625C10.7391 5.625 9.5066 5.99889 8.45824 6.69938C7.40988 7.39988 6.59278 8.39551 6.11027 9.56039C5.62776 10.7253 5.50151 12.0071 5.74749 13.2437C5.99347 14.4803 6.60063 15.6162 7.49219 16.5078C8.38375 17.3994 9.51967 18.0065 10.7563 18.2525C11.9929 18.4985 13.2747 18.3722 14.4396 17.8897C15.6045 17.4072 16.6001 16.5901 17.3006 15.5418C18.0011 14.4934 18.375 13.2609 18.375 12C18.3725 10.31 17.7001 8.68994 16.5051 7.49493C15.3101 6.29993 13.69 5.62748 12 5.625V5.625ZM12 16.875C11.0358 16.875 10.0933 16.5891 9.2916 16.0534C8.48991 15.5177 7.86506 14.7564 7.49609 13.8656C7.12711 12.9748 7.03057 11.9946 7.21867 11.0489C7.40677 10.1033 7.87107 9.23464 8.55285 8.55285C9.23464 7.87107 10.1033 7.40677 11.0489 7.21867C11.9946 7.03057 12.9748 7.12711 13.8656 7.49609C14.7564 7.86506 15.5177 8.48991 16.0534 9.2916C16.5891 10.0933 16.875 11.0358 16.875 12C16.875 13.2929 16.3614 14.5329 15.4471 15.4471C14.5329 16.3614 13.2929 16.875 12 16.875V16.875ZM11.25 3.375V1.5C11.25 1.30109 11.329 1.11032 11.4697 0.96967C11.6103 0.829018 11.8011 0.75 12 0.75C12.1989 0.75 12.3897 0.829018 12.5303 0.96967C12.671 1.11032 12.75 1.30109 12.75 1.5V3.375C12.75 3.57391 12.671 3.76468 12.5303 3.90533C12.3897 4.04598 12.1989 4.125 12 4.125C11.8011 4.125 11.6103 4.04598 11.4697 3.90533C11.329 3.76468 11.25 3.57391 11.25 3.375ZM4.04062 5.10938C3.95869 5.04213 3.89174 4.95847 3.84408 4.86379C3.79643 4.76911 3.76912 4.6655 3.76392 4.55963C3.75872 4.45376 3.77574 4.34798 3.81389 4.24908C3.85204 4.15019 3.91047 4.06038 3.98542 3.98542C4.06038 3.91047 4.15019 3.85204 4.24908 3.81389C4.34798 3.77574 4.45376 3.75872 4.55963 3.76392C4.6655 3.76912 4.76911 3.79643 4.86379 3.84408C4.95847 3.89174 5.04213 3.95869 5.10938 4.04062L6.43125 5.37187C6.57151 5.51247 6.65028 5.70296 6.65028 5.90156C6.65028 6.10016 6.57151 6.29065 6.43125 6.43125C6.28947 6.56926 6.09942 6.64649 5.90156 6.64649C5.7037 6.64649 5.51365 6.56926 5.37187 6.43125L4.04062 5.10938ZM3.375 12.75H1.5C1.30109 12.75 1.11032 12.671 0.96967 12.5303C0.829018 12.3897 0.75 12.1989 0.75 12C0.75 11.8011 0.829018 11.6103 0.96967 11.4697C1.11032 11.329 1.30109 11.25 1.5 11.25H3.375C3.57391 11.25 3.76468 11.329 3.90533 11.4697C4.04598 11.6103 4.125 11.8011 4.125 12C4.125 12.1989 4.04598 12.3897 3.90533 12.5303C3.76468 12.671 3.57391 12.75 3.375 12.75ZM6.43125 17.5687C6.57151 17.7093 6.65028 17.8998 6.65028 18.0984C6.65028 18.297 6.57151 18.4875 6.43125 18.6281L5.10938 19.9594C4.96541 20.097 4.77416 20.1742 4.575 20.175C4.37621 20.1723 4.18562 20.0954 4.04062 19.9594C3.89979 19.8172 3.82078 19.6251 3.82078 19.425C3.82078 19.2249 3.89979 19.0328 4.04062 18.8906L5.37187 17.5687C5.51247 17.4285 5.70296 17.3497 5.90156 17.3497C6.10016 17.3497 6.29065 17.4285 6.43125 17.5687V17.5687ZM12.75 20.625V22.5C12.75 22.6989 12.671 22.8897 12.5303 23.0303C12.3897 23.171 12.1989 23.25 12 23.25C11.8011 23.25 11.6103 23.171 11.4697 23.0303C11.329 22.8897 11.25 22.6989 11.25 22.5V20.625C11.25 20.4261 11.329 20.2353 11.4697 20.0947C11.6103 19.954 11.8011 19.875 12 19.875C12.1989 19.875 12.3897 19.954 12.5303 20.0947C12.671 20.2353 12.75 20.4261 12.75 20.625ZM19.9594 18.8906C20.1002 19.0328 20.1792 19.2249 20.1792 19.425C20.1792 19.6251 20.1002 19.8172 19.9594 19.9594C19.8144 20.0954 19.6238 20.1723 19.425 20.175C19.2258 20.1742 19.0346 20.097 18.8906 19.9594L17.5687 18.6281C17.4395 18.4855 17.37 18.2985 17.3748 18.1061C17.3795 17.9136 17.4581 17.7303 17.5942 17.5942C17.7303 17.4581 17.9136 17.3795 18.1061 17.3748C18.2985 17.37 18.4855 17.4395 18.6281 17.5687L19.9594 18.8906ZM23.25 12C23.25 12.1989 23.171 12.3897 23.0303 12.5303C22.8897 12.671 22.6989 12.75 22.5 12.75H20.625C20.4261 12.75 20.2353 12.671 20.0947 12.5303C19.954 12.3897 19.875 12.1989 19.875 12C19.875 11.8011 19.954 11.6103 20.0947 11.4697C20.2353 11.329 20.4261 11.25 20.625 11.25H22.5C22.6989 11.25 22.8897 11.329 23.0303 11.4697C23.171 11.6103 23.25 11.8011 23.25 12ZM17.5687 6.43125C17.4285 6.29065 17.3497 6.10016 17.3497 5.90156C17.3497 5.70296 17.4285 5.51247 17.5687 5.37187L18.8906 4.04062C19.0363 3.92103 19.2213 3.85991 19.4096 3.86916C19.5979 3.8784 19.776 3.95736 19.9093 4.09066C20.0426 4.22396 20.1216 4.40208 20.1308 4.59037C20.1401 4.77866 20.079 4.96365 19.9594 5.10938L18.6281 6.43125C18.4863 6.56926 18.2963 6.64649 18.0984 6.64649C17.9006 6.64649 17.7105 6.56926 17.5687 6.43125V6.43125Z" fill="black"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_58_860">
                            <rect width="24" height="24" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                        <div class="temaModeText">Tema Modu</div>
                    </div>

                    
                    
                    <form method="POST" action="signOut.php" class="signOutForm">
                        <button name="signOut" id="signOut">Çıkış Yap</button>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3082 2C13.7542 2 15.7442 3.99 15.7442 6.436V7.368C15.7442 7.782 15.4082 8.118 14.9942 8.118C14.5802 8.118 14.2442 7.782 14.2442 7.368V6.436C14.2442 4.816 12.9272 3.5 11.3082 3.5H6.43324C4.81624 3.5 3.50024 4.816 3.50024 6.436V17.565C3.50024 19.184 4.81624 20.5 6.43324 20.5H11.3192C12.9312 20.5 14.2442 19.188 14.2442 17.576V16.633C14.2442 16.219 14.5802 15.883 14.9942 15.883C15.4082 15.883 15.7442 16.219 15.7442 16.633V17.576C15.7442 20.016 13.7582 22 11.3192 22H6.43324C3.98924 22 2.00024 20.011 2.00024 17.565V6.436C2.00024 3.99 3.98924 2 6.43324 2H11.3082ZM19.3883 8.554L22.3163 11.469C22.3425 11.4949 22.3659 11.5219 22.3873 11.5504L22.3163 11.469C22.3518 11.5039 22.3833 11.5421 22.4106 11.5828C22.4227 11.6012 22.4343 11.6203 22.445 11.6399C22.4537 11.6552 22.4618 11.6712 22.4692 11.6875C22.4755 11.7018 22.4816 11.7162 22.4872 11.7308C22.4948 11.7498 22.5014 11.7693 22.5071 11.7891C22.5115 11.8047 22.5155 11.8203 22.519 11.836C22.5235 11.8551 22.527 11.8743 22.5298 11.8937C22.5314 11.9063 22.5329 11.9195 22.5341 11.9328C22.5364 11.9556 22.5373 11.9777 22.5373 12L22.5322 12.062L22.5302 12.1017C22.53 12.1034 22.5297 12.1051 22.5295 12.1068L22.5373 12C22.5373 12.0555 22.5312 12.1105 22.5193 12.1639C22.5155 12.1797 22.5115 12.1953 22.507 12.2107C22.5014 12.2307 22.4948 12.2502 22.4874 12.2695C22.4816 12.2838 22.4755 12.2982 22.469 12.3123C22.4618 12.3288 22.4537 12.3448 22.4451 12.3605C22.4343 12.3797 22.4227 12.3988 22.4102 12.4172C22.4032 12.4282 22.3955 12.439 22.3875 12.4497C22.3637 12.481 22.3378 12.5104 22.3097 12.5377L19.3883 15.447C19.2423 15.593 19.0503 15.666 18.8593 15.666C18.6673 15.666 18.4743 15.593 18.3283 15.445C18.0363 15.151 18.0373 14.677 18.3303 14.385L19.9702 12.75H9.74604C9.33204 12.75 8.99604 12.414 8.99604 12C8.99604 11.586 9.33204 11.25 9.74604 11.25H19.9722L18.3303 9.616C18.0373 9.324 18.0353 8.85 18.3283 8.556C18.6203 8.262 19.0943 8.262 19.3883 8.554Z" fill="#EA4335"/>
                        </svg>
                    </form>
                </div>
                
            </div>
            
    </div>
    <div class="OrderHeader">Sıralamam</div>
    
    <div class="orderPanel">
        <div id="subjectOrder"></div>
        <div class="orderSection">
        </div>
    </div>
    <script src="../js/jquery-3.6.0.slim.min.js"></script>
    <script>
        const userDatas = <?php echo $listUser?>;
        const DOM_OrderSection = document.querySelector(".orderSection")
        const headerSubject = '<?php echo $header?>';
        let personName,personPicture,personScore,orderImg,userData;

        //Konu başlığı belirleme
        $("#subjectOrder").text(headerSubject)
        //her bir kişiyi listeye ekleme
        let i = 1;
        userDatas.forEach(person => {
            personName = person["userName"]
            personPicture = person["userPicture"]
            personScore = person["userScore"] +" "+ "Puan"

            if(person["myInfo"] === true){
                userData = $(`<div id='orderMy' data-site-key='${i}' class='orderData'></div>`)
            }else{
                userData = $(`<div id='orderData' data-site-key='${i}' class='orderData'></div>`)
            }
            

            let userOrder = $(`<div id='orderOrder'></div>`)
            let userName = $(`<div id='orderName'></div>`).text(personName)
            let userPicture = $(`<img src='${personPicture}' id='orderPicture' alt="PP"></img>`).text(personPicture)
            let userScore = $(`<div id='orderScore'></div>`).text(personScore)
            let userOrderNamePicture = $("<div id='userOrderNamePicture'></div>")
            $(userOrderNamePicture).append(userOrder)
            if(i<=3){
                switch (i) {
                    case 1:
                        orderImg = $("<img src='../img/GoldMedal.svg' id='orderFinalist'>")
                        $(userOrder).append(orderImg)
                        break;
                    case 2:
                        orderImg = $("<img src='../img/SilverMedal.svg' id='orderFinalist'>")
                        $(userOrder).append(orderImg)
                        break;
                    case 3:
                        orderImg = $("<img src='../img/BronzeMedal.svg' id='orderFinalist'>")
                        $(userOrder).append(orderImg)
                        break;
                }
            }else{
                userOrder.text(i)
            }
            $(userOrderNamePicture).append(userPicture)
            $(userOrderNamePicture).append(userName)
            $(userData).append(userOrderNamePicture)
            $(userData).append(userScore)

            $(".orderSection").append(userData)
            i++
        });
    </script>
    <script>
        // Header Bölümü
        const headerLogo = document.querySelector("#headerLogo")
        const scoreText = document.querySelector(".scoreText")
        const userPictureArea = document.querySelector("#userPicture")
        const textPicture = document.querySelector(".textPicture")
        const userName = document.querySelector(".userName")
        const headerMenu = document.querySelector(".header-menu")
        const eduLevel = '<?php echo $current_Education?>';
        const userPicture = '<?php echo $pictureSrc?>';
        const name = '<?php echo $user_name?>'
        
        switch (eduLevel) {
            case "primary-school":
                headerLogo.src = "../img/CodingoHeaders/Codingo _ İlkokul.png"
                break;
        
            case "secondary-school":
                headerLogo.src = "../img/CodingoHeaders/Codingo _ Ortaokul.png"
                break;
            case "high-school":
                headerLogo.src = "../img/CodingoHeaders/Codingo _ Lise.png"
                break;
            case "graduate":
                headerLogo.src = "../img/CodingoHeaders/Codingo _ Mezun.png"
                break;
        }

        scoreText.textContent = '<?php echo $current_Score?> puan';

        if(userPicture == '../img/unknown.png'){
            userPictureArea.src = '../img/UndefinedUserPicture.png'
            userPictureArea.title = name
            textPicture.textContent = name[0]
        }else{
            userPictureArea.src = userPicture
            userPictureArea.title = name
            textPicture.textContent = name[0]
        }

        userName.textContent = name

        headerMenu.style.display = "none"

        $(".menu-clickArea").on("click",()=>{
            if(headerMenu.style.display === "none"){
                headerMenu.style.display = "flex"
                $(".arrow").css("transform","rotate(-180deg)")
            }else{
                headerMenu.style.display = "none"
                $(".arrow").css("transform","rotate(0deg)")
            }
        })
        $("#closePopup").on("click",()=>{
            headerMenu.style.display = "none"
            $(".arrow").css("transform","rotate(0deg)")
        })

        $(".mainPage").on("click",()=>{
            window.location.href = "./personal_home.php"
        })
        $(".settingPage").on("click",()=>{
            window.location.href = "./setting.php"
        })
        $(".notsPage").on("click",()=>{
            window.location.href = "./nots.php"
        })
        $(".orderPage").on("click",()=>{
            window.location.href = "./order_list.php"
        })
        
    </script>
</body>
</html>