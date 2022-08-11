<?php
    try {
        include_once("../php/conexiondb.php");

        if (!empty($_GET['accion'])) {
            $opcion = $_GET['accion'];
        } else {
            session_start();
            $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no permitida";
            $_SESSION['mensajeTipo'] = "is-warning";
            header("Location: ../registrarE.php");
        }

        // CRUD - INS - DLT - UDT
        switch ($opcion) {
            case 'INS':
                if (isset($_POST['guardar'])) {
                    $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
                    $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
                    $correo = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
                    $tid = filter_var($_POST['topicoid'], FILTER_SANITIZE_NUMBER_INT);
                    $contraseña = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

                    $hash_passcode = password_hash($contraseña, PASSWORD_DEFAULT);

                    $query = "
                        INSERT INTO `estudiantes`(`nombre`,`apellido`, `email`, `password`, `topicoid`, `estado`) 
                        VALUES ('$nombre', '$apellido', '$correo', '$hash_passcode', '$tid', 'Activo')
                    ";
                }

                $resultado = mysqli_query($link, $query);

                if (!$resultado) {
                    $_SESSION['mensajeTexto'] = "Error Registrando al Estudiante";
                    $_SESSION['mensajeTipo'] = "is-danger";
                    //header("Location: ../registrarE.php");
                    die("Error en base de datos: " . mysqli_error($link));
                } else {
                    $_SESSION['mensajeTexto'] = "Estudiante Registrado con Exito";
                    $_SESSION['mensajeTipo'] = "is-success";
                    header("Location: ../index.php");
                }
                // cerrar la conexion
                mysqli_close($link);

                break;

            default:
                $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no identificada";
                $_SESSION['mensajeTipo'] = "is-warning";
                header("Location: ../registrarE.php");
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
