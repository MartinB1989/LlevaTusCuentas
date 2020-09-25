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

document.addEventListener("DOMContentLoaded", e =>{
    appearModal("#gasto",$modal,"no-ver",$form,"add");
    appearModal("#ingreso",$modal,"no-ver",$form, "del");
    cancelModal(".btn-cancel",$modal,"no-ver");

    // document.addEventListener("click", e =>{
    //     if(e.target.matches(".btn-cancel")){
    //         $modal.classList.add("no-ver")
    //     }
    // })
})
