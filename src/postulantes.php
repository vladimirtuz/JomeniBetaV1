<?php
session_start();
require("../db/db.php");
$id_alumno=$_POST['id_alumno'];
$id_proyecto=$_POST['id_proyecto'];
$conexion=mysqli_connect($servidor,$usuario,$password,$bd);
if($_SESSION['matricula']==null && $_SESSION['pass']==null){
header("location: ../index.html");
}
else{
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

<!-- Navbar alumnos-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Empresa</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Mis datos<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="proyectos_empresas.php">Proyectos</a>
      </li>
      <li class="nav-item">
      <form action="acciones_db.php" method="POST">
      <input type="submit" name="cerrar_sesion" value="Cerrar Sesion"  class="btn btn-primary" />
      </form>
      </li>
    </ul>
  </div>
</nav>

<!-- Pestañas de las opciones del alumno postulado -->
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Datos')" id="activo">Datos del Alumno</button>
  <!-- Validacion de que existe organigrama para poder crear un proyecto-->
<?php
  $archivo='../pdf/'.$id_alumno.'.pdf';
  if(file_exists($archivo)){
?>
  <button class="tablinks" onclick="openCity(event, 'Curriculum')">Curriculum</button>
  <?php } ?>
</div>
<?php } ?>

<!--Conculta de los datos del alumno -->
<?php
$consulta="select *from alumnos where matricula=$id_alumno";
$execute=mysqli_query($conexion,$consulta);
while($fila=mysqli_fetch_assoc($execute)){
?>

<!-- Seccion de los datos del alumno-->
<div id="Datos" class="tabcontent">

    <!--imagen del alumno -->
    <div class="col-row"> 
    <div class="col-md-12" style="text-align:center;">
       <img src="../images/alumnos/<?php echo $fila['matricula'].".png"?>" alt="..." class="img-thumbnail">
    </div>
  </div>
  <!--Formulario con los datos del alumno -->
  <form action="acciones_db.php" method="POST" id="form_alumno">
    <!-- Nombre completo del alumno-->
    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Nombre(s)</label>
            <input type="text" class="form-control" name="name_alumno" id="name_alumno" value="<?php echo $fila["nombre"];?>" disabled required>
        </div>

        <div class="form-group col-md-4">
            <label>Apellido Paterno</label>
            <input type="text" class="form-control" name="apellido_alumno" id="apellido_alumno" value="<?php echo $fila["apellido_paterno"];?>" disabled required>
        </div>

        <div class="form-group col-md-4">
            <label>Apellido Materno</label>
            <input type="text" class="form-control" name="apellido2_alumno" id="apellido2_alumno" value="<?php echo $fila["apellido_materno"];?>" disabled required>
        </div>
    </div>

    <!-- Datos escolares del alumno -->
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Matricula</label>
        <input type="text" class="form-control" name="matricula_alumno" id="matricula_alumno" value="<?php echo $fila["matricula"];?>" disabled required>
      </div>

      <div class="form-group col-md-6">
            <label>Carrera</label>
            <input type="text" class="form-control" name="carrera_alumno" id="carrera_alumno" value="<?php echo $fila["carrera"];?>" disabled required>
      </div>
    </div>

    <!-- Datos de direccion -->
    <div class="form-row">
      <div class="form-group col-md-3">
        <label>Direccion</label>
        <input type="text" class="form-control" name="direccion_alumno" id="direccion_alumno" value="<?php echo $fila["domicilio"];?>" disabled required>
      </div>

      <div class="form-group col-md-3">
        <label>Ciudad</label>
        <input type="text" class="form-control" name="ciudad_alumno" id="ciudad_alumno" value="<?php echo $fila["ciudad"];?>" disabled required>
      </div>

      <div class="form-group col-md-3">
        <label>Estado</label>
        <input type="text" class="form-control" name="estado_alumno" id="estado_alumno" value="<?php echo $fila["estado"];?>" disabled required>
      </div>

      <div class="form-group col-md-3">
        <label>Pais</label>
        <input type="text" class="form-control" name="pais_alumno" id="pais_alumno" value="<?php echo $fila["pais"];?>" disabled required>
      </div>
    </div> 

    <!-- Datos de Contacto  -->
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Telefono</label>
          <input type="text" class="form-control" name="telefono_alumno"  id="telefono_alumno" value="<?php echo $fila["telefono"];?>" disabled required>
        </div>

        <div class="form-group col-md-6">
          <label>Correo Electronico</label>
          <input type="text" class="form-control" name="email_alumno" id="email_alumno" value="<?php echo $fila["email"];?>" disabled required>
        </div>
      </div>
      
      <!-- Boton para aceptar rechazar al alumno-->
      <?php 
      $consulta_status="select *from postulante_proyecto where id_alumno=$id_alumno && id_proyecto=$id_proyecto";
      $estado=mysqli_query($conexion,$consulta_status);
      if($dato=mysqli_fetch_assoc($estado)){
          if(!($dato['status']=='ACEPTADO')){
      
      ?>
      <div class="form-col">
          <div class="form-group col-md-12" style="text-align:center;">
          <input type="hidden" name="id_proyecto" value="<?php echo $id_proyecto; ?>" >
          <input type="hidden" name="id_alumno" value="<?php echo $fila['matricula']; ?>" >
          <input type="submit" class="btn btn-primary" id="acepta_alumno" name="acepta_alumno"  value="Aceptar">
          <input type="submit" class="btn btn-primary" id="rechazar_alumno" name="rechaza_alumno" value="Rechazar">
          </div>
      </div>
          <?php } } ?>
  </form>
<?php } ?>
</div>

<!-- Seccion que muestra el curriculum de un alumno -->
<div id="Curriculum" class="tabcontent">
  <!-- En esta parte se verifica que existe el documento en el sistema (curriculum)-->
  <?php if(file_exists($archivo)) { ?>
    <!--Muestra el archivo pdf del curriculum -->
  <div class="col-md-12" style="text-align:center;">
     <embed src="<?php echo $archivo?>" width="100%" height="850px" id="curriculum_alumno">
      <div class="col-md-12" style="text-align:center;">
      </div>
  </div>

  <?php } ?>
</div>
</body>
</html>