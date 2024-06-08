<?php
session_start();
include("datos_conexion.php");
$conexion_db =  mysqli_connect($db_host, $db_usr,$db_pass,$db_nombre);
if (!$conexion_db) {
	die('No se ha podido conectar a la base de datos');
}
date_default_timezone_set("America/Guatemala");

$id_tarea=$_POST['id_tarea'];
$fecha_completada=date('Y-m-d');



echo "ID: ".$id_tarea."<br>";
$actualizar_tarea= mysqli_query($conexion_db,"UPDATE tarea SET estatus = 'COMPLETADA', fecha_completada = '".$fecha_completada."' WHERE tarea.id_tarea = ".$id_tarea.";");
    	header("location: pagina_tareas_completadas.php")

?>