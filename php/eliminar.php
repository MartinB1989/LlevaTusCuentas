<?php 


session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]===true){
    
    $id_user = $_SESSION["id"];
    $nrodato = intval($_POST["idproducto"]);
    $total = floatval($_POST["total"]);
    require_once "dbconec.php";

    $conexion = mysqli_connect($bdhost,$bdusuario,$bdcontra,$bdnombre);

    $eliminar = "DELETE FROM `datauserlist` WHERE nrodato=$nrodato";
    $result = mysqli_query($conexion,$eliminar);
    $actualizar = "UPDATE `totalencuenta` SET `total`= '$total' WHERE iduser = '$id_user' ";
    mysqli_query($conexion,$actualizar);
}