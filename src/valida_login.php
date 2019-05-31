<?php
require("../db//db.php");
session_start();
$estado=false;
$conexion=mysqli_connect($servidor,$usuario,$password,$bd);
$consult="select *from usuarios";
$execute=mysqli_query($conexion,$consult);
while($fila=mysqli_fetch_assoc($execute)){
    if($fila['matricula']==$_POST['user'] && $fila['password']==$_POST['pass']){
        $estado=true;
        $tipo=$fila['tipo'];
        $alumno=$fila['matricula'];
        $_SESSION['matricula']=$alumno;
        $_SESSION['pass']=md5($fila['password']);
        $_SESSION['tipo']=$fila['tipo'];
    }
}
if($estado==true){
    header('Location: dashboard.php');
}else{
    header('Location: ../index.html');
}

?>