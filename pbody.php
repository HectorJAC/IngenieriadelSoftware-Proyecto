<?php
  include_once('php/pheader.php');
?>

<div class="column is-right">

  <!-- Migas de pan -->
  <nav class="breadcrumb" aria-label="breadcrumbs">
    <ul>
      <li><a href="./pbody.php"> Inicio </a></li>
    </ul>
  </nav>

<!-- Titulos -->
  <div class="block">
    <h1 class="title"> Vista Profesor </h1>
  </div>

  <!-- Contenido -->
  <div class="block">
    <h1> 
      Bienvenido profesor <?php echo utf8_decode($row['username']); ?>  <?php echo utf8_decode($row['apellido']); ?>. 
      Puede crear un curso, crear una tarea dentro de un curso o subir un libro.
      </br>
      Para empezar a trabajar ingrese a uno de los apartados de la izquierda.
    </h1>
  </div>


  <?php
    include_once('php/pfooter.php');
  ?>