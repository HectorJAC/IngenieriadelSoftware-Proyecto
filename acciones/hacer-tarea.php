<?php

    if (!empty($_GET['tareaid'])) {
        include_once('../php/pheaderE.php');
        $id = $_GET['tareaid'];
        $row2 = RealizarTareas($link, $id);
        $estudiante = $_SESSION['estudianteid'];
        $row = EditarEstudiantes($link, $estudiante);

    } else {
        session_start();
        $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no permitida";
        $_SESSION['mensajeTipo'] = "is-warning";
        header("Location: ./cursos-miosE.php");
    }

?>

<div class="column is-half">
    <!-- Migas de Pan -->
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="../pbodyE.php"> Inicio </a></li>
            <li class="is-active"><a href="#" aria-current="page"> Realizar Tarea </a></li>
        </ul>
    </nav>
    <!-- Titulos -->
    <div class="block">
        <h1 class="title"> Curso: <?php echo $row2['nombre_curso'] ?> </h1>
        <h2 class="subtitle"> Realizar Tarea: <?php echo $row2['titulo_tarea'] ?> </h2>
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
    <div class="block">

        <div class="columns">
            <div class="column is-5">
                <form action="./hacer-tarea-crud.php?accion=INS" method="POST" enctype="multipart/form-data" autocomplete="off"> 
                    <input type="hidden" name="tareaid" id="tareaid" value="<?php echo $row2['tareaid']; ?>">
                    <input type="hidden" name="estudianteid" id="estudianteid" value="<?php echo $row['estudianteid']; ?>">

                <div class="field is-grouped">
                    <p class="control">
                        <input type="file" name="archivo">
                    </p>
                </div>

                <div class="field is-grouped">
                    <p class="control">
                        <input class="button is-primary" type="submit" value="Subir tarea" name="guardar"> 
                        <a class="button is-light" href="javascript: history.go(-1)"> Regresar </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

<?php
    include_once('../php/pfooter.php');
?>