<?php

    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"]!== true){
        header("location: iniciarsesion.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cuenta.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Peta&family=Raleway:wght@300&display=swap" rel="stylesheet">
    <title>Cuentador Diario</title>
</head>
<body>
    <div class="contenedor-principal">
        <nav class="nav-class">
            <a href="iniciarsesion.php" class="nav-link">Inicio</a>
            <a href="#" class="nav-link"><span class="ico">👤</span><?php echo $_SESSION["usuario"]?></a>
            <a href="php/logout.php" class="nav-link">Cerrar Sesión</a>
            
        </nav>
        <div class="modal-container no-ver" id="modal-container">
            <div class="modal">  
                <form action="" id="form-modal" data-operation="">
                    <input type="text" max-lenght="100" placeholder="detalle"><br><br>
                    <input type="number" name="monto" id="monto" placeholder="monto" min=0><br><br>
                    <input type="button" value="Agregar" class="btn-add">
                    <input type="button" value="Cancel" class="btn-cancel">
                </form>
            </div>
        </div>
        <div class="botones">
            <a href="#" class="ingreso" id="ingreso">Ingreso</a>
            <a href="#" class="gasto" id="gasto">Gasto</a>
        </div>

        <main class="main-box">
            <section class="box-titulos">
                <div class="titulos">Detalle</div>
                <div class="titulos">Monto</div>
                <div class="titulos">Fecha</div>
            </section>


        </main>
    <script src="js/script.js" type="module"></script>
    </div>
</body>
</html>