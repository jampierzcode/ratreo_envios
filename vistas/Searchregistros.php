<?php
session_start();
if (empty($_SESSION["id_usuario"])) {
    session_destroy();
    header("Location: ../index.php");
} else {


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Style icon port -->
        <link rel="icon" href="../img/favicon.ico">
        <!-- Link de style FontAwesome -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
        <!-- Browser Font Google Styles -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Style main -->
        <link rel="stylesheet" href="../css/main.css">
        <!-- Style main Sidebar -->
        <link rel="stylesheet" href="../css/Sidebar.css">
        <link rel="stylesheet" href="../css/Formulario_update.css">
        <link rel="stylesheet" href="../css/registrarenvios.css">
        <title>Registrar Envios</title>
    </head>

    <body>
        <div id="modal-update" class="modal-update md-hidden">
            <div class="container-modal">
                <div id="toast-modal-exito" class="toast-exito">
                    <p>Creacion de queja exitosa</p>
                </div>
                <div id="toast-modal-error" class="toast-fracaso">
                    <p>No se pudo actualizar el usuario</p>
                </div>
                <div id="close-modal" class="close-modal">
                    <i class="fas fa-times"></i>
                </div>
                <form id="form-update-queja">
                    <h1>Registra una queja</h1>
                    <label for="">Tipo de Queja</label>
                    <select name="tipo_queja" id="tipo_quejas">
                    </select>
                    <label for="">Descripcion</label>
                    <textarea id="descripcion_queja" name="descripcion" cols="30" rows="10" placeholder="Ingresa la descripccion de la queja"></textarea>
                    <label for="">Direccion</label>
                    <input id="direccion_queja" name="phone" type="text" placeholder="Ingresa tu direccion">
                    <button class="btn-submit-update" type="submit">Crear Queja</button>
                </form>
            </div>
        </div>
        <div class="container-plataforms">
            <?php include_once "../components/Sidebar.php" ?>
            <div class="view-navigation">
                <div id="nav_down" class="barra-navigation">
                    <div class="dropdown">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
                <div class="body-navigation">
                    <h1 class="title_search">Buscar registros</h1>
                    <form id="search_quejas_user" class="search_user">
                        <input id="input_correo" name="correo_user" type="email" placeholder="Buscar quejas de usuarios" required>
                        <button id="search_quejas_user" class="search_btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    <div id="list-quejas" class="container-quejas">
                    </div>
                </div>
            </div>

        </div>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/viewquejas.js"></script>
    </body>

    </html>
<?php
}
?>