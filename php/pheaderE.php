<?php
    include_once("conexiondb.php");
    include_once("consultas.php");


    if (isset($_SESSION['estudianteid'])) {
        $cUsuario = $_SESSION['estudianteid'];
        $row = consultarUsuarioE($link, $cUsuario);
    } else {
        $_SESSION['mensajeTexto'] = "Error: acceso al sistema no registrado, acceso denegado";
        $_SESSION['mensajeTipo'] = "is-danger";
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Style Bulma -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <!-- link rel="stylesheet" href="bulma/css/bulma.min.css" -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/Proyecto - Ingenieria del Software/library/fontawesome/css/all.min.css">

    <title> Plataforma de Aprendizaje </title>
</head>

<body>

    <!-- Barra de Menu -->
        <div class="navbar-end">
            <div class="navbar-item">
                <div class="field is-grouped">
                    <p class="control">
                        <a class="button is-light" href="#">
                            <span class="icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <span>
                                Estudiante: <?php echo utf8_decode($row['nombre']); ?>  <?php echo utf8_decode($row['apellido']); ?>
                            </span>
                        </a>

                        <a class="button is-primary" href="/Proyecto - Ingenieria del Software/php/cerrar.php">
                            <span class="icon">
                                <i class="fas fa-sign-out-alt"></i>
                            </span>
                            <span> Cerrar Sesion </span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    </nav>

    <!-- Header -->
    <section class="hero is-link">
    <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Plataforma de Aprendizaje
      </h1>
      <h2 class="subtitle">
        Proyecto Ingenieria del Software
      </h2>
    </div>
  </div>
</section>

    <!-- Cuerpo -->
    <section class ="section">
        <div class="columns is-multiline is-mobile">
            <div class="column is-one-quarter">
                <!-- trabajar con menu-->
                <aside class="menu">
                    <p class="menu-label">
                        Lista de acciones 
                    </p>
                    <ul class="menu-list">
                        <li> <a href="/Proyecto - Ingenieria del Software/acciones/libros-verE.php"> Ver todos los libros </a> </li>
                    </ul>
                    <ul class="menu-list">
                        <li> <a href="/Proyecto - Ingenieria del Software/acciones/libros-topicosE.php"> Ver libros de interes </a> </li>
                    </ul>
                    <ul class="menu-list">
                        <li> <a href="/Proyecto - Ingenieria del Software/acciones/cursos-verE.php"> Ver todos los cursos </a></li>
                    </ul>
                    <ul class="menu-list">
                        <li> <a href="/Proyecto - Ingenieria del Software/acciones/cursos-miosE.php"> Mis Cursos </a></li>
                    </ul>
                    <ul class="menu-list">
                        <li> <a href="/Proyecto - Ingenieria del Software/sobre-nosotrosE.php"> Contactanos </a> </li>
                    </ul>
                </aside>
            </div>
