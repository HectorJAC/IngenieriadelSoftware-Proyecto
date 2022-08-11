<?php

    if (!empty($_GET['cursoid'])) {
        include_once('../php/pheader.php');
        $id = $_GET['cursoid'];
        $resultadomt = MostrarCursos($link, $id);
        $resultadoEstudiantes = MostrarEstudiantes($link, $id);
    } else {
        session_start();
        $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no permitida";
        $_SESSION['mensajeTipo'] = "is-warning";
        header("Location: ./cursos-mios.php");
    }

?>

<div class="column is-half">
    <!-- Migas de Pan -->
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="../pbody.php"> Inicio </a></li>
            <li class="is-active"><a href="#" aria-current="page"> Todas los estudiantes </a> </li>
        </ul>
    </nav>
    <!-- Titulos -->
    <div class="block">
        <h1 class="title"> Ver Estudiantes </h1>
        <h2 class="subtitle"> Ver todos los estudiantes del  
                                <?php $row = mysqli_fetch_array($resultadomt, MYSQLI_ASSOC) ?>
                                <?php echo $row['nombre_curso'] ?>      
                            </h2>
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

    <!-- Contenido --> 
    <div class="column is-12">
        <div class="table-container">
        <table class="table is-fullwidth">
                <thead>
                    <th> Nombre del estudiante </th>
                    <th> Apellido del estudiante </th>
                    <th> Email del estudiante </th>
                    <th> Nota Final </th>
                    <th> </th>
                </thead>
                <tbody>
                    <?php  
                        while ($row = mysqli_fetch_array($resultadoEstudiantes, MYSQLI_ASSOC)) {
                    ?>
                            <tr>
                                <td> <?php echo $row['nombre'] ?> </td>
                                <td> <?php echo $row['apellido'] ?> </td>
                                <td> <?php echo $row['email'] ?> </td>
                                <td> <?php echo $row['nota_final'] ?> </td>
                                <td>
                                    <a 
                                        class="button is-info" 
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="Asignar Nota Final" name="guardar" 
                                        href="./nota-final.php?accion=INS&cursoeid=<?php echo $row['cursoeid'] ?>"> 
                                        <i class="fas fa-edit"> </i> 
                                    </a> 
                                </td>
                        <?php
                            }
                        ?>
                </tbody>
            </table>
            <div class="field is-grouped">
                <p class="control">
                    <a class="button is-light" href="javascript: history.go(-1)"> Regresar </a>
                </p>
            </div>
        </div>
    </div>       

<?php
    include_once('../php/pfooter.php');
?>