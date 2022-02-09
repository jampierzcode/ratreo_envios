<?php
include_once "../modelo/Usuario.php";
session_start();
$dni = $_POST["dni"];
$password = $_POST["password"];

if (isset($dni) && isset($password)) {
    if (preg_match('/^[0-9a-zA-Z%]+$/', $password)) {

        $usuario = new Usuario();
        // $encrypt_password = md5($password);

        $usuario->Loguearse($dni, $password);

        if (!empty($usuario->datos)) {

            foreach ($usuario->datos as $dato) {
                $_SESSION["id_usuario"] = $dato->id_usuario;
                $_SESSION["us_tipo"] = $dato->us_tipo;
                $_SESSION["nombres"] = $dato->nombre;
            }
            header("Location: ../vistas/consultas.php");
        } else {
            $_SESSION["error"] = "EL usuario o contraseña es incorrecto";
            header("Location: ../index.php");
        }
    } else {
        $_SESSION["error"] = "No se admiten caracteres especiales";
        header("Location: ../vistas/Login.php");
    }
} else {
    $_SESSION["error"] = "Te faltan llenar datos";
    header("Location: ../vistas/Login.php");
}
