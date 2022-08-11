<?php
    try {
        include_once("../php/conexiondb.php");

        if (!empty($_GET['accion'])) {
            $opcion = $_GET['accion'];
        } else {
            session_start();
            $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no permitida";
            $_SESSION['mensajeTipo'] = "is-warning";
            header("Location: ./libros-agregar.php");
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
                            $tid = filter_var($_POST['topicoid'], FILTER_SANITIZE_NUMBER_INT);
                            $pid = filter_var($_POST['profesorid'], FILTER_SANITIZE_NUMBER_INT);
                            $titulo = $_POST['titulo'];
                            $descripcion = $_POST['descripcion'];
                            $query = "
                                INSERT INTO `libros_profesores`(`topicoid`, `profesorid`, `titulo`, `descripcion`, `tamano`, `tipo`, `nombre_archivo`) 
                                VALUES ('$tid', '$pid', '$titulo', '$descripcion', '$tamano', '$tipo', '$nombre')
                            ";
                            $resultado = mysqli_query($link, $query);

                            if (!$resultado) {
                                $_SESSION['mensajeTexto'] = "Error Subiendo el Libro";
                                $_SESSION['mensajeTipo'] = "is-danger";
                                //header("Location: ./libros-agregar.php");
                                die("Error en base de datos: " . mysqli_error($link));
                            } else {
                                $_SESSION['mensajeTexto'] = "Libro Subido con Exito";
                                $_SESSION['mensajeTipo'] = "is-success";
                                header("Location: ./libros-agregar.php"); 
                                
                                $tid = filter_var($_POST['topicoid'], FILTER_SANITIZE_NUMBER_INT);
                                $query = "
                                    INSERT INTO `notificaciones_libros`(`topicoid`, `mensaje`)
                                    VALUES ('$tid', 'Se ha subido un nuevo libro de tu interes')
                                ";
                                $resultado = mysqli_query($link, $query);
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
                header("Location: ./libros-agregar.php");
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



