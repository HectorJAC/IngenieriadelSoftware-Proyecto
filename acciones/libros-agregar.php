<?php
    include_once('../php/pheader.php');
    $resultadoTopicos = MostrarTopicos($link);
?>

<div class="column is-half">
    <!-- Migas de Pan -->
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="../pbody.php"> Inicio </a></li>
            <li class="is-active"><a href="#" aria-current="page"> Subir Libros </a></li>
        </ul>
    </nav>
    <!-- Titulos -->
    <div class="block">
        <h1 class="title"> Libros </h1>
        <h2 class="subtitle"> Agregar un nuevo libro </h2>
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
                <form action="./libros-crud.php?accion=INS" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="profesorid" id="profesorid" value="<?php echo $row['profesorid']; ?>">
                <div class="field">
                    <label class="label"> Titulo </label>
                    <div class="control">
                        <input class="input" type="text" name="titulo" id="titulo">
                    </div>
                </div>

                <div class="field">
                    <label class="label"> Descripcion </label>
                    <div class="control">
                        <textarea class="textarea" name="descripcion" id="descripcion"></textarea>
                    </div>
                </div>

                <div class="field">
                    <label class="label"> Asignar topico al que pertenece el libro </label>
                        <div class="control">
                            <div class="select">
                                <select name="topicoid" id="topicoid">
                                    <?php
                                        while ($row = mysqli_fetch_array($resultadoTopicos, MYSQLI_ASSOC)) {
                                    ?>
                                    <option value="<?php echo $row['topicoid']; ?>"> <?php echo $row['topico'] ?> </option>
                                <?php 
                                    }
                                ?> 
                                </select> 
                            </div>
                        </div> 
                </div>    

                <div class="field is-grouped">
                    <p class="control">
                        <input type="file" name="archivo">
                    </p>
                </div>

                <div class="field is-grouped">
                    <p class="control">
                        <input class="button is-primary" type="submit" value="Subir" name="guardar">
                    </p>
                </div>
            </form>
        </div>
    </div>

<?php
include_once('../php/pfooter.php');
?>