<?php require "dbconec.php"?>
<?php


$usuario = $_POST["usuario"];
$contrasenia = $_POST["contrasenia"];

$conexion = mysqli_connect($bdhost,$bdusuario,$bdcontra,$bdnombre);

if(mysqli_connect_errno()){
    echo "<h1>No se encontro la base de datos</h1>";
    exit();
}

$consulta = 'SELECT * FROM `userslist`';
$resultados = mysqli_query($conexion, $consulta);
    
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
   
if (!existenciaDeUsuario("usuario",$usuario,$resultados)){

        $guardar = "INSERT INTO `userslist`(`usuario`, `contrasenia`) VALUES ('$usuario','$contrasenia')";
        $result = mysqli_query($conexion,$guardar);
        echo json_encode("false");  
       
}
else{
    echo json_encode("true");

}
?>