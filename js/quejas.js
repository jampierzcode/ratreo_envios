$(document).ready(function () {
  var funcion = "";

  buscar_envios();
  llenar_sedes();

  $("#crear_envios").click(function () {
    $("#modal-update").removeClass("md-hidden");
  });
  $("#close-modal").click(function () {
    $("#modal-update").addClass("md-hidden");
  });

  function buscar_envios() {
    funcion = "obtener_datos_envios";
    $.post("../controlador/UsuarioController.php", { funcion }, (response) => {
      let template = "";
      if (response.length === 2) {
        template = "No hay ningun envio creado actualmente ...";
      } else {
        const envios = JSON.parse(response);
        envios.forEach((envio) => {
          let id_registro_envio = envio.id_registro_envio;
          let remito = envio.remito;
          let fecha_manifiesto = envio.fecha_manifiesto;
          let contenido = envio.contenido;
          let origen = envio.origen;
          let destino = envio.destino;
          template += `
            <div class="card-envios" key="${id_registro_envio}">
                <h1  class="envio-tipo">Remito: <span id="tipo_envio">${remito}</span></h1>
                <div class="rutas_envios">                
                  <p date="${origen}" class="origen">Origen: <span>${origen}</span></p>
                  <p date="${destino}" class="destino">Destino: <span>${destino}</span></p>
                </div>
                <p desc="${fecha_manifiesto}" class="descripcion-tipo">Fecha de manifiesto: <span>${fecha_manifiesto}</span></p>
                <p direc="${contenido}" class="direccion-tipo">Contenido: <span>${contenido}</span></p>
                <button id="edt_envios_user" class="edit_envios"><i class="fas fa-marker"></i></button>
            </div>`;
        });
      }
      $("#list-envios").html(template);
    });
  }

  function llenar_sedes() {
    funcion = "llenar_sedes";
    $.post("../controlador/UsuarioController.php", { funcion }, (response) => {
      const sedes = JSON.parse(response);
      let template = "";
      sedes.forEach((sede) => {
        let id_sede = sede.id_sedes;
        let nombre_sede = sede.nombre_sede;
        template += `
          <option value="${id_sede}">${nombre_sede}</option>
        `;
      });
      $("#origen_envio").html(template);
      $("#destino_envio").html(template);
    });
  }

  // Buscar remitente
  $("#btn-search-documento-remitente").click((e) => {
    funcion = "llenar_clientes";
    let tipo_documento = $("#documento_tipo_remitente").val();
    let documento = $("#documento_remitente").val();
    if (tipo_documento == 1) {
      if (documento.length == 8) {
        llenar_clientes(tipo_documento, documento, 1);
      } else {
        alert(
          "La cantidad de numeros para el DNI DNI(8 digitos) es incorrecto"
        );
      }
    } else {
      console.log("RUC");
      if (documento.length == 11) {
        llenar_clientes(tipo_documento, documento, 1);
      } else {
        alert(
          "La cantidad de numeros para el RUC es incorrecto RUC(11 digitos)"
        );
      }
    }
  });
  // Buscar consignado
  $("#btn-search-documento-consignado").click((e) => {
    funcion = "llenar_clientes";
    let tipo_documento = $("#documento_tipo_consignado").val();
    let documento = $("#documento_consignado").val();
    if (tipo_documento == 1) {
      if (documento.length == 8) {
        llenar_clientes(tipo_documento, documento, 2);
      } else {
        alert(
          "La cantidad de numeros para el DNI DNI(8 digitos) es incorrecto"
        );
      }
    } else {
      console.log("RUC");
      if (documento.length == 11) {
        llenar_clientes(tipo_documento, documento, 2);
      } else {
        alert(
          "La cantidad de numeros para el RUC es incorrecto RUC(11 digitos)"
        );
      }
    }
  });
  // funcion de buscar clientes
  function llenar_clientes(tipo_documento, documento, tipo_usuario) {
    $.post(
      "../controlador/UsuarioController.php",
      { funcion, tipo_documento, documento },
      (response) => {
        const clientes = JSON.parse(response);
        clientes.forEach((cliente) => {
          let id_cliente = cliente.id_cliente;
          let nombre_cliente = cliente.nombre;
          let direccion_cliente = cliente.direccion;
          let telefono_cliente = cliente.telefono;
          if (tipo_usuario == 1) {
            // quiere decir que si es remitente
            $("#name_remitente").val(nombre_cliente);
            $("#direccion_remitente").val(direccion_cliente);
            $("#telefono_remitente").val(telefono_cliente);
            $("#documento_remitente").attr("key_remitente", id_cliente);
          } else {
            $("#name_consignado").val(nombre_cliente);
            $("#direccion_consignado").val(direccion_cliente);
            $("#telefono_consignado").val(telefono_cliente);
            $("#documento_consignado").attr("key_consignado", id_cliente);
          }
        });
      }
    );
  }

  buscar_cant_registros();

  function buscar_cant_registros() {
    funcion = "buscar_cant_registros";
    $.post("../controlador/UsuarioController.php", { funcion }, (response) => {
      let template = "";
      template = "";
      if (response < 10 && response > 0) {
        template = `00000${response}`;
      }
      if (response < 100 && response > 9) {
        template = `0000${response}`;
      }
      if (response < 1000 && response > 99) {
        template = `000${response}`;
      }
      $("#remito_envio").val(template);
    });
  }
  // EDITAR envioS LLENAR DATOS AL DAR CLICK

  // $(document).on("click", "#edt_envios_user", function () {
  //   const boton = $(this)[0]; // boton clickeado
  //   const element = $(this)[0].parentElement; // select card envios
  //   const id_envio = $(element).attr("key"); // get id_envios
  //   const nombre_envio = $(element).attr("tipo"); //get tipo_envio
  //   const direccion = $(boton).prev("p").prev("p");
  //   const direccion_val = $(direccion).attr("direc");
  //   const descripcion = $(boton).prev("p").prev("p").prev("p");
  //   const descripcion_val = $(descripcion).attr("desc");
  //   $("#modal-edit").removeClass("md-hidden");
  //   buscar_tipo_envio(nombre_envio);
  //   $("#descripcion_edit_envio").val(descripcion_val);
  //   $("#direccion_edit_envio").val(direccion_val);
  //   $("#form-edit-envio").attr("id_envio", id_envio);
  // });

  // // ACTUALIZAR O EDITAR LAS envioS DEL USUARIO

  // $("#form-edit-envio").submit(function (e) {
  //   e.preventDefault();
  //   const id_envio = $("#form-edit-envio").attr("id_envio");
  //   const tipo_envio = $("#tipo_envios_edit").val();
  //   const descripcion = $("#descripcion_edit_envio").val();
  //   const direccion = $("#direccion_edit_envio").val();
  //   funcion = "editar_envio_usuario";
  //   $.post(
  //     "../controlador/UsuarioController.php",
  //     { funcion, id_envio, tipo_envio, descripcion, direccion },
  //     (response) => {
  //       if (response.trim() == "actualizacion_exitosa") {
  //         $("#toast-modal-exito-edit").addClass("toast_show");
  //         setInterval(() => {
  //           $("#toast-modal-exito-edit").removeClass("toast_show");
  //         }, 2000);
  //         buscar_envios();
  //       } else {
  //         $("#toast-modal-error-edit").addClass("toast_show");
  //         setInterval(() => {
  //           $("#toast-modal-exito-edit").removeClass("toast_show");
  //         }, 2000);
  //       }
  //     }
  //   );
  // });

  // CREAR envioS
  $("#form-crear-envio").click(function (e) {
    e.preventDefault();
    funcion = "crear_envio";
    const remito = $("#remito_envio").val();
    const origen = $("#origen_envio").val();
    const destino = $("#destino_envio").val();
    const remitente = $("#documento_remitente").attr("key_remitente");
    console.log(remitente);
    const consignado = $("#documento_consignado").attr("key_consignado");
    console.log(consignado);
    const contenido = $("#contenido_envio").val();
    const peso = $("#peso_envio").val();
    const piezas = $("#piezas_envio").val();

    $.post(
      "../controlador/UsuarioController.php",
      {
        funcion,
        remito,
        origen,
        destino,
        remitente,
        consignado,
        contenido,
        peso,
        piezas,
      },
      (response) => {
        console.log(response);
        buscar_cant_registros();
        if (response.trim() == "envio_creado") {
          $("#toast-modal-exito").addClass("toast_show");
          setInterval(() => {
            $("#toast-modal-exito").removeClass("toast_show");
          }, 2000);
          buscar_envios();
          $("#form-update-envio").trigger("reset");
        } else {
          $("#toast-modal-error").addClass("toast_show");
          setInterval(() => {
            $("#toast-modal-exito").removeClass("toast_show");
          }, 2000);
        }
      }
    );
  });
  $("#close-modal-edit").click(function () {
    $("#modal-edit").addClass("md-hidden");
  });
});
