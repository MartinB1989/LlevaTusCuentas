<?php 


session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]===true){
    $h = $_SESSION["id"];
    require_once "dbconec.php";
    $conexion = mysqli_connect($bdhost,$bdusuario,$bdcontra,$bdnombre);
    $consulta = "SELECT nrodato,fecha,monto,detalle,iduser,tipodeentrada FROM datauserlist WHERE iduser=$h";
    $consultaDos ="SELECT iduser,total FROM totalencuenta WHERE iduser=$h";
    $resultados = mysqli_query($conexion, $consulta);
    $resultadosDos = mysqli_query($conexion, $consultaDos);
    $rawdata = array();
    $i =0;
    $j = 0;
    while($registro = mysqli_fetch_row($resultados)){
    $rawdata[$i] = $registro;
    $i++; 
    }
    while($registro = mysqli_fetch_row($resultadosDos)){
        $rawdata[$i] = $registro;
        $i++; 
    }


    echo json_encode($rawdata);

    mysqli_close($conexion);
   
}else{
    header("location: ../iniciarsesion.php");
    exit;
}
