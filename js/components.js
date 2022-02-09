$(document).ready(function () {
  // Change Interfaz Usuario
  $("#btn-register-click").click(function () {
    $(".login-form").addClass("hidden-form");
    $(".register-form").removeClass("hidden-form");
  });
  $("#btn-login-click").click(function () {
    $(".register-form").addClass("hidden-form");
    $(".login-form").removeClass("hidden-form");
  });
});
