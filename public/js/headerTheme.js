import {Decryption} from '../js/decrypt.js';
function controlTheme (){
    let theme = localStorage.getItem("theme")
    if(theme === null){

    }else{
        let themeVal = Decryption(theme)
        if(themeVal == "lightTheme"){
            document.documentElement.setAttribute('data-theme', 'light')
            $("#arrowSvgColor").attr("fill","black")

            $("#mainpage").attr("stroke","black")
            $("#setting").attr("fill","black")
            $("#nots").attr("fill","black")
            $("#order").attr("fill","black")
            $("#theme").attr("fill","black")

        }else{
            document.documentElement.setAttribute('data-theme', 'dark')
            $("#arrowSvgColor").attr("fill","white")

            $("#mainpage").attr("stroke","white")
            $("#setting").attr("fill","white")
            $("#nots").attr("fill","white")
            $("#order").attr("fill","white")
            $("#theme").attr("fill","white")
        }
    }
}
controlTheme()