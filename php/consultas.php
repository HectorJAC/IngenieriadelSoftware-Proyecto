<?php 
    
    //Consulta para asiganr la nota de una tarea a un estudiante
    function NotaTarea($link, $id)
    {
        $query = "SELECT * FROM `tareas_estudiantes` 
                    INNER JOIN `estudiantes` ON estudiantes.estudianteid = tareas_estudiantes.estudianteid
                    INNER JOIN `tareas` ON tareas.tareaid = tareas_estudiantes.tareaid
                    WHERE `tareaeid` = '$id' ";
        $resultado = mysqli_query($link, $query);

        if (mysqli_num_rows($resultado) == 1) {
            $row = $resultado -> fetch_assoc();
            return $row;
        } else {
            $_SESSION['mensajeTexto'] = "Error consultando Datos -> consultarTipos";
            $_SESSION['mensajeTipo'] = "is-danger";

            header("Location: ./index.php");
            
        }
    }
    
    //Consulta para ver los estudiantes que han realizado una tarea
    function TareasEstudiantes($link, $id)
    {
        $query = "SELECT * FROM `tareas`
                    INNER JOIN `tareas_estudiantes` ON tareas_estudiantes.tareaid = tareas.tareaid
                    INNER JOIN `estudiantes` ON estudiantes.estudianteid = tareas_estudiantes.estudianteid
                    WHERE tareas.tareaid = '$id' ";
        $resultadote = mysqli_query($link, $query);

        return $resultadote;
    }
    
    //Consulta para ver la tarea realizada de un estudiante
    function MostrarTareaRealizada($link, $id, $eid)
    {
        $query = "SELECT * FROM `tareas_estudiantes`
                    INNER JOIN `tareas` ON tareas.tareaid = tareas_estudiantes.tareaid
                    INNER JOIN `cursos_estudiantes` ON cursos_estudiantes.cursoid = tareas.cursoid
                    INNER JOIN `estudiantes` ON estudiantes.estudianteid = cursos_estudiantes.estudianteid
                    WHERE tareas_estudiantes.tareaid = '$id' AND tareas_estudiantes.estudianteid = '$eid' ";
        $resultadotr = mysqli_query($link, $query);

        return $resultadotr;
    }
    
    //Consulta para que los estudiantes puedan hacer las tareas
    function RealizarTareas($link, $id)
    {
        $query = "SELECT * FROM `tareas` 
                    INNER JOIN `cursos` ON cursos.cursoid = tareas.cursoid
                    WHERE `tareaid` = '$id' ";

        $resultado = mysqli_query($link, $query);

        if (mysqli_num_rows($resultado) == 1) {
            $row2 = $resultado -> fetch_assoc();
            return $row2;
        } else {
            $_SESSION['mensajeTexto'] = "Error consultando Datos -> consultarTipos";
            $_SESSION['mensajeTipo'] = "is-danger";

            header("Location: ./libros-verE.php");
            
        }
    }

    //Consulta para asiganr la nota final de un curso a un estudiante
    function NotaFinal($link, $id)
    {
        $query = "SELECT * FROM `cursos_estudiantes` 
                    INNER JOIN `estudiantes` ON estudiantes.estudianteid = cursos_estudiantes.estudianteid
                    INNER JOIN `cursos` ON cursos.cursoid = cursos_estudiantes.cursoid
                    WHERE `cursoeid` = '$id' ";
        $resultado = mysqli_query($link, $query);

        if (mysqli_num_rows($resultado) == 1) {
            $row = $resultado -> fetch_assoc();
            return $row;
        } else {
            $_SESSION['mensajeTexto'] = "Error consultando Datos -> consultarTipos";
            $_SESSION['mensajeTipo'] = "is-danger";

            header("Location: ./index.php");
            
        }
    }
    
    //Consulta para poder editar tareas
    function EditarTareas($link, $id)
    {
        $query = "SELECT * FROM `tareas` WHERE `tareaid` = '$id' ";
        $resultado = mysqli_query($link, $query);

        if (mysqli_num_rows($resultado) == 1) {
            $row2 = $resultado -> fetch_assoc();
            return $row2;
        } else {
            $_SESSION['mensajeTexto'] = "Error consultando Datos -> consultarTipos";
            $_SESSION['mensajeTipo'] = "is-danger";

            header("Location: ./index.php");
            
        }
    }
    
    //Consulta para ver los estudiantes de un curso
    function MostrarEstudiantes($link, $id)
    {
        $query = "SELECT * FROM `cursos_estudiantes` 
                    INNER JOIN `estudiantes` ON estudiantes.estudianteid = cursos_estudiantes.estudianteid
                    WHERE cursos_estudiantes.cursoid = '$id' ";

        $resultadoEstudiantes = mysqli_query($link, $query);

        return $resultadoEstudiantes;
    }
    
    //Consulta para contar cuantos estudiantes tiene un curso
    function TotalEstudiantesCursos($link, $id)
    {
        $query = "SELECT COUNT(cursos_estudiantes.cursoid) AS TotalEstudiantes FROM `cursos_estudiantes` 
                    INNER JOIN `cursos` ON cursos.cursoid = cursos_estudiantes.cursoid 
                    WHERE cursos_estudiantes.cursoid = '$id' ";
        $resultadotec = mysqli_query($link, $query);

        return $resultadotec;
    }

    //Consulta poder usar el input hidden de cursoid en curso-anadirseE
    function EditarCursosE($link, $id)
    {
        $query = "SELECT * FROM `cursos` WHERE `cursoid` = '$id' ";
        $resultado = mysqli_query($link, $query);

        if (mysqli_num_rows($resultado) == 1) {
            $row2 = $resultado -> fetch_assoc();
            return $row2;
        } else {
            $_SESSION['mensajeTexto'] = "Error consultando Datos -> consultarTipos";
            $_SESSION['mensajeTipo'] = "is-danger";

            header("Location: ./index.php");
            
        }
    }
    
    //Consulta poder usar el input hidden de estudianteid en curso-anadirseE y en hacer-tarea
    function EditarEstudiantes($link, $id)
    {
        $query = "SELECT * FROM `estudiantes` WHERE `estudianteid` = '$id' ";
        $resultado = mysqli_query($link, $query);

        if (mysqli_num_rows($resultado) == 1) {
            $row = $resultado -> fetch_assoc();
            return $row;
        } else {
            $_SESSION['mensajeTexto'] = "Error consultando Datos -> consultarTipos";
            $_SESSION['mensajeTipo'] = "is-danger";

            header("Location: ./index.php");
            
        }
    }
        
    //Consulta para ver los cursos en los cuales el estudiante activo se ha agregado
    function MisCursosE($link, $id)
    {
        $query = "SELECT * FROM `cursos_estudiantes`
                    INNER JOIN `estudiantes` ON estudiantes.estudianteid = cursos_estudiantes.estudianteid
                    INNER JOIN `cursos` ON cursos.cursoid = cursos_estudiantes.cursoid
                    INNER JOIN `profesores` ON profesores.profesorid = cursos.profesorid
                    WHERE cursos_estudiantes.estudianteid = '$id' ";
        $resultadoec = mysqli_query($link, $query);

        return $resultadoec;
    }
    
    //Consulta para ver el topico elegido por los estudiantes
    function MostrarTopicosE($link, $id)
    {
        $query = "SELECT * FROM `topicos` 
                    INNER JOIN `estudiantes` ON topicos.topicoid = estudiantes.topicoid
                    WHERE estudiantes.estudianteid = '$id' ";

        $resultadoTopicosE = mysqli_query($link, $query);

        return $resultadoTopicosE;
    }
    
    //Consulta para ver las notificaciones segun el estudiante
    function MostrarNotificaciones($link, $id)
    {
        $query = "SELECT * FROM `notificaciones_libros` 
                    INNER JOIN `estudiantes` ON notificaciones_libros.topicoid = estudiantes.topicoid 
                    WHERE estudiantes.estudianteid = '$id' ";

        $resultadoNotificaciones = mysqli_query($link, $query);

        return $resultadoNotificaciones;
    }
    
    //Consulta para ver los libros segun el topico del estudiante
    function MostrarLibrosEstudiantes($link, $id)
    {
        $query = "SELECT * FROM `libros_profesores`
                    INNER JOIN `topicos` ON libros_profesores.topicoid = topicos.topicoid
                    INNER JOIN `profesores` ON libros_profesores.profesorid = profesores.profesorid
                    INNER JOIN `estudiantes` ON libros_profesores.topicoid = estudiantes.topicoid 
                    WHERE estudiantes.estudianteid = '$id' ";

        $resultadoLibrosE = mysqli_query($link, $query);

        return $resultadoLibrosE;
    }
    
    //Consulta para ver las tareas de un curso segun el id (es necesaria para el while de tareas-cursos)
    function MostrarTareas($link, $id)
    {
        $query = "SELECT * FROM `tareas`
                    INNER JOIN `cursos` ON cursos.cursoid = tareas.cursoid
                    INNER JOIN `profesores` ON profesores.profesorid = cursos.profesorid
                    WHERE cursos.cursoid = '$id' ";
        $resultadomt2 = mysqli_query($link, $query);

        return $resultadomt2;
    }
    
    //Consulta para seleccionar un curso segun su id
    function MostrarCursos($link, $id)
    {
        $query = "SELECT * FROM `cursos` WHERE cursos.cursoid = '$id' ";
        $resultadomt = mysqli_query($link, $query);

        return $resultadomt;
    }

    //Conulta para ver todos los cursos para crear nuevas tareas en un curso
    function CursosT($link)
    {
        $query = "SELECT * FROM `cursos` ";
        $resultadoTc = mysqli_query($link, $query);

        return $resultadoTc;
    }
    
    //Conulta para ver los cursos del profesor (tabla cursos_tareas)
    function VerMisCursos($link, $id)
    {
        $query = "SELECT * FROM `profesores`
                    INNER JOIN `cursos` ON profesores.profesorid = cursos.profesorid
                    INNER JOIN `cursos_tareas` ON cursos_tareas.cursoid = cursos.cursoid
                    INNER JOIN `tareas` ON tareas.tareaid = cursos_tareas.tareaid
                    WHERE cursos.profesorid = '$id' ";
        $resultadoct = mysqli_query($link, $query);

        return $resultadoct;
    }

    //Consulta para ver todos los libros
    function MostrarLibros($link)
    {
        $query = "SELECT * FROM `libros_profesores`
                    INNER JOIN `topicos` ON libros_profesores.topicoid = topicos.topicoid
                    INNER JOIN `profesores` ON libros_profesores.profesorid = profesores.profesorid";

        $resultadoLibros = mysqli_query($link, $query);

        return $resultadoLibros;
    }

    //Consulta para ver todos los topicos
    function MostrarTopicos($link)
    {
        $query = "SELECT * FROM `topicos`";

        $resultadoTopicos = mysqli_query($link, $query);

        return $resultadoTopicos;
    }

    //Consulta para todos los cursos
    function VerCursos($link) 
    {
        $query = "SELECT * FROM `cursos` 
                    INNER JOIN `profesores` ON cursos.profesorid = profesores.profesorid";
        $resultado = mysqli_query($link, $query);

        return $resultado;
    }

    //Consulta para ver los cursos creados por el profesor activo
    function MisCursos($link, $id)
    {
        $query = "SELECT * FROM `profesores`
                    INNER JOIN `cursos` ON profesores.profesorid = cursos.profesorid
                    WHERE cursos.profesorid = '$id' ";
        $resultadopc = mysqli_query($link, $query);

        return $resultadopc;
    }

     //Consulta para ver las tareas que ha creado un profesor dentro de un curso
     function MisTareas($link, $id)
     {
         $query = "SELECT * FROM `profesores`
                     INNER JOIN `tareas` ON profesores.profesorid = tareas.profesorid
                     WHERE tareas.profesorid = '$id' ";
         $resultadopt = mysqli_query($link, $query);
 
         return $resultadopt;
     }

    //Consulta para poder editar los cursos
    function EditarCursos($link, $id)
    {
        $query = "SELECT * FROM `cursos` WHERE `cursoid` = '$id' ";
        $resultado = mysqli_query($link, $query);

        if (mysqli_num_rows($resultado) == 1) {
            $row = $resultado -> fetch_assoc();
            return $row;
        } else {
            $_SESSION['mensajeTexto'] = "Error consultando Datos -> consultarTipos";
            $_SESSION['mensajeTipo'] = "is-danger";

            header("Location: ./index.php");
            
        }
    }

    function validarLogin($link, $user, $pass)
    {
        // $query = "SELECT * FROM `usuario` WHERE `email` = '$user' AND `password` = '$pass' AND `estado` = 'A' ";
        $query = "SELECT * FROM `profesores` WHERE `email` = '$user' AND `estado` = 'Activo' ";
        $resultado = mysqli_query($link, $query);

        if (mysqli_num_rows($resultado) == 1) {
            $row = $resultado -> fetch_assoc();

            $hash = $row['password'];
            if(password_verify($pass, $hash)) {
                $_SESSION['profesorid'] = $row['profesorid'];
                //eliminar contenido de sesion
                $_SESSION['mensajeTexto'] = null;
                $_SESSION['mensajeTipo'] = null;
                header("Location: ./pbody.php");
            } else {
                $_SESSION['mensajeTexto'] = "Error: contraseña incorrecta";
                $_SESSION['mensajeTipo'] = "is-danger";
            }

        } else {
            $_SESSION['mensajeTexto'] = "Error: correo incorrecto";
            $_SESSION['mensajeTipo'] = "is-danger";
        }
    }

    function validarLoginE($link, $user, $pass)
    {
        // $query = "SELECT * FROM `usuario` WHERE `email` = '$user' AND `password` = '$pass' AND `estado` = 'A' ";
        $query = "SELECT * FROM `estudiantes` WHERE `email` = '$user' AND `estado` = 'Activo' ";
        $resultado = mysqli_query($link, $query);

        if (mysqli_num_rows($resultado) == 1) {
            $row = $resultado -> fetch_assoc();

            $hash = $row['password'];
            if(password_verify($pass, $hash)) {
                $_SESSION['estudianteid'] = $row['estudianteid'];
                //eliminar contenido de sesion
                $_SESSION['mensajeTexto'] = null;
                $_SESSION['mensajeTipo'] = null;
                header("Location: ./pbodyE.php");
            } else {
                $_SESSION['mensajeTexto'] = "Error: contraseña incorrecta";
                $_SESSION['mensajeTipo'] = "is-danger";
            }

        }
    }

    function consultarUsuario($link, $id)
    {
        $query = "SELECT * FROM `profesores` WHERE `profesorid` = '$id' AND `estado` = 'Activo' ";
        $resultado = mysqli_query($link, $query);

        if (mysqli_num_rows($resultado) == 1) {
            $row = $resultado -> fetch_assoc();
            return $row;
        } else {
            $_SESSION['mensajeTexto'] = "Error validando datos de usuario";
            $_SESSION['mensajeTipo'] = "is-danger";

            header("Location: ./index.php");
            
        }
    }

    function consultarUsuarioE($link, $id)
    {
        $query = "SELECT * FROM `estudiantes` WHERE `estudianteid` = '$id' AND `estado` = 'Activo' ";
        $resultado = mysqli_query($link, $query);

        if (mysqli_num_rows($resultado) == 1) {
            $row = $resultado -> fetch_assoc();
            return $row;
        } else {
            $_SESSION['mensajeTexto'] = "Error validando datos de usuario";
            $_SESSION['mensajeTipo'] = "is-danger";

            header("Location: ./index.php");
            
        }
    }
