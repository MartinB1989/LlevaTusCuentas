import {appearModal,cancelModal} from "./modal.js";

// -------------FUNCIONES-------------------
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
const eliminarExp=(text="")=>{
    let array = []
    for(let i=0; i<text.length;i++)
    {
        array.push(text.charAt(i))
    }

    array.splice(0,2)
    array = array.join("")
    return array

}

//------------VARIABLES----------------------
let $modal =document.getElementById("modal-container"),
$form = document.getElementById("form-modal"),
$main = document.querySelector("main"),
$template = document.getElementById("template-row").content,
$fragment = document.createDocumentFragment(),
$tipo ="",
$total=document.querySelector("#total"),
$btnadd = document.querySelector(".btn-add"),$uno,$dos,$id_prod,$det,$mon,$padre,iog;



//----------------------EVENTO PRINCIPAL-------------------------
document.addEventListener("DOMContentLoaded", e =>{
    
    //-------------BOTONES "AGREGAR" Y "GASTO"-----------------
    appearModal("#gasto",$modal,"no-ver",$form,"del");
    appearModal("#ingreso",$modal,"no-ver",$form, "add");
    cancelModal(".btn-cancel",$modal,"no-ver");
    //-------------------CARGA DE DATOS EN EL DOM------------------
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
                $template.querySelector(".id-prod").value = el[0]
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

    
    //------------------EVENTO CLICK-------------------------

    document.addEventListener("click", e =>{
        //----------------BOTÓN "ACEPTAR" EN VENTANA MODAL PARA "INGRESAR"------------------
        if(e.target.matches(".btn-add")){
            
            if(validarTexto(document.querySelector("#monto").value)){
                $modal.classList.add("no-ver")
                let $monto = document.querySelector("#monto").value;
                let all = new FormData()
                if($form.getAttribute("data-operation")=="add"){
                    $tipo ="i"
                    all.append("total",parseFloat($total.textContent)+parseFloat($monto))
                }else{
                    $tipo ="g"
                    all.append("total",parseFloat($total.textContent)-parseFloat($monto))
                }

               
                let date = new Date()
                let data = new FormData($form)
                data.append("fecha",date.toLocaleDateString())
                data.append("tipo", $tipo)
                fetch("./php/cargardatos.php",{
                    method:"POST",
                    body:data
                })
                .then(res => res.json())
                .then(json => console.log(json))
               
                // let $det = $form.children[0].value,
                //     $mont = $form.children[3].value;
    
                fetch("./php/actualizartotal.php",{
                method:"POST",
                body:all})
                .then(res=> res.json())
                .then(json =>{
                    location.reload();

                    // $total.textContent = json
                    // $template.querySelector("#detail").textContent = $det;
                    // $template.querySelector("#amount").textContent =`$ ${$mont}`;
                    // $template.querySelector("#date").textContent = date.toLocaleDateString();
                    // if($form.getAttribute("data-operation")=="add"){
                    //     $template.querySelector("#box-titulos").classList.add("i")
                    // }else{
                    //     $template.querySelector("#box-titulos").classList.add("g")
                    // }
                    // let $clone = document.importNode($template,true);
                    // $fragment.appendChild($clone);
                    // $main.appendChild($fragment)
                    // $template.querySelector("#box-titulos").classList.remove("i")
                    // $template.querySelector("#box-titulos").classList.remove("g")

                })
                
            }else{
                
                let err = document.createElement("span")
                err.style.color = "red"
                err.innerHTML = "<br>Introduce un monto"
                $form.appendChild(err)
                setTimeout(()=>{
                    $form.removeChild(err)
                },3000)
            }


            
        }
        //----------------------BOTÓN "EDITAR"-----------------
        if(e.target.matches(".btn-editar")){
            $btnadd.classList.replace("btn-add","btn-edit")
            $uno = e.target.parentElement.parentElement.children[0].textContent;
            $dos = eliminarExp(e.target.parentElement.parentElement.children[1].textContent);
            $id_prod = e.target.parentElement.children[2].value;
            $det=e.target.parentElement.parentElement.children[0];
            $mon=e.target.parentElement.parentElement.children[1];
            $padre = e.target.parentElement.parentElement;
            iog = $padre.getAttribute("class");
            
            $modal.classList.remove("no-ver")
            $form.setAttribute("data-operation","edit")
            
            
            $form.detalle.value = $uno
            $form.monto.value = $dos
            document.addEventListener("click", e =>{
                //----------BOTÓN "ACEPTAR" PARA EDITAR-------------
                if(e.target.matches(".btn-edit")){
                    if(validarTexto(document.querySelector("#monto").value)){
                        $btnadd.classList.replace("btn-edit","btn-add")
                        $det.textContent=$form.detalle.value
                        $mon.textContent=`$ ${$form.monto.value}`
                        
                        $modal.classList.add("no-ver")
                        let diferencia = parseFloat($dos)-parseFloat($form.monto.value)
                        console.log(diferencia)
                        let resta;
                        if(iog=="box-titulos i"){
                            resta =parseFloat($total.textContent)-(diferencia)
                            console.log(resta)
                         }
                         if(iog=="box-titulos g"){
                             resta =parseFloat($total.textContent)+(diferencia)
                             console.log(resta)
                         }

                        $total.textContent = resta
                        let datos = new FormData($form)
                        datos.append("idprod",$id_prod)
                        datos.append("total",resta)
                        fetch("./php/editar.php",{
                            method:"POST",
                            body: datos
                        })

                    }else{
                        let err = document.createElement("span")
                        err.style.color = "red"
                        err.innerHTML = "<br>Introduce un monto"
                        $form.appendChild(err)
                        setTimeout(()=>{
                            $form.removeChild(err)
                        },3000)
                    }
                    
                }
            })
            
        }
        //-------------------BOTÓN "ELIMINAR"---------------
        if(e.target.matches(".btn-eliminar")){
            let $confirmar = confirm("¿Esta seguro que deseas eliminar este registro?"),
            $id_prod_2 = e.target.parentElement.children[2].value,
            $padre = e.target.parentElement.parentElement,
            iog = $padre.getAttribute("class"),
            resta,
            valortodel = eliminarExp(e.target.parentElement.parentElement.children[1].textContent);
            
        
            if(iog=="box-titulos i"){
               resta =parseFloat($total.textContent)-parseFloat(valortodel)
            }
            if(iog=="box-titulos g"){
                resta =parseFloat($total.textContent)+parseFloat(valortodel)
            }
            if($confirmar){
                
                let $enviar = new FormData()
                $enviar.append("idproducto",$id_prod_2)
                $enviar.append("total",resta)
                fetch("./php/eliminar.php",{
                    method:"POST",
                    body:$enviar
                })
                .then(()=>{

                    $main.removeChild($padre)
                    $total.textContent = resta
                })
            
            }
        }
    })
})




    

