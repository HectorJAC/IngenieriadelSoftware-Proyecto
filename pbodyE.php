<?php
  include_once('php/pheaderE.php');
  $estudiante = $_SESSION['estudianteid'];
  $resultadoNotificaciones = MostrarNotificaciones($link, $estudiante);
  $resultadoTopicosE = MostrarTopicosE($link, $estudiante);
?>

<div class="column is-right">

  <!-- Migas de pan -->
  <nav class="breadcrumb" aria-label="breadcrumbs">
    <ul>
      <li><a href="./pbodyE.php"> Inicio </a></li>
    </ul>
  </nav>

<!-- Titulos -->
<div class="block">
    <h1 class="title"> Vista Estudiante </h1>
  </div>

  <!-- Contenido -->
  <div class="block">
    <h1> 
      Bienvenido estudiante <?php echo utf8_decode($row['nombre']); ?>  <?php echo utf8_decode($row['apellido']); ?>, 
      para empezar a trabajar ingrese a unos de los apartados de la derecha.
    </h1>
    <h1>
      El topico de interes que has elegido es el de: 
      <b> 
        <?php 
          $row = mysqli_fetch_array($resultadoTopicosE, MYSQLI_ASSOC);
          if ($cUsuario = $estudiante) {
            echo $row['topico']; 
          }
        ?> 
      </b>
    </h1>

  </div>
  <h1> <b> Notificaciones </b> </h1>
  <div class="column is-12">
        <div class="table-container">
            <table class="table is-fullwidth">
                <thead>
                  <th> Mensaje </th>
                </thead>
                <tbody>
                    <?php  
                        while ($row = mysqli_fetch_array($resultadoNotificaciones, MYSQLI_ASSOC)) {
                          if ($cUsuario = $estudiante) { // cUsuario es la variable que contiene la sesion del usuario en activo, en este caso del estudiante, esta en el pheaderE.
                    ?>
                            <tr>
                                <td> <?php echo $row['mensaje'] ?> </td>
                                <td> <a 
                                        class="button is-danger" 
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="Borrar notificacion" 
                                        name="eliminar" 
                                        href="./acciones/notificaciones-crud.php?accion=DLT&notificacionid=<?php echo $row['notificacionid'] ?>"> 
                                        <i class="fas fa-trash"> </i>
                                      </a> 
                                </td>
                            </tr>
                        <?php 
                            }
                          }
                        ?>
                </tbody>
            </table>
        </div>
    </div> 


  <?php
    include_once('php/pfooter.php');
  ?>