<?php

    if (!empty($_GET['tareaid'])) {
        include_once('../php/pheader.php');
        $id = $_GET['tareaid'];
        $resultadote = TareasEstudiantes($link, $id);
    } else {
        session_start();
        $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no permitida";
        $_SESSION['mensajeTipo'] = "is-warning";
        header("Location: ./todos-estudiantesC.php");
    }

?>

<div class="column is-half">
    <!-- Migas de Pan -->
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="../pbody.php"> Inicio </a></li>
            <li class="is-active"><a href="#" aria-current="page"> Todas las tareas </a></li>
        </ul>
    </nav>
    <!-- Titulos -->
    <div class="block">
        <h1 class="title"> Tareas realizadas por los estudiantes </h1> 
        <h2>  </h2>    
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
                    <th> Titulo Tarea </th>
                    <th> Descripcion de la Tarea </th>
                    <th> Estudiante </th> 
                    <th> Archivo </th>
                    <th> Descargar </th>
                    <th> Nota </th>
                </thead>
                <tbody>
                    <?php  
                        while ($row = mysqli_fetch_array($resultadote, MYSQLI_ASSOC)) {
                            $rutaDescarga = "../archivos/".$row['nombre_entrega'];
                    ?>
                        <tr>
                            <td> <?php echo $row['titulo_tarea'] ?> </td>
                            <td> <?php echo $row['descripcion'] ?> </td>
                            <td> <?php echo $row['nombre'] ?> </td>
                            <td> <?php echo $row['nombre_entrega'] ?> </td>
                            <td> <a href="<?php echo $rutaDescarga ?>" 
                                    download="<?php echo $row['nombre_entrega'] ?>"
                                    class="btn btn-succes btn-sm"
                                > 
                                    <span class="fas fa-download"></span> 
                                </a> 
                            </td>
                            <td> <?php echo $row['nota'] ?> </td>
                            <td>
                                    <a 
                                        class="button is-info" 
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="Asignar Nota a la Tarea" name="guardar" 
                                        href="./nota-tarea.php?accion=INS&tareaeid=<?php echo $row['tareaeid'] ?>"> 
                                        <i class="fas fa-edit"> </i> 
                                    </a> 
                                </td>
                        </tr>
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