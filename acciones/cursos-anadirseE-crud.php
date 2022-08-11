<?php
    try {
        include_once("../php/conexiondb.php");

        if (!empty($_GET['accion'])) {
            $opcion = $_GET['accion'];
        } else {
            session_start();
            $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no permitida";
            $_SESSION['mensajeTipo'] = "is-warning";
            header("Location: ./cursos-verE.php");
        }

        // CRUD - INS - DLT - UDT
        switch ($opcion) {
            case 'INS':
                if (isset($_POST['guardar'])) {
                        $cursoid = filter_var($_POST['cursoid'], FILTER_SANITIZE_NUMBER_INT);
                        $id = filter_var($_POST['estudianteid'], FILTER_SANITIZE_NUMBER_INT);
                        $query = "
                            INSERT INTO `cursos_estudiantes`(`cursoid`, `estudianteid`) 
                            VALUES ('$cursoid', '$id');
                        ";        
                        
                        $resultado = mysqli_query($link, $query);

                        if (!$resultado) {
                            $_SESSION['mensajeTexto'] = "Error Añadiendo el curso";
                            $_SESSION['mensajeTipo'] = "is-danger";
                            //header("Location: ./cursos-crear.php");
                            die("Error en base de datos: " . mysqli_error($link));
                        } else {
                            $_SESSION['mensajeTexto'] = "Curso Añadido con Exito";
                            $_SESSION['mensajeTipo'] = "is-success";
                            header("Location: ./cursos-verE.php");
                        }
                }
                
                // cerrar la conexion
                mysqli_close($link);

                break;
            
            default:
                $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no identificada";
                $_SESSION['mensajeTipo'] = "is-warning";
                header("Location: ./cursos-verE.php");
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



