<?php
    include_once('../php/pheader.php');
?>

<div class="column is-half">
    <!-- Migas de Pan -->
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="../pbody.php"> Inicio </a></li>
            <li class="is-active"><a href="#" aria-current="page"> Crear cursos </a> </li>
        </ul>
    </nav>
    <!-- Titulos -->
    <div class="block">
        <h1 class="title"> Cursos </h1>
        <h2 class="subtitle"> Crear un nuevo curso </h2>
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
                <form action="./cursos-crud.php?accion=INS" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="profesorid" id="profesorid" value="<?php echo $row['profesorid']; ?>">

                <div class="field">
                    <label class="label"> Nombre del curso </label>
                    <div class="control">
                        <input class="input" type="text" name="nombre_curso" id="nombre_curso">
                    </div>
                </div>

                <div class="field">
                    <label class="label"> Descripcion del curso </label>
                    <div class="control">
                        <textarea class="textarea" name="descripcion_curso" id="descripcion_curso"></textarea>
                    </div>
                </div> 

                <div class="field is-grouped">
                    <p class="control">
                        <input class="button is-primary" type="submit" value="Crear curso" name="guardar"> 
                    </p>
                </div>
            </form>
        </div>
    </div>

<?php
    include_once('../php/pfooter.php');
?>