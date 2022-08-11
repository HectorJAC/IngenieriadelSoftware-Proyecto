<?php
    try {
        include_once("../php/conexiondb.php");

        if (!empty($_GET['accion'])) {
            $opcion = $_GET['accion'];
        } else {
            session_start();
            $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no permitida";
            $_SESSION['mensajeTipo'] = "is-warning";
            header("Location: ./cursos-mios.php");
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
                            $cid = filter_var($_POST['cursoid'], FILTER_SANITIZE_NUMBER_INT);
                            $titulo = $_POST['titulo'];
                            $descripcion = $_POST['descripcion'];
                            $query = "
                                INSERT INTO `tareas`(`cursoid`, `titulo_tarea`, `descripcion`, `tamano`, `tipo`, `nombre_archivo`) 
                                VALUES ('$cid', '$titulo', '$descripcion', '$tamano', '$tipo', '$nombre')
                            ";
                            $resultado = mysqli_query($link, $query);

                            if (!$resultado) {
                                $_SESSION['mensajeTexto'] = "Error Subiendo la Tarea";
                                $_SESSION['mensajeTipo'] = "is-danger";
                                //header("Location: ./libros-agregar.php");
                                die("Error en base de datos: " . mysqli_error($link));
                            } else {
                                $_SESSION['mensajeTexto'] = "Tarea Subida con Exito";
                                $_SESSION['mensajeTipo'] = "is-success";
                                header("Location: ./cursos-mios.php"); 
                            }
                        }
                    }
                    
                }
                
                // cerrar la conexion
                mysqli_close($link);

                break;

                case 'UDT':
                    if (isset($_POST['guardar'])) {
                        $nombre = $_FILES['archivo'] ['name'];
                        $tipo = $_FILES['archivo'] ['type'];
                        $tamano = $_FILES['archivo'] ['size'];
                        $ruta = $_FILES['archivo'] ['tmp_name'];
                        $destino = "../archivos/".$nombre;
                        if ($nombre != "") {
                            if (copy($ruta, $destino)) {
                                $id = filter_var($_POST['tareaid'], FILTER_SANITIZE_NUMBER_INT);
                                $cid = filter_var($_POST['cursoid'], FILTER_SANITIZE_NUMBER_INT);
                                $titulo = $_POST['titulo'];
                                $descripcion = $_POST['descripcion'];
                                $query = " UPDATE `tareas` SET `cursoid` = '$cid', `titulo_tarea` = '$titulo', 
                                        `descripcion` = '$descripcion', `tamano` = '$tamano', `tipo` = '$tipo', 
                                        `nombre_archivo` = '$nombre' WHERE `tareaid` = '$id' 
                                ";
                                $resultado = mysqli_query($link, $query);
    
                                if (!$resultado) {
                                    $_SESSION['mensajeTexto'] = "Error Editando la Tarea";
                                    $_SESSION['mensajeTipo'] = "is-danger";
                                    //header("Location: ./libros-agregar.php");
                                    die("Error en base de datos: " . mysqli_error($link));
                                } else {
                                    $_SESSION['mensajeTexto'] = "Tarea Editada con Exito";
                                    $_SESSION['mensajeTipo'] = "is-success";
                                    header("Location: ./cursos-mios.php"); 
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
                header("Location: ./cursos-mios.php");
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



