<?php 


session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]===true){
    
    $id_user = $_SESSION["id"];
    $fecha = $_POST["fecha"];
    $monto =$_POST["monto"];
    $detalle = $_POST["detalle"];
    $tipo =$_POST["tipo"];

    require_once "dbconec.php";

    $conexion = mysqli_connect($bdhost,$bdusuario,$bdcontra,$bdnombre);


    $guardar = "INSERT INTO `datauserlist`(`fecha`, `monto`, `detalle`, `iduser`,`tipodeentrada`) VALUES ('$fecha','$monto','$detalle','$id_user','$tipo')";
    $result = mysqli_query($conexion,$guardar);



}
