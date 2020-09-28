const appearModal = (selector,ventana,clase,form,operation) =>{
    document.addEventListener("click", e =>{
        if(e.target.matches(selector)){
            ventana.classList.remove(clase)
            form.setAttribute("data-operation",operation)
        }
    })
};

const cancelModal=(selector,ventana,clase)=>{
    document.addEventListener("click", e =>{
        if(e.target.matches(selector)){
            ventana.classList.add(clase)
        }
    })
}


export {appearModal,cancelModal}