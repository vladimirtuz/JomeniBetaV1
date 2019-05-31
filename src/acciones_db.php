<?php
session_start();
require("../db/db.php");
$conexion=mysqli_connect($servidor,$usuario,$password,$bd);

// Funcion para actualizar la informacion de un alumno
if(isset($_POST['guarda_alumno'])){
        $matricula=$_SESSION['matricula'];
        $nombre=$_POST['name_alumno'];
        $ap_paterno=$_POST['apellido_alumno'];
        $ap_materno=$_POST['apellido2_alumno'];
        $carrera=$_POST['carrera_alumno'];
        $domicilio=$_POST['direccion_alumno'];
        $telefono=$_POST['telefono_alumno'];
        $ciudad=$_POST['ciudad_alumno'];
        $estado=$_POST['estado_alumno'];
        $pais=$_POST['pais_alumno'];
        $email=$_POST['email_alumno'];
        $insert_dato="update alumnos set  nombre='$nombre', apellido_paterno='$ap_paterno', apellido_materno='$ap_materno', carrera='$carrera', domicilio='$domicilio', telefono=$telefono, ciudad='$ciudad', estado='$estado', pais='$pais', email='$email' where id_usuario=$matricula";
        if(mysqli_query($conexion,$insert_dato)){
            header("location: dashboard.php");
        }
        else{
            echo"Error guardando datos";
        }
    }

//Funcion para actualizar la informacion de una empresa
if(isset($_POST['guarda_empresa'])){
    $matricula=$_SESSION['matricula'];
    $nombre=$_POST['name_empresa'];
    $titular=$_POST['titular_empresa'];
    $puesto=$_POST['puesto_empresa'];
    $giro=$_POST['giro_empresa'];
    $rfc=$_POST['rfc_empresa'];
    $email=$_POST['email_empresa'];
    $telefono=$_POST['telefono_empresa'];
    $direccion=$_POST['direccion_empresa'];
    $ciudad=$_POST['ciudad_empresa'];
    $municipio=$_POST['municipio_empresa'];
    $codigo=$_POST['codigo_empresa'];
    
    $insert_dato="update empresas set  nombre='$nombre', titular='$titular', puesto='$puesto', giro='$giro', rfc='$rfc', email='$email', telefono='$telefono', direccion='$direccion', ciudad='$ciudad', municipio='$municipio', codigo_postal='$codigo' where  matricula=$matricula";
    if(mysqli_query($conexion,$insert_dato)){
        header("location: dashboard.php");
    }
    else{
        echo"Error guardando datos".mysqli_error($conexion);
    }
}

//funcion para actualizar la infromacion de un proyecto
    if(isset($_POST['guarda_proyecto'])){
        $nombre=$_POST['nombre_proyecto'];
        $departamento=$_POST['departamento_proyecto'];
        $division=$_POST['division_proyecto'];
        $responsable=$_POST['responsable_proyecto'];
        $cargo_responsable=$_POST['cargo_responsable_proyecto'];
        $objetivo=$_POST['general_proyecto'];
        $descripcion=$_POST['descripcion_proyecto'];
        $modalidad=$_POST['modalidad_proyecto'];
        $periodo=$_POST['inicio_proyecto']." al ".$_POST['fin_proyecto'];
        $acuerdo=$_POST['persona_acuerdo_proyecto'];
        $cargo_acuerdo=$_POST['cargo_acuerdo_proyecto'];
        $id_proyecto=$_POST['id_proyecto'];
        $update_dato="update proyectos set nombre='$nombre', departamento='$departamento', division='$division', nombre_responsable='$responsable', cargo_responsable='$cargo_responsable', objetivo_general='$objetivo', descripcion='$descripcion', modalidad='$modalidad', periodo='$periodo', persona_acuerdo='$acuerdo', puesto_acuerdo='$cargo_acuerdo' where id_proyecto=$id_proyecto";
        if(mysqli_query($conexion,$update_dato)){
            header("location: dashboard.php");
        }
        else{
            echo "Error al guardar datos".mysqli_error($conexion);
        }
    }

    //funcion para eliminar un proyecto
    if(isset($_POST['eliminar_proyecto_empresa'])){
        $id_proyecto=$_POST['id_proyecto'];
        $borra_proyecto="delete from proyectos where id_proyecto=$id_proyecto";
        if(mysqli_query($conexion,$borra_proyecto)){
            header("location: proyectos_empresas.php");
        }
        else{
            echo "Error al borrar proyecto".mysqli_error($conexion);
        }

    }

    //Funcion para subir el curriculum de un alumno
    if(isset($_POST['subir_curriculum'])){
        $archivo='../pdf/'.$fila['matricula'].'.pdf';
        if(file_exists($archivo)){
            unlink($archivo);
        }
        if (isset($_FILES['archivo_curriculum']) && $_FILES['archivo_curriculum']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['archivo_curriculum']['tmp_name'];
                $fileName = $_FILES['archivo_curriculum']['name'];
                $fileSize = $_FILES['archivo_curriculum']['size'];
                $fileType = $_FILES['archivo_curriculum']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = $_SESSION['matricula'].".pdf";
                $allowedfileExtensions = array('pdf');
                if (in_array($fileExtension, $allowedfileExtensions)){
                    $uploadFileDir = '../pdf/';
                    $dest_path = $uploadFileDir . $newFileName;
                    if(move_uploaded_file($fileTmpPath, $dest_path))
                    {
                        header("location: dashboard.php");
                    }
                    else
                    {
                        echo "Error al subir Curriculum";

                    }
                }
            }
    }

    //funcion para subir organigrama de la empresa
    if(isset($_POST['subir_organigrama'])){
        $archivo='../images/organigramas/'.$_SESSION['matricula'].'.pdf';
        if(file_exists($archivo)){
            unlink($archivo);
        }
        if (isset($_FILES['archivo_organigrama']) && $_FILES['archivo_organigrama']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['archivo_organigrama']['tmp_name'];
                $fileName = $_FILES['archivo_organigrama']['name'];
                $fileSize = $_FILES['archivo_organigrama']['size'];
                $fileType = $_FILES['archivo_organigrama']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = $_SESSION['matricula'].".png";
                $allowedfileExtensions = array('png');
                if (in_array($fileExtension, $allowedfileExtensions)){
                    $uploadFileDir = '../images/organigramas/';
                    $dest_path = $uploadFileDir . $newFileName;
                    if(move_uploaded_file($fileTmpPath, $dest_path))
                    {
                        header("location: dashboard.php");
                    }
                    else
                    {
                        echo "Error al subir Curriculum";
                    }
                }
            }
    }


    //Funcion para borar curriculum de un alumno
if(isset($_POST["borrar_curriculum"])){
    $archivo='../pdf/'.$_SESSION['matricula'].'.pdf';
    if(file_exists($archivo)){
        unlink($archivo);
    }
    header("location:dashboard.php");
}

//funcion que borra organigrama de la empresa
if(isset($_POST["borrar_organigrama"])){
    $archivo='../images/organigramas/'.$_SESSION['matricula'].'.png';
    if(file_exists($archivo)){
        unlink($archivo);
    }
    header("location:dashboard.php");
}

//Funcion para postularse a un proyecto
if(isset($_POST['postula_proyecto'])){
    $id_proyecto=$_POST['id_proyecto'];
    $id_alumno=$_SESSION['matricula'];
    $status="pendiente";
    $sql="insert into postulante_proyecto values('','$id_proyecto','$id_alumno','$status')";
    if(mysqli_query($conexion,$sql)){
        $sql2="select *from proyectos where id_proyecto=$id_proyecto";
        $execute2=mysqli_query($conexion,$sql2);
        if($proyecto=mysqli_fetch_assoc($execute2)){
            $postulantes_proyecto=$proyecto['postulantes'];
            $postulantes_proyecto++;
            $sql3="update proyectos set postulantes=$postulantes_proyecto where id_proyecto=$id_proyecto";
            $execute=mysqli_query($conexion,$sql3);
            if($execute){
                header("location: mis_proyectos.php");
            } 
            else{
                header("dashboard.php");
            }
        }
    }
    else{
        header("location: dashboard.php");
    }
}

//funcion para cancelar solicutud de un proyecto
if(isset($_POST['cancela_solicitud_proyecto'])){
    $id_proyecto=$_POST['id_proyecto'];
    $id_alumno=$_POST['id_alumno'];
    $sql_cancelar="delete from postulante_proyecto where id_proyecto=$id_proyecto && id_alumno=$id_alumno";
    $execute=mysqli_query($conexion,$sql_cancelar);
    if($execute){
        $sql2="select *from proyectos where id_proyecto=$id_proyecto";
        $execute2=mysqli_query($conexion,$sql2);
        $execute2=mysqli_query($conexion,$sql2);
        if($proyecto=mysqli_fetch_assoc($execute2)){
            $postulantes_proyecto=$proyecto['postulantes'];
            if($postulantes_proyecto!=0){
            $postulantes_proyecto--;
            }
            $sql3="update proyectos set postulantes=$postulantes_proyecto where id_proyecto=$id_proyecto";
            $execute=mysqli_query($conexion,$sql3);
            if($execute){
                header("location: mis_proyectos.php");
            } 
            else{
                header("dashboard.php");
            }
        }
    }else{
        header("location: mis_proyectos.php");
    }
}

//funcion para cerrar sesion 

if(isset($_POST['cerrar_sesion'])){
    session_destroy();
    header("location: ../index.html");
}

//funcion para agregar un nuevo proyecto
if(isset($_POST['guarda_proyecto_nuevo'])){
    $empresa=$_SESSION['matricula'];
    $nombre=$_POST['nombre_proyecto'];
    $departamento=$_POST['departamento_proyecto'];
    $division=$_POST['division_proyecto'];
    $responsable=$_POST['responsable_proyecto'];
    $cargo_responsable=$_POST['cargo_responsable_proyecto'];
    $objetivo=$_POST['general_proyecto'];
    $descripcion=$_POST['descripcion_proyecto'];
    $modalidad=$_POST['modalidad_proyecto'];
    $periodo=$_POST['inicio_proyecto']." al ".$_POST['fin_proyecto'];
    $acuerdo=$_POST['persona_acuerdo_proyecto'];
    $cargo_acuerdo=$_POST['cargo_acuerdo_proyecto'];
    $inserta_proyecto="insert into proyectos (nombre, departamento, division,nombre_responsable,cargo_responsable,objetivo_general,descripcion,modalidad,periodo,persona_acuerdo,puesto_acuerdo,id_empresa)  values('$nombre','$departamento','$division','$responsable','$cargo_responsable','$objetivo','$descripcion','$modalidad','$periodo','$acuerdo','$cargo_acuerdo',$empresa)";
    if(mysqli_query($conexion,$inserta_proyecto)){
        header("location: proyectos_empresas.php");
    }else{
        echo "Error al agregar el proyecto".mysqli_error($conexion);
    }
}

//funcion para actualizar informacion cuando un alumno es aceptado 
if(isset($_POST['acepta_alumno'])){
    $id_alumno=$_POST['id_alumno'];
    $id_proyecto=$_POST['id_proyecto'];
    $actualiza_status="update postulante_proyecto set status='ACEPTADO' where id_alumno=$id_alumno && id_proyecto=$id_proyecto";
    if(mysqli_query($conexion,$actualiza_status)){
        $actualiza_status_proyecto="update postulante_proyecto set status='NO DISPONIBLE' where id_proyecto=$id_proyecto && id_alumno!=$id_alumno";
        if(mysqli_query($conexion,$actualiza_status_proyecto)){
            header("location: dashboard.php");
        }
    }else{
            echo"Error al guardar".mysqli_error($conexion);
    }
}

//funcion para actualizar informacion cuando un alumno es rechazado 
if(isset($_POST['rechaza_alumno'])){
    $id_alumno=$_POST['id_alumno'];
    $id_proyecto=$_POST['id_proyecto'];
    $actualiza_status="update postulante_proyecto set status='RECHAZADO' where id_alumno=$id_alumno && id_proyecto=$id_proyecto";
    if(mysqli_query($conexion,$actualiza_status)){
        header("location: dashboard.php");
    }else{
            echo"Error al guardar".mysqli_error($conexion);
    }
}

//Funcion ppara agregar un nuevo usuario al sistema
if(isset($_POST['nuevo_registro'])){
    $tipo=$_POST['tipo_usuario'];
    $usuario=$_POST['matricula'];
    $pass=$_POST['password'];
    $archivo_foto=$_POST['foto'];
    $existe=false;
    $comprueba="select *from usuarios";
    $execute=mysqli_query($conexion,$comprueba);
    while($fila=mysqli_fetch_assoc($execute)){
            if($fila['matricula']==$usuario){
                $existe=true;
            }
    }
    if($existe==true){
        echo"Ya existe el usuario";
    }
    else{
        if($tipo=="alumnos"){
            $archivo='../images/alumnos/'.$usuario.'.png';
            $uploadFileDir = '../images/alumnos/';
        }
        if($tipo=="empresas"){
            $archivo='../images/empresas/'.$usuario.'.png';
            $uploadFileDir = '../images/empresas/';

        }
    if(file_exists($archivo)){
        unlink($archivo);
    }
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['foto']['tmp_name'];
            $fileName = $_FILES['foto']['name'];
            $fileSize = $_FILES['foto']['size'];
            $fileType = $_FILES['foto']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $newFileName =$usuario.".png";
            $allowedfileExtensions = array('png');
            if (in_array($fileExtension, $allowedfileExtensions)){
                $dest_path = $uploadFileDir . $newFileName;
                if(move_uploaded_file($fileTmpPath, $dest_path))
                {
                    $sql="insert into usuarios values ($usuario,'$pass','$tipo','')";
                    if(mysqli_query($conexion,$sql)){
                     $insert="insert into $tipo (matricula) values ($usuario)";
                     if(mysqli_query($conexion,$insert)){
                         header("location: ../index.html");
                     }
                     else{
                         echo "ERROR";
                     }
                    }
                }
                else
                {
                    echo "Error al subir Curriculum";
                }
            }
        }

    }
}
?>