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
        <link rel="stylesheet" href="../css/Reset_user.css">
        <title>Aula Virtual</title>
    </head>

    <body>
        <div id="modal-edit" class="modal-update md-hidden">
            <div class="container-modal">
                <div id="toast-modal-exito" class="toast-exito">
                    <p>Se actualizo la contraseña</p>
                </div>
                <div id="toast-modal-error" class="toast-fracaso">
                    <p>No se pudo actualizar la contraseña</p>
                </div>
                <div id="close-modal" class="close-modal">
                    <i class="fas fa-times"></i>
                </div>
                <form id="form-update-clave">
                    <h1>Cambiar password</h1>
                    <input id="change_clave" name="password" type="text" placeholder="Ingresa la nueva contraseña">
                    <button class="btn-submit-update" type="submit">Actualizar Clave</button>
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
                    <h1 class="title_search">Buscar usuario</h1>
                    <form id="search_user_reset" class="search_user">
                        <input id="input_correo" name="correo_user" type="email" placeholder="Buscar usuario" required>
                        <button id="search_user" class="search_btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    <div id="user_search" class="container-user">
                    </div>
                </div>
            </div>

        </div>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/reset_clave.js"></script>
    </body>

    </html>
<?php
}
?>