<?php
    if (!empty($_GET['cursoeid'])) {
        include_once('../php/pheader.php');
        $id = $_GET['cursoeid'];
        $row = NotaFinal($link, $id);

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
            <li class="is-active"><a href="#" aria-current="page"> Mis Cursos - Asignar Nota Final a Estudiante </a></li>
        </ul>
    </nav>
    <!-- Titulos -->
    <div class="block">
        <h1 class="title"> Nota Final del curso <?php echo $row['nombre_curso'] ?>  </h1>
        <h2 class="subtitle"> <?php echo $row['nombre'] ?> <?php echo $row['apellido'] ?> </h2>
    </div>

    <!-- Contenido -->
    <div class="block">

        <div class="columns">
            <div class="column is-12">
                <form action="nota-final-crud.php?accion=UDT" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="cursoeid" id="cursoeid" value="<?php echo $row['cursoeid']; ?>">
                    <input type="hidden" name="cursoid" id="cursoid" value="<?php echo $row['cursoid']; ?>">
                    <input type="hidden" name="estudianteid" id="estudianteid" value="<?php echo $row['estudianteid']; ?>">
                
                <div class="field">
                    <label class="label"> Nota Final </label>
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