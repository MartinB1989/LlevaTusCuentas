<?php 


session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]===true){
    
    $nrodato = intval($_POST["idproducto"]);

    require_once "dbconec.php";

    $conexion = mysqli_connect($bdhost,$bdusuario,$bdcontra,$bdnombre);

    $eliminar = "DELETE FROM `datauserlist` WHERE nrodato=$nrodato";
    $result = mysqli_query($conexion,$eliminar);

    echo json_encode($result);
}