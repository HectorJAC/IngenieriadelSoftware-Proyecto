<?php
    if (!empty($_GET['tareaeid'])) {
        include_once('../php/pheader.php');
        $id = $_GET['tareaeid'];
        $row = NotaTarea($link, $id);

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
            <li class="is-active"><a href="#" aria-current="page"> Mis Cursos - Asignar Nota de una Tarea a Estudiante </a></li>
        </ul>
    </nav>
    <!-- Titulos -->
    <div class="block">
        <h1 class="title"> Nota de la tarea: <?php echo $row['titulo_tarea'] ?>  </h1>
        <h2 class="subtitle"> <?php echo $row['nombre'] ?> <?php echo $row['apellido'] ?> </h2>
    </div>

    <!-- Contenido -->
    <div class="block">

        <div class="columns">
            <div class="column is-12">
                <form action="nota-tarea-crud.php?accion=UDT" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="tareaeid" id="tareaeid" value="<?php echo $row['tareaeid']; ?>">
                    <input type="hidden" name="tareaid" id="tareaid" value="<?php echo $row['tareaid']; ?>">
                    <input type="hidden" name="estudianteid" id="estudianteid" value="<?php echo $row['estudianteid']; ?>">
                
                <div class="field">
                    <label class="label"> Nota de la Tarea </label>
                    <div class="control">
                        <input class="input" type="number" name="nota" id="nota">
                    </div>
                </div>

                <div class="field is-grouped">
                    <p class="control">
                        <input class="button is-primary" type="submit" value="Guardar" name="guardar"> 
                    </p>
                    <p class="control">
                        <a class="button is-light" href="javascript: history.go(-1)"> Regresar </a>
                    </p>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once('../php/pfooter.php');
?>