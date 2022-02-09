<?php
if ($_SESSION["us_tipo"] == 1) {
?>
    <div class="sidebar">
        <div class="container-img-sidebar">
            <img src="../img/logo_plataforma.png" alt="">
        </div>
        <ul class="nav-sidebar">
            <span class="title_nav">Escritorio</span>
            <li><a href="./consultas.php"><i class="far fa-user"></i> Perfil</a></li>
            <span class="title_nav">Gestion de Envios</span>
            <li><a href="./Registrarenvios.php"><i class="fas fa-people-carry"></i> Registrar Envios</a></li>
            <li><a href="./searchregistros.php"><i class="fas fa-search"></i> Buscar envios</a></li>
            <li><a href=""><i class="fas fa-truck"></i> Registrar Sedes</a></li>
            <li><a href="./Reset_user.php"><i class="fas fa-lock"></i> Resetear clave</a></li>
            <li><a href="../controlador/LogoutController.php"><i class="fas fa-angle-left"></i> Cerrar Sesion</a></li>
        </ul>
    </div>
<?php
} else {
?>
    <div class="sidebar">
        <div class="container-img-sidebar">
            <img src="../img/logo_plataforms.png" alt="">
            <span class="title-system">Complaints System</span>
        </div>
        <ul class="nav-sidebar">
            <span class="title_nav">Profile</span>
            <li><a href="./consultas.php"><i class="far fa-user"></i> Perfil</a></li>
            <span class="title_nav">Quejas</span>
            <li><a href="./Quejas.php"><i class="far fa-comment-alt"></i> Quejas</a></li>
            <li><a href="../controlador/LogoutController.php"><i class="fas fa-angle-left"></i> Cerrar Sesion</a></li>
        </ul>
    </div>
<?php
}
?>