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
        <link rel="stylesheet" href="../css/Quejas.css">
        <title>Registrar Envios</title>
    </head>

    <body>
        <div id="modal-update" class="modal-update">
            <div class="container-modal">
                <div id="toast-modal-exito" class="toast-exito">
                    <p>Creacion de envio exitoso</p>
                </div>
                <div id="toast-modal-error" class="toast-fracaso">
                    <p>No se pudo crear el envio, revisar los datos</p>
                </div>
                <div id="close-modal" class="close-modal">
                    <i class="fas fa-times"></i>
                </div>
                <h1>Registrar envio</h1>
                <div class="dates_rutas">
                    <div class="col-3">
                        <label for="">N° Remito</label>
                        <input id="remito_envio" type="text" disabled="disabled">
                    </div>
                    <div class="col-3">
                        <label for="">Origen</label>
                        <select name="origen" id="origen_envio"></select>
                    </div>
                    <div class="col-3">
                        <label for="">Destino</label>
                        <select name="destino" id="destino_envio"></select>
                    </div>
                </div>
                <label for="">Buscar remitente</label>
                <div class="dates_rutas">
                    <div class="col-3">
                        <select name="documento_tipo_remitente" id="documento_tipo_remitente">
                            <option value="1">DNI</option>
                            <option value="2">RUC</option>
                        </select>
                    </div>

                    <div class="col-3 documento-section">
                        <input name="documento_remitente" id="documento_remitente" key_remitente="" max="8" placeholder="Ingrese el numero">
                        <button class="btn-form" id="btn-search-documento-remitente"><i class="fas fa-search"></i></button>
                    </div>
                    <div class="col-3">
                    </div>

                </div>
                <div class="dates_rutas">
                    <div class="col-3">
                        <input name="nombres_remitente" id="name_remitente" placeholder="Nombres y apellidos" disabled="disabled">
                    </div>
                    <div class="col-3">
                        <input name="direccion_remitente" id="direccion_remitente" placeholder="Direccion" disabled="disabled">
                    </div>
                    <div class="col-3">
                        <input name="telefono_remitente" id="telefono_remitente" placeholder="Telefono" disabled="disabled">
                    </div>
                </div>
                <label for="">Buscar Consignado</label>
                <div class="dates_rutas">
                    <div class="col-3">
                        <select name="documento_tipo_remitente" id="documento_tipo_consignado">
                            <option value="1">DNI</option>
                            <option value="2">RUC</option>
                        </select>
                    </div>

                    <!-- <form id="search_remitente"> -->
                    <div class="col-3 documento-section">
                        <input name="documento_remitente" id="documento_consignado" key_consignado="" placeholder="Ingrese el numero">
                        <button class="btn-form" id="btn-search-documento-consignado"><i class="fas fa-search"></i></button>
                    </div>
                    <!-- </form> -->
                    <div class="col-3">
                    </div>

                </div>
                <div class="dates_rutas">
                    <div class="col-3">
                        <input name="name_consignado" id="name_consignado" placeholder="Nombres y apellidos del consignado" disabled="disabled">
                    </div>
                    <div class="col-3">
                        <input name="direccion_consignado" id="direccion_consignado" placeholder="Direccion del consignado" disabled="disabled">
                    </div>
                    <div class="col-3">
                        <input name="telefono_consignado" id="telefono_consignado" placeholder="Telefono del consignado" disabled="disabled">
                    </div>
                </div>

                <label for="">Contenido</label>
                <textarea id="contenido_envio" name="contenido" cols="10" rows="4" placeholder="Ingresa la descripccion de la queja"></textarea>
                <div class="dates_rutas">
                    <div class="col-2">
                        <label for="">Peso</label>
                        <input name="peso" id="peso_envio">
                    </div>
                    <div class="col-2">
                        <label for="">Piezas</label>
                        <input name="piezas" id="piezas_envio">
                    </div>
                </div>
                <button id="form-crear-envio" class="btn-submit-update">Registrar Envio</button>

            </div>
        </div>
        <div id="modal-edit" class="modal-update md-hidden">
            <div class="container-modal">
                <div id="toast-modal-exito-edit" class="toast-exito">
                    <p>Actualizacion de queja exitosa</p>
                </div>
                <div id="toast-modal-error-edit" class="toast-fracaso">
                    <p>No se pudo actualizar la queja</p>
                </div>
                <div id="close-modal-edit" class="close-modal">
                    <i class="fas fa-times"></i>
                </div>
                <form id="form-edit-queja">
                    <h1>Editar Queja</h1>
                    <label for="">Tipo de Queja</label>
                    <select name="tipo_queja" id="tipo_quejas_edit">
                    </select>
                    <label for="">Descripcion</label>
                    <textarea id="descripcion_edit_queja" name="descripcion" cols="30" rows="10" placeholder="Ingresa la descripccion de la queja"></textarea>
                    <label for="">Direccion</label>
                    <input id="direccion_edit_queja" name="phone" type="text" placeholder="Ingresa tu direccion">
                    <button class="btn-submit-update" type="submit">Editar Queja</button>
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
                    <button id="crear_envios">Registrar <i class="fas fa-plus"></i></button>
                    <h1 class="title_envios">Mis Envios</h1>
                    <div id="list-envios" class="container-envios">

                    </div>
                </div>
            </div>

        </div>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/quejas.js"></script>
    </body>

    </html>
<?php
}
?>