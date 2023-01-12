<?php
require_once '../../vendor/autoload.php';
require_once 'config.php';
 
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
    <link rel="shorcut icon" href="../img/Codingo_Title.png" />
    
    <!--Link Tag-->
    <link rel="stylesheet" href="../css/loginPage.css">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/inputArea.css">
    
    <script src="../js/controlCookie.js" type="module"></script>
</head>
<body>
    <div class="header">
        <img src="" width="100%" alt="Header Görseli" id="headerImg">
        <div class="Codingo" title="Anasayfa'ya git">Codingo</div>
        <div class="text">Giriş Yap</div>
    </div>
    
    <div class="logInArea">
        <a href="register.php">Henüz kayıt olmadıysanız şimdi <span id="registerText">kayıt olun</span>.</a>
        <div class="EmailPlace">
            <div class="EmailWrite">
                <div id="İnfoEmail">E - Posta </div>
                <input type="text" class="email" id="email" placeholder="E - Posta adresinizi giriniz">
            </div>
        </div>
        <div class="PassPlace">
                <div class="PassWrite">
                    <div id="infoPass">Şifre</div>
                    <input type="password" class="password" id="password" placeholder="Şifrenizi giriniz"></input>
                </div>
                <div class="show">
                    <svg width="30" height="30" viewBox="0 0 30 30" id="hide" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.75 15C10.5 5 19.5 5 26.25 15C19.5 25 10.5 25 3.75 15Z" stroke="#A0A0A0" stroke-width="2" stroke-linejoin="round"/>
                        <path d="M18.75 15C18.75 15.9946 18.3549 16.9484 17.6517 17.6517C16.9484 18.3549 15.9946 18.75 15 18.75C14.0054 18.75 13.0516 18.3549 12.3483 17.6517C11.6451 16.9484 11.25 15.9946 11.25 15C11.25 14.0054 11.6451 13.0516 12.3483 12.3483C13.0516 11.6451 14.0054 11.25 15 11.25C15.9946 11.25 16.9484 11.6451 17.6517 12.3483C18.3549 13.0516 18.75 14.0054 18.75 15V15Z" stroke="#A0A0A0" stroke-width="2" stroke-linejoin="round"/>
                    </svg>
                    <svg width="30" height="30" viewBox="0 0 30 30" id="show" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 10C3.85861 11.0414 4.87009 11.9467 6 12.685M21 10C20.1414 11.0414 19.1299 11.9467 18 12.685M10 14.309L9.5 16.5M10 14.31C11.3212 14.5641 12.6788 14.5641 14 14.31M10 14.31C8.57444 14.0311 7.21621 13.4793 6 12.685M14 14.309L14.5 16.5M14 14.31C15.4256 14.0311 16.7838 13.4793 18 12.685M18 12.685L19.5 14.5M6 12.685L4.5 14.5" stroke="#A0A0A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
        </div>
        <div class="warn" style="display: none;">
            <img class="icon" src="../img/signWarn.svg"></img>
            <div class="text">E - Postanızı ve şifrenizi kontrol ediniz</div>
        </div>
        <div class="rememberMe">
            <input type="checkbox" name="checkbox" id="checkbox_id">
            <label for="checkbox_id">Beni hatırla</label>
        </div>
        
        <button type="submit" id="setProgress">Giriş Yap</button>
        
        <a id="authGoogle" href="<?php echo $client->createAuthUrl()?>">
            <div class="googleIcon"><img src="../img/GoogleLogo.svg" alt="Google Logo" id="GoogleLogo" title="Google ile giriş yap"></div>
            <div class="authText">Google ile Giriş Yap</div>
        </a>
    </div>
    
    



    <img id="logInSvgPgoto"src="../img/Login.svg" alt="Sol Alt Görsel" >


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>,
    <script>
        //Header
        const screenWidth = screen.width
        if(screenWidth <=400){
            $("#headerImg").attr("src","../img/headerSmall.svg")
        }else if(screenWidth >400 && screenWidth <=767){
            $("#headerImg").attr("src","../img/headerMid.svg")
        }else{
            $("#headerImg").attr("src","../img/headerBig.svg")
        }
    </script>
    <script>
        //Password
        $("#show").css("display","none")

        $(".show svg").on("click",()=>{
            if($(".password").attr("type") === "text"){
                $(".password").attr("type","password")

                $("#hide").css("display","none")
                $("#show").css("display","block")
            }else{
                $(".password").attr("type","text")
                
                $("#show").css("display","none")
                $("#hide").css("display","block")
            }
        })
    </script>
    <script>
        $(".Codingo").on("click",()=>{
            window.location.href="./homepage.html"
        })
    </script>
    <script type="module" src="../js/controlAnotherTheme.js"></script>
    <script type="module">
        import {encryption} from '../js/encrypt.js';
        //sendLogData 
        $("#setProgress").on("click",()=>{
            let ourEmail = $("#email").val()
            let ourPassword = $("#password").val()
            let rememberBool = $("#checkbox_id").is(':checked')

            $.ajax({
                url:"./loginDatas.php",
                type:"POST",
                data: {"ourEmail":ourEmail,"ourPassword":ourPassword},
                success: function(data){
                    console.log(data)
                    if(data == true){
                        if(rememberBool === true){
                            let encryptEmail = encryption(ourEmail);
                            let encryptPassword = encryption(ourPassword)
                            const date = "Sun Jan 01 2100 21:46:10 GMT";
                            document.cookie = "email ="+encryptEmail+";expires="+date;
                            document.cookie = "password ="+encryptPassword+";expires="+date;
                        }
                        window.location.href="./personal_home.php"
                    }else{
                        //Warn CSS
                        $(".warn").css("display","flex")

                        //Email CSS
                        $(".EmailWrite").css("border","1px solid rgb(234,67,53)")
                        $(".EmailWrite").css("background-color","rgba(234,67,53,.1)")
                        $("#İnfoEmail").css("color","rgb(234,67,53)")
                        $("#email").css("background-color","rgba(234,67,53,.0)")
                        $("#email").attr("value","Hatalı E - Posta")
                        $("#email").css("color","rgb(234,67,53)")

                        //Password CSS
                        $(".PassPlace").css("border","1px solid rgb(234,67,53)")
                        $(".PassPlace").css("background-color","rgba(234,67,53,.1)")
                        $(".PassWrite").css("background-color","rgba(234,67,53,.0)")
                        $("#infoPass").css("color","rgb(234,67,53)")
                        $("#show").css("display","none")
                        $("#show path").attr("stroke","rgb(234,67,53)")
                        $("#hide").css("display","block")
                        $("#hide path").attr("stroke","rgb(234,67,53)")
                        $("#password").css("background-color","rgba(234,67,53,.0)")
                        $("#password").attr("value","Hatalı Şifre")
                        $("#password").css("color","rgb(234,67,53)") 
                        $(".password").attr("type","text")
                    }
                }
            })

        })
    </script>
</body>
</html>