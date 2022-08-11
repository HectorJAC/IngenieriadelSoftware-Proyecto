<?php
    include_once('../php/pheaderE.php');
    $estudiante = $_SESSION['estudianteid'];
    $resultadoec = MisCursosE($link, $estudiante);
?>

<div class="column is-half">
    <!-- Migas de Pan -->
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="../pbodyE.php"> Inicio </a></li>
            <li class="is-active"><a href="#" aria-current="page"> Ver Mis Cursos </a></li>
        </ul>
    </nav>
    <!-- Titulos -->
    <div class="block">
        <h1 class="title"> Cursos </h1>
        <h2 class="subtitle"> Cursos del estudiante <?php echo $row['nombre'] ?> </h2>
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
                    <th> Nombre del Curso </th>
                    <th> Profesor </th>
                    <th> Descripcion </th>
                    <th> Nota Final </th>
                </thead>
                <tbody>
                    <?php  
                        while ($row = mysqli_fetch_array($resultadoec, MYSQLI_ASSOC)) {
                            if ($cUsuario = $estudiante) { // cUsuario es la variable que contiene la sesion del usuario en activo, en este caso el estudiante, esta en el pheaderE.
                    ?>
                            <tr>
                                <td> <a href="./tareas-cursosE.php?cursoid=<?php echo $row['cursoid'] ?>"> <?php echo $row['nombre_curso'] ?> </a> </td>
                                <td> <?php echo $row['username'] ?> </td>
                                <td> <?php echo $row['descripcion_curso'] ?> </td>
                                <td> <?php echo $row['nota_final'] ?> </td>
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
    include_once('../php/pfooter.php');
?>

