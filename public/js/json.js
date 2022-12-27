var education_level = "primary-school"
var province = "ADANA"

function deleteSelect(){
    const parent_school = document.querySelector(".schoolSelect")
    var school = document.getElementById("school");
    parent_school.removeChild(school)
    var select= document.createElement("select")
    parent_school.appendChild(select)
    var selects = document.querySelector(".schoolSelect > select")
    selects.setAttribute("name","school")
    selects.setAttribute("id","school")
}

function getEducation(){
    education_level = document.querySelector("#education-level").value
    schoolSelect()
}
function getProvince(){
    province = document.querySelector("#province").value
    schoolSelect()
}
function schoolSelect(){
    var data = fetch("../json/okullar.json")
    .then(response => response.json())
    .then(data =>{
        if(education_level!=undefined && province!=undefined){

            if(education_level == "primary-school"){
                deleteSelect()
                path = data[`${province}`]["0"]["İlkokul"]
                data_list_length = Object.keys(path).length
                for(var i=0;i<data_list_length;i++){
                    var schoolName = path[`${i}`]["OKULADI"]
                    var option = document.createElement("option")
                    option.textContent = schoolName
                    const selection = document.querySelector("#school");
                    selection.appendChild(option)
                }
                
            }else if(education_level == "secondary-school"){
                deleteSelect()
                path = data[`${province}`]["0"]["Ortaokul"]
                data_list_length = Object.keys(path).length
                for(var i=0;i<data_list_length;i++){
                    var schoolName = path[`${i}`]["OKULADI"]
                    var option = document.createElement("option")
                    option.textContent = schoolName
                    const selection = document.querySelector("#school");
                    selection.appendChild(option)
                }
                
            }else if(education_level == "high-school"){
                deleteSelect()
                path = data[`${province}`]["0"]["Lise"]
                data_list_length = Object.keys(path).length
                for(var i=0;i<data_list_length;i++){
                    var schoolName = path[`${i}`]["OKULADI"]
                    var option = document.createElement("option")
                    option.textContent = schoolName
                    const selection = document.querySelector("#school");
                    selection.appendChild(option)
                }
            }else{
                
            }

            
            
        
        }else{
        }
    })
}


var data = fetch("../json/province.json")
    .then(response => response.json())
    .then(data =>{
        data_list_length = Object.keys(data).length
        for(var i=1;i<data_list_length;i++){
            var schoolName = data[`${i}`]
            var option = document.createElement("option")
            option.textContent = schoolName
            const selection = document.querySelector("#province");
            selection.appendChild(option)
        }
    })

