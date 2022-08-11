<?php
    include_once('../php/pheaderE.php');
    $resultadoLibros = MostrarLibros($link);
?>

<div class="column is-half">
    <!-- Migas de Pan -->
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="../pbodyE.php"> Inicio </a></li>
            <li class="is-active"><a href="#" aria-current="page"> Ver Libros </a></li>
        </ul>
    </nav>
    <!-- Titulos -->
    <div class="block">
        <h1 class="title"> Libros </h1>
        <h2 class="subtitle"> Ver todos los libros </h2>
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
                    <th> Titulo </th>
                    <th> Topico </th>
                    <th> Subido por </th>
                    <th> Descripcion </th>
                    <th> Nombre del archivo </th>
                    <th> Descargar </th>
                </thead>
                <tbody>
                    <?php  
                        while ($row = mysqli_fetch_array($resultadoLibros, MYSQLI_ASSOC)) {
                            $rutaDescarga = "../archivos/".$row['nombre_archivo'];
                    ?>
                            <tr>
                                <td> <?php echo $row['titulo'] ?> </td>
                                <td> <?php echo $row['topico'] ?> </td>
                                <td> <?php echo $row['username'] ?> </td>
                                <td> <?php echo $row['descripcion'] ?> </td>
                                <td> <?php echo $row['nombre_archivo'] ?> </td>
                                <td> <a href="<?php echo $rutaDescarga ?>" 
                                        download="<?php echo $row['nombre_archivo'] ?>"
                                        class="btn btn-succes btn-sm"
                                    > 
                                        <span class="fas fa-download"></span> 
                                    </a> 
                                </td>
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

