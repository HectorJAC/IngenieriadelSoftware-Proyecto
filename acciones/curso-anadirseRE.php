<?php

    if (!empty($_GET['cursoid'])) {
        include_once('../php/pheaderE.php');
        $id = $_GET['cursoid'];
        $row2 = EditarCursosE($link, $id);
        $estudiante = $_SESSION['estudianteid'];
        $row = EditarEstudiantes($link, $estudiante);

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
            <li class="is-active"><a href="#" aria-current="page"> Pagina para confirmar agregarse a un curso </a></li>
        </ul>
    </nav>
    <!-- Titulos -->
    <div class="block">
        <h1 class="title"> Agregarse a un curso </h1>
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
                <form action="./cursos-anadirseE-crud.php?accion=INS" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="cursoid" id="cursoid" value="<?php echo $row2['cursoid']; ?>">
                    <input type="hidden" name="estudianteid" id="estudianteid" value="<?php echo $row['estudianteid']; ?>">   
                    
                    <h1> ESTUDIANTE:
                        <?php echo $row['nombre'] ?> </h1>

                    <h1> DESEA AGREGARSE Al CURSO:
                        <?php echo $row2['nombre_curso'] ?> </h1>

                <div class="field is-grouped">
                    <p class="control">
                        <input class="button is-primary" type="submit" value="Agregarse a curso" name="guardar"> 
                        <a class="button is-light" href="javascript: history.go(-1)"> Regresar </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

<?php
    include_once('../php/pfooter.php');
?>