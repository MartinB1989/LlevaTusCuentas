$template = document.getElementById("template-row").content,
fragment = document.createDocumentFragment()

document.addEventListener("DOMContentLoaded", e=>{
    fetch("./php/getdatos.php",{
        method:"GET",
    })
    .then(res => res.json())
    .then(data => console.log(data))

})