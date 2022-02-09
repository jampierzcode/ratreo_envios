$(document).ready(function () {
  var funcion = "";

  $("#search_quejas_user").submit(function (e) {
    funcion = "buscar_quejas_user";
    e.preventDefault();
    const email = $("#input_correo").val();
    $.post(
      "../controlador/UsuarioController.php",
      { funcion, email },
      (response) => {
        let template = "";
        if (response.trim() == "sin_quejas") {
          template += `
                <p>No hay quejas por parte de este usuario o el correo es incorrecto</p>
            `;
        } else {
          const quejas = JSON.parse(response);

          quejas.forEach((queja) => {
            template += `
                <div class="queja_user">
                    <h1>Fecha: <span>${queja.fecha}</span></h1>
                    <p>Descripcion: <span>${queja.descripcion}</span></p>
                    <p>Direccion: <span>${queja.direccion}</span></p>
                    <p>Tipo Queja: <span>${queja.nombre}</span></p>
                </div>
              `;
          });
        }

        $("#list-quejas").html(template);
      }
    );
  });
});
