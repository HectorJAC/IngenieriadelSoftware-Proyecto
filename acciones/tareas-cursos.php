<?php

    if (!empty($_GET['cursoid'])) {
        include_once('../php/pheader.php');
        $id = $_GET['cursoid'];
        $resultadomt = MostrarCursos($link, $id);
        $resultadomt2 = MostrarTareas($link, $id);
        $resultadotec = TotalEstudiantesCursos($link, $id);
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
            <li class="is-active"><a href="#" aria-current="page"> Todas las tareas </a></li>
        </ul>
    </nav>
    <!-- Titulos -->
    <div class="block">
        <h1 class="title"> Ver Tareas </h1>
        <h2 class="subtitle"> Ver todas las tareas del 
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
        <h1> 
            Total de estudiantes: 
            <?php $row2 = mysqli_fetch_array($resultadotec, MYSQLI_ASSOC) ?>
            <a 
                title="Ver todos los estudiantes"    
                href="./todos-estudiantesC.php?cursoid=<?php echo $row['cursoid'] ?>"
            > 
                <b> <?php echo $row2['TotalEstudiantes'] ?> </b> 
            </a>
        </h1>
        
        <a 
            class="button is-info" 
            data-toggle="tooltip" 
            data-placement="top" 
            title="Crear nueva tarea" name="guardar" 
            href="./tareas-crear.php?accion=INS&cursoid=<?php echo $row['cursoid'] ?>"> 
            <i class="fas fa-edit"> </i> 
        </a> 
        <table class="table is-fullwidth">
                <thead>
                    <th> </th>
                    <th> Titulo de la Tarea </th>
                    <th> Descripcion de la tarea </th>
                    <th> Archivo </th>
                    <th> Descargar </th>
                </thead>
                <tbody>
                    <?php  
                        while ($row = mysqli_fetch_array($resultadomt2, MYSQLI_ASSOC)) {
                            $rutaDescarga = "../archivos/".$row['nombre_archivo'];
                    ?>
                            <tr>
                                <td>
                                    <a 
                                        class="button is-info" 
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="Editar Tarea" name="guardar" 
                                        href="./tareas-editar.php?accion=UDT&tareaid=<?php echo $row['tareaid'] ?>"> 
                                        <i class="fas fa-edit"> </i> 
                                    </a> 
                                </td>
                                <td> <a href="./tareas-estudiantes.php?tareaid=<?php echo $row['tareaid'] ?>"> <?php echo $row['titulo_tarea'] ?> </a> </td>
                                <td> <?php echo $row['descripcion'] ?> </td>
                                <td> <?php echo $row['nombre_archivo'] ?> </td>
                                <td> <a href="<?php echo $rutaDescarga ?>" 
                                        download="<?php echo $row['nombre_archivo'] ?>"
                                        class="btn btn-succes btn-sm"
                                    > 
                                        <span class="fas fa-download"></span> 
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