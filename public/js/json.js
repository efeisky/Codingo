let province,education_level;
let selectOptionSchool,dropdownSchool,selectSchool,caretSchool,menuSchool,selectedSchool;
function deleteSelect(){
    $(".schoolMenu").empty()
}
function getActive(){
    province = document.querySelector("#province").textContent
    education_level = document.querySelector("#education-level").getAttribute("value")
    if(education_level === "graduate"){
        $(".dropdown-school").css("display","none")
    }else{
        $(".dropdown-school").css("display","block")
    }
    schoolSelect()
}
function schoolSelect(){
    var data = fetch("../json/okullar.json")
    .then(response => response.json())
    .then(data =>{
        deleteSelect()
            if(education_level == "primary-school"){
                path = data[`${province}`]["0"]["İlkokul"]
                data_list_length = Object.keys(path).length

                for(var i=0;i<data_list_length;i++){
                    var schoolName = path[`${i}`]["OKULADI"]
                    var option = document.createElement("li")
                    option.setAttribute("value",schoolName)
                    option.setAttribute("class","schoolLi")
                    option.textContent = schoolName
                    const selection = document.querySelector(".schoolMenu");
                    selection.appendChild(option)
                }
                selectOptionSchool = document.querySelectorAll('.schoolLi');
                dropdownSchool = document.querySelector(".dropdown-school");
                selectSchool = document.querySelector('.selectSchool');
                caretSchool = document.querySelector('.caretSchool svg');
                menuSchool = document.querySelector('.schoolMenu');
                selectedSchool = document.querySelector('#school');
                
                $(selectSchool).on("click",()=>{
                    selectSchool.classList.toggle("select-clicked")
                    caretSchool.classList.toggle("caret-rotate")
                    menuSchool.classList.toggle("schoolOpen")
                })
                
                selectOptionSchool.forEach(option =>{
                        option.addEventListener("click",()=>{
                            var liValue = option.getAttribute("value")
                            var textValue = option.textContent
                            selectedSchool.textContent = textValue
                            selectedSchool.setAttribute("value",liValue)
                            selectSchool.classList.remove("select-clicked")
                            caretSchool.classList.remove("caret-rotate")
                            menuSchool.classList.remove("schoolOpen")
                            selectOptionSchool.forEach(option =>{
                                option.classList.remove("active")
                            })
                            option.classList.add("active")
                        })
                })
                
            }else if(education_level == "secondary-school"){
                path = data[`${province}`]["0"]["Ortaokul"]
                data_list_length = Object.keys(path).length
                for(var i=0;i<data_list_length;i++){
                    var schoolName = path[`${i}`]["OKULADI"]
                    var option = document.createElement("li")
                    option.setAttribute("value",schoolName)
                    option.setAttribute("class","schoolLi")
                    option.textContent = schoolName
                    const selection = document.querySelector(".schoolMenu");
                    selection.appendChild(option)
                }
                
                selectOptionSchool = document.querySelectorAll('.schoolLi');
                dropdownSchool = document.querySelector(".dropdown-school");
                selectSchool = document.querySelector('.selectSchool');
                caretSchool = document.querySelector('.caretSchool svg');
                menuSchool = document.querySelector('.schoolMenu');
                selectedSchool = document.querySelector('#school');
                
                $(selectSchool).on("click",()=>{
                    selectSchool.classList.toggle("select-clicked")
                    caretSchool.classList.toggle("caret-rotate")
                    menuSchool.classList.toggle("schoolOpen")
                })
                
                selectOptionSchool.forEach(option =>{
                        option.addEventListener("click",()=>{
                            var liValue = option.getAttribute("value")
                            var textValue = option.textContent
                            selectedSchool.textContent = textValue
                            selectedSchool.setAttribute("value",liValue)
                            selectSchool.classList.remove("select-clicked")
                            caretSchool.classList.remove("caret-rotate")
                            menuSchool.classList.remove("schoolOpen")
                            selectOptionSchool.forEach(option =>{
                                option.classList.remove("active")
                            })
                            option.classList.add("active")
                        })
                })

            }else if(education_level == "high-school"){
                path = data[`${province}`]["0"]["Lise"]
                data_list_length = Object.keys(path).length
                for(var i=0;i<data_list_length;i++){
                    var schoolName = path[`${i}`]["OKULADI"]
                    var option = document.createElement("li")
                    option.setAttribute("value",schoolName)
                    option.setAttribute("class","schoolLi")
                    option.textContent = schoolName
                    const selection = document.querySelector(".schoolMenu");
                    selection.appendChild(option)
                }
                selectOptionSchool = document.querySelectorAll('.schoolLi');
                dropdownSchool = document.querySelector(".dropdown-school");
                selectSchool = document.querySelector('.selectSchool');
                caretSchool = document.querySelector('.caretSchool svg');
                menuSchool = document.querySelector('.schoolMenu');
                selectedSchool = document.querySelector('#school');
                
                $(selectSchool).on("click",()=>{
                    selectSchool.classList.toggle("select-clicked")
                    caretSchool.classList.toggle("caret-rotate")
                    menuSchool.classList.toggle("schoolOpen")
                })
                
                selectOptionSchool.forEach(option =>{
                        option.addEventListener("click",()=>{
                            var liValue = option.getAttribute("value")
                            var textValue = option.textContent
                            selectedSchool.textContent = textValue
                            selectedSchool.setAttribute("value",liValue)
                            selectSchool.classList.remove("select-clicked")
                            caretSchool.classList.remove("caret-rotate")
                            menuSchool.classList.remove("schoolOpen")
                            selectOptionSchool.forEach(option =>{
                                option.classList.remove("active")
                            })
                            option.classList.add("active")
                        })
                })
            }

    })
}


var data = fetch("../json/province.json")
    .then(response => response.json())
    .then(data =>{
        data_list_length = Object.keys(data).length
        for(var i=1;i<=data_list_length;i++){
            var provinceName = data[`${i}`]
            var option = document.createElement("li")
            option.textContent = provinceName
            option.setAttribute("value",provinceName)
            option.setAttribute("class","provinceLi")
            const selection = document.querySelector(".provinceMenu");
            selection.appendChild(option)
        }
        const selectOptionPro = document.querySelectorAll('.provinceLi');
        const dropdownPro = document.querySelector(".dropdown-province");
        const selectPro = document.querySelector('.selectPro');
        const caretPro = document.querySelector('.caretPro svg');
        const menuPro = document.querySelector('.provinceMenu');
        const selectedPro = document.querySelector('#province');

        $(selectPro).on("click",()=>{
            selectPro.classList.toggle("select-clicked")
            caretPro.classList.toggle("caret-rotate")
            menuPro.classList.toggle("proOpen")
        })

        selectOptionPro.forEach(option =>{
            option.addEventListener("click",()=>{
                var liValue = option.getAttribute("value")
                var textValue = option.textContent
                selectedPro.textContent = textValue
                selectedPro.setAttribute("value",liValue)
                selectPro.classList.remove("select-clicked")
                caretPro.classList.remove("caret-rotate")
                menuPro.classList.remove("proOpen")
                selectOptionPro.forEach(option =>{
                    option.classList.remove("active")
                })
                option.classList.add("active")
            })
        })
        getActive()

        $(".provinceLi").on("click",()=>{
            getActive()
        })
})

