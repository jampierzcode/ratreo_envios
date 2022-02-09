$(document).ready(function () {
  var funcion = "";

  $("#search_user_reset").submit(function (e) {
    funcion = "buscar_user_reset";
    e.preventDefault();
    const email = $("#input_correo").val();
    $.post(
      "../controlador/UsuarioController.php",
      { funcion, email },
      (response) => {
        let template = "";
        if (response.trim() == "no_user") {
          template += `
                  <p>No existe el usuario con ese correo, o escribio mal el correo</p>
              `;
        } else {
          const usuario = JSON.parse(response);

          usuario.forEach((datos) => {
            template += `
                <div class="card-user" key="${datos.id_usuario}">
                    <h1 >Usuario: <span id="tipo_queja">${datos.nombre}</span></h1>
                    <p>Correo: <span>${datos.correo}</span></p>
                    <p>Cedula: <span>${datos.cedula}</span></p>
                    <p>Celular: <span>${datos.celular}</span></p>
                    <button id="edt_clave_user" class="edit_user"><i class="fas fa-marker"></i></button>
                </div>`;
          });
        }

        $("#user_search").html(template);
      }
    );
  });
  // EDITAR CLAVE DEL USUARIO

  $(document).on("click", "#edt_clave_user", function () {
    const element = $(this)[0].parentElement; // select card quejas
    const id_usuario = $(element).attr("key"); // get id_quejas
    $("#form-update-clave").attr("key_user_change", id_usuario);

    $("#modal-edit").removeClass("md-hidden");
    // reset_clave_user(id_usuario);
  });
  $("#close-modal").click(function () {
    $("#modal-edit").addClass("md-hidden");
  });

  $("#form-update-clave").submit(function (e) {
    e.preventDefault();
    const contraseña = $("#change_clave").val();
    const id_usuario = $("#form-update-clave").attr("key_user_change");
    funcion = "reset_clave_user";

    $.post(
      "../controlador/UsuarioController.php",
      { funcion, contraseña, id_usuario },
      (response) => {
        console.log(response);
        if (response.trim() == "clave_actualizada") {
          $("#toast-modal-exito").addClass("toast_show");
          setInterval(() => {
            $("#toast-modal-exito").removeClass("toast_show");
          }, 2000);
        } else {
          $("#toast-modal-error").addClass("toast_show");
          setInterval(() => {
            $("#toast-modal-exito").removeClass("toast_show");
          }, 2000);
        }
      }
    );
  });
});
