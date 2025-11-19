<?php
// Detecta la página actual para marcar el link activo automáticamente
$current = basename($_SERVER['PHP_SELF']);
function isActive($page, $current) { return $page === $current ? 'active' : ''; }

// Datos de usuario desde sesión
$usuarioNombre = isset($_SESSION['nomUsuario']) ? $_SESSION['nomUsuario'] : "Invitado";
$usuarioUser = isset($_SESSION['usuUsuario']) ? $_SESSION['usuUsuario'] : "";
$usuarioRol = isset($_SESSION['rolNombre']) ? $_SESSION['rolNombre'] : "cliente";

// Determinar el icono según el rol
$userIcon = ($usuarioRol == "administrador") ? "bi-person-gear" : "bi-person";
$userBadge = ($usuarioRol == "administrador") ? "bg-warning" : "bg-info";

// Fecha y hora actual en español
setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain');
$fechaActual = strftime("%d/%m/%Y");
$horaActual = date('H:i:s');
// Fallback si strftime no está disponible
if (empty($fechaActual)) {
    $fechaActual = date('d/m/Y');
}
?>

<!-- Bootstrap 5 -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-light rappi-nav sticky-top shadow">
  <div class="container-fluid">
    <!-- Logo Rappi -->
    <a class="navbar-brand d-flex align-items-center" href="inicio.php">
      <img src="imagenes/productos/rappi.png" alt="Rappi Pachuca" class="rappi-logo">
    </a>

    <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#rappiNavbar"
            aria-controls="rappiNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="rappiNavbar">
      <ul class="navbar-nav me-auto align-items-lg-center mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-white <?= isActive('inicio.php',$current) ?>" href="inicio.php">
            <i class="bi bi-house-door me-1"></i>Inicio
          </a>
        </li>        
        <li class="nav-item">
          <a class="nav-link text-white <?= isActive('rptarticulos.php',$current) ?>" href="inicio.php?op=rptarticulos">
            <i class="bi bi-box-seam me-1"></i>Productos
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= isActive('rptusuarios.php',$current) ?>" href="inicio.php?op=rptusuarios">
            <i class="bi bi-people me-1"></i>Usuarios
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= isActive('abcproductos.php',$current) ?>" href="inicio.php?op=abcproductos">
            <i class="bi bi-pencil-square me-1"></i>Admin Productos
          </a>
        </li>
      </ul>

      <!-- Sección de Usuario y Fecha (Derecha) -->
      <div class="user-info-card d-none d-lg-flex align-items-center">
        <div class="user-avatar-circle">
          <img src="imagenes/usuarios/1.jpg" alt="Usuario" class="avatar-img">
        </div>
        <div class="user-details-right ms-3">
          <div class="user-fecha">
            <strong>Fecha:</strong> <?= $fechaActual ?>
          </div>
          <div class="user-nombre-display">
            <strong>Usuario:</strong> (<?= $usuarioNombre ?>)
          </div>
          <div class="user-hora">
            <i class="bi bi-clock me-1"></i><?= $horaActual ?>
          </div>
        </div>
        
        <!-- Menú desplegable -->
        <div class="dropdown ms-2">
          <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-three-dots-vertical"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><span class="dropdown-item-text small">
              <strong>Usuario:</strong> <?= $usuarioUser ?><br>
              <strong>Rol:</strong> <?= $usuarioRol ?>
            </span></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <?php if (isset($_SESSION['nomUsuario'])): ?>
                <a class="dropdown-item text-danger" href="inicio.php?op=cerrarsesion">
                  <i class="bi bi-box-arrow-right me-1"></i>Cerrar Sesión
                </a>
              <?php else: ?>
                <a class="dropdown-item" href="inicio.php?op=acceso">
                  <i class="bi bi-box-arrow-in-right me-1"></i>Iniciar Sesión
                </a>
              <?php endif; ?>
            </li>
          </ul>
        </div>
      </div>

      <!-- Versión móvil -->
      <div class="d-lg-none mt-3">
        <div class="user-info-mobile">
          <div class="text-white text-center mb-2">
            <i class="bi bi-person-circle fs-1"></i>
            <div><strong><?= $usuarioNombre ?></strong></div>
            <div class="small"><?= $fechaActual ?> - <?= $horaActual ?></div>
          </div>
          <?php if (isset($_SESSION['nomUsuario'])): ?>
            <a class="btn btn-light btn-sm w-100" href="inicio.php?op=cerrarsesion">
              <i class="bi bi-box-arrow-right me-1"></i>Cerrar Sesión
            </a>
          <?php else: ?>
            <a class="btn btn-light btn-sm w-100" href="inicio.php?op=acceso">
              <i class="bi bi-box-arrow-in-right me-1"></i>Iniciar Sesión
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</nav>

<style>
  /* Estilo principal del navbar tipo Rappi */
  .rappi-nav {
    background: linear-gradient(135deg, #ff6b6b 0%, #ff5252 100%);
    padding: 0.8rem 0;
  }
  
  /* Logo de Rappi */
  .rappi-logo {
    height: 50px;
    width: auto;
    object-fit: contain;
    transition: transform 0.3s ease;
  }
  
  .rappi-logo:hover {
    transform: scale(1.05);
  }
  
  .rappi-nav .navbar-brand {
    padding: 0.5rem 1rem;
  }
  
  /* Card de información de usuario (DERECHA) */
  .user-info-card {
    background: linear-gradient(135deg, #ff8a8a 0%, #ff6b6b 100%);
    border-radius: 25px;
    padding: 0.6rem 1.2rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
  }
  
  .user-avatar-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    overflow: hidden;
  }
  
  .avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .user-details-right {
    color: white;
    line-height: 1.3;
  }
  
  .user-fecha {
    font-size: 0.75rem;
    font-weight: 500;
  }
  
  .user-nombre-display {
    font-size: 0.85rem;
    font-weight: 600;
    margin: 2px 0;
  }
  
  .user-hora {
    font-size: 0.7rem;
    opacity: 0.9;
  }
  
  .rappi-nav .nav-link {
    position: relative;
    padding: 0.5rem 1rem;
    font-weight: 500;
    transition: all 0.3s ease;
  }
  
  .rappi-nav .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    transform: translateY(-2px);
  }
  
  .rappi-nav .nav-link.active {
    background-color: rgba(255, 255, 255, 0.3);
    border-radius: 8px;
  }
  
  /* Dropdown personalizado */
  .dropdown-menu {
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    border: none;
  }
  
  /* Usuario móvil */
  .user-info-mobile {
    background-color: rgba(255, 255, 255, 0.15);
    padding: 1rem;
    border-radius: 12px;
  }
  
  /* Responsive logo */
  @media (max-width: 992px) {
    .rappi-logo {
      height: 40px;
    }
  }
</style>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
// Actualizar hora en tiempo real
function actualizarHora() {
    const ahora = new Date();
    const horas = String(ahora.getHours()).padStart(2, '0');
    const minutos = String(ahora.getMinutes()).padStart(2, '0');
    const segundos = String(ahora.getSeconds()).padStart(2, '0');
    const horaActual = horas + ':' + minutos + ':' + segundos;
    
    const elementoHora = document.querySelector('.user-hora');
    if (elementoHora) {
        elementoHora.innerHTML = '<i class="bi bi-clock me-1"></i>' + horaActual;
    }
    
    const elementoHoraMobile = document.querySelector('.user-info-mobile .small');
    if (elementoHoraMobile) {
        const fecha = elementoHoraMobile.textContent.split(' - ')[0];
        elementoHoraMobile.textContent = fecha + ' - ' + horaActual;
    }
}

// Actualizar cada segundo
setInterval(actualizarHora, 1000);
// Ejecutar inmediatamente
actualizarHora();
</script>