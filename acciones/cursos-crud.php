<?php
    try {
        include_once("../php/conexiondb.php");

        if (!empty($_GET['accion'])) {
            $opcion = $_GET['accion'];
        } else {
            session_start();
            $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no permitida";
            $_SESSION['mensajeTipo'] = "is-warning";
            header("Location: ./cursos-crear.php");
        }

        // CRUD - INS - DLT - UDT
        switch ($opcion) {
            case 'INS':
                if (isset($_POST['guardar'])) {
                        $pid = filter_var($_POST['profesorid'], FILTER_SANITIZE_NUMBER_INT);
                        $nombre_curso = $_POST['nombre_curso'];
                        $descripcion_curso = $_POST['descripcion_curso'];
                        $query = "
                            INSERT INTO `cursos`(`profesorid`, `nombre_curso`, `descripcion_curso`) 
                            VALUES ('$pid', '$nombre_curso', '$descripcion_curso');
                        ";       
                        
                        $resultado = mysqli_query($link, $query);

                        if (!$resultado) {
                            $_SESSION['mensajeTexto'] = "Error Creando el curso";
                            $_SESSION['mensajeTipo'] = "is-danger";
                            //header("Location: ./cursos-crear.php");
                            die("Error en base de datos: " . mysqli_error($link));
                        } else {
                            $_SESSION['mensajeTexto'] = "Curso creado con Exito";
                            $_SESSION['mensajeTipo'] = "is-success";
                            header("Location: ./cursos-crear.php");
                        }
                    }
                
                // cerrar la conexion
                mysqli_close($link);

                break;

                case 'UDT':
                    $id = filter_var($_POST['cursoid'], FILTER_SANITIZE_NUMBER_INT);
                    $nombre = $_POST['nombre'];
                    $descripcion = $_POST['descripcion'];
                    $query = " UPDATE `cursos` SET `nombre_curso` = '$nombre', `descripcion_curso` = '$descripcion' WHERE `cursoid` = '$id' ";

                    $resultado = mysqli_query($link, $query);

                if (!$resultado) {
                    $_SESSION['mensajeTexto'] = "Error Actualizando el Curso";
                    $_SESSION['mensajeTipo'] = "is-danger";
                    //header("Location: ./cursos-mios.php");
                    die("Error en base de datos: " . mysqli_error($link));
                } else {
                    $_SESSION['mensajeTexto'] = "Curso Actualizado con Exito";
                    $_SESSION['mensajeTipo'] = "is-success";
                    header("Location: ./cursos-mios.php");
                }
                // cerrar la conexion
                mysqli_close($link);

                break;
            
            default:
                $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no identificada";
                $_SESSION['mensajeTipo'] = "is-warning";
                header("Location: ./cursos-crear.php");
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



