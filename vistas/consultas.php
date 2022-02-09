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
        <link rel="stylesheet" href="../css/Perfil.css">
        <title>Aula Virtual</title>
    </head>

    <body>
        <div id="modal-update" class="modal-update md-hidden">
            <div class="container-modal">
                <div id="toast-modal-exito" class="toast-exito">
                    <p>Actualizacion exitosa</p>
                </div>
                <div id="toast-modal-error" class="toast-fracaso">
                    <p>No se pudo actualizar el usuario</p>
                </div>
                <div id="close-modal" class="close-modal">
                    <i class="fas fa-times"></i>
                </div>
                <div class="header-img-modal">
                    <img src="../img/user.png" alt="">
                </div>
                <form id="form-update-user">
                    <h1>Actualiza tu datos</h1>
                    <?php
                    if ($_SESSION["us_tipo"] == 1) {
                    ?>
                        <input id="name-user" name="name" type="text" placeholder="Ingresa tu nombre">
                        <input id="email-user" name="phone" type="email" placeholder="Ingresa tu email">
                        <input id="password-user" name="phone" type="password" placeholder="Ingresa contraseña">
                        <!-- <input id="password-user" name="pssword" type="text" placeholder="ingresa tu contraseña "> -->
                        <button class="btn-submit-update" type="submit">Actualizar</button>
                    <?php
                    } else {
                    ?>
                        <input id="name-user" name="name" type="text" placeholder="Ingresa tu nombre">
                        <input id="cedula-user" name="cedula" type="text" placeholder="Ingresa tu cedula">
                        <input id="celular-user" name="phone" type="text" placeholder="Ingresa tu celular">
                        <input id="email-user" name="phone" type="email" placeholder="Ingresa tu email" disabled>
                        <!-- <input id="password-user" name="pssword" type="text" placeholder="ingresa tu contraseña "> -->
                        <button class="btn-submit-update" type="submit">Actualizar</button>
                    <?php
                    }
                    ?>
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
                    <div class="container-body">
                        <div class="card-user">
                            <div class="header-card">
                            </div>
                            <div class="body-card">
                                <img src="../img/avatar.jpg" alt="">
                                <ul class="list-dates">
                                    <li class="dates">Nombres y apellidos: <span id="nombre-usuario"></span></li>
                                    <li class="dates">Dni: <span id="dni-usuario"></span></li>
                                    <li class="dates">Tipo de usuario: <span id="tipo-usuario"></span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="card-nav-modal">
                            <div id="card-update" class="card-dashboard "><i class="fas fa-user-edit"></i> Actualizar datos</div>
                            <div id="card-queja"><a class="card-dashboard" href="./Quejas.php"><i class="far fa-clipboard"></i> Registrar envio</a></div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/user.js"></script>
    </body>

    </html>
<?php
}
?>