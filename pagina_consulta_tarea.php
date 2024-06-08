<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		 <script src="script.js"></script>
		<title>TAREAS</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="boostrap-sitio/css/bootstrap.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="boostrap-sitio/css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="boostrap-sitio/css/style.css"/>
		<!-- ESTILOS ALERT SWEET  -->
		<link rel="stylesheet"  href="alerts/dist/sweetalert2.min.css">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>

		<!-- Header -->
		<header id="header">
			<div class="container">
				<div  class="navbar-header">
					<!-- Logo -->
					<div  class="navbar-brand">
						
					</div>
					<!-- /Logo -->
					<!-- Mobile toggle -->
					<button class="navbar-toggle">
						<span></span>
					</button>
					<!-- /Mobile toggle -->
				</div>

				<!-- Navigation -->
				<nav id="nav">
					<ul class="main-menu nav navbar-nav navbar-right ">
						<li><a href="pagina_tareas_pendientes.php">tareas</a></li>
						<li><a href="pagina_consulta_usuario.php">Usuario</a></li>
						<li><a href="pagina_notificaciones.php">Notificaciones  </a></li>
					</ul>
				</nav>
				<!-- /Navigation -->

			</div>
		</header>
		<!-- /Header -->
		<!-- Hero-area -->
		<div class="hero-area section">
			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg);border: 4px solid black"></div>
			<!-- /Backgound Image -->
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="pagina_tareas_pendientes.php">Home</a></li>
							<li>TAREAS</li>
						</ul>
						<h1 class="white-text">TAREAS</h1>
					</div>
				</div>
			</div>
		</div>	
<?php 
						/*echo "<br>
						<table align='center'>
						<tr><td><form  action='actualizar-estudiante.php' method='post'style='float: right'><input  class='form-control' type='hidden' name='id_estudiante' value=$id_estudiante /><input type='submit'class='btn btn-primary' value='Editar Estudiante' style='width:200px; height:50px;color: white;float: right;font-size:14pt'/></form> </td>
						<td><form  action='consulta-reuniones-estudiante.php' method='post'style='float: right'><input  class='form-control' type='hidden' name='id_estudiante' value=$id_estudiante /><input type='submit' value='Reuniones Estudiante' style='width:230px; height:50px;color: white;float: right;font-size:14pt; background-color: grey'/></form> </td>
						</tr>
						</table>";*/
							      //<!-- /contact form -->
						//echo $_GET['variable1'];
						//$variable1=0;
						session_start();
						include("datos_conexion.php");
						   $conexion_db =  mysqli_connect($db_host, $db_usr,$db_pass,$db_nombre);

						if (!$conexion_db) {
							die('No se ha podido conectar a la base de datos');
						}
						$id_reunion=0;
						date_default_timezone_set("America/Guatemala");
						$fecha_hoy=date("d-m-Y");
						$fecha_global=$fecha_hoy;
						$contador=1;
						$contador_menos=-1;
						$id_tarea=$_POST['id_tarea'];
						

						/*if (isset($_GET['fecha'])) {
							$fecha_global=$_GET['fecha'];
						}
						else
						{
							if (isset($_POST['fecha'])) {
							$fecha_global=$_POST['fecha'];
							}
						}
						//***se convierte por si se cambio al recibir dato del post o get**
						$fecha_objeto = date_create($fecha_global);
						$fecha_global=date_format($fecha_objeto, "d-m-Y");
						//**************************************************
						if (isset($_GET['contador'])) {
							$contador=$_GET['contador'];
							$f=$_GET['f'];
							if ($contador==1) {
							$dia_siguiente=date("d-m-Y",strtotime($f."+1 days"));
							$fecha_global=$dia_siguiente;
							}
							else
							{
								$f=$_GET['f'];
								if($contador==-1)
								{
								$dia_anterior=date("d-m-Y",strtotime($f."-1 days"));
								$fecha_global=$dia_anterior;
								}
							}
						}*/
						$fecha_objeto = date_create($fecha_global);
						$fecha_conversion=date_format($fecha_objeto, "Y-m-d");
						$nombre_dia=date_format($fecha_objeto, "l");
						switch ($nombre_dia) {
							case 'Monday':
								$nombre_dia="Lunes";
								break;
							case 'Tuesday':
								$nombre_dia="Martes";
								break;
							case 'Wednesday':
								$nombre_dia="Miércoles";
								break;
							case 'Thursday':
								$nombre_dia="Jueves";
								break;
							case 'Friday':
								$nombre_dia="Viernes";
								break;
							case 'Saturday':
								$nombre_dia="Sábado";
								break;
							case 'Sunday':
								$nombre_dia="Domingo";
								break;
							default:
								# code...
								break;
						}

					    echo "
							      <div style='float: center' class='col-md'>
							      <br>
							      <table align='center' >
						<tr>
						<td style='width: 250px;vertical-align: middle;'><form  action='pagina_crear_tarea.php' method='post'><input type='submit'class='btn btn-primary' value='Crear Tarea' style='width:240px; height:50px;color: white;font-size:14pt;border: 3px solid black;font-weight: bold'/></form> </td>
						
						</tr>
						</table>";
						$concatenacion_usuario_responsable= ""; //string
						$consulta_asignacion = mysqli_query($conexion_db,"select usuario.nombre usuario_responsable, tarea.nombre nombre_tarea from usuario, asignacion,tarea where usuario.id_usuario = asignacion.id_usuario and tarea.id_tarea = ".$id_tarea." and tarea.id_tarea = asignacion.id_tarea;");
						while ($row=mysqli_fetch_array($consulta_asignacion))
							    	{
							    		$usuario_responsable=$row['usuario_responsable'];
							    		
							    		$concatenacion_usuario_responsable=$concatenacion_usuario_responsable . $usuario_responsable . ",";
							    	}
						 $consulta_tarea = mysqli_query($conexion_db,"select tarea.id_tarea,usuario.nombre nombre_usuario, tarea.nombre nombre_tarea, descripcion, estatus, fecha_limite, fecha_creacion, estatus, observaciones, prioridad from tarea, usuario where id_tarea = ".$id_tarea." and usuario.id_usuario = tarea.id_usuario;");
							    $contador_tareas=0;
							    while ($row=mysqli_fetch_array($consulta_tarea))
							    	{
							    		$nombre_tarea=$row['nombre_tarea'];
							    		$descripcion_tarea=$row['descripcion'];
							    		$estatus_tarea=$row['estatus'];
							    		$fecha_creacion_tarea=date("d/m/Y", strtotime($row['fecha_creacion']));
							    		$fecha_limite_tarea=$row[]=date("d/m/Y", strtotime($row['fecha_limite']));
							    		$prioridad_tarea=$row['prioridad'];
							    		$observaciones_tarea=$row['observaciones'];
							    		$nombre_usuario=$row['nombre_usuario'];
							    		$contador_tareas=$contador_tareas+1;
							    		 echo "	
								 <br><br><font face='Eras Bold ITC'> <h4 style='text-align: center;font-family:Verdana; font-size: 40px'>Tarea: $nombre_tarea </h4></font>
							            <div class='table-responsive'>
							        	<table border=5 align='center' style='width: 900px'>	
							        	<tr>
							        	<td  align=center style='width: 200px;font-size: 17pt;color: black;font-weight: bold;border: 2px solid black;background-color: white'><font color= black> Descripcion </font> </td>
							        	
							    	<td vertical-align='middle' align=center  style='width: 50px;font-size: 18pt;color: black;border: 2px solid black'> $descripcion_tarea </td>
							    	</tr>
							    	<tr>
							        	<td  align=center style='width: 150px;font-size: 17pt;color: black;font-weight: bold;border: 2px solid black;background-color: white'><font color= black> Estatus </font> </td>
							    	<td vertical-align='middle' align=center  style='width: 50px;font-size: 18pt;color: white;border: 2px solid black;black;background-color: green'> $estatus_tarea </td>
							    	</tr>
							    	<tr>
							        	<td  align=center style='width: 200px;font-size: 17pt;color: black;font-weight: bold;border: 2px solid black;background-color: white'><font color= black> Fecha Límite </font> </td>
							    	<td vertical-align='middle' align=center  style='width: 50px;font-size: 18pt;color: blue;border: 2px solid black'> $fecha_limite_tarea </td>
							    	</tr>
							    	<tr>
							        	<td  align=center style='width: 150px;font-size: 17pt;color: black;font-weight: bold;border: 2px solid black;background-color: white'><font color= black> Creado por </font> </td>
							    	<td vertical-align='middle' align=center  style='width: 50px;font-size: 18pt;color: black;border: 2px solid black'> $nombre_usuario </td>
							    	</tr>
							    	<tr>
							        	<td  align=center style='width: 150px;font-size: 17pt;color: black;font-weight: bold;border: 2px solid black;background-color: white'><font color= black> Fecha creación </font> </td>
							    	<td vertical-align='middle' align=center  style='width: 50px;font-size: 18pt;color: black;border: 2px solid black'> $fecha_creacion_tarea </td>
							    	</tr>
							    	<tr>
							        	<td  align=center style='width: 150px;font-size: 17pt;color: black;font-weight: bold;border: 2px solid black;background-color: white'><font color= black> Usuarios Responsables </font> </td>
							    	<td vertical-align='middle' align=center  style='width: 50px;font-size: 18pt;color: purple;border: 2px solid black'> $concatenacion_usuario_responsable </td>
							    	</tr>
							    	<tr>
							        	<td  align=center style='width: 150px;font-size: 17pt;color: black;font-weight: bold;border: 2px solid black;background-color: white'><font color= black> Prioridad </font> </td>
							    	<td vertical-align='middle' align=center  style='width: 50px;font-size: 18pt;color: RED;border: 2px solid black'> $prioridad_tarea</td>
							    	</tr>
							    	<tr>
							        	<td  align=center style='width: 150px;font-size: 17pt;color: black;font-weight: bold;border: 2px solid black;background-color: white'><font color= black> Observaciones </font> </td>
							    	<td vertical-align='middle' align=center  style='width: 50px;font-size: 18pt;color: black;border: 2px solid '> $observaciones_tarea </td>
							    	</tr>
							    	</table>
							    	</div> 
							    	<br>
							    	<br>
							    	<br>
							    	<table align='center' style='width: 800px'>
						<tr>
						
						<td style='width: 250px;vertical-align: middle;'><form  action='actualizar_tarea.php' method='post'><input  class='btn btn-succes' type='hidden' name='id_tarea' value='".$id_tarea."' /><input type='submit'class='btn btn-primary' value='COMPLETAR TAREA' style='width:240px; height:50px;color: white;font-size:14pt;border: 3px solid black;font-weight: bold;black;background-color: green'/></form> </td>
						</tr>
						</table>	    	";
							    	}
							    	
								
							 /*
							    if ($reunion_activado==0 && mysqli_num_rows($consulta_horario)==null ) {
								echo "<font face='Eras Bold ITC'> <h4 style='text-align: center;font-family:Verdana; font-size: 30px;color: red'>No Hay Reuniones Hoy :v</h4></font>";
							    }
							    
							    $consulta_reuion= mysqli_query($link,"select * from reunion where id_estudiante=1");
							    */
							    
		?>

								
					       	<a href="pagina_tareas_pendientes.php"><input class="main-button icon-button pull-right" type="submit" name="boton" value="REGRESAR"></a>    
					</div>
					</div>	
					</div>
					<!-- /aside blog -->

				</div>
				<!-- row -->

			</div>
			<!-- container -->

		</div>

		<hr width=100%  align="center"  size='100' color='#FF0000'>
		<!--<script type="text/javascript">
		function myFunction() {
		  // Declare variables 
		  var input, filter, table, tr, td, i, j, visible,fila;
		  input = document.getElementById("myInput");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("myTable");
		  tr = table.getElementsByTagName("tr");

		  // Loop through all table rows, and hide those who don't match the search query
		  for (i = 0; i < tr.length; i++) {
		    visible = false;
		    /* Obtenemos todas las celdas de la fila, no sólo la primera */
		    td = tr[i].getElementsByTagName("td");
		    for (j = 0; j < td.length; j++) {
		      if (td[j] && td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
		        visible = true;
		      }
		    }
		    if (visible === true) {
		      tr[i].style.display = "";

		    } else {
		      tr[i].style.display = "none";

		    }
		  }

		}
		</script>-->
		<!-- /Blog -->
		     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
		     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />

		<!-- Footer -->
		<footer id="footer" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- footer logo -->
					<div class="col-md-6">
						<div class="footer-lgo">
							
						</div>
					</div>
					<!-- footer logo -->

					<!-- footer nav -->
					<div class="col-md-6">
						<ul class="footer-nav">
							<li><a href="index.php">Home</a></li>
						<li><a href="lista-reuniones.php">Reuniones</a></li>
						<li><a href="lista-estudiantes.php">Estudiantes</a></li>
						<!--<li><a href="blog-post.php">Pagos</a></li>
						<li><a href="blog.php">Perfil</a></li>
						<li><a href="contact.php">Clases</a></li>-->
						</ul>
					</div>
					<!-- /footer nav -->

				</div>
				<!-- /row -->

				<!-- row -->
				<div id="bottom-footer" class="row">

					<!-- social -->
					<div class="col-md-4 col-md-push-8">
						<ul class="footer-social">
							<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
							<li><a href="#" class="youtube"><i class="fa fa-youtube"></i></a></li>
							<li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>
					<!-- /social -->

					<!-- copyright -->
					<div class="col-md-8 col-md-pull-4">
						<div class="footer-copyright">
							<span>&copy; Copyright 2021. All Rights Reserved. |  Este sistema fue creado <i class="fa fa-instagram" aria-hidden="true"></i> Por <a href="https://colorlib.com">Brandon Valle</a></span>
						</div>
					</div>
					<!-- /copyright -->

				</div>
				<!-- row -->

			</div>
			<!-- /container -->

		</footer>
		<!-- /Footer -->

		<!-- preloader -->
		<div id='preloader'><div class='preloader'></div></div>
		<!-- /preloader -->

		<!-- jQuery Plugins -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
		<script  src="alerts/dist/sweetalert2.all.min.js"></script>
		<script  src="scripts/alertas.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />
	</body>
</html>
