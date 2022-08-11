<?php
    include_once('../php/pheader.php');
    $resultado = VerCursos($link);
?>

<div class="column is-half">
    <!-- Migas de Pan -->
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="../pbody.php"> Inicio </a></li>
            <li class="is-active"><a href="#" aria-current="page"> Ver Cursos </a></li>
        </ul>
    </nav>
    <!-- Titulos -->
    <div class="block">
        <h1 class="title"> Cursos </h1>
        <h2 class="subtitle"> Ver todos los cursos </h2>
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

    <div class="column is-12">
        <div class="table-container">
            <table class="table is-fullwidth">
                <thead>
                    <th> Nombre del profesor </th>
                    <th> Nombre del curso </th>
                    <th> Descripcion del curso </th>
                </thead>
                <tbody>
                    <?php  
                        while ($row = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
                    ?>
                            <tr>
                                <td> <?php echo $row['username'] ?> </td>
                                <td> <?php echo $row['nombre_curso'] ?> </td>
                                <td> <?php echo $row['descripcion_curso'] ?> </td>
                            </tr>
                        <?php 
                            }
                        ?>
                </tbody>
            </table>
        </div>
    </div>       

<?php
    include_once('../php/pfooter.php');
?>

