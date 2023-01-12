<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Deneme Dersi Bilgi Formu ~ Codingo</title>
    
    <link rel="shorcut icon" href="../img/Codingo_Title.png" />

    <link rel="stylesheet" href="../css/getInfo.css" type="text/css">
    <link rel="stylesheet" href="../css/reset.css" type="text/css">
    <link rel="stylesheet" href="../css/practice.css" type="text/css">
    <script src="../js/jquery-3.6.0.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header">
        <a class="logos" href="./homepage.html">
            <div class="logo">
                <svg viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg" id="homeIcon">
                    <path d="M13.3543 30.2916V25.8193C13.3542 24.6818 14.2816 23.7575 15.4306 23.7498H19.6395C20.794 23.7498 21.7299 24.6764 21.7299 25.8193V25.8193V30.3055C21.7296 31.2714 22.5083 32.0607 23.4836 32.0834H26.2895C29.0866 32.0834 31.3542 29.8385 31.3542 27.0694V27.0694V14.3469C31.3392 13.2575 30.8226 12.2345 29.9512 11.569L20.355 3.91608C18.6739 2.58355 16.284 2.58355 14.6029 3.91608L5.04878 11.5829C4.17412 12.2457 3.6566 13.2704 3.64583 14.3608V27.0694C3.64583 29.8385 5.91335 32.0834 8.71049 32.0834H11.5164C12.5159 32.0834 13.3262 31.2812 13.3262 30.2916V30.2916" stroke="#3ACD7E" stroke-opacity="0.98" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="Text">Codingo</div>
            </div>
        </a>
    </div>
    <div class="getDiv">
        <div class="headText">Demek ki deneme dersine katılmak istiyorsun aşağıdakileri doldurur musun?</div>
        <div class="personalInfo">
            <div class="dropdown-education">
                <div class="select">
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
                <ul class="menu">
                    <li value="primary-school">İlkokul</li>
                    <li value="secondary-school">Ortaokul</li>
                    <li value="high-school">Lise</li>
                    <li value="graduate">Mezun</li>
                </ul>
            </div>
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
            <button type="submit" id="startLesson" class="noActive">Derse Başla</button>      
        </div>
    </div>
    <script>
        let accessEducation,accessPy;
        const buttonStyle = () =>{
            if(accessEducation === true && accessPy === true){
                document.querySelector("#startLesson").setAttribute("class","Active")
            }else{
                
            }
        }
        $(".menu li").on("click",()=>{
            accessEducation = true
            buttonStyle()
        })

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

        $("#startLesson").on("click",()=>{
            const dropdownValue = document.querySelector("#education-level").getAttribute("value")
            const pyLevels = document.getElementsByName("python")
            let pyLevel;
            pyLevels.forEach(element => {
                if(element.checked === true){
                    pyLevel = element["value"]
                }else{
                    return
                }
            });
            $.ajax({
                type:"POST",
                url:"./dataPilot.php",
                data: {
                    "education-level":dropdownValue,
                    "pyLevel":pyLevel
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
            window.location.href = "./pilot_lesson.php"
        })
    </script>
    <script>
        $(document).on('click', 'input[type="checkbox"]', function(){
    
            $("input[type='checkbox']").not(this).prop('checked', false)
        });
        
    </script>
    <script src="../js/appStyle.js"></script>
    <script type="module" src="../js/controlAnotherTheme.js"></script>
</body>
</html>