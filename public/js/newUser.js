function EmailVerification(email) {
    var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex.test(email);
}

function newUserAjax(name,email,password,eduLevel,Province,School,pyLevel) {
    $.ajax({
        url:"./registerData.php",
        type:"POST",
        data: {
            "name":name,
            "email":email,
            "password":password,
            "eduLevel":eduLevel,
            "Province":Province,
            "School":School,
            "pyLevel":pyLevel
        },
        success: function(data){
            if(data == true){
                console.info("Kayıt işlemi gerçekleşmiştir. Yönlendirme Gerçekleşiyor..")
                window.location.href="./personal_home.php"
            }else{
                $(".warnCurrentUser").css("display","flex")
            }
        }
    })
}
$(".registerButton").on("click",(e)=>{

    $(".warn").css("display","none")
    $(".warnCurrentUser").css("display","none")

    let permissionEmail,permissionReCaptcha;
    //userName Get
    let userName = $(".name").val()

    //userEmail Get and Verification
    let userEmail = $(".email").val()
    if(EmailVerification(userEmail)){
        permissionEmail = true
    }else{
        permissionEmail = false
    }

    //userPassword Get
    let userPassword = $(".password").val()

    // userEducationLevel Get
    let userEducationLevel = $("#education-level").attr("value")
    
    // userProvince Get
    let userProvince = $("#province").attr("value")

    // userSchool Get
    let userSchool = $("#school").attr("value")

    // pyLevel Get
    const pyLevels = document.getElementsByName("python")
    let pyLevel;
    pyLevels.forEach(element => {
        if(element.checked === true){
            pyLevel = element["value"]
        }else{
            return
        }
    });
    if(pyLevel === undefined){
        permissionPython = false
    }else{
        permissionPython = true
    }

    //reCaptchaResponse
    var response = grecaptcha.getResponse();
    if(response.length != 0){
        permissionReCaptcha = true
    }else{
        permissionReCaptcha = false
    }

    if(userEducationLevel=="graduate"){
        if( userName != "" && 
            permissionEmail == true && 
            userPassword != "" && 
            userEducationLevel != "none" && 
            userProvince != "none" && 
            permissionPython == true && 
            permissionReCaptcha == true
        ){
            newUserAjax(userName,userEmail,userPassword,userEducationLevel,userProvince,userSchool,"")
        }else{
            $(".warn").css("display","flex")
        }
    }
    else{
        if( userName != "" && 
        permissionEmail == true && 
        userPassword != "" && 
        userEducationLevel != "none" && 
        userProvince != "none" && 
        userSchool != "none" && 
        permissionPython == true && 
        permissionReCaptcha == true
        ){
            newUserAjax(userName,userEmail,userPassword,userEducationLevel,userProvince,userSchool,pyLevel)
        }else{
            $(".warn").css("display","flex")
        }
    }
    
})