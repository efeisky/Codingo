//Name
const namePlace = document.querySelector(".namePlace")
const nameInput = document.querySelector(".name")
namePlace.addEventListener("click",()=>{
    nameInput.focus()
})
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

//Password New
$("#showSvgNew ").css("display","none")

$(".showNew svg").on("click",()=>{
    if($(".newPassword").attr("type") === "text"){
        $(".newPassword").attr("type","password")

        $(".showNew #hideSvgNew").css("display","none")
        $(".showNew #showSvgNew").css("display","block")
    }else{
        $(".newPassword").attr("type","text")
        
        $(".showNew #showSvgNew").css("display","none")
        $(".showNew #hideSvgNew").css("display","block")
    }
})

//Education-Level

const dropdown = document.querySelector(".dropdown-education")

const select = document.querySelector('.selectEdu')
const caret = document.querySelector('.caret')
const menu = document.querySelector('.menuEdu')
const options = document.querySelectorAll('.menuEdu li')
const selected = document.querySelector('.selected')

select.addEventListener("click",()=>{
    select.classList.toggle("select-clicked")
    caret.classList.toggle("caret-rotate")
    menu.classList.toggle("menu-open")
})

options.forEach(option =>{
    option.addEventListener("click",()=>{
        var liValue = option.getAttribute("value")
        var textValue = option.textContent
        selected.textContent = textValue
        selected.setAttribute("value",liValue)
        select.classList.remove("select-clicked")
        caret.classList.remove("caret-rotate")
        menu.classList.remove("menu-open")
        options.forEach(option =>{
            option.classList.remove("active")
        })
        option.classList.add("active")
    })
})
