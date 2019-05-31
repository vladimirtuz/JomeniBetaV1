<?php session_start();?>

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
<?php if($_SESSION['tipo']=="alumnos"){ ?>
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
        <a class="nav-link" href="#">Proyectos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mis_proyectos.php">Mis Proyectos</a>
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
<?php } else {?>
<!-- Navbar Empresa-->
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
        <a class="nav-link" href="proyectos_logueados">Proyectos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Documentos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Organigrama</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Cerrar Sesion</a>
      </li>
    </ul>
  </div>
</nav>
<?php } ?>
</body>
</html>
<?php include("proyectos.php"); ?>