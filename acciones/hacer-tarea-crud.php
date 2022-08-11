<?php
    try {
        include_once("../php/conexiondb.php");

        if (!empty($_GET['accion'])) {
            $opcion = $_GET['accion'];
        } else {
            session_start();
            $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no permitida";
            $_SESSION['mensajeTipo'] = "is-warning";
            header("Location: ./cursos-miosE.php");
        }

        // CRUD - INS - DLT - UDT
        switch ($opcion) {
            case 'INS':
                if (isset($_POST['guardar'])) {
                    $nombre = $_FILES['archivo'] ['name'];
                    $tipo = $_FILES['archivo'] ['type'];
                    $tamano = $_FILES['archivo'] ['size'];
                    $ruta = $_FILES['archivo'] ['tmp_name'];
                    $destino = "../archivos/".$nombre;
                    if ($nombre != "") {
                        if (copy($ruta, $destino)) {
                            $eid = filter_var($_POST['estudianteid'], FILTER_SANITIZE_NUMBER_INT);
                            $tid = filter_var($_POST['tareaid'], FILTER_SANITIZE_NUMBER_INT);
                            $query = "
                                INSERT INTO `tareas_estudiantes`(`estudianteid`, `tareaid`, `tamano_entrega`, `tipo_entrega`, `nombre_entrega`) 
                                VALUES ('$eid', '$tid', '$tamano', '$tipo', '$nombre')
                            ";
                            $resultado = mysqli_query($link, $query);

                            if (!$resultado) {
                                $_SESSION['mensajeTexto'] = "Error Realizando la Tarea";
                                $_SESSION['mensajeTipo'] = "is-danger";
                                //header("Location: ./libros-agregar.php");
                                die("Error en base de datos: " . mysqli_error($link));
                            } else {
                                $_SESSION['mensajeTexto'] = "Tarea Realizada con Exito";
                                $_SESSION['mensajeTipo'] = "is-success";
                                header("Location: ./cursos-miosE.php"); 
                            }
                        }
                    }
                    
                }
                
                // cerrar la conexion
                mysqli_close($link);

                break;
            
            default:
                $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no identificada";
                $_SESSION['mensajeTipo'] = "is-warning";
                header("Location: ./cursos-miosE.php");
                // die("Error en base de datos: " . mysqli_error($link));
                break;
        }
    } catch (Exception $e) {
        print "Excepcion no controlada 01: " . $e->getMessage();
        print "Estamos trabajando en la solucion";
    } catch (Error $e) {
        print "Error no controlado 01: " . $e->getMessage();
        print "Estamos trabajando en la solucion";
    }



