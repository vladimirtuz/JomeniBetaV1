<?php
session_start();
require("../db/db.php");
$conexion=mysqli_connect($servidor,$usuario,$password,$bd);
$id_proyecto=$_POST['id_proyecto'];
$empresa=$_POST['empresa'];
$sentencia="select *from proyectos where id_proyecto=$id_proyecto";
$execute=mysqli_query($conexion,$sentencia);
if($fila=mysqli_fetch_assoc($execute)){
?>


<!DOCTYPE HTML>
<html>
<head>
	<title>Catalogo</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-grid.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-reboot.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-reboot.min.css">
    <script type="text/javascript" src="../js/funciones.js"></script>

</head>
  <body>
  <!--------------------------------------------------------------------------- Logotipos del tec----------------------------------------->
    <div class="row">
      <div class="col-md-12">
        <img src="../images/logos/logotecnm.png" width="15%" style="margin:0% 10%;">
        <img src="../images//logos/logosep.png" width="15%" style="margin:0% 5%;">
        <img src="../images/logos/logotec.png" width="15%"style="margin:0% 5%;">
      </div>
    </div> 

  <!--------------------------------------------------------Barra de navegaciones para opciones de proyecto---------------------------------- -->

<?php if(isset($_SESSION)) { // Validacion de que existe una sesion y no es un usuario invitado?> 

  <!-- Pestañas que se muestran en la opcion detalles del proyecto-->
  <div class="tab">
    <button class="tablinks" onclick="openCity(event, 'Proyecto')" id="activo">Datos Proyecto</button>
    <?php if($_SESSION['tipo']=="alumnos" || $_SESSION['tipo']!="empresas") { // Si el usuario es un alumno muestra la pestaña de datos de la empresa?>
    <button class="tablinks" onclick="openCity(event, 'Empresa')">Datos Empresa</button>
    <?php }
    if($_SESSION['tipo']=="empresas") // Si el usuario es una empresa muestra la pestaña postulantes 
    { ?>
    <button class="tablinks" onclick="openCity(event, 'Postulantes')">Postulantes</button>
    <?php }
    ?>
  </div> 


    <!-- Seccion que muestra los proyectos de las empresas-->
  <div id="Proyecto" class="tabcontent">
    <form action="acciones_db.php" method="POST">
        <!-- primera fila del formulario para mostrar nombre departamento y division-->
      <div class="form-row">
  
        <div class="form-group col-md-12">
          <label>Nombre del proyecto</label>
          <input type="text" class="form-control" name="nombre_proyecto" id="nombre_proyecto" value="<?php echo $fila['nombre']?>" disabled required>
        </div>

        <div class="form-group col-md-4">
          <label >Empresa</label>
          <input type="text" class="form-control"  value="<?php echo $empresa;?>" disabled>
        </div>

        <div class="form-group col-md-4">
          <label>Departamento</label>
          <input type="text" class="form-control" name="departamento_proyecto" id="departamento_proyecto" value="<?php echo $fila['departamento']?>" disabled required>
        </div>

        <div class="form-group col-md-4">
          <label>Division</label>
          <input type="text" class="form-control" name="division_proyecto" id="division_proyecto" value="<?php echo $fila['division']?>" disabled required>
        </div>

      </div>

        <!-- Segunda fila donde se mostraran los objetivos generales y la descripcion del proyecto-->
      <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputAddress">Objetivo general</label>
            <textarea style="width:100%; height:auto; resize:none;" name="general_proyecto" id="general_proyecto" disabled required><?php echo $fila['objetivo_general'];?> </textarea>
        </div>
      
        <div class="form-group col-md-6">
            <label for="inputAddress">Descripcion</label>
            <textarea style="width:100%; height:auto; resize:none;" name="descripcion_proyecto" id="descripcion_proyecto" disabled required ><?php echo $fila['descripcion'];?> </textarea>
        </div>

      </div>

        <!-- Tercera fila donde se mostrara la modalidad, periodo y postulantes del proyecto-->
      <div class="form-row">

        <div class="form-group col-md-4">
          <label >Modalidad</label>
          <input type="text" class="form-control" name="modalidad_proyecto" id="modalidad_proyecto" value="<?php echo $fila['modalidad']?>" disabled required>
        </div>

        <div class="form-group col-md-4">
          <label>Periodo</label>
          <input type="text" class="form-control" name="periodo_proyecto" id="periodo_proyecto"value="<?php echo $fila['periodo']?>" disabled required>
          <input type="date" class="form-control" name="inicio_proyecto" id="inicio_proyecto"value=""  required style="display:none;">-
          <input type="date" class="form-control" name="fin_proyecto" id="fin_proyecto"value="ñ"required style="display:none;">        
        </div>

        <div class="form-group col-md-4">
          <label>Postulantes</label>
          <input type="text" class="form-control" value="<?php echo $fila['postulantes']?>" disabled required>
        </div>

      </div>

      <!-- Cuarta fila donde se muestra al responsable del proyecto-->
      <div class="form-row">

        <div class="form-group col-md-6">
          <label >Responsable del proyecto</label>
          <input type="text" class="form-control" name="responsable_proyecto" id="responsable_proyecto" value="<?php echo $fila['nombre_responsable']?>" disabled required>
        </div>

        <div class="form-group col-md-6">
          <label>Cargo</label>
          <input type="text" class="form-control" name="cargo_responsable_proyecto" id="cargo_responsable_proyecto"  value="<?php echo $fila['cargo_responsable']?>" disabled required>
        </div>

      </div>

      <!-- Quinta fila donde se muestra la informacion de la persona que firmara el acuerdo -->
      <div class="form-row">

        <div class="form-group col-md-6">
          <label >Persona que firmara el acuerdo</label>
          <input type="text" class="form-control" name="persona_acuerdo_proyecto" id="persona_acuerdo_proyecto"value="<?php echo $fila['persona_acuerdo']?>" disabled required>
        </div>

        <div class="form-group col-md-6">
          <label>Cargo</label>
          <input type="text" class="form-control" name="cargo_acuerdo_proyecto" id="cargo_acuerdo_proyecto" value="<?php echo $fila['puesto_acuerdo']?>" disabled required>
        </div>

      </div>

      <?php
      //si el usuario es una empresa muestra el boton de guardar cuando edita el prouyecto
      if($_SESSION["tipo"]=="empresas"){
        ?> 
        <div class="form-row" style="text-align:center">
          <div class="form-group col-md-12">
            <input type="hidden" name="id_proyecto" value="<?php echo $fila['id_proyecto']?>">
            <input type="submit" name="guarda_proyecto" value="GUARDAR" id="guardar_proyecto"  class="btn btn-primary" style="display:none;"/> 
          </div>
        </div>
        <?php } ?>
 
    <!-- Esto estaba fuera del tab-->
    </form>
    
    <form action="acciones_db.php" method="POST">
      <div class="form-group col-md-12" style="text-align:center;">
        <input type="button" name="aceptar" value="ACEPTAR" id="aceptar_proyecto" class="btn btn-primary"  onclick='history.back(1)'/>
        <input type="hidden" name="id_proyecto" value="<?php echo $id_proyecto;?>">
          <?php
            $sql3="select * from postulante_proyecto";
            $execute3=mysqli_query($conexion,$sql3);
            $alumno=$_SESSION['matricula'];
            $ocultar=false;
              while($existe_solicitud=mysqli_fetch_assoc($execute3)){
                if($existe_solicitud['id_proyecto']==$fila['id_proyecto'] && $existe_solicitud['id_alumno']==$alumno){
                    $ocultar=true;
                }
              }
              if($ocultar==false){
                if(isset($_SESSION)){
                  if($_SESSION['tipo']=="alumnos"){
          ?>
        <input type="submit" name="postula_proyecto" value="POSTULARSE"  class="btn btn-primary" />
                  <?php }
          
                } } ?>
                   <?php
            if(isset($_SESSION)){
              if($_SESSION['tipo']=="empresas"){
                ?>
                <input type="button" name="edita_proyecto" value="EDITAR" id="editar_proyecto" class="btn btn-primary" onclick='editar_proyecto_empresa()' />

                <?php
              }}

          ?>
      </div>

    </form>
  </div>


    <!--Seccion que muestra los datos de la empresa  -->
  <div id="Empresa" class="tabcontent">
      <!--Obtiene el nombre de la empresa -->
    <?php
      $id_empresa=$fila['id_empresa'];
      $sentencia2="select *from empresas where matricula=$id_empresa";
      $execute2=mysqli_query($conexion,$sentencia2);
      if($datos_empresa=mysqli_fetch_assoc($execute2)){
    ?>
    <!--Logotipo de la empresa -->
    <div class="col-row"> 
      <div class="col-md-12" style="text-align:center;">
        <img src="../images/empresas/<?php echo $fila['id_empresa'].".png"?>" alt="..." class="img-thumbnail" width="15%" height="15%">
      </div>
    </div>
      <!--Formulario que muestra los datos de la empresa -->
    <form>
        <!--Datos del titular de la empresa y nombre de la empresa -->
      <div class="form-row">
          <!--Nombre de la empresa -->
        <div class="form-group col-md-12">
          <label>Nombre de la empresa</label>
          <input type="text" class="form-control" value="<?php echo $datos_empresa['nombre']?>" disabled>
        </div>
            <!-- Datos del titular de la empresa -->
        <div class="form-group col-md-6">
          <label>Titular</label>
          <input type="text" class="form-control" value="<?php echo $datos_empresa['titular']?>" disabled>
        </div>

        <div class="form-group col-md-6">
          <label>Puesto</label>
          <input type="text" class="form-control" value="<?php echo $datos_empresa['puesto']?>" disabled>
        </div>

          <!--Giro , telefono,email y rfc de la empresa -->
        <div class="form-group col-md-3">
            <label>Giro</label>
            <input type="text" class="form-control" value="<?php echo $datos_empresa['giro']?>" disabled>
        </div>

        <div class="form-group col-md-3">
            <label>RFC</label>
            <input type="text" class="form-control" value="<?php echo $datos_empresa['rfc']?>" disabled>
        </div>

        <div class="form-group col-md-3">
            <label>Email</label>
            <input type="text" class="form-control" value="<?php echo $datos_empresa['email']?>" disabled>
        </div>

        <div class="form-group col-md-3">
            <label>Telefono</label>
            <input type="text" class="form-control" value="<?php echo $datos_empresa['telefono']?>" disabled>
        </div>

          <!-- Direccion ciudad municipio y cp de la empresa-->
        <div class="form-group col-md-3">
            <label>Direccion</label>
            <input type="text" class="form-control" value="<?php echo $datos_empresa['direccion']?>" disabled>
        </div>

        <div class="form-group col-md-3">
            <label>Ciudad</label>
            <input type="text" class="form-control" value="<?php echo $datos_empresa['ciudad']?>" disabled>
        </div>

        <div class="form-group col-md-3">
            <label>Municipio</label>
            <input type="text" class="form-control" value="<?php echo $datos_empresa['municipio']?>" disabled>
        </div>

        <div class="form-group col-md-3">
            <label>C.P</label>
            <input type="text" class="form-control" value="<?php echo $datos_empresa['codigo_postal']?>" disabled>
        </div>

        <div class="form-group col-md-12" style="text-align:center;">
          <input type="button" name="aceptar" value="ACEPTAR"  class="btn btn-primary"  onclick='history.back(1)'/>
        </div>
      </div>
    </form>
    <?php } } else {?>

      <!-- Formulario para mostrar datos del proyecto si es un usuario invitado-->
    <form >
       <!-- primera fila del formulario para mostrar nombre departamento y division-->
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Nombre del proyecto</label>
          <input type="text" class="form-control" value="<?php echo $fila['nombre']?>" disabled required>
        </div>

        <div class="form-group col-md-4">
          <label >Empresa</label>
          <input type="text" class="form-control" value="<?php echo $empresa;?>" disabled required>
        </div>

        <div class="form-group col-md-4">
          <label>Departamento</label>
          <input type="text" class="form-control" value="<?php echo $fila['departamento']?>" disabled required>
        </div>

        <div class="form-group col-md-4">
          <label>Division</label>
          <input type="text" class="form-control" value="<?php echo $fila['division']?>" disabled required>
        </div>

      </div>

        <!-- Segunda fila donde se mostraran los objetivos generales y la descripcion del proyecto-->
      <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputAddress">Objetivo general</label>
            <textarea style="width:100%; height:auto; resize:none;" disabled required><?php echo $fila['objetivo_general'];?> </textarea>
        </div>
      
        <div class="form-group col-md-6">
            <label for="inputAddress">Descripcion</label>
            <textarea style="width:100%; height:auto; resize:none;" disabled required ><?php echo $fila['descripcion'];?> </textarea>
        </div>

      </div>

       <!-- Tercera fila donde se mostrara la modalidad, periodo y postulantes del proyecto-->
      <div class="form-row">

        <div class="form-group col-md-4">
          <label >Modalidad</label>
          <input type="text" class="form-control" value="<?php echo $fila['modalidad']?>" disabled required>
        </div>

        <div class="form-group col-md-4">
          <label>Periodo</label>
          <input type="text" class="form-control" value="<?php echo $fila['periodo']?>" disabled required>
        </div>

        <div class="form-group col-md-4">
          <label>Postulantes</label>
          <input type="text" class="form-control" value="<?php echo $fila['postulantes']?>" disabled>
        </div>

      </div>

        <!-- Cuarta fila donde se muestra al responsable del proyecto-->
      <div class="form-row">

        <div class="form-group col-md-6">
          <label >Responsable del proyecto</label>
          <input type="text" class="form-control" value="<?php echo $fila['nombre_responsable']?>" disabled required>
        </div>

        <div class="form-group col-md-6">
          <label>Cargo</label>
          <input type="text" class="form-control" value="<?php echo $fila['cargo_responsable']?>" disabled required>
        </div>

      </div>

         <!-- Quinta fila donde se muestra la informacion de la persona que firmara el acuerdo -->
      <div class="form-row">

        <div class="form-group col-md-6">
          <label >Persona que firmara el acuerdo</label>
          <input type="text" class="form-control" value="<?php echo $fila['persona_acuerdo']?>" disabled required>
        </div>

        <div class="form-group col-md-6">
          <label>Cargo</label>
          <input type="text" class="form-control" value="<?php echo $fila['puesto_acuerdo']?>" disabled required>
        </div>
      </div>

    </form>
  
      <?php } ?>
  </div>

      <!-- Seccion que muestra los datos de los postulantes-->
  <div id="Postulantes"  class="tabcontent">
    <?php
    $consulta_postulantes="select *from postulante_proyecto where id_proyecto=$id_proyecto && status!='NO DISPONIBLE' && status!='RECHAZADO'";
    $consulta=mysqli_query($conexion,$consulta_postulantes);
    while($datos_proyecto=mysqli_fetch_assoc($consulta)){
      $id_alumno=$datos_proyecto['id_alumno'];
      $consulta_nombre_alumno="select *from alumnos where id_usuario=$id_alumno";
      $consulta_alumno=mysqli_query($conexion,$consulta_nombre_alumno);
      while($datos_alumno=mysqli_fetch_assoc($consulta_alumno)){
        $nombre=$datos_alumno['nombre']." ".$datos_alumno['apellido_paterno']." ".$datos_alumno['apellido_materno'];
        ?>
          <form action="postulantes.php" method="POST"> 
            <div class="form-row">
                <div class="form-group col-md-8">
                  <input type="text" class="form-control" name="nombre_alumno" id="nombre_alumno" value="<?php echo $nombre?>" disabled required>
                </div>

                <div class="form-group col-md-4">
                  <input type="hidden" name="id_alumno" value="<?php echo $datos_alumno['matricula']; ?>">
                  <input type="hidden" name="id_proyecto" value="<?php echo $id_proyecto?>">
                  <input type="submit" name="ver_alumno" value="VER INFORMACION" id="ver_informacion"  class="btn btn-primary"/> 
                </div>
            </div>
          </form>
        <?php
      }
    }
    ?> 
  </div>

<script>
 var btn=document.getElementById("activo");
  btn.click();

  function editar_proyecto_empresa(){
   var btn_aceptar=document.getElementById("aceptar_proyecto");
   btn_aceptar.style.display="none";
   var btn_editar=document.getElementById("editar_proyecto");
   btn_editar.style.display="none";
   var btn_guardar=document.getElementById("guardar_proyecto");
   btn_guardar.style.display="inline";
   var t1=document.getElementById("nombre_proyecto");
    var t2=document.getElementById("departamento_proyecto");
    var t3=document.getElementById("division_proyecto");
    var t4=document.getElementById("general_proyecto");
    var t5=document.getElementById("descripcion_proyecto");
    var t7=document.getElementById("modalidad_proyecto");
    var t8=document.getElementById("periodo_proyecto");
    var t9=document.getElementById("responsable_proyecto");
    var t10=document.getElementById("cargo_responsable_proyecto");
    var t11=document.getElementById("persona_acuerdo_proyecto");
    var t12=document.getElementById("cargo_acuerdo_proyecto");
    var t13=document.getElementById("inicio_proyecto");
    var t14=document.getElementById("fin_proyecto");    
    t1.disabled=false;
    t2.disabled=false;
    t3.disabled=false;
    t4.disabled=false;
    t5.disabled=false;
    t7.disabled=false;
    t8.style.display="none";
    t9.disabled=false;
    t10.disabled=false;
    t11.disabled=false;
    t12.disabled=false;
    t13.style.display="inline";
    t14.style.display="inline";


  }
</script>
    </body>
</html>

<?php  }  ?>


