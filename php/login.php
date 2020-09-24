<?php

    //INICIALIZAR LA SESIÓN

    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]===true){
        header("location: ./cuenta.php");
        exit;
    }

require_once "dbconec.php";

$conexion = mysqli_connect($bdhost,$bdusuario,$bdcontra,$bdnombre);

$user = $pass = "";
$user_error = $pass_error = "";

if($_SERVER["REQUEST_METHOD"]==="POST"){
    if(empty(trim($_POST["usuario"]))){
        $user_error = "Usuario incorrecto";

    }else{
        $user = trim($_POST["usuario"]);
    }

    if(empty(trim($_POST["contrasenia"]))){
        $pass_error = "Contraseña <br>incorrecto<br>";

    }else{
        $pass = trim($_POST["contrasenia"]);
    }



    //VALIDACIÓN 
    if(empty($user_error) && empty($pass_error)){

       $sql = "SELECT id,usuario,contrasenia FROM userslist WHERE usuario = ?";
        
       if($stmt = mysqli_prepare($conexion,$sql)){

           mysqli_stmt_bind_param($stmt,"s", $param_user);

           $param_user = $user;

           if(mysqli_stmt_execute($stmt)){
               mysqli_stmt_store_result($stmt);
           }
           if(mysqli_stmt_num_rows($stmt)==1){
               mysqli_stmt_bind_result($stmt,$id,$user,$h_pass);
               if(mysqli_stmt_fetch($stmt)){
                   if($pass == $h_pass){
                       session_start();

                       //ALMACENAR DATOS EN VARIABLES DE SESSIÓN

                       $_SESSION["loggedin"] = true;
                       $_SESSION["id"] = $id;
                       $_SESSION["usuario"] = $user;

                       header("location: ./cuenta.php");
                   }else{
                       $pass_error = "Contraseña <br>incorrecto<br>";
                    }
               }
           }else{
                   $user_error = "Usuario incorrecto";
               }
       }else{
           echo "UPS algo salio mal";
        }
    }

    mysqli_close($conexion);

}



?>