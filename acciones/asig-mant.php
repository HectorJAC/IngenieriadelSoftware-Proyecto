<?php
include_once('../php/pheaderE.php');

$resultado = mostrarTipost($link);

?>

<div class="column is-half">
    <!-- Migas de Pan -->
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="../pbodyE.php"> Inicio </a></li>
            <li class="is-active"><a href="#" aria-current="page"> To-Do: Realizar tareas </a></li>
        </ul>
    </nav>
    <!-- Titulos -->
    <div class="block">
        <h1 class="title"> To-Do </h1>
        <h2 class="subtitle"> Realizar tareas </h2>
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
            <div class="column is-12">
                <div class="table-container">
                    <table class="table is-fullwidth">
                        <thead> Tabla de Tareas
                            <th> Id de la tarea </th>
                            <th> Id del profesor </th>
                            <th> Nombre </th>
                            <th> Asignacion </th>
                            <th> Contenido </th>
                            <th> Fecha de entrega </th>
                            <th> Estado de la tarea </th>
                            <th> Estado </th>
                        </thead>
                        <tbody>
                        <?php  
                            while ($row = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) { ?>
                                <tr>
                                    <td> <?php echo $row['tareaid'] ?> </td>
                                    <td> <?php echo $row['profesorid'] ?> </td>
                                    <td> <?php echo $row['titulo'] ?> </td>
                                    <td> <?php echo $row['asignacion'] ?> </td>
                                    <td> <?php echo $row['contenido'] ?> </td>
                                    <td> <?php echo $row['fecha_entrega'] ?> </td>
                                    <td> <?php echo $row['estado_tarea'] ?> </td>
                                    <td> <?php echo $row['estado'] ?> </td>
                                    <td> <a class="button is-info" data-toggle="tooltip" data-placement="top" title="Realizar Tarea" name="editar" 
                                    href="asig-editar.php?accion=UDT&tareaid=<?php echo $row['tareaid'] ?>"> <i class="fas fa-edit"></i> </a> </td>
                                </tr>
                        <?php 
                            }   
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>          
        </div>


    </div>
</div>

<?php
include_once('../php/pfooter.php');
?>