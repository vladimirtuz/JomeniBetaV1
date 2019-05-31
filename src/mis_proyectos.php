<?php session_start();
require("../db/db.php");
$id_usuario=$_SESSION['matricula'];
$conexion=mysqli_connect($servidor,$usuario,$password,$bd);
$consult="select *from postulante_proyecto where id_alumno=$id_usuario";
$execute=mysqli_query($conexion,$consult);  
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
  <script type="text/javascript" src="../js/funciones.js"></script>
</head>
<body style="	overflow-x: hidden;">
<!-- Logotipos del tec -->
<div class="row">
    <div class="col-md-12">
        <img src="../images/logos/logotecnm.png" width="15%" style="margin:0% 10%;">
        <img src="../images//logos/logosep.png" width="15%" style="margin:0% 5%;">
        <img src="../images/logos/logotec.png" width="15%"style="margin:0% 5%;">
    </div>    
</div>

<!-- Navbar alumno-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Alumno</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">Mis datos<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="proyectos_logueados.php">Proyectos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Mis Proyectos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="documentos.php">Documentos</a>
      </li>
      <li class="nav-item">
      <form action="acciones_db.php" method="POST">
      <input type="submit" name="cerrar_sesion" value="Cerrar Sesion"  class="btn btn-primary" />
      </form>
      </li>
    </ul>
  </div>
</nav>
    <div class="form" style="margin-top:2%;">
    <?php 
        while($fila=mysqli_fetch_assoc($execute)){
            $id_proyecto=$fila['id_proyecto'];
            $sql2="select *from proyectos where id_proyecto=$id_proyecto";
            $execute2=mysqli_query($conexion,$sql2);
            
            if($datos_proyecto=mysqli_fetch_assoc($execute2)){
    ?>
    <div class="form-row">
        <div class="form-group col-md-6">
          <input type="text" class="form-control" name="name_alumno" id="name_alumno" value="<?php echo $datos_proyecto["nombre"];?>" disabled required>    
        </div>

        <div class="form-group col-md-2">
          <input type="text" class="form-control" name="name_alumno" id="name_alumno" value="<?php echo $fila["status"];?>" disabled required>    
        </div>

        <div class="form-group col-md-4">
            <form action="detalles_proyecto.php" method="POST">
                <?php
                    $id_empresa=$datos_proyecto['id_empresa'];
                    $slq3="select *from empresas where matricula=$id_empresa";
                    $execute3=mysqli_query($conexion,$slq3);
                    if($nombre_empresa=mysqli_fetch_assoc($execute3)){
                    ?>
                    <input type="hidden" name="id_proyecto" value="<?php echo $fila["id_proyecto"]?>">
                    <input type="hidden" name="empresa" value="<?php echo $nombre_empresa["nombre"]?>">
                    <?php } ?>
                    <input type="submit" name="ver_solicitud_proyecto" value="VER"  class="btn btn-primary" style="float:left; margin-right:3%;"/>
            </form>
            <?php 
            if($fila['status']=='pendiente'){
            ?>
            <form action="acciones_db.php" method="POST" >
                <input type="submit" name="cancela_solicitud_proyecto" value="CANCELAR SOLICITUD"  class="btn btn-primary" />  
                <input type="hidden" name="id_proyecto" value="<?php echo $fila["id_proyecto"]?>">
                <input type="hidden" name="id_alumno" value="<?php echo $fila["id_alumno"]?>">
            </form>
            <?php } ?>
         </div>


    </div>
        <?php } 
                 } ?>
    </div>
    <script>
        function cancelar_proyecto(){
            var form_cancela=document.getElementById("form_datos_cancelar");
            form_cancela.submit();
        }
    </script>
</body>
</html>