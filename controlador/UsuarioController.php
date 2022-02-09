<?php
include_once '../modelo/Usuario.php';
$usuario = new Usuario();
session_start();
$id_usuario = $_SESSION["id_usuario"];

// Seccion Usuarios


if ($_POST["funcion"] == "obtener_datos_usuario") {
    $json = array();
    $usuario->obtener_datos_usuario($id_usuario);
    foreach ($usuario->datos as $objeto) {
        $json[] = array(
            'id_usuario' => $objeto->id_usuario,
            'nombre' => $objeto->nombre,
            'apellido' => $objeto->apellido,
            'dni_usuario' => $objeto->dni_usuario,
            'us_tipo' => $objeto->tipo_usuario
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if ($_POST["funcion"] == "actulizar-user") {
    $nombres = $_POST["nombres"];
    $cedula = $_POST["cedula"];
    $celular = $_POST["celular"];
    $usuario->actualizar_usuario($id_usuario, $nombres, $cedula, $celular);
}
if ($_POST["funcion"] == "actulizar-admin") {
    $nombres = $_POST["nombres"];
    $email = $_POST["correo"];
    $password = $_POST["password"];
    $usuario->actualizar_admin($id_usuario, $nombres, $email, $password);
}

// Seccion de Quejas del usuario
if ($_POST["funcion"] == "obtener_datos_envios") {
    $json = array();
    $usuario->obtener_datos_envios();
    foreach ($usuario->datos as $objeto) {
        $json[] = array(
            'id_registro_envio' => $objeto->id_registro_envio,
            'remito' => $objeto->remito,
            'fecha_manifiesto' => $objeto->fecha_manifiesto,
            'contenido' => $objeto->contenido,
            'origen' => $objeto->origen,
            'destino' => $objeto->destino
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
// Crear envio
if ($_POST['funcion'] == 'crear_envio') {
    date_default_timezone_set('America/Lima');
    $remito = $_POST["remito"];
    $origen = $_POST["origen"];
    $destino = $_POST["destino"];
    $remitente = $_POST["remitente"];
    $consignado = $_POST["consignado"];
    $contenido = $_POST["contenido"];
    $peso = $_POST["peso"];
    $piezas = $_POST["piezas"];
    $fecha = date("Y-m-d H:i:s");
    $usuario->crear_envio($remito, $origen, $destino, $remitente, $consignado, $contenido, $peso, $piezas, $fecha);
}
// Buscar Sedes
if ($_POST['funcion'] == 'llenar_sedes') {
    $json = array();
    $usuario->llenar_sedes();
    foreach ($usuario->datos as $objeto) {
        $json[] = array(
            'id_sedes' => $objeto->id_sedes,
            'nombre_sede' => $objeto->nombre_sede
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
// Buscar Clientes
if ($_POST['funcion'] == 'llenar_clientes') {
    $tipo_documento = $_POST["tipo_documento"];
    $documento = $_POST["documento"];
    $json = array();
    $usuario->llenar_clientes($tipo_documento, $documento);
    foreach ($usuario->datos as $objeto) {
        $json[] = array(
            'id_cliente' => $objeto->id_cliente,
            'nombre' => $objeto->nombre,
            'direccion' => $objeto->direccion,
            'telefono' => $objeto->telefono
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
// Buscar cantidad de registros
if ($_POST['funcion'] == 'buscar_cant_registros') {
    $usuario->buscar_cant_registros();
}

// Actualizar quejas
if ($_POST['funcion'] == 'editar_queja_usuario') {
    $id_queja = $_POST["id_queja"];
    $tipo_queja = $_POST["tipo_queja"];
    $descripcion = $_POST["descripcion"];
    $direccion = $_POST["direccion"];
    $usuario->actualizar_queja($id_queja, $tipo_queja, $descripcion, $direccion);
}

// SECCION DE ADMIN PARA QUEJAS
if ($_POST['funcion'] == 'buscar_quejas_user') {
    $email = $_POST["email"];
    $usuario->buscar_quejas_user_email($email);
    if (empty($usuario->datos)) {
        echo "sin_quejas";
    } else {
        foreach ($usuario->datos as $objeto) {
            $json[] = array(
                'id_quejas' => $objeto->id_quejas,
                'nombre' => $objeto->tipo_queja,
                'descripcion' => $objeto->descripcion,
                'direccion' => $objeto->direccion,
                'fecha' => $objeto->fecha
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
}
// SECCION DE ADMIN PARA RESETEAR CLAVE DE USUARIO
if ($_POST['funcion'] == 'buscar_user_reset') {
    $email = $_POST["email"];
    $usuario->buscar_user_email($email);
    if (empty($usuario->datos)) {
        echo "no_user";
    } else {
        foreach ($usuario->datos as $objeto) {
            $json[] = array(
                'id_usuario' => $objeto->id_usuario,
                'nombre' => $objeto->nombre,
                'correo' => $objeto->correo,
                'cedula' => $objeto->cedula,
                'celular' => $objeto->celular,
                'password' => $objeto->password
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
}
if ($_POST['funcion'] == 'reset_clave_user') {
    $password = $_POST["contraseña"];
    $id_user_reset = $_POST["id_usuario"];
    $usuario->reset_clave_user($password, $id_user_reset);
}
