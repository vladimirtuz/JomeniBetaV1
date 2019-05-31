<!DOCTYPE html>
<html>
<head>
	<title>Anteproyectos ITC</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

</head>
<body>
	<div class="container">

	   <!-- Imagenes del encabezado -->
<?php if(!isset($_SESSION)) {  ?>
			<div class="row">
				<div class="col-md-4">
					<img src="../images/logos/logotecnm.png" width="50%">
				</div>

				<div class="col-md-4">
					<img src="../images//logos/logosep.png" width="50%">
				</div>

				<div class="col-md-4">
					<img src="../images/logos/logotec.png" width="50%">
				</div>

			</div>
<?php
	 }
	   
	   ?>
			<div class="row">
		<?php
			include("../db/db.php");
			$con=mysqli_connect($servidor,$usuario,$password,$bd);
			$sql="select *from proyectos";
			$execute=mysqli_query($con,$sql);
			$proyecto_ocultar=0;
			$alumno=0; 
			if(isset($_SESSION)) $alumno=$_SESSION['matricula'];
			while($fila=mysqli_fetch_assoc($execute)){

					//Revisa que el alumno no este postulado al proyecto o no haya sido ocupado el proyecto
					$sql3="select * from postulante_proyecto";
					$execute3=mysqli_query($con,$sql3);
						while($existe_proyecto=mysqli_fetch_assoc($execute3)){
							if($existe_proyecto['id_proyecto']==$fila['id_proyecto'] && $existe_proyecto['id_alumno']==$alumno){
									$proyecto_ocultar=$existe_proyecto['id_proyecto'];
							}
						}
						if($proyecto_ocultar!=$fila['id_proyecto']){
				?>
					<div class="col-md-4 container-tarjeta">
						<img src="../images/empresas/<?php echo $fila['id_empresa']?>.png" class="logo_empresa">
							
							<?php
								$id_empresa=$fila['id_empresa'];
								$sql2="select *from empresas where matricula=$id_empresa";
								$execute2=mysqli_query($con,$sql2);
								$empresa=mysqli_fetch_assoc($execute2);
								

							?>


							<table>
							<tr><td><h5><?php echo $empresa['nombre']; ?></h5></td><td>&nbsp</td></tr>
							<tr><td><h4><?php echo $fila['nombre']?></h4></td></tr>
							<tr><td><p><?php echo substr( $fila['descripcion'],0,100)."....."?></p></td></tr>
							<form action="detalles_proyecto.php" method="POST">
                            <input type="hidden" name="id_proyecto" value="<?php echo $fila['id_proyecto'] ?>" >
							<input type="hidden" name="empresa" value="<?php echo $empresa['nombre']; ?>" >
                            <tr><td><input type="submit" name="ver_proyecto_invitado" value="VER MAS" class="btn_ver" ></td></tr>
							</form>
							</table>

						
					</div>
	
				<?php
				} 
			}
		?>
			</div>
	</div>

</body>
</html>