<ul class="sidebar navbar-nav position-static">
    <li class="nav-item">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel de Control</span>
        </a>
    </li>
    <?php if ($_SESSION["nivel"] == "Administrador") {
        # code...
    ?>
    <li class="nav-item">
        <a class="nav-link" href="usuarios.php">
            <i class="fas fa-users"></i>
            <span>Usuarios</span>
        </a>
    </li>
<?php }?>

    <li class="nav-item">
        <a class="nav-link" href="alumnos.php">
            <i class="fas fa-user-graduate"></i>
            <span>Alumnos</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="carreras.php?t=integradora">
            <i class="fas fa-folder-open"></i>
            <span>Integradora</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="carreras.php?t=estadias">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Estadias</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="carreras.php?t=especiales">
            <i class="fas fa-id-card-alt"></i>
            <span>Especiales</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link"  onclick="cerrarSesion('Está seguro que desea cerrar su sesión ?','warning','../modelo/logout.php')">
            <i class="fas fa-fw fa-power-off"></i>
            <span>Cerrar Sesión</span>
        </a>

      
    </li>

</ul>