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
$user_name = $check["name"];
$school_level = $check["education_level"];
$lessonNo = $check["pylesson"];
$py_Info = $db->query("SELECT * FROM lessons WHERE lessonType= 'Python' AND lessonID= '{$lessonNo}'")->fetch(PDO::FETCH_ASSOC);
$listInfo = json_encode($py_Info); 

$py_lesson = $db->query("SELECT * FROM questions WHERE lessonType= 'Python' AND lessonID= '{$lessonNo}'")->fetchAll(PDO::FETCH_ASSOC);
$listQuestion = json_encode($py_lesson); 


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
    <title>Ders <?php echo $lessonNo?> | Python ~ Codingo</title>
    
    <!--Link Tag-->
    <link rel="stylesheet"  href="../css/reset.css">
    <link rel="stylesheet" href="../css/lesson.css" type="text/css">
    <script src="../js/jquery-3.6.0.slim.min.js"></script>
    <style>
        
        .circles{
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background-color: #F2F2F2;
        }
        .level {
            font-family: "Montserrat", sans-serif;
            font-weight: 500;
            text-align: center;
        }
        .subject{
            font-family: "Montserrat", sans-serif;
            font-weight: 500;
            text-align: center;
        }
        .answerPut{
            border-radius: 5px;
        }
        .answerPut.correctAnswer, .textDiv.correctAnswer{
            background-color: rgb(58,205 ,126,.1 );
            border-color:#3ACD7F8E
            
        }
        .answerPut.notCorrectAnswer, .textDiv.notCorrectAnswer{
            background-color: rgb(234,67 ,53,.1 );
            border-color:#EA4335
        }
        .answerPut.notCorrectAnswer .questionAnswerInfos, .answerPut.notCorrectAnswer #choice, .textDiv.notCorrectAnswer .textAreaCompArea textarea,.textDiv.notCorrectAnswer #YourAnswer{
            color: #EA4335
        }
        .answerPut.correctAnswer .questionAnswerInfos, .answerPut.correctAnswer #choice,.textDiv.correctAnswer .textAreaCompArea textarea,.textDiv.correctAnswer #YourAnswer{
            color: #3ACD7E;
        }
        .text{
            font-family: "Montserrat", sans-serif;
            font-weight: 500;
            text-align: center;
        }
        #name{
            font-weight: 600;
        }
        .myAddScore{
            font-family: "Montserrat", sans-serif;
            font-weight: 600;
            text-align: center;
            color: #FFC331;
        }
        .score{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
        }
        #difficultyLevel{
            font-weight: 600;
        }
        @media only screen and (max-width: 400px) {
            .mobile-Note{
                display: block;
            }
            .openNote{
                display: none;
            }
            .answerCircles{
                margin-top: 10px;
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 10px;
            }
            #homeIcon{
                width: 20px;
            }
            .level{
                margin-top: 30px;
                font-size: 18px;
            }
            .subject{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 5px;
            }
            .SpaceBlank{
                width: 50px;
                height: 30px;
                border: 1px solid #CBCBCB;
                border-radius: 5px;
            }
            .dragLetter{
                min-width: 50px;
                width: auto;
                height: 30px;
                border: 1px solid #4285F4;
                border-radius: 5px;
                font-family: "Montserrat", sans-serif;
                font-weight: 500;
                font-size: 18px;
                text-align: center;
                line-height: 30px;
                cursor: move;
            }
            .dragAndDrop{
                justify-content: center;
                gap: 50px;
                flex-wrap: wrap;

            }
            .controlDrag{
               width: 300px;
               height: 60px; 
               font-family: "Montserrat", sans-serif;
               font-weight: 500;
               font-size: 18px;
               position: absolute;
               margin-top: 50px;
               left: calc(50% - 150px);
               background-color: #FFFFFF;
               border:  1px solid #4285F4;
               color: #4285F4;
               border-radius: 5px;
               cursor: pointer;
               transition: .5s all ease-in-out;
            }
            .controlDrag:hover{
                background-color: rgb(66,133,244,.1);
            }
            .result{
                padding: 50px 0 50px 0;
                justify-content: center;
                align-items: center;
                gap: 50px;
                flex-direction: column;
            }
            .result img{
                width: 250px;
            }
            #PersonelButton{
               width: 200px;
               height: 80px; 
               font-family: "Montserrat", sans-serif;
               font-weight: 500;
               font-size: 18px;
               background-color: rgb(66,133,244,.1);
               border:  1px solid #4285F4;
               color: #4285F4;
               border-radius: 20px;
               cursor: pointer;
               transition: .5s all ease-in-out;
            }
            #PersonelButton:hover{
                background-color:rgb(66,133,244,.7);
                border-color: #4285F4;
                color: #FFFFFF;
            }
            .text{
                font-size: 16px;
            }
            .myAddScore{
                font-size: 18px;
            }
        }
        @media only screen and (max-width: 767px) and (min-width: 401px){
            
            .mobile-Note{
                display: none;
            }
            .answerCircles{
                margin-top: 50px;
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 10px;
            }
            #homeIcon{
                width: 20px;
            }
            .level{
                margin-top: 30px;
                font-size: 18px;
            }
            .subject{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 5px;
            }
            .SpaceBlank{
                width: 50px;
                height: 30px;
                border: 1px solid #CBCBCB;
                border-radius: 5px;
            }
            .dragLetter{
                min-width: 50px;
                width: auto;
                height: 30px;
                border: 1px solid #4285F4;
                border-radius: 5px;
                font-family: "Montserrat", sans-serif;
                font-weight: 500;
                font-size: 18px;
                text-align: center;
                line-height: 30px;
                cursor: move;
            }
            .dragAndDrop{
                justify-content: center;
                gap: 50px;
                flex-wrap: wrap;

            }
            .controlDrag{
               width: 300px;
               height: 60px; 
               font-family: "Montserrat", sans-serif;
               font-weight: 500;
               font-size: 18px;
               position: absolute;
               margin-top: 50px;
               left: calc(50% - 150px);
               background-color: #FFFFFF;
               border:  1px solid #4285F4;
               color: #4285F4;
               border-radius: 5px;
               cursor: pointer;
               transition: .5s all ease-in-out;
            }
            .controlDrag:hover{
                background-color: rgb(66,133,244,.1);
            }
            .result{
                padding: 50px 0 50px 0;
                justify-content: center;
                align-items: center;
                gap: 50px;
                flex-direction: column;
            }
            .result img{
                width: 250px;
            }
            #PersonelButton{
               width: 300px;
               height: 60px; 
               font-family: "Montserrat", sans-serif;
               font-weight: 500;
               font-size: 18px;
               background-color: rgb(66,133,244,.1);
               border:  1px solid #4285F4;
               color: #4285F4;
               border-radius: 20px;
               cursor: pointer;
               transition: .5s all ease-in-out;
            }
            #PersonelButton:hover{
                background-color:rgb(66,133,244,.7);
                border-color: #4285F4;
                color: #FFFFFF;
            }
            .text{
                font-size: 16px;
            }
            .myAddScore{
                font-size: 18px;
            }
        }
        @media only screen and (max-width: 1920px) and (min-width: 767px) {
            .mobile-Note{
                display: none;
            }
            .answerCircles{
                margin-top: 50px;
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 10px;
            }
            #homeIcon{
                width: 24px;
            }
            .header div{
                width: 200px;
                text-align: center;
            }
            .level{
                margin-top: 30px;
                font-size: 18px;
            }
            .subject{
                display: flex;
                align-items: center;
                gap: 5px;
            }
            .SpaceBlank{
                width: 50px;
                height: 30px;
                border: 1px solid #CBCBCB;
                border-radius: 5px;
            }
            .dragLetter{
                min-width: 50px;
                width: auto;
                height: 30px;
                border: 1px solid #4285F4;
                border-radius: 5px;
                font-family: "Montserrat", sans-serif;
                font-weight: 500;
                font-size: 18px;
                text-align: center;
                line-height: 30px;
                cursor: move;
            }
            .dragAndDrop{
                justify-content: center;
                gap: 50px;
                flex-wrap: wrap;

            }
            .controlDrag{
               width: 300px;
               height: 60px; 
               font-family: "Montserrat", sans-serif;
               font-weight: 500;
               font-size: 18px;
               position: absolute;
               margin-top: 50px;
               left: calc(50% - 150px);
               background-color: #FFFFFF;
               border:  1px solid #4285F4;
               color: #4285F4;
               border-radius: 5px;
               cursor: pointer;
               transition: .5s all ease-in-out;
            }
            .controlDrag:hover{
                background-color: rgb(66,133,244,.1);
            }
            .result{
                padding: 50px 0 50px 0;
                justify-content: center;
                align-items: center;
                gap: 50px;
                flex-direction: column;
            }
            .result img{
                width: 400px;
            }
            #PersonelButton{
               width: 300px;
               height: 60px; 
               font-family: "Montserrat", sans-serif;
               font-weight: 500;
               font-size: 18px;
               background-color: rgb(66,133,244,.1);
               border:  1px solid #4285F4;
               color: #4285F4;
               border-radius: 20px;
               cursor: pointer;
               transition: .5s all ease-in-out;
            }
            #PersonelButton:hover{
                background-color:rgb(66,133,244,.7);
                border-color: #4285F4;
                color: #FFFFFF;
            }
            .text{
                font-size: 26px;
            }
            .myAddScore{
                font-size: 22px;
            }
        }
        @media only screen and (min-width: 1920px) {
            .mobile-Note{
                display: none;
            }
            .answerCircles{
                margin-top: 50px;
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 10px;
            }
            #homeIcon{
                width: 32px;
            }
            .header div{
                width: 200px;
                text-align: center;
            }
            .level{
                margin-top: 50px;
                font-size: 19px;
            }
            .subject{
                display: flex;
                align-items: center;
                gap: 5px;
            }
            .SpaceBlank{
                width: 50px;
                height: 30px;
                border: 1px solid #CBCBCB;
                border-radius: 5px;
            }
            .dragLetter{
                min-width: 50px;
                width: auto;
                height: 30px;
                border: 1px solid #4285F4;
                border-radius: 5px;
                font-family: "Montserrat", sans-serif;
                font-weight: 500;
                font-size: 18px;
                text-align: center;
                line-height: 30px;
                cursor: move;
            }
            .dragAndDrop{
                justify-content: center;
                gap: 50px;
                flex-wrap: wrap;

            }
            .controlDrag{
               width: 300px;
               height: 60px; 
               font-family: "Montserrat", sans-serif;
               font-weight: 500;
               font-size: 18px;
               position: absolute;
               margin-top: 50px;
               left: calc(50% - 150px);
               background-color: #FFFFFF;
               border:  1px solid #4285F4;
               color: #4285F4;
               border-radius: 5px;
               cursor: pointer;
               transition: .5s all ease-in-out;
            }
            .controlDrag:hover{
                background-color: rgb(66,133,244,.1);
            }
            .result{
                padding: 50px 0 50px 0;
                justify-content: center;
                align-items: center;
                gap: 50px;
                flex-direction: column;
            }
            #PersonelButton{
               width: 300px;
               height: 60px; 
               font-family: "Montserrat", sans-serif;
               font-weight: 500;
               font-size: 18px;
               background-color: rgb(66,133,244,.1);
               border:  1px solid #4285F4;
               color: #4285F4;
               border-radius: 20px;
               cursor: pointer;
               transition: .5s all ease-in-out;
            }
            #PersonelButton:hover{
                background-color:rgb(66,133,244,.7);
                border-color: #4285F4;
                color: #FFFFFF;
            }
            .text{
                font-size: 26px;
            }
            .myAddScore{
                font-size: 22px;
            }
        }
        @media only screen and (min-width: 1921px) {
            .mobile-Note{
                display: none;
            }
            .answerCircles{
                margin-top: 50px;
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 10px;
            }
            #homeIcon{
                width: 35px;
            }
            .header div{
                width: 200px;
                text-align: center;
            }
            .level{
                margin-top: 60px;
                font-size: 21px;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="logo">
            <svg viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg" id="homeIcon">
                <path d="M13.3543 30.2916V25.8193C13.3542 24.6818 14.2816 23.7575 15.4306 23.7498H19.6395C20.794 23.7498 21.7299 24.6764 21.7299 25.8193V25.8193V30.3055C21.7296 31.2714 22.5083 32.0607 23.4836 32.0834H26.2895C29.0866 32.0834 31.3542 29.8385 31.3542 27.0694V27.0694V14.3469C31.3392 13.2575 30.8226 12.2345 29.9512 11.569L20.355 3.91608C18.6739 2.58355 16.284 2.58355 14.6029 3.91608L5.04878 11.5829C4.17412 12.2457 3.6566 13.2704 3.64583 14.3608V27.0694C3.64583 29.8385 5.91335 32.0834 8.71049 32.0834H11.5164C12.5159 32.0834 13.3262 31.2812 13.3262 30.2916V30.2916" stroke="#3ACD7E" stroke-opacity="0.98" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div class="Text">Codingo</div>
        </div>
        <div class="TextSubject"></div>
        <div class="lessonNo TextSubject"><?php echo $lessonNo?>. Ders</div>
        
    </div>
    <script>
        document.querySelector(".logo").addEventListener("click",()=>{
            window.location.href = "personal_home.php"
        })
    </script>

    <div class="info">
        <div class="area">
            <div class="video">
            <iframe  id="infoVideo" src="" frameborder="0" title="Bilgilendirici Eğitim Videosu"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>
            </div>
            <div class="infoHeader">Python <?php echo $lessonNo?>. Ders Bilgilerdirme Yazısı</div>
            <div class="infoText"></div>
            <div class="button">
                <button id="closeInfo">Devam Et</button>
            </div>
        </div>
        
        
    </div>
    <div class="exam">
        <div class="questionContent">
            <div class="mobile-Note">
                <svg width="78" height="24" viewBox="0 0 78 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.47 17.5V7.7H2.618L9.1 15.75H8.498V7.7H9.898V17.5H8.75L2.268 9.45H2.87V17.5H1.47ZM15.8133 17.584C15.0667 17.584 14.404 17.4207 13.8253 17.094C13.2467 16.7673 12.7893 16.3193 12.4533 15.75C12.1173 15.1713 11.9493 14.518 11.9493 13.79C11.9493 13.0527 12.1173 12.3993 12.4533 11.83C12.7893 11.2607 13.2467 10.8173 13.8253 10.5C14.404 10.1733 15.0667 10.01 15.8133 10.01C16.5507 10.01 17.2087 10.1733 17.7873 10.5C18.3753 10.8173 18.8327 11.2607 19.1593 11.83C19.4953 12.39 19.6633 13.0433 19.6633 13.79C19.6633 14.5273 19.4953 15.1807 19.1593 15.75C18.8327 16.3193 18.3753 16.7673 17.7873 17.094C17.2087 17.4207 16.5507 17.584 15.8133 17.584ZM15.8133 16.408C16.2893 16.408 16.714 16.3007 17.0873 16.086C17.47 15.8713 17.7687 15.568 17.9833 15.176C18.198 14.7747 18.3053 14.3127 18.3053 13.79C18.3053 13.258 18.198 12.8007 17.9833 12.418C17.7687 12.026 17.47 11.7227 17.0873 11.508C16.714 11.2933 16.2893 11.186 15.8133 11.186C15.3373 11.186 14.9127 11.2933 14.5393 11.508C14.166 11.7227 13.8673 12.026 13.6433 12.418C13.4193 12.8007 13.3073 13.258 13.3073 13.79C13.3073 14.3127 13.4193 14.7747 13.6433 15.176C13.8673 15.568 14.166 15.8713 14.5393 16.086C14.9127 16.3007 15.3373 16.408 15.8133 16.408ZM24.07 17.584C23.3234 17.584 22.7447 17.3833 22.334 16.982C21.9234 16.5807 21.718 16.0067 21.718 15.26V8.456H23.062V15.204C23.062 15.6053 23.16 15.9133 23.356 16.128C23.5614 16.3427 23.8507 16.45 24.224 16.45C24.644 16.45 24.994 16.3333 25.274 16.1L25.694 17.066C25.4887 17.2433 25.2414 17.374 24.952 17.458C24.672 17.542 24.378 17.584 24.07 17.584ZM20.458 11.186V10.08H25.19V11.186H20.458ZM29.7907 17.5L34.2287 7.7H35.6147L40.0667 17.5H38.5967L34.6347 8.484H35.1947L31.2327 17.5H29.7907ZM31.6807 15.05L32.0587 13.93H37.5747L37.9807 15.05H31.6807ZM41.3326 17.5V7.112H42.6766V17.5H41.3326Z" fill="black"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M69.9087 2C73.0527 2 75.1647 4.153 75.1647 7.357V16.553C75.1647 19.785 73.1177 21.887 69.9497 21.907L62.2567 21.91C59.1127 21.91 56.9997 19.757 56.9997 16.553V7.357C56.9997 4.124 59.0467 2.023 62.2147 2.004L69.9077 2H69.9087ZM69.9087 3.5L62.2197 3.504C59.8917 3.518 58.4997 4.958 58.4997 7.357V16.553C58.4997 18.968 59.9047 20.41 62.2557 20.41L69.9447 20.407C72.2727 20.393 73.6647 18.951 73.6647 16.553V7.357C73.6647 4.942 72.2607 3.5 69.9087 3.5ZM69.7158 15.4737C70.1298 15.4737 70.4658 15.8097 70.4658 16.2237C70.4658 16.6377 70.1298 16.9737 69.7158 16.9737H62.4958C62.0818 16.9737 61.7458 16.6377 61.7458 16.2237C61.7458 15.8097 62.0818 15.4737 62.4958 15.4737H69.7158ZM69.7158 11.2872C70.1298 11.2872 70.4658 11.6232 70.4658 12.0372C70.4658 12.4512 70.1298 12.7872 69.7158 12.7872H62.4958C62.0818 12.7872 61.7458 12.4512 61.7458 12.0372C61.7458 11.6232 62.0818 11.2872 62.4958 11.2872H69.7158ZM65.2505 7.1104C65.6645 7.1104 66.0005 7.4464 66.0005 7.8604C66.0005 8.2744 65.6645 8.6104 65.2505 8.6104H62.4955C62.0815 8.6104 61.7455 8.2744 61.7455 7.8604C61.7455 7.4464 62.0815 7.1104 62.4955 7.1104H65.2505Z" fill="black"/>
                </svg>
            </div>
        <script>
            $(".mobile-Note").on("click",()=>{
                $(".mobile-Note").css("display","none")
                $(".newNote").css("display","flex")
                $(".newNote").addClass("active")     
            })
            $(".close-Popup").on("click",()=>{
                $(".mobile-Note").css("display","block")
                $(".newNote").css("display","none")
                $(".newNote").removeClass("active")       
            })
        </script>
            <div class="answerCircles"></div>
            <div class="question">
                <div class="level">Zorluk : <span id="difficultyLevel"></span></div>
                <div class="questSandQ">
                    <div class="subject"></div>
                    <div class="speaker">
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 14.6857H19.6667L23 12V24L19.6667 21.3446H18V14.6857Z" fill="#4285F4" fill-opacity="0.1"/>
                    <rect x="6" y="15" width="12" height="6" fill="#4285F4" fill-opacity="0.1"/>
                    <path d="M18 12H6C5.20435 12 4.44129 12.3161 3.87868 12.8787C3.31607 13.4413 3 14.2044 3 15V21C3 21.7956 3.31607 22.5587 3.87868 23.1213C4.44129 23.6839 5.20435 24 6 24H7.5V30C7.5 30.3978 7.65804 30.7794 7.93934 31.0607C8.22064 31.342 8.60218 31.5 9 31.5H12C12.3978 31.5 12.7794 31.342 13.0607 31.0607C13.342 30.7794 13.5 30.3978 13.5 30V24H18L25.5 30V6L18 12ZM22.5 23.4L19.5 21H6V15H19.5L22.5 12.6V23.4ZM32.25 18C32.25 20.565 30.81 22.89 28.5 24V12C30.795 13.125 32.25 15.45 32.25 18Z" fill="#4285F4"/>
                    </svg>
                </div>
                </div>
                
                
                <div class="images"><img src="" id="image"></div>
                <div class="questionComponent">
                    <div class="rowsABCD">
                        <div class="row-AB">
                            <div class="answerA answerPut flex">
                                <div id="choice" class="questionAnswerInfos">A )</div>
                                <div id="A" class="questionAnswerInfos"></div>
                            </div>
                            <div class="answerB answerPut flex">
                                <div id="choice" class="questionAnswerInfos">B )</div>
                                <div id="B" class="questionAnswerInfos"></div>
                            </div>
                        </div>
                        <div class="row-CD">
                            <div class="answerC answerPut flex">
                                <div id="choice" class="questionAnswerInfos">C )</div>
                                <div id="C" class="questionAnswerInfos"></div>
                            </div>
                            <div class="answerD answerPut flex">
                                <div id="choice" class="questionAnswerInfos">D )</div>
                                <div id="D" class="questionAnswerInfos"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                <div class="textArea">
                    <div class="textDiv">
                        <div id="YourAnswer">Cevabınız:</div>
                        <div class="textAreaCompArea"><textarea id = "valueText" style="resize: none" placeholder="..."></textarea></div>
                        <div class="textAreaCompButton sendText">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8373 14.545L15.3384 21.8473C15.5353 22.1673 15.843 22.1636 15.9674 22.1464C16.0917 22.1292 16.3908 22.0529 16.4991 21.6898L22.1276 2.6801C22.2261 2.34409 22.0451 2.11516 21.9639 2.03393C21.8851 1.9527 21.6599 1.77915 21.3337 1.87146L2.31018 7.44206C1.94955 7.54791 1.87078 7.85069 1.85355 7.975C1.83632 8.10177 1.83139 8.41562 2.15017 8.61624L9.53632 13.2354L16.0621 6.64081C16.4203 6.27896 17.0049 6.27526 17.368 6.63343C17.7311 6.99159 17.7336 7.57745 17.3754 7.9393L10.8373 14.545ZM15.8714 24C15.0147 24 14.2294 23.5643 13.7667 22.816L8.99476 15.073L1.17167 10.1806C0.328561 9.65258 -0.112072 8.71225 0.0245487 7.72391C0.159939 6.73558 0.838121 5.95033 1.79078 5.67094L20.8143 0.100344C21.6894 -0.155662 22.6273 0.0868052 23.2723 0.729282C23.9172 1.37791 24.1572 2.32563 23.8963 3.20442L18.2678 22.2129C17.9859 23.1692 17.1982 23.8449 16.2123 23.9766C16.0966 23.9914 15.9846 24 15.8714 24Z" fill="#4285F4"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="dragAndDrop">

                </div>
                <button class="controlDrag">Taşımayı kontrol et</button>
            </div>
            <div class="rightAnswer">
                <div class="scos">
                    <div class="ThisTrue">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M31.5 10.5L13.5 28.5L5.25 20.25L7.365 18.135L13.5 24.255L29.385 8.38501L31.5 10.5Z" fill="#3ACD7E"/>
                        </svg>
                    </div>
                    <div class="message">Doğru Cevap</div>
                </div>
                
                <button id="nextQstnTrue">Yeni Soruya Geç</button>
  
            </div>
            <div class="falseAnswer">
                <div class="scos">
                    <div class="ThisFalse">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M36 14.1L33.9 12L24 21.9L14.1 12L12 14.1L21.9 24L12 33.9L14.1 36L24 26.1L33.9 36L36 33.9L26.1 24L36 14.1Z" fill="#EA4335"/>
                        </svg>
                    </div>
                    <div class="message">Yanlış Cevap</div>
                </div>
                
                <button id="nextQstnFalse">Yeni Soruya Geç</button>
  
            </div>
        </div>
        
        <div class="openNote">
            <svg width="34" height="62" viewBox="0 0 34 62" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M33.1213 0.87868C34.1864 1.94375 34.2832 3.6104 33.4118 4.78485L33.1213 5.12132L7.244 31L33.1213 56.8787C34.1864 57.9437 34.2832 59.6104 33.4118 60.7848L33.1213 61.1213C32.0563 62.1864 30.3896 62.2832 29.2152 61.4118L28.8787 61.1213L0.878681 33.1213C-0.186385 32.0563 -0.283211 30.3896 0.588207 29.2152L0.878681 28.8787L28.8787 0.87868C30.0503 -0.292893 31.9497 -0.292893 33.1213 0.87868Z" fill="#DBDBDB"/>
            </svg>
        </div>
        <div class="newNote">
            <div class="head">
                <div class="close-Popup">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24 9.4L22.6 8L16 14.6L9.4 8L8 9.4L14.6 16L8 22.6L9.4 24L16 17.4L22.6 24L24 22.6L17.4 16L24 9.4Z" fill="black"/>
                    </svg>
                </div>
                <div class="content">Notlar</div>
            </div>
            
            <div class="notSend">
                <textarea id="noteArea" name="" placeholder="Ekleyeceğiniz notu giriniz"></textarea>
                <div id="sendNote">
                    <svg svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.80495 12.0815L12.462 18.0216C12.622 18.2819 12.872 18.2789 12.973 18.2649C13.074 18.2509 13.317 18.1888 13.405 17.8934L17.978 2.42984C18.058 2.15652 17.911 1.97029 17.845 1.90421C17.781 1.83813 17.598 1.69696 17.333 1.77205L1.87695 6.3035C1.58395 6.38961 1.51995 6.6359 1.50595 6.73703C1.49195 6.84015 1.48795 7.09546 1.74695 7.25865L7.74795 11.0162L13.05 5.65172C13.341 5.35737 13.816 5.35436 14.111 5.64571C14.406 5.93706 14.408 6.41364 14.117 6.70799L8.80495 12.0815ZM12.895 19.7727C12.199 19.7727 11.561 19.4183 11.185 18.8095L7.30795 12.511L0.951945 8.53118C0.266945 8.10167 -0.0910551 7.33675 0.019945 6.53278C0.129945 5.72881 0.680945 5.09004 1.45495 4.86277L16.911 0.33132C17.622 0.12307 18.384 0.320307 18.908 0.842936C19.432 1.37057 19.627 2.1415 19.415 2.85636L14.842 18.319C14.613 19.0969 13.973 19.6466 13.172 19.7537C13.078 19.7657 12.987 19.7727 12.895 19.7727Z" fill="#4285F4"/>
                    </svg>
                </div>
            </div>
            <div class="myNote">
                <div class="noteCount">Bu ders <span id="count"> 0 </span> not aldın.</div>
            </div>
        </div>
        <script> 
           $(".newNote").css("display","none")
            $(".openNote").on("click",()=>{
                $(".openNote").css("display","none")
                
                $(".newNote").css("display","flex")
                $(".newNote").addClass("active")     
            })
            $(".close-Popup").on("click",()=>{
                if(screen.width>400){
                    $(".openNote").css("display","block")
                }else{
                    $(".mobile-Note").css("display","block")
                }
                $(".newNote").css("display","none")
                $(".newNote").removeClass("active")       
            })
        </script>
    </div>
    
    
    <div class="result">
        <div class="text">Bu dersi de başarıyla tamamladın <span id="name"></span> :)</div>
        <div class="score">
            <div class="star">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="28" height="28" fill="white"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.7084 5.25C13.6022 5.25 13.3409 5.27917 13.2021 5.55683L11.0717 9.81633C10.7346 10.4895 10.0847 10.9573 9.3334 11.0647L4.56406 11.7518C4.24906 11.7973 4.14173 12.0307 4.10906 12.1287C4.0799 12.2232 4.03323 12.4635 4.25023 12.6712L7.6989 15.9845C8.2484 16.513 8.49806 17.2748 8.3674 18.0203L7.5554 22.6987C7.50523 22.9915 7.6884 23.1618 7.77006 23.2202C7.8564 23.2855 8.0874 23.415 8.37323 23.2657L12.6374 21.0548C13.3094 20.7083 14.1097 20.7083 14.7794 21.0548L19.0424 23.2645C19.3294 23.4127 19.5604 23.2832 19.6479 23.2202C19.7296 23.1618 19.9127 22.9915 19.8626 22.6987L19.0482 18.0203C18.9176 17.2748 19.1672 16.513 19.7167 15.9845L23.1654 12.6712C23.3836 12.4635 23.3369 12.222 23.3066 12.1287C23.2751 12.0307 23.1677 11.7973 22.8527 11.7518L18.0834 11.0647C17.3332 10.9573 16.6834 10.4895 16.3462 9.81517L14.2136 5.55683C14.0759 5.27917 13.8146 5.25 13.7084 5.25ZM8.1049 25.0833C7.62306 25.0833 7.14473 24.9317 6.73523 24.633C6.02823 24.115 5.68173 23.2598 5.83223 22.3988L6.64423 17.7205C6.67456 17.5467 6.61506 17.3705 6.48673 17.2468L3.03806 13.9335C2.4034 13.3257 2.1759 12.4273 2.44423 11.5932C2.7149 10.7497 3.43123 10.1465 4.3144 10.0205L9.08373 9.33333C9.26806 9.30767 9.42673 9.1945 9.50606 9.0335L11.6376 4.77283C12.0307 3.98767 12.8241 3.5 13.7084 3.5C14.5927 3.5 15.3861 3.98767 15.7792 4.77283L17.9119 9.03233C17.9924 9.1945 18.1499 9.30767 18.3331 9.33333L23.1024 10.0205C23.9856 10.1465 24.7019 10.7497 24.9726 11.5932C25.2409 12.4273 25.0122 13.3257 24.3776 13.9335L20.9289 17.2468C20.8006 17.3705 20.7422 17.5467 20.7726 17.7193L21.5857 22.3988C21.7351 23.261 21.3886 24.1162 20.6804 24.633C19.9629 25.1592 19.0284 25.2303 18.2362 24.8173L13.9744 22.6088C13.8076 22.5225 13.6081 22.5225 13.4412 22.6088L9.1794 24.8185C8.83873 24.9958 8.47123 25.0833 8.1049 25.0833Z" fill="#FFC331"/>
                </svg>
            </div>
            <div class="myAddScore"></div>
        </div>
        <img src="../img/result.png" alt="Tebrik Resmi">
        <button id="PersonelButton">Devam Et</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>
        
        lessonInfo = <?php echo $listInfo?>;
        if(lessonInfo["lessonInfo"] == 1){
            document.querySelector(".exam").style.display = "none"
            document.querySelector(".infoText").textContent = lessonInfo["lessonText"]
            document.querySelector("#infoVideo").setAttribute("src",lessonInfo["lessonVideoSrc"])
            document.querySelector(".TextSubject").textContent = "Bilgilendirme"
        }else{
            document.querySelector(".info").style.display = "none"
        }

        $("#closeInfo").on("click",()=>{
            document.querySelector(".info").style.display = "none"
            document.querySelector(".exam").style.display = "block"
            document.querySelector(".TextSubject").textContent = "1. Soru"
        })
    </script>
<script>
    const array = <?php echo $listQuestion?>;
    var ipybn = 0
    if(array.length == 0){
        
    }else{
        
    }
    array.forEach(element => {
        var placeCircle = document.querySelector(".answerCircles")
        var nope = document.createElement("div")
        placeCircle.appendChild(nope)
        nope.setAttribute("id","Num"+ipybn)
        nope.setAttribute("class","circles")
        nope.setAttribute("complete","notActive")
        ipybn++
    });
</script>
<script>
    const questionContent = document.querySelector(".questionContent")
    const level = document.querySelector("#difficultyLevel")
    const subject = document.querySelector(".subject")
    const result = document.querySelector(".result")
    const images = document.querySelector(".images")
    const image = document.querySelector("#image")
    const textArea = document.querySelector(".textArea")
    const A = document.querySelector("#A")
    const B = document.querySelector("#B")
    const C = document.querySelector("#C")
    const D = document.querySelector("#D")
    const sendText = document.querySelector(".sendText")
    const sendNote= document.querySelector("#sendNote")
    const answerA = document.querySelector(".answerA")
    const answerB = document.querySelector(".answerB")
    const answerC = document.querySelector(".answerC")
    const answerD = document.querySelector(".answerD")
    const textarea = document.querySelector("textarea")
    const textDiv = document.querySelector(".textDiv")
    const questionComponent = document.querySelector(".questionComponent")
    const dragAndDrop = document.querySelector(".dragAndDrop")
    const controlDrag = document.querySelector(".controlDrag")
    var choice = document.getElementsByClassName("SpaceBlank")
    var exam = document.querySelector(".exam")
    var info = document.querySelector(".info")


    var i = 0
    let noteCount = 0
    let valuesTrue = [];
    let valuesFalse = [];
    let object,questionType;
    let difficulty,content,A_field,B_field,C_field,D_field;
    const right_answer_info = document.querySelector(".rightAnswer")
    const false_answer_info = document.querySelector(".falseAnswer")
    const nextQstnTrue = document.querySelector("#nextQstnTrue")
    const nextQstnFalse = document.querySelector("#nextQstnFalse")
    result.style.display = "none"
    right_answer_info.style.display = "none"
    false_answer_info.style.display = "none"
    var j = 1
    var dragItem = null
    const difficultyStyle = (questionLevel) =>{
        switch (questionLevel) {
            case "Kolay":
                level.style.color = "#34A853"
                break;
        
            case "Orta":
                level.style.color = "#FFC331"
                break;
            case "Zor":
                level.style.color = "#EA4335"
                break;
        }
    }
    const writeQuestion = ()=>{
        images.style.display = "none"
        textArea.style.display = "none"
        dragAndDrop.style.display = "none"
        controlDrag.style.display = "none"
        questionComponent.style.display = "block"
        sendText.style.display = "block"
        object = array[i]
        subject.textContent = ""
        if(!object && i!=0){
            document.querySelector(".TextSubject").style.display = "none"
            document.querySelector(".lessonNo").style.display = "none"
            result.style.display = "flex"
            exam.style.display = "none"
            info.style.display = "none"
            if(valuesFalse.length <= 2){
                your_score = lessonInfo["score"]
            }else if(valuesFalse.length == 3){
                your_score = lessonInfo["score"]*(3/4)
            }else if(valuesFalse.length >3){
                your_score = lessonInfo["score"]*(1/2)
            }
            document.querySelector("#name").textContent = '<?php echo $user_name?>'
            document.querySelector(".myAddScore").textContent = "+"+your_score+" puan"
            $.ajax({
                type:"POST",
                url:"./sendPyData.php",
                data: {
                    "score":your_score,
                    "email":"<?php echo $user_email?>"
                },
                dataType: "json",
                success: function(data){
                    if(data){
                        console.info("CONNECTED RESULT")
                    }else{
                        console.warn("NOT DEFINED RESULT !!!");
                    }
                }
            })
            
        }else if(!object && i==0){
            console.error("Codingo tarafından hazırlanıyor..")
            alert("Error :: Hazırlanıyor")
            window.location.href = "personal_home.php"
        }
        else{
            questionType = array[i]["questionType"]
            document.querySelector(`#Num${i}`).setAttribute("complete","isProcessing")
            document.querySelector(`#Num${i}`).style.backgroundColor = "#3ACD7E"
            document.querySelector(`#Num${i}`).style.opacity = "0.2"
            switch(questionType){
                case "ABCD-rightoption":
                    difficulty = array[i]["questionDifficulty"];
                    content = array[i]["questionSubject"];

                    A_field = array[i]["A"]
                    B_field = array[i]["B"]
                    C_field = array[i]["C"]
                    D_field = array[i]["D"]

                    level.textContent = difficulty
                    difficultyStyle(difficulty)
                    subject.textContent = content
                    A.textContent = A_field;
                    B.textContent = B_field;
                    C.textContent = C_field;
                    D.textContent = D_field;
                    break;
                case "ABCD-img":
                    images.style.display = "block"
                    difficulty = array[i]["questionDifficulty"];
                    content = array[i]["questionSubject"];

                    A_field = array[i]["A"]
                    B_field = array[i]["B"]
                    C_field = array[i]["C"]
                    D_field = array[i]["D"]
                    image.setAttribute("src","../img/questionImg/"+array[i]["questionImg"])

                    level.textContent = difficulty
                    difficultyStyle(difficulty)
                    subject.textContent = content
                    A.textContent = A_field;
                    B.textContent = B_field;
                    C.textContent = C_field;
                    D.textContent = D_field;
                    break;
                case "Textarea":
                    textArea.style.display = "block"
                    difficulty = array[i]["questionDifficulty"];
                    content = array[i]["questionSubject"];

                    level.textContent = difficulty
                    difficultyStyle(difficulty)
                    subject.textContent = content

                    questionComponent.style.display = "none"

                    break;
                case "dragAndSelect":
                    dragAndDrop.style.display = "flex"
                    controlDrag.style.display = "block"
                    difficulty = array[i]["questionDifficulty"];
                    questionComponent.style.display = "none"
                    splitSubject = array[i]["questionSubject"].split("%nbs98")
                    level.textContent = difficulty
                    difficultyStyle(difficulty)
                    content = ""
                    splitSubject.forEach(element => {
                        content += element+" nokta nokta "
                    })

                    var lastİndex = content.lastIndexOf("nokta nokta");
                    content = content.slice(0,lastİndex);

                    splitSubject.forEach(element => {
                        var text = document.createElement("div")
                        text.textContent = element
                        subject.appendChild(text)

                        var space = document.createElement("div")
                        subject.appendChild(space)

                        space.setAttribute("class","SpaceBlank")
                    });
                    subject.removeChild(subject.lastChild)

                    splitDragLetter = array[i]["privateQuestionLetter"].split("%phn0")

                    splitDragLetter.forEach(element => {
                        var letters = document.createElement("div")
                        letters.textContent = element
                        dragAndDrop.appendChild(letters)
                        letters.setAttribute("class","dragLetter")
                        letters.setAttribute("draggable","true")
                    });
                    var dragElement = document.getElementsByClassName("dragLetter")
                    for(var k of dragElement){
                        k.addEventListener("dragstart",dragStart)
                        k.addEventListener("dragend",dragEnd)
                    }
                
                    
                    for(var t of choice){
                        t.addEventListener("dragover",dragOver)
                        t.addEventListener("dragenter",dragEnter)
                        t.addEventListener("dragleave",dragLeave)
                        t.addEventListener("drop",dragDrop)
                    }
                    break;


            }
        }
    }
    function dragStart(e){
        dragItem = this
        setTimeout(() => this.style.display = "none", 0);
    }
    function dragEnd(){
        setTimeout(() => this.style.display = "block", 0);
        dragItem = this
    }

    function dragOver(e){
        e.preventDefault()
    }
    function dragEnter(e){
        e.preventDefault()
        this.style.border = "1px solid #4285F4"
    }
    function dragLeave(){
        this.style.border = "none"
    }
    function dragDrop(){
        this.append(dragItem)
        this.setAttribute("drop","true")
        var droppable = this.getAttribute("drop")
        
    }
    const ifMechanics = ()=>{
        if(answerA.classList.contains("correctAnswer")){
            answerA.classList.remove("correctAnswer")
        }else if(answerB.classList.contains("correctAnswer")){
            answerB.classList.remove("correctAnswer")
        }else if(answerC.classList.contains("correctAnswer")){
            answerC.classList.remove("correctAnswer")
        }else if(answerD.classList.contains("correctAnswer")){
            answerD.classList.remove("correctAnswer")
        }
        if(answerA.classList.contains("notCorrectAnswer")){
            answerA.classList.remove("notCorrectAnswer")
        }else if(answerB.classList.contains("notCorrectAnswer")){
            answerB.classList.remove("notCorrectAnswer")
        }else if(answerC.classList.contains("notCorrectAnswer")){
            answerC.classList.remove("notCorrectAnswer")
        }else if(answerD.classList.contains("notCorrectAnswer")){
            answerD.classList.remove("notCorrectAnswer")
        }
        if(textDiv.classList.contains("correctAnswer")){
            textDiv.classList.remove("correctAnswer")
            textarea.value = ""
        }else if(textDiv.classList.contains("notCorrectAnswer")){
            textDiv.classList.remove("notCorrectAnswer")
            textarea.value = ""
        }
    }
    writeQuestion()
    $(nextQstnTrue).on("click",()=>{
        right_answer_info.style.display = "none"
        i = i+j
        document.querySelector(".TextSubject").textContent = (i+1)+". Soru"
        ifMechanics()
        writeQuestion()
    })
    $(nextQstnFalse).on("click",()=>{
        false_answer_info.style.display = "none"
        i = i+j
        document.querySelector(".TextSubject").textContent = (i+1)+". Soru"
        ifMechanics()
        writeQuestion()
    })
    
    $(sendNote).on("click",()=>{
        let note = document.querySelector("#noteArea").value
        if(note==""){
            
        }else{
            noteCount ++
            document.querySelector("#count").textContent = noteCount
            document.querySelector("#noteArea").value = ""
            let lessonNo = '<?php echo $lessonNo?>';
            let date = "Python " + lessonNo + ". Ders"
            $.ajax({
                    type:"POST",
                    url:"./newNote.php",
                    data: {
                        "note":note,
                        "email":"<?php echo $user_email?>",
                        "date":date
                    },
                    dataType: "json",
                    success: function(result){
                        if(result.hata){
                            console.info("CONNECTED RESULT")
                        }else{
                            console.warn("NOT DEFINED RESULT !!!");
                        }
                    }
                })
            
            
            $('.myNote').append(`
            <div class="note">
                <div class="noteIcon">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="25" height="25" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2395 4.6875C12.1447 4.6875 11.9114 4.71354 11.7875 4.96146L9.88537 8.76458C9.58433 9.36562 9.00412 9.78333 8.33329 9.87917L4.07495 10.4927C3.7937 10.5333 3.69787 10.7417 3.6687 10.8292C3.64266 10.9135 3.601 11.1281 3.79474 11.3135L6.87391 14.2719C7.36454 14.7438 7.58745 15.424 7.47079 16.0896L6.74579 20.2667C6.70099 20.5281 6.86454 20.6802 6.93745 20.7323C7.01454 20.7906 7.22079 20.9062 7.47599 20.7729L11.2833 18.799C11.8833 18.4896 12.5979 18.4896 13.1958 18.799L17.002 20.7719C17.2583 20.9042 17.4645 20.7885 17.5427 20.7323C17.6156 20.6802 17.7791 20.5281 17.7343 20.2667L17.0072 16.0896C16.8906 15.424 17.1135 14.7438 17.6041 14.2719L20.6833 11.3135C20.8781 11.1281 20.8364 10.9125 20.8093 10.8292C20.7812 10.7417 20.6854 10.5333 20.4041 10.4927L16.1458 9.87917C15.476 9.78333 14.8958 9.36563 14.5947 8.76354L12.6906 4.96146C12.5677 4.71354 12.3343 4.6875 12.2395 4.6875ZM7.23641 22.3958C6.8062 22.3958 6.37912 22.2604 6.01349 21.9938C5.38225 21.5313 5.07287 20.7677 5.20724 19.999L5.93225 15.8219C5.95933 15.6667 5.9062 15.5094 5.79162 15.399L2.71245 12.4406C2.14579 11.8979 1.94266 11.0958 2.18224 10.351C2.42391 9.59792 3.06349 9.05938 3.85204 8.94688L8.11037 8.33333C8.27495 8.31042 8.41662 8.20938 8.48745 8.06563L10.3906 4.26146C10.7416 3.56042 11.45 3.125 12.2395 3.125C13.0291 3.125 13.7375 3.56042 14.0885 4.26146L15.9927 8.06458C16.0645 8.20938 16.2052 8.31042 16.3687 8.33333L20.627 8.94688C21.4156 9.05938 22.0552 9.59792 22.2968 10.351C22.5364 11.0958 22.3322 11.8979 21.7656 12.4406L18.6864 15.399C18.5718 15.5094 18.5197 15.6667 18.5468 15.8208L19.2729 19.999C19.4062 20.7688 19.0968 21.5323 18.4645 21.9938C17.8239 22.4635 16.9895 22.5271 16.2822 22.1583L12.477 20.1865C12.3281 20.1094 12.15 20.1094 12.001 20.1865L8.19579 22.1594C7.89162 22.3177 7.56349 22.3958 7.23641 22.3958Z" fill="#FFC331"/>
                    </svg>
                </div>
                <div id="${note}" class="LessonNote" >${note}</div>
            </div>
            `); 
        }
          
    })
    $("#PersonelButton").on("click",()=>{
        window.location.href = "personal_home.php"
    })

    const checkQuestion = ()=>{
        $(answerA).on("click",()=>{
            document.querySelector(`#Num${i}`).setAttribute("complete","Completed")
            var answer = array[i]["rightOption"];
            if(answer == "A"){
                valuesTrue.push(true)
                right_answer_info.style.display = "flex"
                answerA.classList.toggle("correctAnswer")
                document.querySelector(`#Num${i}`).style.opacity = "0.98"
            }else{
                valuesFalse.push(false)
                false_answer_info.style.display = "flex"
                if(answer == "B"){
                    answerB.classList.toggle("correctAnswer")
                }else if(answer == "C"){
                    answerC.classList.toggle("correctAnswer")
                }else{
                    answerD.classList.toggle("correctAnswer")
                }
                answerA.classList.toggle("notCorrectAnswer")
                document.querySelector(`#Num${i}`).style.backgroundColor = "#EA4335"
                document.querySelector(`#Num${i}`).style.opacity = "1"
            }
        })
        $(answerB).on("click",()=>{
            document.querySelector(`#Num${i}`).setAttribute("complete","Completed")
            var answer = array[i]["rightOption"];
            if(answer == "B"){
                valuesTrue.push(true)
                right_answer_info.style.display = "flex"
                answerB.classList.toggle("correctAnswer")
                document.querySelector(`#Num${i}`).style.opacity = "0.98"
            }else{
                valuesFalse.push(false)
                false_answer_info.style.display = "flex"
                if(answer == "A"){
                    answerA.classList.toggle("correctAnswer")
                }else if(answer == "C"){
                    answerC.classList.toggle("correctAnswer")
                }else{
                    answerD.classList.toggle("correctAnswer")
                }
                answerB.classList.toggle("notCorrectAnswer")
                document.querySelector(`#Num${i}`).style.backgroundColor = "#EA4335"
                document.querySelector(`#Num${i}`).style.opacity = "1"
            }
        })
        $(answerC).on("click",()=>{
            document.querySelector(`#Num${i}`).setAttribute("complete","Completed")
            var answer = array[i]["rightOption"];
            if(answer == "C"){
                valuesTrue.push(true)
                right_answer_info.style.display = "flex"
                answerC.classList.toggle("correctAnswer")
                document.querySelector(`#Num${i}`).style.opacity = "0.98"
            }else{
                valuesFalse.push(false)
                false_answer_info.style.display = "flex"
                if(answer == "A"){
                    answerA.classList.toggle("correctAnswer")
                }else if(answer == "B"){
                    answerB.classList.toggle("correctAnswer")
                }else{
                    answerD.classList.toggle("correctAnswer")
                }
                answerC.classList.toggle("notCorrectAnswer")
                document.querySelector(`#Num${i}`).style.backgroundColor = "#EA4335"
                document.querySelector(`#Num${i}`).style.opacity = "1"
            }
        })
        $(answerD).on("click",()=>{
            document.querySelector(`#Num${i}`).setAttribute("complete","Completed")
            var answer = array[i]["rightOption"];
            if(answer == "D"){
                valuesTrue.push(true)
                right_answer_info.style.display = "flex"
                answerD.classList.toggle("correctAnswer")
                document.querySelector(`#Num${i}`).style.opacity = "0.98"
            }else{
                valuesFalse.push(false)
                false_answer_info.style.display = "flex"
                if(answer == "A"){
                    answerA.classList.toggle("correctAnswer")
                }else if(answer == "B"){
                    answerB.classList.toggle("correctAnswer")
                }else{
                    answerC.classList.toggle("correctAnswer")
                }
                answerD.classList.toggle("notCorrectAnswer")
                document.querySelector(`#Num${i}`).style.backgroundColor = "#EA4335"
                document.querySelector(`#Num${i}`).style.opacity = "1"
            }
        })
        $(sendText).on("click",()=>{
            document.querySelector(`#Num${i}`).setAttribute("complete","Completed")
            var answer = array[i]["rightOption"];
            var value = document.querySelector("#valueText").value
            if(answer == value){
                valuesTrue.push(true)
                right_answer_info.style.display = "flex"
                sendText.style.display = "none"
                textDiv.classList.toggle("correctAnswer")
                document.querySelector(`#Num${i}`).style.opacity = "0.98"
            }else{
                valuesFalse.push(false)
                false_answer_info.style.display = "flex"
                sendText.style.display = "none"
                textarea.value = "Doğru Cevap : --> "+answer+" <--"
                textDiv.classList.toggle("notCorrectAnswer")
                document.querySelector(`#Num${i}`).style.backgroundColor = "#EA4335"
                document.querySelector(`#Num${i}`).style.opacity = "1"
            }
        })
        $(controlDrag).on("click",()=>{
            var controlArray = []
            var trues = []
            var falses = []
            for(var z = 0;z<choice.length;z++){
                controlArray.push(choice[z].firstChild.textContent)
            }
            var answer = array[i]["privateQuestionAnswer"].split("&")
            for(var x = 0;x<controlArray.length;x++){
                if(controlArray[x] == answer[x]){

                }else{
                    choice[x].style.backgroundColor = "rgb(234,67 ,53,.1 )"
                    choice[x].style.color = "#EA4335"
                    choice[x].style.borderColor = "#000000"
                    falses.push("false")
                }
            }
            if(falses.length != 0){
                valuesFalse.push(false)
                false_answer_info.style.display = "flex"
                document.querySelector(`#Num${i}`).style.backgroundColor = "#EA4335"
                document.querySelector(`#Num${i}`).style.opacity = "1"
            }else{
                valuesTrue.push(true)
                right_answer_info.style.display = "flex"
                document.querySelector(`#Num${i}`).style.opacity = "0.98"
            }
        })
    }
    checkQuestion()
</script>
<script>
    const speaker=document.querySelector(".speaker");
    const recognition=new  webkitSpeechRecognition();
    recognition.continous=true;
    recognition.lang="tr-TR";
    recognition.interimResults=false;
    recognition.maxAlternative=1;

    const synth=window.speechSynthesis;
    

    speaker.addEventListener("click",()=>{
        let utter = new SpeechSynthesisUtterance(content)
        synth.speak(utter)
    })
    $(document).keypress(function (event) {
        var keycode=(event.keyCode ? event.keyCode : event.which);
        
        if(keycode ==13) {
            let utter = new SpeechSynthesisUtterance(content)
            synth.speak(utter)
        }
    });
</script>
</body>
</html>