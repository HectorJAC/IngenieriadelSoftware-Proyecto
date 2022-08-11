<?php

    if (!empty($_GET['tareaid'])) {
        include_once('../php/pheaderE.php');
        $id = $_GET['tareaid'];
        $estudiante = $_SESSION['estudianteid'];
        $resultadotr = MostrarTareaRealizada($link, $id, $estudiante);
        $resultadote = TareasEstudiantes($link, $id);
    } else {
        session_start();
        $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no permitida";
        $_SESSION['mensajeTipo'] = "is-warning";
        header("Location: ./cursos-verE.php");
    }

?>

<div class="column is-half">
    <!-- Migas de Pan -->
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="../pbodyE.php"> Inicio </a></li>
            <li class="is-active"><a href="#" aria-current="page"> Ver Tarea Realizada </li>
        </ul>
    </nav>
    <!-- Titulos -->
    <div class="block">
    <h1 class="title"> Ver Tarea Realizada </h1> 
            <?php if ($row = mysqli_fetch_array($resultadote, MYSQLI_ASSOC)) {?>
                    <h2 class="subtitle"> Tarea: <?php echo $row['titulo_tarea'] ?>
            <?php } else { ?>
                    No has realizado esta tarea
            <?php } ?>
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
                    <th> Archivo </th>
                    <th> Descargar </th>
                    <th> Nota </th>
                </thead>
                <tbody>
                    <?php
                        if ($row = mysqli_fetch_array($resultadotr, MYSQLI_ASSOC)) {
                            if ($row['estudianteid'] = $estudiante) {
                                if ($row['tareaid'] == $id) {
                                        $rutaDescarga = "../archivos/".$row['nombre_entrega'];
                    ?>
                        <tr>
                            <td> <?php echo $row['nombre_entrega'] ?> </td>
                            <td> <a href="<?php echo $rutaDescarga ?>" 
                                    download="<?php echo $row['nombre_entrega'] ?>"
                                    class="btn btn-succes btn-sm"
                                > 
                                    <span class="fas fa-download"></span> 
                                </a> 
                            </td>
                            <td> <?php echo $row['nota'] ?> </td>
                        </tr>
                    <?php
                                }
                            } 
                        } else {
                    ?>
                        <h2> RECUERDA REALIZAR TUS TAREAS A TIEMPO </h2>
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