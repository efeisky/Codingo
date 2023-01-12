<?php
require_once("conn.php");

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

    <title>Codingo ~ Kayıt Ol</title>
    
    <!--Link Tag-->
    
    <link rel="shorcut icon" href="../img/Codingo_Title.png" />
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/inputArea.css">
    <script src="../js/jquery-3.6.0.slim.min.js"></script>
    
</head>
<body>
    <div class="header">
        <img src="" width="100%" alt="Header Görseli" id="headerImg">
        <div class="Codingo" title="Anasayfa'ya git">Codingo</div>
        <div class="text">Kayıt Ol</div>
    </div>
    <div class="registerArea">
        <a href="login.php" id="relativeText">Zaten kayıt olduysanız hemen <span id="registerText">giriş yapın</span>.</a>
        
        <div class="left">
            <div class="namePlace">
                <div class="nameWrite">
                    <div id="İnfoName">Ad - Soyad</div>
                    <input type="text" class="name" id="name" placeholder="Adınızı ve soyadınızı giriniz">
                </div>
            </div>
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
            <div class="dropdown-education">
                    <div class="selectEdu">
                        <div class="select-texts">
                            <div id="infoSelect">Eğitim seviyesi</div>
                            <div class="selected" id="education-level" name="education-level" value="none">Eğitim seviyenizi seçiniz</div>
                        </div>
                        <div class="caret">
                            <svg width="19" height="10" viewBox="0 0 19 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.258435 0.258435C0.57169 -0.0548196 1.06188 -0.0832973 1.40731 0.173002L1.50627 0.258435L9.11765 7.86941L16.729 0.258435C17.0423 -0.0548196 17.5325 -0.0832973 17.8779 0.173002L17.9769 0.258435C18.2901 0.57169 18.3186 1.06188 18.0623 1.40731L17.9769 1.50627L9.74156 9.74156C9.42831 10.0548 8.93812 10.0833 8.59269 9.827L8.49373 9.74156L0.258435 1.50627C-0.0861451 1.16169 -0.0861451 0.603015 0.258435 0.258435Z" fill="#A0A0A0"/>
                            </svg>
                        </div>
                    </div>
                    <ul class="menuEdu">
                        <li value="primary-school" class="eduLi">İlkokul</li>
                        <li value="secondary-school" class="eduLi">Ortaokul</li>
                        <li value="high-school" class="eduLi">Lise</li>
                        <li value="graduate" class="eduLi">Mezun</li>
                    </ul>
            </div>
        
            <div class="dropdown-province">
                    <div class="selectPro">
                        <div class="select-texts">
                            <div id="infoSelect">İl</div>
                            <div class="selected" id="province" name="province" value="none">İlinizi seçiniz</div>
                        </div>
                        <div class="caretPro">
                            <svg width="19" height="10" viewBox="0 0 19 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.258435 0.258435C0.57169 -0.0548196 1.06188 -0.0832973 1.40731 0.173002L1.50627 0.258435L9.11765 7.86941L16.729 0.258435C17.0423 -0.0548196 17.5325 -0.0832973 17.8779 0.173002L17.9769 0.258435C18.2901 0.57169 18.3186 1.06188 18.0623 1.40731L17.9769 1.50627L9.74156 9.74156C9.42831 10.0548 8.93812 10.0833 8.59269 9.827L8.49373 9.74156L0.258435 1.50627C-0.0861451 1.16169 -0.0861451 0.603015 0.258435 0.258435Z" fill="#A0A0A0"/>
                            </svg>
                        </div>
                    </div>
                    <ul class="provinceMenu">
                    </ul>
            </div>
            <div class="dropdown-school">
                    <div class="selectSchool">
                        <div class="select-texts">
                            <div id="infoSelect">Okul</div>
                            <div class="selected" id="school" name="school" value="none">Okulunuzu seçiniz</div>
                        </div>
                        <div class="caretSchool">
                            <svg width="19" height="10" viewBox="0 0 19 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.258435 0.258435C0.57169 -0.0548196 1.06188 -0.0832973 1.40731 0.173002L1.50627 0.258435L9.11765 7.86941L16.729 0.258435C17.0423 -0.0548196 17.5325 -0.0832973 17.8779 0.173002L17.9769 0.258435C18.2901 0.57169 18.3186 1.06188 18.0623 1.40731L17.9769 1.50627L9.74156 9.74156C9.42831 10.0548 8.93812 10.0833 8.59269 9.827L8.49373 9.74156L0.258435 1.50627C-0.0861451 1.16169 -0.0861451 0.603015 0.258435 0.258435Z" fill="#A0A0A0"/>
                            </svg>
                        </div>
                    </div>
                    <ul class="schoolMenu">
                    </ul>
            </div>
        </div>
        <div class="secondFlex">
            <div class="py-level">
                    <div class="text">
                        <div class="textContent">Python derecenizi seçiniz</div>
                        <img src="../img/Python.png" alt="pythonPng" title="Python">
                    </div>
                    <div class="options">
                        <input type="checkbox" name="python" value="bad" id="bad" >
                        <label for="bad" class="bad">
                            <img src="../img/Sad.png" alt="SadPng" title="Daha o ne bilmiyorum bile" >
                            <div class="labelText">Daha o ne bilmiyorum bile</div>
                        </label>
                        <input type="checkbox" name="python" value="medium" id="medium">
                        <label for="medium" class="medium">
                            <img src="../img/Medium.png" alt="MediumPng" title="Orta derece biliyorum" >
                            <div class="labelText">Orta derece biliyorum</div>
                        </label>
                        <input type="checkbox" name="python" value="high" id="high">
                        <label for="high" class="high">
                            <img src="../img/Good.png" alt="GoodPng" title="Baya iyiyim" >
                            <div class="labelText">Baya iyiyim</div>
                        </label>
                </div> 
            </div>
        </div>
        
        <div class="rightFlex">
            <div class="warnCopyright">
                Kayıt olarak <span>gizlilik</span>, <span>kullanım</span> ve <span>telif haklarımızı</span> kabul etmiş olursunuz.
            </div>
            <div class="g-recaptcha" data-sitekey="6LdliGMjAAAAAA0GgvCDe_o0xiDWKhjYaYsTGyLP"></div>
            <div class="warn" style="display: none;">
                <img class="icon" src="../img/signWarn.svg"></img>
                <div class="text">Tüm bilgileri tamamlamanız gerekiyor</div>
            </div>
            <div class="warnCurrentUser" style="display: none;">
                <img class="icon" src="../img/signWarn.svg"></img>
                <div class="text">Zaten böyle bir kullanıcı bulunmaktadır</div>
            </div>
            <button class="registerButton">Kayıt Ol</button>
            <a id="authGoogle" href="<?php echo $client->createAuthUrl()?>">
                <div class="googleIcon"><img src="../img/GoogleLogo.svg" alt="Google Logo" id="GoogleLogo" title="Google ile kayıt ol"></div>
                <div class="authText">Google ile Kayıt Ol</div>
            </a>
        </div>
        
    </div>
    
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="../js/settingİnput.js"></script>
    <script src="../js/json.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?hl=tr" async defer></script>
    <script>
        let accessEducation,accessPy;
        const buttonStyle = () =>{
            if(accessEducation === true && accessPy === true){
                document.querySelector("#startLesson").setAttribute("class","Active")
            }else{
                
            }
        }
        $(".bad").on("click",()=>{
            $(".medium").removeClass("SelectedPy")
            $(".high").removeClass("SelectedPy")

            $(".bad").addClass("SelectedPy")
            accessPy = true
            buttonStyle()
        })
        $(".medium").on("click",()=>{
            $(".bad").removeClass("SelectedPy")
            $(".high").removeClass("SelectedPy")

            $(".medium").addClass("SelectedPy")
            accessPy = true
            buttonStyle()
        })
        $(".high").on("click",()=>{
            $(".bad").removeClass("SelectedPy")
            $(".medium").removeClass("SelectedPy")

            $(".high").addClass("SelectedPy")
            accessPy = true
            buttonStyle()
        })
    </script>
    <script>
        $(document).on('click', 'input[type="checkbox"]', function(){
            $("input[type='checkbox']").not(this).prop('checked', false)
        });
    </script>
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
        $(".Codingo").on("click",()=>{
            window.location.href="./homepage.html"
        })
    </script>
    
    <script type="module" src="../js/controlAnotherTheme.js"></script>
    <script src="../js/newUser.js"></script>
</body>
</html>