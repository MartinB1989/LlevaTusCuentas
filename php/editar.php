<?php 


session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]===true){
    
    $id_user = $_SESSION["id"];
    $monto =floatval($_POST["monto"]);
    $detalle = $_POST["detalle"];
    $nrodato = intval($_POST["idprod"]);
    $total = floatval($_POST["total"]);

    require_once "dbconec.php";

    $conexion = mysqli_connect($bdhost,$bdusuario,$bdcontra,$bdnombre);


    $editar = "UPDATE `datauserlist` SET `monto`=$monto,`detalle`= '$detalle' WHERE nrodato=$nrodato";
    $result = mysqli_query($conexion,$editar);
    $actualizar = "UPDATE `totalencuenta` SET `total`= '$total' WHERE iduser = '$id_user' ";
    mysqli_query($conexion,$actualizar);


}