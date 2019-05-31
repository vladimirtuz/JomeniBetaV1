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

<?php  if($_SESSION['tipo']=="alumnos"){ 
  $conexion=mysqli_connect($servidor,$usuario,$password,$bd);
  $consult="select *from alumnos where matricula=$id_usuario";
  $execute=mysqli_query($conexion,$consult);  
  ?>
<!--Navbar  alumnos-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Alumno</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Mis datos<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="proyectos_logueados.php">Proyectos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mis_proyectos.php">Mis Proyectos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="documentos">Documentos</a>
      </li>
      <li class="nav-item">
      <form action="acciones_db.php" method="POST">
      <input type="submit" name="cerrar_sesion" value="Cerrar Sesion"  class="btn btn-primary" />
      </form>
      </li>
    </ul>
  </div>
</nav>
<?php } else { ?>

<!--Navbar Empresa -->
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
<?php } ?>


<!------------------------------------------------------ Formulario de los datos de los alumnos--------------------------------------->
<?php if($_SESSION['tipo']=="alumnos") {
   $conexion=mysqli_connect($servidor,$usuario,$password,$bd);
   $consult="select *from alumnos where matricula=$id_usuario";
   $execute=mysqli_query($conexion,$consult);  
  ?>
    <!-- Pestañas de las opciones del alumno en datos -->
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Datos Personales')" id="activo">Datos Personales</button>
  <button class="tablinks" onclick="openCity(event, 'Curriculum')">Curriculum Vitae</button>
</div>


<?php  if($fila=mysqli_fetch_assoc($execute)) { ?>
    
<!-- Contenido de la opcion datos personales -->
<div id="Datos Personales" class="tabcontent">

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
      
      <!-- Boton para editar informacion del alumno-->
      <div class="form-col">
          <div class="form-group col-md-12" style="text-align:center;">
          <input type="button" class="btn btn-primary" id="edita_alumno" onclick='habilita_form_alumno()' Value="Editar">
          <input type="submit" class="btn btn-primary" id="guarda_alumno" name="guarda_alumno" style="display:none;" value="Guardar">
          </div>
      </div>
  </form>
</div>
<!-- Seccion donde se muestra el documento pdf del curriculum-->
<?php $archivo='../pdf/'.$_SESSION['matricula'].'.pdf'; ?>

<div id="Curriculum" class="tabcontent">
  <!-- En esta parte se verifica que existe el documento en el sistema (curriculum)-->
  <?php if(file_exists($archivo)) { ?>
    <!--Muestra el archivo pdf del curriculum -->
  <div class="col-md-12" style="text-align:center;">
     <embed src="<?php echo $archivo?>" width="100%" height="850px" id="curriculum_alumno">
      <div class="col-md-12" style="text-align:center;">
        <!--Formulario para actualizar el archivo pdf del curriculum -->
        <form action="acciones_db.php" method="POST">
           <input type="submit" name="borrar_curriculum" value="ELIMINAR"  class="btn btn-primary" />
        </form>
      </div>
  </div>

  <?php } else {?>
    <!-- Subir curriculum por que no existe-->
    <div class="col-md-12" style="text-align:center;">
          <h1 id="title-1">No cuentas con un curriculum en el sistema</h1>
        </div>
        <div class="col-md-12" style="text-align:center;" >
        <input type="button" class="btn btn-primary" id="boton_subir_curriculum" onclick='subir_curriculum()' Value="Subir">
        </div>
        <form method="POST" action="acciones_db.php" enctype="multipart/form-data" id="form_curriculum_subir" style="display:none;">
          <div class="col-md-12">
            <h1>Subir Archivo PDF de su curriculum(tamaño max 15Mb)</h1>
          </div>
          <div class="col-md-12">
              <span>Upload a File:</span>
            <input type="file" name="archivo_curriculum" required/>
            </div>
            <div class="col-md-12" style="text-align:center; margin-top:20px;">
              <input type="submit" name="subir_curriculum" value="SUBIR"  class="btn btn-primary" />
              <input type="button" name="cancela_subida" value="CANCELAR"  class="btn btn-primary"  onclick='cancelar_subida()'/>
            </div>
          </form>
  <?php } ?>
</div>


<?php } ?>    <!-- Cierra el if de la sentencia sql-->
<?php } ?>    <!-- Cierra el if de la compracion si usuario es alumno-->

<!---------------------------------------------------------- Formulario de los datos de las empresas ----------------------------------------------->
<?php if($_SESSION['tipo']=="empresas") {
   $conexion=mysqli_connect($servidor,$usuario,$password,$bd);
   $consult="select *from empresas where matricula=$id_usuario";
   $execute=mysqli_query($conexion,$consult); 
  ?>
    <!-- Pestañas de las opciones del alumno en datos -->
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Datos Personales')" id="activo">Datos Personales</button>
  <button class="tablinks" onclick="openCity(event, 'Organigrama')">Organigrama</button>
</div>


<?php  if($fila=mysqli_fetch_assoc($execute)){ ?>
<!-- Contenido de la opcion datos personales de la empresa-->
<div id="Datos Personales" class="tabcontent">
  <?php
          $id_empresa=$_SESSION['matricula'];
          $sentencia2="select *from empresas where matricula=$id_empresa";
          $execute2=mysqli_query($conexion,$sentencia2);
          if($datos_empresa=mysqli_fetch_assoc($execute2)){
        ?>
    <div class="col-row"> 
      <div class="col-md-12" style="text-align:center;">
        <img src="../images/empresas/<?php echo $fila['matricula'].".png"?>" alt="..." class="img-thumbnail" width="15%" height="15%">
      </div>
    </div>
            <form action="acciones_db.php" method="POST" id="form_empresa">
            <div class="form-row">
            <!--Nombre de la empresa -->
              <div class="form-group col-md-6">
                <label>Nombre de la empresa</label>
                <input type="text" class="form-control" value="<?php echo $datos_empresa['nombre']?>" name="name_empresa" id="name_empresa" disabled>
              </div>

              <div class="form-group col-md-6">
                <label>Matricula</label>
                <input type="text" class="form-control" value="<?php echo $datos_empresa['matricula']?>" name="matricula" disabled>
              </div>
            <!-- Datos del titular de la empresa -->
              <div class="form-group col-md-6">
                <label>Titular</label>
                <input type="text" class="form-control" value="<?php echo $datos_empresa['titular']?>" name="titular_empresa" id="titular_empresa" disabled>
              </div>

              <div class="form-group col-md-6">
                <label>Puesto</label>
                <input type="text" class="form-control" value="<?php echo $datos_empresa['puesto']?>" name="puesto_empresa" id="puesto_empresa" disabled>
              </div>

            <!--Giro , telefono,email y rfc de la empresa -->

            <div class="form-group col-md-3">
                <label>Giro</label>
                <input type="text" class="form-control" value="<?php echo $datos_empresa['giro']?>" name="giro_empresa" id="giro_empresa" disabled>
            </div>

            <div class="form-group col-md-3">
                <label>RFC</label>
                <input type="text" class="form-control" value="<?php echo $datos_empresa['rfc']?>" name="rfc_empresa" id="rfc_empresa" disabled>
            </div>

            <div class="form-group col-md-3">
                <label>Email</label>
                <input type="text" class="form-control" value="<?php echo $datos_empresa['email']?>" name="email_empresa" id="email_empresa" disabled>
            </div>

            <div class="form-group col-md-3">
                <label>Telefono</label>
                <input type="text" class="form-control" value="<?php echo $datos_empresa['telefono']?>" name="telefono_empresa" id="telefono_empresa" disabled>
            </div>

            <!-- Direccion ciudad municipio y cp de la empresa-->
            <div class="form-group col-md-3">
                <label>Direccion</label>
                <input type="text" class="form-control" value="<?php echo $datos_empresa['direccion']?>" name="direccion_empresa" id="direccion_empresa" disabled>
            </div>

            <div class="form-group col-md-3">
                <label>Ciudad</label>
                <input type="text" class="form-control" value="<?php echo $datos_empresa['ciudad']?>"  name="ciudad_empresa" id="ciudad_empresa"disabled>
            </div>

            <div class="form-group col-md-3">
                <label>Municipio</label>
                <input type="text" class="form-control" value="<?php echo $datos_empresa['municipio']?>" name="municipio_empresa" id="municipio_empresa" disabled>
            </div>

            <div class="form-group col-md-3">
                <label>C.P</label>
                <input type="text" class="form-control" value="<?php echo $datos_empresa['codigo_postal']?>" name ="codigo_empresa" id="codigo_empresa" disabled>
            </div>

            <!-- Boton para editar informacion de la empresa-->
        
            <div class="form-group col-md-12" style="text-align:center;">
                <input type="button" class="btn btn-primary" id="edita_empresa" onclick='habilita_form_empresa()' Value="Editar">
                <input type="submit" class="btn btn-primary" id="guarda_empresa" name="guarda_empresa" style="display:none;" value="Guardar">
            </div>



          </div>
        </form>


        <?php } ?>
</div>

<!-- Contenido de la opcion de organigrama de la empresa -->
<?php $archivo='../images/organigramas/'.$_SESSION['matricula'].'.png'; ?>
<div id="Organigrama" class="tabcontent">
  <!-- En esta parte se verifica que existe el documento en el sistema (organigrama)-->
  <?php if(file_exists($archivo)) { ?>
    <!--Muestra el archivo png del organigrama -->
  <div class="col-md-12" style="text-align:center;">
     <img src="<?php echo $archivo?>" width="100%" height="850px" id="organigrama_empresa">
      <div class="col-md-12" style="text-align:center;">
        <!--Formulario para actualizar el archivo png del organigrama-->
        <form action="acciones_db.php" method="POST">
           <input type="submit" name="borrar_organigrama" value="ELIMINAR"  class="btn btn-primary" />
        </form>
      </div>
  </div>

  <?php } else {?>
    <!-- Subir Organigrama por que no existe-->
    <div class="col-md-12" style="text-align:center;">
          <h1 id="title-1-organigrama">No cuentas con un Organigrama en el sistema y es necesario subirlo para publicar sus proyectos</h1>
        </div>
        <div class="col-md-12" style="text-align:center;" >
        <input type="button" class="btn btn-primary" id="boton_subir_organigrama" onclick='subir_organigrama()' Value="Subir">
        </div>
        <form method="POST" action="acciones_db.php" enctype="multipart/form-data" id="form_organigrama_subir" style="display:none;">
          <div class="col-md-12">
            <h1>Subir Archivo PNG de su organigrama(tamaño max 15Mb)</h1>
          </div>
          <div class="col-md-12">
              <span>Upload a File:</span>
            <input type="file" name="archivo_organigrama" required/>
            </div>
            <div class="col-md-12" style="text-align:center; margin-top:20px;">
              <input type="submit" name="subir_organigrama" value="SUBIR"  class="btn btn-primary" />
              <input type="button" name="cancela_subida_organigrama" value="CANCELAR"  class="btn btn-primary"  onclick='cancelar_subida_organigrama()'/>
            </div>
          </form>
  <?php } ?>
</div>


<?php } ?>    <!-- Cierra el if de la sentencia sql-->
<?php } ?>    <!-- Cierra el if de la compracion si usuario es empresa-->

<!---------------------------------------------------- -->

<script>
  var btn=document.getElementById("activo");
  btn.click();

  function habilita_form_alumno(){
    var t1=document.getElementById("name_alumno");
    var t2=document.getElementById("apellido_alumno");
    var t3=document.getElementById("apellido2_alumno");
    var t4=document.getElementById("carrera_alumno");
    var t5=document.getElementById("direccion_alumno");
    var t6=document.getElementById("ciudad_alumno");
    var t7=document.getElementById("estado_alumno");
    var t8=document.getElementById("pais_alumno");
    var t9=document.getElementById("telefono_alumno");
    var t10=document.getElementById("email_alumno");
    var t11=document.getElementById("edita_alumno");
    var t12=document.getElementById("guarda_alumno");
    t1.disabled=false;
    t2.disabled=false;
    t3.disabled=false;
    t4.disabled=false;
    t5.disabled=false;
    t6.disabled=false;
    t7.disabled=false;
    t8.disabled=false;
    t9.disabled=false;
    t10.disabled=false;
    t11.style.display="none";
    t12.style.display="inline";
  }

  function habilita_form_empresa(){
    var t1=document.getElementById("name_empresa");
    var t2=document.getElementById("titular_empresa");
    var t3=document.getElementById("puesto_empresa");
    var t4=document.getElementById("giro_empresa");
    var t5=document.getElementById("rfc_empresa");
    var t6=document.getElementById("email_empresa");
    var t7=document.getElementById("telefono_empresa");
    var t8=document.getElementById("direccion_empresa");
    var t9=document.getElementById("ciudad_empresa");
    var t10=document.getElementById("municipio_empresa");
    var t11=document.getElementById("codigo_empresa");
    var t12=document.getElementById("edita_empresa");
    var t13=document.getElementById("guarda_empresa");
    t1.disabled=false;
    t2.disabled=false;
    t3.disabled=false;
    t4.disabled=false;
    t5.disabled=false;
    t6.disabled=false;
    t7.disabled=false;
    t8.disabled=false;
    t9.disabled=false;
    t10.disabled=false;
    t11.disabled=false;
    t12.style.display="none";
    t13.style.display="inline";
  }


  function subir_curriculum(){
  var titulo1=document.getElementById("title-1");
  var btn1=document.getElementById("boton_subir_curriculum");
  var form_subir=document.getElementById("form_curriculum_subir");
  titulo1.style.display="none";
  btn1.style.display="none";
  form_subir.style.display="inline";
  }

  function subir_organigrama(){
  var titulo1=document.getElementById("title-1-organigrama");
  var btn1=document.getElementById("boton_subir_organigrama");
  var form_subir=document.getElementById("form_organigrama_subir");
  titulo1.style.display="none";
  btn1.style.display="none";
  form_subir.style.display="inline";
  }

  function cancelar_subida(){
    var titulo1=document.getElementById("title-1");
  var btn1=document.getElementById("boton_subir_curriculum");
  var form_subir=document.getElementById("form_curriculum_subir");
  titulo1.style.display="inline";
  btn1.style.display="inline";
  form_subir.style.display="none";
  }

  function cancelar_subida_organigrama(){
    var titulo1=document.getElementById("title-1-organigrama");
  var btn1=document.getElementById("boton_subir_organigrama");
  var form_subir=document.getElementById("form_organigrama_subir");
  titulo1.style.display="inline";
  btn1.style.display="inline";
  form_subir.style.display="none";
  }

</script>

</body>
</html>

<?php
}


?>
