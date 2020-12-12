let formulario = document.getElementById("formulario")
let respuesta = document.getElementById("respuesta")

formulario.addEventListener('submit', e =>{
    e.preventDefault()

    let datos = new FormData(formulario)

    fetch('./php/crearusuario.php',{
        method:"POST",
        body: datos
    })

    .then( res => res.json())
    .then(data => {
        
        if(data == "true"){
            respuesta.innerHTML = '<p class="fetch">El usuario ya existe, prueba con otro nombre</p>'
            
        }
        else{
            respuesta.innerHTML = '<p class="fetch">El usuario ha sido creado, <a href ="index.php" class="iniciarsesionluegoderegistrarse">Inicia Sesión<a/></p>'
           }

    })
})