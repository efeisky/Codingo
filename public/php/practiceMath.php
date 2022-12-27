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
$school_level = $check["education_level"];
$lessonNo = $check["lessonNo"];
$selectQuestions = $db->query("SELECT * FROM questions WHERE lessonType= 'Matematik' AND questionLevel='{$school_level}' AND lessonID<='{$lessonNo}' ORDER BY rand()");
$listQuestion = array();
foreach ($selectQuestions as $question) {
    array_push($listQuestion,$question);
}
$questions = json_encode($listQuestion);
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
    <title>Pratik Yap | Matematik ~ Codingo</title>
    
    <!--Link Tag-->
    <link rel="stylesheet" href="../css/reset.css" type="text/css">
    <link rel="stylesheet" href="../css/practice.css" type="text/css">
    <link rel="stylesheet" href="../css/lesson.css" type="text/css">
    <style>
        #outLesson{
            margin: 10px 0 0 10px;
            display: flex;
            gap: 10px;
            cursor: pointer;
            align-items: center;
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
        .level{
            font-family: "Montserrat", sans-serif;
            font-weight: 500;
            text-align: center;
        }
        #difficultyLevel{
            font-weight: 600;
        }      
        .subject
        {
            font-family: "Montserrat", sans-serif;
            font-weight: 500;
            text-align: center;
        }
        .outText{
            font-family: "Montserrat", sans-serif;
            font-weight: 500;
            text-align: center;
            color: #3ACD7E;
        } 
        @media only screen and (max-width: 400px) {
            .sameTrue{
                position: absolute;
                left: 30px;
                bottom: 20px;
                padding: 10px 15px;
                color:#3ACD7E;
                font-size: 14px;
                background: none;
                border: 1px solid #3ACD7E;
                cursor: pointer;
                border-radius: 10px;
            }
            .sameFalse{
                position: absolute;
                left: 30px;
                bottom: 20px;
                padding: 10px 15px;
                color: #EA4335;
                font-size: 14px;
                background: none;
                border: 1px solid #EA4335;
                cursor: pointer;
                border-radius: 10px;
            }
            .icon{
                width: 20px;
            }
            .outText{
                font-size: 16px;
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
            
        }
        @media only screen and (max-width: 767px) and (min-width: 401px){
            .sameTrue{
                position: absolute;
                left: 30px;
                bottom: 25px;
                padding: 10px 15px;
                color:#3ACD7E;
                font-size: 14px;
                background: none;
                border: 1px solid #3ACD7E;
                cursor: pointer;
                border-radius: 10px;
            }
            .sameFalse{
                position: absolute;
                left: 30px;
                bottom: 25px;
                padding: 10px 15px;
                color: #EA4335;
                font-size: 14px;
                background: none;
                border: 1px solid #EA4335;
                cursor: pointer;
                border-radius: 10px;
            }
            .icon{
                width: 24px;
            }
            .outText{
                font-size: 18px;
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
        }
        @media only screen and (max-width: 1919px) and (min-width: 767px) {
            .buttons{
                display: flex;
                gap: 30px;
            }
            .sameTrue{
                color:#3ACD7E;
                font-size: 18px;
                background: none;
                padding: 15px 20px;
                border-radius: 10px;
                border: 1px solid #3ACD7E;
                cursor: pointer;
            }
            .sameFalse{
                color: #EA4335;
                font-size: 18px;
                background: none;
                padding: 15px 20px;
                border-radius: 10px;
                border: 1px solid #EA4335;
                cursor: pointer;
            }
            .icon{
                width: 30px;
            }
            .outText{
                font-size: 22px;
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

        }
        @media only screen and (min-width: 1920px) {
            .buttons{
                display: flex;
                gap: 40px;
            }
            .sameTrue{
                color:#3ACD7E;
                font-size: 22px;
                background: none;
                padding: 25px;
                border-radius: 10px;
                border: 1px solid #3ACD7E;
                cursor: pointer;
            }
            .sameFalse{
                color: #EA4335;
                font-size: 22px;
                background: none;
                padding: 25px;
                border-radius: 10px;
                border: 1px solid #EA4335;
                cursor: pointer;
            }
            .icon{
                width: 30px;
            }
            .outText{
                font-size: 22px;
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
        }
        @media only screen and (min-width: 1921px) {
            .buttons{
                display: flex;
                gap: 40px;
            }
            .sameTrue{
                color:#3ACD7E;
                font-size: 22px;
                background: none;
                padding: 25px;
                border-radius: 10px;
                border: 1px solid #3ACD7E;
                cursor: pointer;
            }
            .sameFalse{
                color: #EA4335;
                font-size: 22px;
                background: none;
                padding: 25px;
                border-radius: 10px;
                border: 1px solid #EA4335;
                cursor: pointer;
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
        <div class="lessonNo TextSubject">Pratik Yap</div>
        
    </div>
    <div id="outLesson">
        <div class="icon">
            <svg viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.1355 2.5C17.193 2.5 19.6805 4.9875 19.6805 8.045V9.21C19.6805 9.7275 19.2605 10.1475 18.743 10.1475C18.2255 10.1475 17.8055 9.7275 17.8055 9.21V8.045C17.8055 6.02 16.1592 4.375 14.1355 4.375H8.04174C6.02049 4.375 4.37549 6.02 4.37549 8.045V21.9562C4.37549 23.98 6.02049 25.625 8.04174 25.625H14.1492C16.1642 25.625 17.8055 23.985 17.8055 21.97V20.7913C17.8055 20.2738 18.2255 19.8538 18.743 19.8538C19.2605 19.8538 19.6805 20.2738 19.6805 20.7913V21.97C19.6805 25.02 17.198 27.5 14.1492 27.5H8.04174C4.98674 27.5 2.50049 25.0137 2.50049 21.9562V8.045C2.50049 4.9875 4.98674 2.5 8.04174 2.5H14.1355ZM24.2356 10.6925L27.8956 14.3362C27.9283 14.3687 27.9575 14.4023 27.9843 14.438L27.8956 14.3362C27.9399 14.3799 27.9793 14.4276 28.0135 14.4785C28.0285 14.5016 28.043 14.5254 28.0565 14.5499C28.0674 14.569 28.0774 14.589 28.0867 14.6093C28.0946 14.6273 28.1022 14.6452 28.1092 14.6635C28.1186 14.6872 28.1269 14.7116 28.1341 14.7364C28.1396 14.7559 28.1446 14.7753 28.149 14.795C28.1546 14.8189 28.159 14.8429 28.1624 14.8671C28.1644 14.8828 28.1663 14.8993 28.1678 14.9159C28.1706 14.9445 28.1719 14.9722 28.1719 15L28.1655 15.0775L28.1629 15.1272C28.1626 15.1293 28.1623 15.1314 28.162 15.1335L28.1719 15C28.1719 15.0694 28.1642 15.1381 28.1492 15.2049C28.1446 15.2247 28.1396 15.2441 28.134 15.2633C28.1269 15.2884 28.1186 15.3128 28.1094 15.3368C28.1022 15.3548 28.0946 15.3727 28.0865 15.3904C28.0774 15.411 28.0674 15.431 28.0566 15.4506C28.043 15.4746 28.0285 15.4984 28.013 15.5216C28.0042 15.5353 27.9946 15.5488 27.9846 15.5621C27.9548 15.6012 27.9224 15.6381 27.8873 15.6722L24.2356 19.3087C24.0531 19.4912 23.8131 19.5825 23.5744 19.5825C23.3344 19.5825 23.0931 19.4912 22.9106 19.3062C22.5456 18.9387 22.5469 18.3463 22.9131 17.9813L24.963 15.9375H12.1827C11.6652 15.9375 11.2452 15.5175 11.2452 15C11.2452 14.4825 11.6652 14.0625 12.1827 14.0625H24.9655L22.9131 12.02C22.5469 11.655 22.5444 11.0625 22.9106 10.695C23.2756 10.3275 23.8681 10.3275 24.2356 10.6925Z" fill="#3ACD7E" fill-opacity="0.98"/>
            </svg>
        </div>
        <div class="outText">Dersten Çık</div>
    </div>
    <div class="exam">
        <div class="questionContent">
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
                <div class="buttons">
                    <button class="sameQuestionGet sameTrue">Benzer Soruları Getir</button>
                    <button id="nextQstnTrue">Yeni Soruya Geç</button>
                </div>
                
  
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

                <div class="buttons">
                    <button class="sameQuestionGet sameFalse">Benzer Soruları Getir</button>
                    <button id="nextQstnFalse">Yeni Soruya Geç</button>
                </div>
            </div>
            </div>
        </div>
        
    </div>
    
    
    <div class="result">
        <div class="text"></div>
        <button id="PersonelButton">Anasayfaya dön</button>
    </div>
    <script src="../js/jquery-3.6.0.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
    let array = <?php echo $questions?>;
    document.querySelector(".TextSubject").textContent = "1. Soru"
    $("#outLesson").on("click",()=>{
        window.location.href = "personal_home.php"
    })
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

    var i = 0
    var questionNumber = 1
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
            i = 0
            function sortRandom(list) {
                var ctr = list.length, temp, index;
            
                while (ctr > 0) {
            
                    index = Math.floor(Math.random() * ctr);
            
                    ctr--;
                    temp = list[ctr];
                    list[ctr] = list[index];
                    list[index] = temp;
                }
                return list;
            }
            sortRandom(array)
            writeQuestion()    
        }else if(!object && i==0){
            console.error("Codingo tarafından hazırlanıyor..")
            alert("Error :: Hazırlanıyor")
            window.location.href = "personal_home.php"
        }
        else{
            questionType = array[i]["questionType"]
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

    writeQuestion()
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
    $(nextQstnTrue).on("click",()=>{
        right_answer_info.style.display = "none"
        i = i+j
        questionNumber++
        document.querySelector(".TextSubject").textContent = (questionNumber)+". Soru"
        ifMechanics()
        writeQuestion()
    })
    $(nextQstnFalse).on("click",()=>{
        false_answer_info.style.display = "none"
        i = i+j
        questionNumber++
        document.querySelector(".TextSubject").textContent = (questionNumber)+". Soru"
        ifMechanics()
        writeQuestion()
    })
    $(".sameQuestionGet").on("click",()=>{
        var currentKeyValue = array[i]["keyValue"]
        var currentValue = array[i]
        var otherKeyValues = []
        array.forEach(element => {
            if(element != currentValue){
                otherKeyValues.push(element)
            }
        });
        for (let index = 0; index < otherKeyValues.length; index++) {
            var forValue = otherKeyValues[index]["keyValue"]
            if(currentKeyValue === forValue){
                right_answer_info.style.display = "none"
                false_answer_info.style.display = "none"
                newSelectedQuestion = otherKeyValues[index]
                console.log(newSelectedQuestion)
                splitListpush = array.slice(0,i+1)
                splitListpush.push(newSelectedQuestion)
                splitListconcat = array.slice(-i+1)
                array = splitListpush.concat(splitListconcat)
                i = i+j
                questionNumber++
                document.querySelector(".TextSubject").textContent = (questionNumber)+". Soru"
                ifMechanics()
                writeQuestion()
                break;
            }else{
                alert("İstediğiniz soruyu şuanda üretemiyoruz.. Bu durum için Codingo olarak özür dileriz..")
            }
        }
    })
    
    $("#outLesson").on("click",()=>{
        window.location.href = "personal_home.php"
    })

    const checkQuestion = ()=>{
        $(answerA).on("click",()=>{
            var answer = array[i]["rightOption"];
            if(answer == "A"){
                right_answer_info.style.display = "flex"
                answerA.classList.toggle("correctAnswer")
            }else{
                false_answer_info.style.display = "flex"
                if(answer == "B"){
                    answerB.classList.toggle("correctAnswer")
                }else if(answer == "C"){
                    answerC.classList.toggle("correctAnswer")
                }else{
                    answerD.classList.toggle("correctAnswer")
                }
                answerA.classList.toggle("notCorrectAnswer")
            }
        })
        $(answerB).on("click",()=>{
            var answer = array[i]["rightOption"];
            if(answer == "B"){
                right_answer_info.style.display = "flex"
                answerB.classList.toggle("correctAnswer")
            }else{
                false_answer_info.style.display = "flex"
                if(answer == "A"){
                    answerA.classList.toggle("correctAnswer")
                }else if(answer == "C"){
                    answerC.classList.toggle("correctAnswer")
                }else{
                    answerD.classList.toggle("correctAnswer")
                }
                answerB.classList.toggle("notCorrectAnswer")
            }
        })
        $(answerC).on("click",()=>{
            var answer = array[i]["rightOption"];
            if(answer == "C"){
                right_answer_info.style.display = "flex"
                answerC.classList.toggle("correctAnswer")
            }else{
                false_answer_info.style.display = "flex"
                if(answer == "A"){
                    answerA.classList.toggle("correctAnswer")
                }else if(answer == "B"){
                    answerB.classList.toggle("correctAnswer")
                }else{
                    answerD.classList.toggle("correctAnswer")
                }
                answerC.classList.toggle("notCorrectAnswer")
            }
        })
        $(answerD).on("click",()=>{
            var answer = array[i]["rightOption"];
            if(answer == "D"){
                right_answer_info.style.display = "flex"
                answerD.classList.toggle("correctAnswer")
            }else{
                false_answer_info.style.display = "flex"
                if(answer == "A"){
                    answerA.classList.toggle("correctAnswer")
                }else if(answer == "B"){
                    answerB.classList.toggle("correctAnswer")
                }else{
                    answerC.classList.toggle("correctAnswer")
                }
                answerD.classList.toggle("notCorrectAnswer")
            }
        })
        $(sendText).on("click",()=>{
            var answer = array[i]["rightOption"];
            var value = document.querySelector("#valueText").value
            if(answer == value){
                right_answer_info.style.display = "flex"
                sendText.style.display = "none"
                textDiv.classList.toggle("correctAnswer")
            }else{
                false_answer_info.style.display = "flex"
                sendText.style.display = "none"
                textarea.value = "Doğru Cevap : --> "+answer+" <--"
                textDiv.classList.toggle("notCorrectAnswer")
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
                false_answer_info.style.display = "flex"
            }else{
                right_answer_info.style.display = "flex"
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