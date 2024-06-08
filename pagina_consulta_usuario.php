<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		 <script src="script.js"></script>
		<title>USUARIO</title>

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
						<a   href="pagina_tareas_pendientes.php">
							
						</a>
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
							<li><a href="index.html">Home</a></li>
							<li>USUARIO</li>
						</ul>
						<h1 class="white-text">Usuario</h1>

					</div>
				</div>
			</div>
		</div>
		
		
<?php 
						//$id_recibido = $_POST['id_entregar']; 
						
						session_start();
						include("datos_conexion.php");
						$conexion_db =  mysqli_connect($db_host, $db_usr,$db_pass,$db_nombre);
						if (!$conexion_db) {
							die('No se ha podido conectar a la base de datos');
						}
						$id_recibido =$_SESSION['id_usuario']; 
						$fecha_reunion="---";
						$consulta_usuario= mysqli_query($conexion_db,"SELECT id_usuario,concat(upper(left(nombre,1)),lower(substring(nombre,2))) nombre,concat(upper(left(apellido,1)),lower(substring(apellido,2))) apellido, edad, correo FROM usuario WHERE id_usuario=$id_recibido;");
						while ($row=mysqli_fetch_array($consulta_usuario))
						{
							$id_usuario=$row['id_usuario'];
							$nombre=$row['nombre'];
							$apellido=$row['apellido'];
							$edad=$row['edad'];
							$correo=$row['correo'];
						}
						date_default_timezone_set("America/Guatemala");
						$consulta_conteo_tareas= mysqli_query($conexion_db,"select COUNT(*) conteo_tareas_usuario from tarea, usuario where usuario.id_usuario= tarea.id_usuario and usuario.id_usuario=".$_SESSION['id_usuario'].";");
						while ($row=mysqli_fetch_array($consulta_conteo_tareas))
						{
							$conteo_tareas_usuario=$row['conteo_tareas_usuario'];
						}
						$consulta_tareas_completadas= mysqli_query($conexion_db,"select COUNT(*) conteo_tareas_completadas from tarea, usuario where usuario.id_usuario= tarea.id_usuario and tarea.estatus = 'COMPLETADA' and usuario.id_usuario=".$_SESSION['id_usuario'].";");
						while ($row=mysqli_fetch_array($consulta_tareas_completadas))
						{
							$conteo_tareas_completadas=$row['conteo_tareas_completadas'];
						}
						$consulta_tareas_pendientes= mysqli_query($conexion_db,"select COUNT(*) conteo_tareas_pendientes from tarea, usuario where usuario.id_usuario= tarea.id_usuario and tarea.estatus = 'EN PROGRESO' and usuario.id_usuario=".$_SESSION['id_usuario'].";");
						while ($row=mysqli_fetch_array($consulta_tareas_pendientes))
						{
							$conteo_tareas_pendientes=$row['conteo_tareas_pendientes'];
						}
						$consulta_tareas_atrasadas= mysqli_query($conexion_db,"select COUNT(*) conteo_tareas_atrasadas from tarea, usuario where usuario.id_usuario= tarea.id_usuario and tarea.estatus = 'EN PROGRESO' and usuario.id_usuario=".$_SESSION['id_usuario']." and tarea.fecha_limite > now();");
						while ($row=mysqli_fetch_array($consulta_tareas_atrasadas))
						{
							$conteo_tareas_atrasadas=$row['conteo_tareas_atrasadas'];
						}
						/*
						//$ultima_clase=$fecha_reunion;
						/*if ($diferencia_horario>=0) {
							if ($diferencia_horario==1) {
								$diferencia_horario="+$diferencia_horario Hora";
							}
							else
							{
								$diferencia_horario="+$diferencia_horario Horas";
							}
							
						}
						else
						{
							if ($diferencia_horario==-1) {
								$diferencia_horario="$diferencia_horario Hora";
							}
							else
							{
								$diferencia_horario="$diferencia_horario Horas";
							}
						}*/
						echo "
						<br>
				
						<!-- /Hero-area -->
 						<!--<h4 style='text-align: center; font-size: 30px'>Creación De Nuevo Estudiante</h4>-->
						<!-- Contact -->
						<div id='contact' class='section'>
						<!-- container -->
						<div class='container'>
						<!-- row -->
						<div class='row'>
						<!-- contact form -->
						<div class='col-md-3'>
						<div class='contact-form'>
						";
						$foto="hombre_usuario.jpg";
						$pais="";
						echo "
							<p style='text-align: center'><img width='220' style='float: center;border: black 7px solid' height='225' src='images/".$foto."'></p>;
							<br><font size=6 color=black><b><i>$pais</i></b></font></p><br><br><br>
								<div class='single-blog' >
									<div class='blog-img'>
										<a>
											<img height=200 src='./img/frase11.jpg' alt=''>
										</a>
									</div>
								<h4 style='text-align: center'><a  href='blog-post.html'>\" cada línea de código escrita es un paso hacia la solución de problemas complejos y la creación de innovadoras soluciones tecnológicas.\"</a></h4>
								<div class='single-blog' >
									<div class='blog-img'>
										<a>
											<img height=200 src='./img/frase22.jpg' alt=''>
										</a>
									</div>
								<h4 style='text-align: center'><a  href='blog-post.html'>\"sumergirse en un universo donde la lógica, la creatividad y la resolución de problemas convergen para construir el futuro digital.\"</a></h4>
							</div>
							</div>
							
							      	</div>
							      </div>";
							      //<!-- /contact form -->
					    echo "
							      <div class='col-md-9'>
							     <font face='Eras Bold ITC'> <h4 style='text-align: center;font-family:Verdana; font-size: 40px'>".$nombre." ".$apellido."<form  action='estado.php' method='post'style='float: right'>
	 									   
										   
							     <br><br>
							     <table  align='left' border='0' align='center' style='vertical-align:middle; font-family: Verdana; font-size:17pt'; >
							     	<tr >
							     	<td height='60' align='left' style='color: black'><b>Edad: </b></td><td align='left' style='vertical-align:middle;padding-left: 20px;font-size: 17pt;color: black'>$edad</td>
							     	</tr>
							     	<tr>
							     	


							     	<td height='60' align='left' style='color: black;'><b>Correo: </b></td><td align='left' style='vertical-align:middle;padding-left: 20px;font-size: 17pt;color: black'>$correo</td>
							     </tr>
							     	</tr>
							     	
							     	</tr>
							     	
							     	
							     
							     
							     	<tr>
							     	<td height='60' align='left' style='color: black'><b>No. Tareas: </b></td><td align='left' style='vertical-align:middle;padding-left: 20px;font-size: 17pt;color: black'>$conteo_tareas_usuario</td>
							     	<tr>
							     	<td height='60' align='left' style='color: black'><b>Tareas Completadas: </b></td><td align='left' style='vertical-align:middle;padding-left: 20px;font-size: 17pt;color: black'> $conteo_tareas_completadas</td>
							     </tr>
							     	<tr>
							     	<td height='60' align='left' style='color: black'><b>Tareas Pendientes: </b></td><td align='left' style='vertical-align:middle;padding-left: 20px;font-size: 17pt;color: black'>$conteo_tareas_pendientes</td>
							     </tr>
							     <tr >
							     ";
							     echo "
							     <tr>
							     	<td height='60' align='left' style='color: black'><b>Tareas Atrasadas: </b></td><td align='left' style='vertical-align:middle;padding-left: 20px;font-size: 17pt;color: black'>$conteo_tareas_atrasadas</td>
							     </tr>
							     </table>";

?>
						</div>
					</div>
		
						
					</div>
					<!-- /aside blog -->

				</div>
				<!-- row -->

			</div>
			<!-- container -->

		</div>
		<hr width=100%  align="center"  size=100 color="#FF0000">
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
							<a class="logo" href="index.html">
								<img align="pull-left" src="./img/logo-español2.jpg" alt="logo" width="275" height="80">
							</a>
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
