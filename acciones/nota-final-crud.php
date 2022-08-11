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
                case 'UDT':
                    if (isset($_POST['guardar'])) {
                        $id = filter_var($_POST['cursoeid'], FILTER_SANITIZE_NUMBER_INT);
                        $cid = filter_var($_POST['cursoid'], FILTER_SANITIZE_NUMBER_INT);
                        $eid = filter_var($_POST['estudianteid'], FILTER_SANITIZE_NUMBER_INT);
                        $nota = $_POST['nota'];
                        $query = " UPDATE `cursos_estudiantes` SET `cursoid` = '$cid', `estudianteid` = '$eid', 
                            `nota_final` = '$nota' WHERE `cursoeid` = '$id' 
                        ";

                        $resultado = mysqli_query($link, $query);

                        if (!$resultado) {
                            $_SESSION['mensajeTexto'] = "Error Asignando la Nota";
                            $_SESSION['mensajeTipo'] = "is-danger";
                            //header("Location: ./cursos-mios.php");
                            die("Error en base de datos: " . mysqli_error($link));
                        } else {
                            $_SESSION['mensajeTexto'] = "Nota Asignada con Exito";
                            $_SESSION['mensajeTipo'] = "is-success";
                            header("Location: ./cursos-mios.php");
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



