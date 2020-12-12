<?php

    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"]!== true){
        header("location: index.php");
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
    <title>LlevaTusCuentas</title>
</head>
<body>
    <div class="contenedor-principal">
        <!-- HEADER -->
        <nav class="nav-class">
            <a href="index.php" class="nav-link">Inicio</a>
            <a href="#" class="nav-link"><span class="ico">👤</span><?php echo $_SESSION["usuario"]?></a>
            <a href="php/logout.php" class="nav-link">Cerrar Sesión</a>
            
        </nav>
        <!-- VENTANA MODAL PARA AGREGAR INGRESOS O GASTOS  -->
        <div class="modal-container no-ver" id="modal-container">
            <div class="modal">  
                <form action="" id="form-modal" data-operation="">
                    <input type="text" name="detalle" max-lenght="100" placeholder="detalle"><br><br>
                    <input type="number" name="monto" id="monto" placeholder="monto" min=0 required="required"><br><br>
                    <input type="button" value="Aceptar" class="btn-add">
                    <input type="button" value="Cancel" class="btn-cancel">
                </form>
            </div>
        </div>
        <!-- BOTONES DE AGREGAR Y GASTO -->
        <div class="botones">
            <div class="total">Total: $<span id="total">0</span></div>
            <a href="#" class="ingreso" id="ingreso">Ingreso</a>
            <a href="#" class="gasto" id="gasto">Gasto</a>
        </div>
    <!-- CONTENEDOR PRINCIPAL DE TODOS LOS DATOS -->
        <main class="main-box">
            <section class="box-titulos">
                <div class="titulos">Detalle</div>
                <div class="titulos">Monto</div>
                <div class="titulos">Fecha</div>
                <div class="titulos">Acciones</div>
            </section>
            <template id="template-row">
                <section class="box-titulos" id="box-titulos">
                    <div class="titulos" id="detail">&#x2692;</div>
                    <div class="titulos" id="amount"></div>
                    <div class="titulos" id="date"></div>
                    <form id="acciones" class="acciones">
                        <input class="btn-editar" type="button" value="✎">
                        <input class="btn-eliminar" type="button" value="✂">
                        <input class="id-prod" type="hidden" name="producto" value="" >
                    </form>
                </section>
            </template>
            
                
        
        </main>
    <script src="js/script.js" type="module"></script>
    </div>
</body>
</html>