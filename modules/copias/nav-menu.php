<section class="menu cid-rHRGlFPieg" once="menu" id="menu1-6">
  <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </button>
    <div class="menu-logo">
      <div class="navbar-brand">
        <span class="navbar-logo">
          <a href="index.php">
           <img src="../assets/images/logo2.png"  title="" style="height: 3.8rem;">
         </a>
       </span>
       <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-4" href="index.php">SIGPROTI</a></span>
     </div>
   </div>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true"><li class="nav-item">
      <a class="nav-link link text-white display-4" href="index.php" aria-expanded="false">
        <span class="mbri-home mbr-iconfont mbr-iconfont-btn"></span>Inicio<br></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link link text-white dropdown-toggle display-4" href="https://mobirise.co" data-toggle="dropdown-submenu" aria-expanded="false">
          <span class="mbri-to-local-drive mbr-iconfont mbr-iconfont-btn"></span>
          Proyectos
        </a>
        <div class="dropdown-menu">
          <a class="text-white dropdown-item display-4" href="integradora.php">
            <span class="mbri-website-theme mbr-iconfont mbr-iconfont-btn"></span>
            Integradora
          </a>
          <a class="text-white dropdown-item display-4" href="estadias.php" aria-expanded="false">
            <span class="mbri-sun mbr-iconfont mbr-iconfont-btn"></span>Estadías</a><a class="text-white dropdown-item display-4" href="especiales.php" aria-expanded="false"><span class="mbri-features mbr-iconfont mbr-iconfont-btn"></span>Especiales</a></div>
          </li>
          <?php if ($_SESSION["nivel"] == "Administrador") {?>
            <li class="nav-item dropdown open">
              <a class="nav-link link text-white dropdown-toggle display-4" href="https://mobirise.co" aria-expanded="true" data-toggle="dropdown-submenu">
                <span class="mbri-tablet mbr-iconfont mbr-iconfont-btn"></span>
                Alumnos
              </a>
              <div class="dropdown-menu">
                <a class="text-white dropdown-item display-4" href="adduser.php" aria-expanded="false">
                  <span class="mbri-contact-form mbr-iconfont mbr-iconfont-btn"></span>Ver registrados
                </a>
                <a class="text-white dropdown-item display-4" href="userwait.php" aria-expanded="false">
                  <span class="mbri-clock mbr-iconfont mbr-iconfont-btn"></span>Ver en espera
                </a>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link link text-white display-4" href="usuarios.php" aria-expanded="false">
                <span class="mbri-user mbr-iconfont mbr-iconfont-btn"></span>
                Usuarios
              </a>
            </li>
          <?php } ?>
        </ul>
        <div class="navbar-buttons mbr-section-btn">
          <a class="btn btn-sm btn-secondary-outline display-4"  onclick="cerrarSesion('Está seguro que desea cerrar su sesión ?','warning','../modelo/logout.php')">
            <span class="mbri-logout mbr-iconfont mbr-iconfont-btn"></span>
            Cerrar sesión
          </a>
        </div>
      </div>
    </nav>
  </section>