const dragArea = document.querySelector(".imgArea")
let validExtensions = ['image/jpeg','image/jpg','image/png']
$(".progressBar").css("display","none")
let input = document.querySelector("#newImg")
let file;
const uploadFile = (name) => {
    $(".progressBar").css("display","block")
    $(".popUpButton").css("display","none")
    let xhr = new XMLHttpRequest();
    xhr.open("POST","newPicture.php")
    xhr.upload.addEventListener("progress", ({loaded, total})=>{
        let fileLoaded = Math.floor((loaded / total) * 100) 
        let fileTotal = Math.floor(total / 1000)
        if(fileLoaded === 100){
            $(".content").text("Resim başarıyla yüklendi..")
            $(".progressBar").css("width",`100%`)
            $(".popUpButton").css("display","block")
        }else{
            $(".progressBar").css("width",`${fileLoaded}%`)
            $(".content").text(`Yüklenme Oranı -> ${fileLoaded}%`)
        }
        
    })
    let formData = new FormData(dragArea)
    console.log(formData)
    xhr.send(formData)
}
const fileInfo = () => {
    let fileType = file.type
    if(validExtensions.includes(fileType)){
        let fileName = file.name
        uploadFile(fileName)
    }else{
       alert("Yalnızca png/jpeg/jpg formatında olabilir.")
    }
    dragArea.classList.remove("dragEvent")
}

dragArea.onclick = () => {
    input.click()
}
input.addEventListener("change",function(){
    file = this.files[0];
    dragArea.classList.add("dragEvent")
    fileInfo()
})
dragArea.addEventListener("dragover",(event)=>{
    event.preventDefault()
    $(".content").text("Resmi buraya bırak")
    dragArea.classList.add("dragEvent")
})

dragArea.addEventListener("dragleave",()=>{
    $(".content").text("Resmi sürükle veya seç")
    dragArea.classList.remove("dragEvent")
})
dragArea.addEventListener("drop",(event)=>{
    event.preventDefault()
    dragArea.classList.remove("dragEvent")
    file = event.dataTransfer.files[0]
    fileInfo()
})

$(".popUpButton").on("click",()=>{
    $(".repeatPicturePopup").css("display","none")
})