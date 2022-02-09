$(document).ready(function () {
  var funcion = "";

  buscar_usuario();

  function buscar_usuario() {
    funcion = "obtener_datos_usuario";
    $.post("../controlador/UsuarioController.php", { funcion }, (response) => {
      console.log(response);
      const usuarios = JSON.parse(response);
      usuarios.forEach((usuario) => {
        let nombre = usuario.nombre;
        let apellido = usuario.apellido;
        let dni_usuario = usuario.dni_usuario;
        let us_tipo = usuario.us_tipo;
        $("#nombre-usuario").html(nombre + " " + apellido);
        $("#dni-usuario").html(dni_usuario);
        $("#tipo-usuario").html(us_tipo);

        $("#card-update").click(function () {
          $("#modal-update").removeClass("md-hidden");
          $("#name-user").val(nombre);
          $("#email-user").val(correo);
          $("#password-user").val(password);
          //   $("#password-user").val(password);
        });
        $("#form-update-user").submit(function (e) {
          e.preventDefault();
          const nombres = $("#name-user").val();
          const correo = $("#email-user").val();
          const password = $("#password-user").val();
          funcion = "actulizar-admin";
          $.post(
            "../controlador/UsuarioController.php",
            { funcion, nombres, correo, password },
            (response) => {
              console.log(response);
              if (response.trim() == "actualizacion_exitosa") {
                $("#toast-modal-exito").addClass("toast_show");
                setInterval(() => {
                  $("#toast-modal-exito").removeClass("toast_show");
                }, 2000);
                buscar_usuario();
              } else {
                $("#toast-modal-error").addClass("toast_show");
                setInterval(() => {
                  $("#toast-modal-exito").removeClass("toast_show");
                }, 2000);
              }
            }
          );
        });

        $("#close-modal").click(function () {
          $("#modal-update").addClass("md-hidden");
        });
      });
    });
  }
});
