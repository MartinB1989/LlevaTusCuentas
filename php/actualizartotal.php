<?php 

function existenciaDeUsuario($campo,$valor_campo,$mysqlquery){
    // Esta funcion recibe como parametro el campo
    //que va a recorrer, el valor que tendra el campo 
    // y una función mysqli_query().
    // Si existe dicho valor en el campo la función devolverá true

    while($registro = mysqli_fetch_array($mysqlquery))
    {

        if($registro[$campo]==$valor_campo){
        return true;
        }
    }

    return false;
}

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]===true){
    
    $id_user = $_SESSION["id"];
    

    require_once "dbconec.php";

    $conexion = mysqli_connect($bdhost,$bdusuario,$bdcontra,$bdnombre);
    $verificacion = "SELECT * FROM `totalencuenta` WHERE iduser = $id_user";
    $consulta = mysqli_query($conexion,$verificacion);
    ;

    if(existenciaDeUsuario("iduser",$id_user,$consulta)){

        $actualizar = "UPDATE `totalencuenta` SET `total`= WHERE iduser = $id_user ";
    }else{
        $guardar = "INSERT INTO `totalencuenta`(`iduser`, `total`) VALUES ([value-1],[value-2])";
        mysqli_query($conexion,$guardar);
    }

}