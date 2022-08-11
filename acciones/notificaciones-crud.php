<?php
    try {
        include_once("../php/conexiondb.php");

        if (!empty($_GET['accion'])) {
            $opcion = $_GET['accion'];
        } else {
            session_start();
            $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no permitida";
            $_SESSION['mensajeTipo'] = "is-warning";
            header("Location: ../pbodyE.php");
        }

        // CRUD - INS - DLT - UDT
        switch ($opcion) {
                case 'DLT':
                        $id = filter_var($_GET['notificacionid'], FILTER_SANITIZE_NUMBER_INT);
    
                        // $query = " DELETE FROM `grupo` WHERE `grupoid` = '$id' ";
                        $query = " DELETE FROM `notificaciones_libros` WHERE `notificacionid` = '$id' ";
    
                        $resultado = mysqli_query($link, $query);
    
                    if (!$resultado) {
                        $_SESSION['mensajeTexto'] = "Error Borrando la Notificacion";
                        $_SESSION['mensajeTipo'] = "is-danger";
                        header("Location: ../pbodyE.php");
                        // die("Error en base de datos: " . mysqli_error($link));
                    } else {
                        $_SESSION['mensajeTexto'] = "Notificacion Borrada con Exito";
                        $_SESSION['mensajeTipo'] = "is-success";
                        header("Location: ../pbodyE.php");
                    }
                    // cerrar la conexion
                    mysqli_close($link);
    
                    break;

            default:
                $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no identificada";
                $_SESSION['mensajeTipo'] = "is-warning";
                header("Location: ../pbodyE.php");
                // die("Error en base de datos: " . mysqli_error($link));
                break;
        }
    } catch (Exception $e) {
        print "Exception no controlada 01: " . $e->getMessage();
        print "Estamos trabajando en la solucion";
    } catch (Error $e) {
        print "Error no controlada 01: " . $e->getMessage();
        print "Estamos trabajando en la solucion";
    }
