<?php 
			include("datos_conexion.php");
			$conexion_db=mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
			if (!$conexion_db){
				die("no se ha encontrado conexion a la base de datos");
			}

			$nombre=$_POST['txt_nombres'];
			$apellido=$_POST['txt_apellidos'];
			$edad=$_POST['txt_edad'];
			$correo=$_POST['txt_correo'];
			$contra=$_POST['txt_contra'];
			//$resultado2= mysqli_query($link,"Select * from usuarios");
			//while ($row=mysqli_fetch_array($resultado2))
//{
			//$id=$row['idUsuario'];
//		}
			$consulta="INSERT INTO `usuario`(`nombre`, `apellido`, `edad`, `correo`, `contraseña`) VALUES ('".$nombre."','".$apellido."','".$edad."','".$correo."','".$contra."')";
				if (mysqli_query($conexion_db, $consulta)) {
    				
    				header("location: index.php");
				} 
				else {
   				 echo "Error: " . "<br>" . mysqli_error($conexion_db);
					}
			  mysqli_close($conexion_db);
 ?>