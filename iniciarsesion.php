<?php 
    require "php/login.php"
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/iniciarsesion.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Peta&family=Raleway:wght@300&display=swap" rel="stylesheet">

    <title>Apps Iniciar Sesión</title>
</head>
<body>
    <div class="contenedor-principal">

        <?php include "nav.php"?>
        <div class="form-box">
            <p class="title-login">Iniciar Sesión</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
                <label class="label-font" for="usuario">Usuario</label>
                <input class="input" type="text" name="usuario" maxlength="12" minlength="4" required="required">
                <span class="msg-error" style="color: #af0000"><?php echo $user_error; ?></span>
                <br>
                <label class="label-font" for="contrasenia">Contraseña</label><br>
                <input class="input" type="password" name="contrasenia" maxlength="12" minlength="4" required="required" >
                <span class="msg-error" style="color: #af0000"><?php echo $pass_error; ?></span><br>

                <button class="button" type="submit">Entrar</button>
                <br>
                <p class="label-font">¿No tenes cuenta?</p>
                <a href="registrarse.php" class="registrate">Registrate</a>


            </form>

        </div>
    </div>





    
</body>
</html>