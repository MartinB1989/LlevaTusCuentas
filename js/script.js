import {appearModal,cancelModal} from "./modal.js";

const validarTexto=(texto)=>{    
    if(texto!="")
    {        for(let i=0;i<=texto.length;i++)
            {   let caracter = texto.charAt(i)
                if(caracter ==" ")
                {   if(i==(texto.length-1))
                    {    return false
                    }else
                    {   continue}
                }else
                {   break}
            }
        return true
    }else
    {    return false}
}


// function cancelModal(selector,ventana,clase){
//     document.addEventListener("click", e =>{
//         if(e.target.matches(selector)){
//             ventana.classList.add(clase)
//         }
//     })
// }
let $modal =document.getElementById("modal-container"),
$form = document.getElementById("form-modal"),
$main = document.querySelector("main"),
$template = document.getElementById("template-row").content,
$fragment = document.createDocumentFragment(),
$tipo ="",
$total=document.querySelector("#total"),
$total_content = $total.textContent;
console.log($total_content)


document.addEventListener("DOMContentLoaded", e =>{
    
    appearModal("#gasto",$modal,"no-ver",$form,"del");
    appearModal("#ingreso",$modal,"no-ver",$form, "add");
    cancelModal(".btn-cancel",$modal,"no-ver");

    fetch("./php/getdatos.php",{
        method:"GET",
    })
    .then(res => res.json())
    .then(data => {
        
        data.forEach(el =>{
            if(el.length != 2){
                $template.querySelector("#detail").textContent = el[3];
                $template.querySelector("#amount").textContent =`$ ${el[2]}`;
                $template.querySelector("#date").textContent = el[1];
                if(el[5]=="i"){
                    
                    $template.querySelector("#box-titulos").classList.add("i")
                }
                if(el[5]=="g"){
                   
                    $template.querySelector("#box-titulos").classList.add("g")
                }
                

                let $clone = document.importNode($template,true);
                $fragment.appendChild($clone);
                $template.querySelector("#box-titulos").classList.remove("i")
                $template.querySelector("#box-titulos").classList.remove("g")
            }else{
                $total.textContent = el[1]
            }
            
        })
            
            $main.appendChild($fragment)
    })

    

    document.addEventListener("click", e =>{
        if(e.target.matches(".btn-add")){
            
            if(validarTexto(document.querySelector("#monto").value)){
                
                let $monto = document.querySelector("#monto").value;
                let all = new FormData()
                if($form.getAttribute("data-operation")=="add"){
                    $tipo ="i"
                    all.append("total",parseFloat($total.textContent)+parseFloat($monto))
                }else{
                    $tipo ="g"
                    all.append("total",parseFloat($total.textContent)-parseFloat($monto))
                }

                cancelModal(".btn-add",$modal,"no-ver")
                let date = new Date()
                let data = new FormData($form)
                data.append("fecha",date.toLocaleDateString())
                data.append("tipo", $tipo)
                fetch("./php/cargardatos.php",{
                    method:"POST",
                    body:data
                })
               
                
                fetch("./php/actualizartotal.php",{
                method:"POST",
                body:all})
                .then(res=> res.json())
                .then(json =>{
                    $total.textContent = json

                    console.log(json)})
                
            }

            
        }
    })
})




    

