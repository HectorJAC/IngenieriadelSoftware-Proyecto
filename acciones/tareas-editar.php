<?php
    if (!empty($_GET['tareaid'])) {
        include_once('../php/pheader.php');
        $id = $_GET['tareaid'];
        $row = EditarTareas($link, $id);

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
            <li class="is-active"><a href="#" aria-current="page"> Mis Cursos - Editar Tarea </a></li>
        </ul>
    </nav>
    <!-- Titulos -->
    <div class="block">
        <h1 class="title"> Editar Tarea  </h1>
        <h2 class="subtitle"> <?php echo $row['titulo_tarea'] ?> </h2>
    </div>

    <!-- Contenido -->
    <div class="block">

        <div class="columns">
            <div class="column is-12">
                <form action="tareas-crud.php?accion=UDT" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="tareaid" id="tareaid" value="<?php echo $row['tareaid']; ?>">
                    <input type="hidden" name="cursoid" id="cursoid" value="<?php echo $row['cursoid']; ?>">
                
                <div class="field">
                    <label class="label"> Titulo de la tarea </label>
                    <div class="control">
                        <input class="input" type="text" name="titulo" id="titulo">
                    </div>
                </div>

                <div class="field">
                    <label class="label"> Descripcion de la tarea </label>
                    <div class="control">
                        <textarea class="textarea" name="descripcion" id="descripcion"></textarea>
                    </div>
                </div>

                <div class="field is-grouped">
                    <p class="control">
                        <input type="file" name="archivo">
                    </p>
                </div>

                <div class="field is-grouped">
                    <p class="control">
                        <input class="button is-primary" type="submit" value="Editar tarea" name="guardar"> 
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