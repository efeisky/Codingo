import {encryption} from '../js/encrypt.js';
import {Decryption} from './decrypt.js';

$("#theme svg").on("click",()=>{
    themeMode()
})
$("#themeMobile svg").on("click",()=>{
    themeMode()
})
let themeMode = () =>{
    if(document.documentElement.getAttribute("data-theme") == null || document.documentElement.getAttribute("data-theme") == "light"){
        document.documentElement.setAttribute('data-theme', 'dark')
        document.querySelector("#themeColor").setAttribute("fill","white")

        document.querySelector("#register1").setAttribute("fill","white")
        document.querySelector("#register2").setAttribute("fill","white")
        document.querySelector("#register3").setAttribute("fill","white")

        document.querySelector("#login1").setAttribute("stroke","white")
        document.querySelector("#login2").setAttribute("stroke","white")
        document.querySelector("#login3").setAttribute("stroke","white")

        document.querySelector("#menu").setAttribute("fill","white")
        themeLocal("darkTheme")
    }else{
        document.documentElement.setAttribute('data-theme', 'light')
        document.querySelector("#themeColor").setAttribute("fill","black")
        
        document.querySelector("#register1").setAttribute("fill","black")
        document.querySelector("#register2").setAttribute("fill","black")
        document.querySelector("#register3").setAttribute("fill","black")

        document.querySelector("#login1").setAttribute("stroke","black")
        document.querySelector("#login2").setAttribute("stroke","black")
        document.querySelector("#login3").setAttribute("stroke","black")

        document.querySelector("#menu").setAttribute("fill","black")
        themeLocal("lightTheme")
    }
}
let themeLocal = (theme)=>{
    let themeEnc = encryption(theme);
    localStorage.setItem("theme",themeEnc)
}

let controlTheme = ()=>{
    let theme = localStorage.getItem("theme")
    if(theme === null){

    }else{
        let themeVal = Decryption(theme)
        if(themeVal == "lightTheme"){
            document.documentElement.setAttribute('data-theme', 'light')
            document.querySelector("#themeColor").setAttribute("fill","black")
            
            document.querySelector("#register1").setAttribute("fill","black")
            document.querySelector("#register2").setAttribute("fill","black")
            document.querySelector("#register3").setAttribute("fill","black")

            document.querySelector("#login1").setAttribute("stroke","black")
            document.querySelector("#login2").setAttribute("stroke","black")
            document.querySelector("#login3").setAttribute("stroke","black")

            document.querySelector("#menu").setAttribute("fill","black")
        }else{
            document.documentElement.setAttribute('data-theme', 'dark')
            document.querySelector("#themeColor").setAttribute("fill","white")

            document.querySelector("#register1").setAttribute("fill","white")
            document.querySelector("#register2").setAttribute("fill","white")
            document.querySelector("#register3").setAttribute("fill","white")

            document.querySelector("#login1").setAttribute("stroke","white")
            document.querySelector("#login2").setAttribute("stroke","white")
            document.querySelector("#login3").setAttribute("stroke","white")

            document.querySelector("#menu").setAttribute("fill","white")
        }
    }
}
controlTheme()