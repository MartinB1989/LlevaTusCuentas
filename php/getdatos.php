<?php 


// session_start();

// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]===true){
//     header("location: ../cuenta.php");
//     exit;
// }

require_once "dbconec.php";
$conexion = mysqli_connect($bdhost,$bdusuario,$bdcontra,$bdnombre);
$consulta = "SELECT nrodato,fecha,monto,detalle,iduser FROM datauserlist WHERE iduser = 1";
$resultados = mysqli_query($conexion, $consulta);

while($registro = mysqli_fetch_array($resultados)){
    echo json_encode($registro);
}
?>