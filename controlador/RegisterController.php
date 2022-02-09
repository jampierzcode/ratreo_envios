<?php
include_once "../modelo/Usuario.php";
session_start();
$nombre = $_POST["name"];
$cedula = $_POST["cedula"];
$celular = $_POST["phone"];
$email = $_POST["email"];
$password = $_POST["password"];

if (isset($nombre) && isset($cedula) && isset($celular) && isset($email) && isset($password)) {
    echo "ingreso al if";
    if (preg_match('/^[a-zA-ZñáéíóúÁÉÍÓÚ ]+$/', $nombre) && preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $email) && preg_match('/^[0-9a-zA-Z%]+$/', $password)) {
        $usuario = new Usuario();
        $us_tipo = 2;
        // $encrypt_password = md5($password);
        $respuesta = $usuario->Registrarse($nombre, $cedula, $celular, $email, $password, $us_tipo);
        if ($respuesta == "user no add") {
            $_SESSION["error-register"] = "Hay un usuario con las mismas credenciales, inicia sesion";
            header("Location: ../vistas/Register.php");
        } else {
            $_SESSION["verify_user_register"] = "Usuario registrado correctamente, inicia sesion para continuar";
            header("Location: ../index.php");
        }
    } else {
        $_SESSION["error-register"] = "No se admiten caracteres especiales";
        header("Location: ../vistas/Register.php");
    }
} else {
    $_SESSION["error-register"] = "Te falta algun campo";
    header("Location: ../vistas/Register.php");
}
