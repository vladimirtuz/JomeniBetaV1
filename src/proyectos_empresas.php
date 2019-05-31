<?php
session_start();
require("../db/db.php");
$id_usuario=$_SESSION['matricula'];
if($_SESSION['matricula']==null && $_SESSION['pass']==null){
header("location: ../index.html");
}
else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Proyectos</title>
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

<!--Navbar Empresa -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Empresa</a>
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
      <form action="acciones_db.php" method="POST">
      <input type="submit" name="cerrar_sesion" value="Cerrar Sesion"  class="btn btn-primary" />
      </form>
      </li>
    </ul>
  </div>
</nav>

<!--Pestañas con las opciones de  los proyectos -->
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Proyectos')" id="activo">Mis proyectos</button>
  <!-- Validacion de que existe organigrama para poder crear un proyecto-->
<?php
  $archivo='../images/organigramas/'.$_SESSION['matricula'].'.png';
  if(file_exists($archivo)){
?>
  <button class="tablinks" onclick="openCity(event, 'Crear')">Crear Proyecto</button>
  <?php } ?>
</div>

<?php
$id_usuario=$_SESSION['matricula'];
$conexion=mysqli_connect($servidor,$usuario,$password,$bd);
$consult="select *from proyectos where id_empresa=$id_usuario";
$execute=mysqli_query($conexion,$consult);  
?>
<!--Pestaña de la opcion de proyectos-->
<div id="Proyectos" class="tabcontent">
  <div class="form" style="margin-top:2%;">
    <?php  while($fila=mysqli_fetch_assoc($execute)){ ?>
    <div class="form-row">
      <div class="form-group col-md-7">
        <input type="text" class="form-control" name="name_proyecto" id="name_alumno" value="<?php echo $fila["nombre"];?>" disabled required>  
      </div>

      <div class="form-group col-md-4">
        <form action="detalles_proyecto.php" method="POST">
          <?php
            $id_empresa=$fila['id_empresa'];
            $slq3="select *from empresas where matricula=$id_empresa";
            $execute3=mysqli_query($conexion,$slq3);
            if($nombre_empresa=mysqli_fetch_assoc($execute3)){
          ?>
          <input type="hidden" name="id_proyecto" value="<?php echo $fila["id_proyecto"]?>">
          <input type="hidden" name="empresa" value="<?php echo $fila["nombre"]?>">
          <?php } ?>
          <input type="submit" name="ver_proyecto_empresa" value="VER"  class="btn btn-primary" style="float:left; margin-right:3%;"/>
        </form>

          <form action="acciones_db.php" method="POST" >
            <input type="submit" name="eliminar_proyecto_empresa" value="ELIMINAR"  class="btn btn-primary" />  
            <input type="hidden" name="id_proyecto" value="<?php echo $fila["id_proyecto"]?>">
          </form>

      </div> 

    </div>
    <?php } } ?>
  </div>
</div>


<!-- Pestaña de la opcion crear proyecto-->
<div id="Crear" class="tabcontent">
  <form action="acciones_db.php" method="POST">
    <!-- primera fila del formulario para mostrar nombre departamento y division-->
    <div class="form-row">
       <div class="form-group col-md-12">
          <label>Nombre del proyecto</label>
          <input type="text" class="form-control" name="nombre_proyecto" id="nombre_proyecto" required>
       </div>

        <div class="form-group col-md-4">
          <label>Departamento</label>
          <input type="text" class="form-control" name="departamento_proyecto" id="departamento_proyecto" required>
        </div>

        <div class="form-group col-md-4">
          <label>Division</label>
          <input type="text" class="form-control" name="division_proyecto" id="division_proyecto"  required>
        </div>
    </div>
     <!-- Segunda fila donde se mostraran los objetivos generales y la descripcion del proyecto-->
    <div class="form-row">
       <div class="form-group col-md-6">
          <label for="inputAddress">Objetivo general</label>
          <textarea style="width:100%; height:auto; resize:none;" name="general_proyecto" id="general_proyecto"  required> </textarea>
       </div>
      
      <div class="form-group col-md-6">
          <label for="inputAddress">Descripcion</label>
          <textarea style="width:100%; height:auto; resize:none;" name="descripcion_proyecto" id="descripcion_proyecto"  required >  </textarea>
      </div>
    </div>

    <!-- Tercera fila donde se mostrara la modalidad, periodo y postulantes del proyecto-->
    <div class="form-row">  

      <div class="form-group col-md-4">
        <label >Modalidad</label>
        <select name="modalidad_proyecto">
          <option value="Grupal">Grupal</option>
          <option value="individual">Individual</option>
        </select>
      </div>

      <div class="form-group col-md-4">
        <label>Periodo</label>
        <input type="date" class="form-control" name="inicio_proyecto" id="inicio_proyecto"value=""  required >-
        <input type="date" class="form-control" name="fin_proyecto" id="fin_proyecto"value=""required >        
      </div>

    </div>

    <!-- Cuarta fila donde se muestra al responsable del proyecto-->
    <div class="form-row">
      <div class="form-group col-md-6">
        <label >Responsable del proyecto</label>
        <input type="text" class="form-control" name="responsable_proyecto" id="responsable_proyecto"  required>
      </div>

      <div class="form-group col-md-6">
        <label>Cargo</label>
        <input type="text" class="form-control" name="cargo_responsable_proyecto" id="cargo_responsable_proyecto"  required>
      </div>
    </div>

    <!-- Quinta fila donde se muestra la informacion de la persona que firmara el acuerdo -->
    <div class="form-row">

      <div class="form-group col-md-6">
        <label >Persona que firmara el acuerdo</label>
        <input type="text" class="form-control" name="persona_acuerdo_proyecto" id="persona_acuerdo_proyecto" required>
      </div>

      <div class="form-group col-md-6">
        <label>Cargo</label>
        <input type="text" class="form-control" name="cargo_acuerdo_proyecto" id="cargo_acuerdo_proyecto" required>
      </div>
    </div>
    
    <div class="form-row" >
      <div class="form-group col-md-12" style="text-align:center;">
     <input type="submit" name="guarda_proyecto_nuevo" value="GUARDAR" id="guardar_proyecto_nuevo"  class="btn btn-primary"/>         
      </div>
    </div>
  </form>
</div>

<script>
var btn=document.getElementById("activo");
  btn.click();
</script>

</body>
</html>