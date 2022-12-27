const dropdown = document.querySelector(".dropdown-education")

const select = document.querySelector('.select')
const caret = document.querySelector('.caret')
const menu = document.querySelector('.menu')
const options = document.querySelectorAll('.menu li')
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