<?php
    try {
        include_once("../php/conexiondb.php");

        if (!empty($_GET['accion'])) {
            $opcion = $_GET['accion'];
        } else {
            session_start();
            $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no permitida";
            $_SESSION['mensajeTipo'] = "is-warning";
            header("Location: ../registrar.php");
        }

        // CRUD - INS - DLT - UDT
        switch ($opcion) {
            case 'INS':
                if (isset($_POST['guardar'])) {
                    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                    $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

                    // Encriptar datos
                    $hash_passcode = password_hash($password, PASSWORD_DEFAULT);

                    $query = "
                        INSERT INTO `profesores`(`username`, `apellido`, `email`, `password`, `estado`) 
                        VALUES ('$username', '$apellido', '$email', '$hash_passcode', 'Activo')
                    ";
                }

                $resultado = mysqli_query($link, $query);

                if (!$resultado) {
                    $_SESSION['mensajeTexto'] = "Error Registrando al Profesor";
                    $_SESSION['mensajeTipo'] = "is-danger";
                    //header("Location: ../registrar.php");
                    die("Error en base de datos: " . mysqli_error($link));
                } else {
                    $_SESSION['mensajeTexto'] = "Profesor registrado con Exito";
                    $_SESSION['mensajeTipo'] = "is-success";
                    header("Location: ../index.php");
                }
                // cerrar la conexion
                mysqli_close($link);

                break;

            default:
                $_SESSION['mensajeTexto'] = "Advertencia: Accion realizada no identificada";
                $_SESSION['mensajeTipo'] = "is-warning";
                header("Location: ../registrar.php");
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

