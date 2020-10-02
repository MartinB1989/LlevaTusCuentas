<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/iniciarsesion.css">
    <link rel="stylesheet" href="css/registrarse.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Peta&family=Raleway:wght@300&display=swap" rel="stylesheet">

    <title>Apps Registrarse</title>
</head>
<body>
    <div class="contenedor-principal">
        <!-- <nav class="nav-class">
            <a href="#" class="nav-link">Iniciar Sesión</a>
            <a href="#" class="nav-link">Registrarse</a>
            <a href="#" class="nav-link">Nosotros</a>
        </nav> -->
        <?php include "nav.php"?>

        <div class="form-box">
            <p class="title-login reg">Registrarse</p>
            <form action="" id="formulario" method="post">
                <label class="label-font" for="usuario">Nombre de Usuario*</label><br>
                <input class="input" type="text" name="usuario" maxlength="12" minlength="4" required="required"><br>
                <label class="label-font" for="contrasenia">Contraseña*</label><br>
                <input class="input" type="password" name="contrasenia" maxlength="12" minlength="4" required="required"><br>
                <button class ="button" type="submit">Crear</button>
                <!-- <input class="button" type="submit" value="Crear"> -->
                <br>
            </form> 
            
        </div>
        
        <div class="respuesta" id="respuesta"></div>
       





    </div>

    <script src="js/registro.js"></script>
</body>
</html>