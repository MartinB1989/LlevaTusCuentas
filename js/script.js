import {appearModal,cancelModal} from "./modal.js";


// function cancelModal(selector,ventana,clase){
//     document.addEventListener("click", e =>{
//         if(e.target.matches(selector)){
//             ventana.classList.add(clase)
//         }
//     })
// }
let $modal =document.getElementById("modal-container"),
$form = document.getElementById("form-modal");
// $template = document.getElementById("template-row").content,
// fragment = document.createDocumentFragment();

document.addEventListener("DOMContentLoaded", e =>{
    
    appearModal("#gasto",$modal,"no-ver",$form,"add");
    appearModal("#ingreso",$modal,"no-ver",$form, "del");
    cancelModal(".btn-cancel",$modal,"no-ver");

    fetch("./php/getdatos.php",{
        method:"GET"
    })
    .then(res => res.json())
    .then(data => console.log(data))
})




    

