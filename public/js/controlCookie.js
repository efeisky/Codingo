import {Decryption} from './decrypt.js';

const cookies = document.cookie.split(";")
if(cookies.length>=2){
    //Email Find
    let emailValue = cookies[0].split("=")[1];
    let cookieEmail = Decryption(emailValue);

    //Password Find

    let passwordValue = cookies[1].split("=")[1];
    let cookiePassword = Decryption(passwordValue);

    $.ajax({
        url:"./loginDatas.php",
        type:"POST",
        data: {"ourEmail":cookieEmail,"ourPassword":cookiePassword},
        success: function(data){
            if(data == true){
                window.location.href = "./personal_home.php"
            }else{
            }
        }
    })
}else{
}

