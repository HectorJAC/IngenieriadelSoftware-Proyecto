<?php
    include_once('../php/pheader.php');
    $profesor = $_SESSION['profesorid'];
    $resultadopc = MisCursos($link, $profesor);
?>

<div class="column is-half">
    <!-- Migas de Pan -->
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="../pbody.php"> Inicio </a></li>
            <li class="is-active"><a href="#" aria-current="page"> Ver Mis Cursos </a></li>
        </ul>
    </nav>
    <!-- Titulos -->
    <div class="block">
        <h1 class="title"> Cursos </h1>
        <h2 class="subtitle"> Cursos del profesor <?php echo $row['username'] ?> </h2>
    </div>
    <!-- Mensajes de alertas -->
    <?php
        if (!empty($_SESSION['mensajeTexto'])) { 
    ?>
        <div class="block">
            <div class="container">
                <div class="notification <?php echo $_SESSION['mensajeTipo'] ?>">
                    <button class="delete"></button>
                        <?php echo $_SESSION['mensajeTexto'] ?>
                </div>
            </div>
        </div>
        <?php 
            // session_destroy();
            $_SESSION['mensajeTexto'] = null;
            $_SESSION['mensajeTipo'] = null;
        }    
        ?>

    <div class="column is-12">
        <div class="table-container">
        <table class="table is-fullwidth">
                <thead>
                    <th>  </th>
                    <th> Nombre del profesor </th>
                    <th> Nombre del curso </th>
                    <th> Descripcion del curso </th>
                </thead>
                <tbody>
                    <?php  
                        while ($row = mysqli_fetch_array($resultadopc, MYSQLI_ASSOC)) {
                            if ($vUsuario = $profesor) { // vUsuario es la variable que contiene la sesion del usuario en activo, esta en el pheader.
                    ?>
                            <tr>
                                <td> <a 
                                        class="button is-info" 
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="Editar curso" name="editar" 
                                        href="curso-editar.php?accion=UDT&cursoid=<?php echo $row['cursoid'] ?>"> 
                                        <i class="fas fa-edit"> </i> 
                                    </a> 
                                </td>
                                <td> <?php echo $row['username'] ?> </td>
                                <td> <a href="./tareas-cursos.php?cursoid=<?php echo $row['cursoid'] ?>"> <?php echo $row['nombre_curso'] ?> </a> </td>
                                <td> <?php echo $row['descripcion_curso'] ?> </td>
                        <?php
                            } 
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </div>       

<?php
    include_once('../php/pfooter.php');
?>

