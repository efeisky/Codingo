import {Decryption} from '../js/decrypt.js';
function controlTheme (){
    let theme = localStorage.getItem("theme")
    if(theme === null){

    }else{
        let themeVal = Decryption(theme)
        if(themeVal == "lightTheme"){
            document.documentElement.setAttribute('data-theme', 'light')
        }else{
            document.documentElement.setAttribute('data-theme', 'dark')
        }
    }
}
controlTheme()