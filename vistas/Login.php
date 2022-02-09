<?php
session_start();
if (!empty($_SESSION["id_usuario"])) {
    header("Location: ../vistas/consultas.php");
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
        <!-- Style forms -->
        <link rel="stylesheet" href="../css/Formulario_inicio.css">
        <title>Login</title>
    </head>

    <body>
        <div class="container-forms">
            <div class="section-form login-form">
                <div class="head-img">
                    <img src="../img/logo_plataforma.png" alt="">
                </div>
                <form action="../controlador/LoginController.php" method="post">
                    <div class="header-form">
                        <h1 class="title-form">Login</h1>
                        <p class="description-form">Inicia sesion con tu cuenta</p>
                    </div>
                    <?php

                    if (!empty($_SESSION["error"])) {
                    ?>
                        <div id="toast" class="toast-error">
                            <p><?php echo $_SESSION["error"] ?></p>
                        </div>
                    <?php
                        session_destroy();
                    } elseif (!empty($_SESSION["verify_user_register"])) {
                    ?>
                        <div id="toast" class="toast-verify">
                            <p><?php echo $_SESSION["verify_user_register"] ?></p>
                        </div>
                    <?php
                        session_destroy();
                    }
                    ?>
                    <div class="body-form">
                        <div class="controls-form">
                            <i class="fas fa-user"></i>
                            <input type="text" name="dni" id="dni" placeholder="Ingresa tu dni" required autocomplete="off">
                        </div>
                        <div class="controls-form">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" id="password" placeholder="Ingresa tu correo contraseña" required>
                        </div>
                        <button class="btn-submit" type="submit">Iniciar sesion</button>
                        <!-- <div>¿No tienes una cuenta de usuario? <a class="link_mode" href="./vistas/Register.php">Registrate</a></div> -->
                    </div>
                </form>
            </div>
        </div>
        <script src="js/jquery.min.js"></script>
    </body>

    </html>
<?php
}
?>