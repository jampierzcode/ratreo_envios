<?php
session_start();
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
    <title>Register</title>
</head>

<body>
    <div class="container-forms">
        <div class="section-form register-form">
            <div class="head-img">
                <img src="../img/logo_icon.jpeg" alt="">
            </div>
            <form action="../controlador/RegisterController.php" method="post">
                <div class="header-form">
                    <h1 class="title-form">Registrate</h1>
                    <p class="description-form">Crea tu cuenta y realiza una consulta</p>
                </div>
                <?php

                if (!empty($_SESSION["error-register"])) {

                ?>
                    <div id="toast" class="toast-error">
                        <p><?php echo $_SESSION["error-register"] ?></p>
                    </div>
                <?php
                    session_destroy();
                }
                ?>
                <div class="body-form">
                    <div class="controls-form">
                        <input type="text" name="name" id="nombre" placeholder="Ingresa tu nombre" required autocomplete="off">
                    </div>
                    <div class="controls-form">
                        <input type="text" name="cedula" id="cedula" placeholder="Ingresa tu Cedula" required>
                    </div>
                    <div class="controls-form">
                        <input type="text" name="phone" id="phone" placeholder="Numero de celular" required autocomplete="off">
                    </div>
                    <div class="controls-form">
                        <input type="email" name="email" id="email" placeholder="Ingresa tu correo electronico" required autocomplete="off">
                    </div>
                    <div class="controls-form">
                        <input type="password" name="password" id="passsword" placeholder="Ingresa tu contraseña" required>
                    </div>
                    <button class="btn-submit register-btn" type="submit">Registrate</button>
                    <div>¿Tienes cuenta? <a class="link_mode" href="../index.php">Inicia Sesion</a></div>

                </div>
            </form>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/components.js"></script>
</body>

</html>