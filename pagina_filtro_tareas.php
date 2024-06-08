<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		 <script src="script.js"></script>
		<title>REUNIONES</title>

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
						<a   href="index.html">
							<img align="pull-left" src="./img/logo-español2.jpg" alt="logo" width="270" height="53">
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
						<li><a href="index.php">Home</a></li>
						<li><a href="lista-reuniones.php">Reuniones</a></li>
						<li><a href="lista-estudiantes.php">Estudiantes</a></li>
						<!--<li><a href="blog-post.php">Pagos</a></li>
						<li><a href="blog.php">Perfil</a></li>
						<li><a href="contact.php">Clases</a></li>-->
					</ul>
				</nav>
				<!-- /Navigation -->

			</div>
		</header>
		<!-- /Header -->
		<!-- Hero-area -->
		<div class="hero-area section">
			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg);border: 2px solid black"></div>
			<!-- /Backgound Image -->
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="index.html">Home</a></li>
							<li>REUNIONES</li>
						</ul>
						<h1 class="white-text">REUNIONES</h1>
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
						date_default_timezone_set("America/Guatemala");
						$fecha_inicio="";
						$fecha_fin="";
						if (isset($_POST['id_estudiante'])) {
							$id_estudiante	 = $_POST['id_estudiante'];
						}
						$id_estudiante=1;
						$consulta_filtrado="reunion.id_estudiante=$id_estudiante and reunion.id_estudiante=estudiantes.id_estudiante";
						if (isset($_POST['fecha_inicio']) && isset($_POST['fecha_fin'])) {
							$fecha_inicio = $_POST['fecha_inicio'];
							$fecha_fin= $_POST['fecha_fin'];
							$fecha_fin=date("Y-m-d",strtotime($fecha_fin."+1 days"));
							$consulta_filtrado="reunion.id_estudiante=$id_estudiante and reunion.id_estudiante=estudiantes.id_estudiante and fecha_reunion BETWEEN '".$fecha_inicio."' and '".$fecha_fin."'";
							$fecha_fin= $_POST['fecha_fin'];
						}

						if (isset($_POST['todos'])) {
							$consulta_filtrado="reunion.id_estudiante=$id_estudiante and reunion.id_estudiante=estudiantes.id_estudiante";
						}

						if (isset($_POST['semana_anterior'])) {
						 $week_start = strtotime('Monday last week',time());
						 $fecha_inicio=date('Y-m-d', $week_start);
						 $week_end = strtotime('Sunday last week', time());
						 $fecha_fin=date('Y-m-d', $week_end);
						 $fecha_fin=date("Y-m-d",strtotime($fecha_fin."+1 days"));

						 $consulta_filtrado="reunion.id_estudiante=$id_estudiante and reunion.id_estudiante=estudiantes.id_estudiante and fecha_reunion BETWEEN '".$fecha_inicio."' and '".$fecha_fin."'";
						 $fecha_fin=date('Y-m-d', $week_end);
						}
						if (isset($_POST['semana_actual'])) {
						if (date("D")=="Mon"){
						     $week_start = date("Y-m-d");
						 } else {
						     $week_start = strtotime('last Monday',time());
						 }
						 $fecha_inicio=date('Y-m-d', $week_start);
						 $week_end = strtotime('next Sunday', time());
						 $fecha_fin=date('Y-m-d', $week_end);
						 $fecha_fin=date("Y-m-d",strtotime($fecha_fin."+1 days"));
							$consulta_filtrado="reunion.id_estudiante=$id_estudiante and reunion.id_estudiante=estudiantes.id_estudiante and fecha_reunion BETWEEN '".$fecha_inicio."' and '".$fecha_fin."'";
						$fecha_fin=date('Y-m-d', $week_end);
						}
						if (isset($_POST['mes'])) {
							$fecha_inicio=date("Y-m-01");
							$fecha_fin=date("Y-m-t");
							$fecha_fin=date("Y-m-d",strtotime($fecha_fin."+1 days"));
							$consulta_filtrado="reunion.id_estudiante=$id_estudiante and reunion.id_estudiante=estudiantes.id_estudiante and fecha_reunion BETWEEN '".$fecha_inicio."' and '".$fecha_fin."'";
							$fecha_fin=date("Y-m-t");
						}
						
						//$consulta=mysqli_connect($conexion_db);
						$consulta_estudiante=mysqli_query($conexion_db,"select nombre, descripcion, estatus, fecha_limite, fecha_creacion,  estatus, observaciones, prioridad from tarea;");
						$aux=0;
						$contador=0;
						date_default_timezone_set("America/Guatemala");
						while ($row=mysqli_fetch_array($consulta_estudiante))
						{
							$nombres=$row['nombres'];
							$pais=$row['pais'];
						}
						echo "
						<br>
						<div style='float: center' class='col-md'>
						<br>
						<table align='center' >
						<tr>
						<td style='width: 340px;vertical-align: middle;'><form  action='crear-reunion-horario.php' method='post' style='float: left'><input class='btn btn-primary' type='submit' value='Crear Reunión Para ".$nombres."' style='width:330px; height:50px;color: white;float: left;font-size:14pt; border: 3px solid black;font-weight: bold'/><input  class='btn btn-succes' type='hidden' name='id_estudiante' value='".$id_estudiante."' /><input  class='btn btn-primary' type='hidden' name='nombre_estudiante' value='".$nombres."' /></form> </td>
						<td style='width: 250px;vertical-align: middle;'><form  action='lista-completa-reuniones.php' method='post'><input type='submit'class='btn btn-primary' value='Lista De Reuniones' style='width:240px; height:50px;color: white;font-size:14pt;border: 3px solid black;font-weight: bold;background-color: #7d9bc0'/></form> </td>
						<td><form  action='crear-reunion-rapida.php' method='post' style='float: right'><input type='submit' value='Reunión Rápida' style='width:230px; height:50px;color: white;float: center;font-size:14pt; background-color: #6fa088;border: 3px solid black;font-weight: bold'/></form> </td>
						<td style='width: 220px;vertical-align: middle;'><form  action='perfil-estudiante.php' method='post' style='float: right'><input type='submit' value='Perfil' style='width:210px; height:50px;color: white;float: center;font-size:14pt; background-color: #4a9463;border: 3px solid black;font-weight: bold'/><input  class='btn btn-succes' type='hidden' name='id_entregar' value='".$id_estudiante."' /></form> </td>	
						</tr>
						</table><br>
						<font face='Eras Bold ITC'> <h4 style='text-align: center;font-family:Verdana; font-size: 25px'>Filtrado De Reuniones</h4></font><br>
						<table align=center><tr>
						<td style='width: 110px;vertical-align: middle;'><form  action='consulta-reunion-estudiantes.php' method='post' style='float: right'><input type='submit' value='todos' style='width:100px; height:50px;color: white;float: center;font-size:14pt; background-color: #00c18c;border: 3px solid black;font-weight: bold'/><input  class='btn btn-succes' type='hidden' name='id_estudiante' value='".$id_estudiante."' /><input  class='btn btn-succes' type='hidden' name='todos' value='todos' /></form> </td>
						<td style='width: 160px;vertical-align: middle;'><form  action='consulta-reunion-estudiantes.php' method='post' style='float: right'><input type='submit' value='Esta Semana' style='width:150px; height:50px;color: white;float: center;font-size:14pt; background-color: #00c18c;border: 3px solid black;font-weight: bold'/><input  class='btn btn-succes' type='hidden' name='semana_actual' value='semana_actual' /><input  class='btn btn-succes' type='hidden' name='id_estudiante' value='".$id_estudiante."' /></form> </td>
						<td style='width: 180px;vertical-align: middle;'><form  action='consulta-reunion-estudiantes.php' method='post' style='float: right'><input type='submit' value='Semana Pasada' style='width:170px; height:50px;color: white;float: center;font-size:14pt; background-color: #00c18c;border: 3px solid black;font-weight: bold'/><input  class='btn btn-succes' type='hidden' name='semana_anterior' value='semana_anterior' /><input  class='btn btn-succes' type='hidden' name='id_estudiante' value='".$id_estudiante."' /></form> </td>
						<td style='width: 125px;vertical-align: middle;'><form  action='consulta-reunion-estudiantes.php' method='post' style='float: right'><input type='submit' value='Este Mes' style='width:115px; height:50px;color: white;float: center;font-size:14pt; background-color: #00c18c;border: 3px solid black;font-weight: bold'/><input  class='btn btn-succes' type='hidden' name='mes' value='mes' /><input  class='btn btn-succes' type='hidden' name='id_estudiante' value='".$id_estudiante."' /></form> </td>
						</tr>
						</table>
						<br>
						<!--<img width='130' style='float:center;border: 3px solid black' alt='Bandera de ".$pais."' height='80'src='banderas/".$pais.".jpg'>-->
						<br><font face='Eras Bold ITC'> <h4 style='text-align: center;font-family:Verdana; font-size: 40px'>LISTADO DE REUNIONES  </h4></font>
						<font face='Eras Bold ITC'> <h4 style='text-align: center;font-family:Verdana; font-size: 40px'>$nombres </h4></font>
			<form  action='' method='post' style='float: right'><input type='button' value='Exportar' style='width:150px; height:50px;color: white;float: center;font-size:14pt; background-color: #4a9463;border: 3px solid black;font-weight: bold'/><input  class='btn btn-succes' type='hidden' name='id_entregar' value='".$id_estudiante."' /></form>
			<table border=0>
			<tr>
			<td colspan=3 style='width: 250px;height: 80px;vertical-align: middle;text-align: center;font-size: 14pt;font-weight: bold;color: black;'><form action='consulta-reunion-estudiantes.php' method='post'>Fecha Comienzo:  <input type='date' name='fecha_inicio' value='".$fecha_inicio."' style='border: 2px solid black;font-size: 13pt;color: black;font-weight: bold;width: 205px'></td>
			<td colspan=3 style='width: 200px;height: 70px;vertical-align: middle;text-align: center;font-size: 14pt;font-weight: bold;color: black;'>Fecha Fin: <input type='date' name='fecha_fin' value='".$fecha_fin."' style='border: 2px solid black;font-size: 13pt;color: black;font-weight: bold;width: 205px'> </td>
			<td colspan=3 style='width: 80px;text-align: center;font-size: 14pt;font-weight: bold;color: black;'><input  class='btn btn-succes' type='hidden' name='id_estudiante' value='".$id_estudiante."' /><input type='submit' value='Ver'></form> </td>
			</tr>
			</table>";

			$consulta_reuniones= mysqli_query($link,"select id_reunion,tema,fecha_creacion,fecha_reunion,id_zoom,codigo_reunion,pass,duracion,reunion.observaciones,join_url,estudiantes.id_estudiante,nombres,pais,nivel,diferencia_horario,estatus from estudiantes,reunion where $consulta_filtrado and tema!='prueba' order by fecha_reunion DESC;");
			echo "
			<br>

						<div class='table-responsive'>
						<table class='table table-hover table-bordered' border=2	align=center>
						<thead style='text-align:center;background-color: #58D68D ;border: 3px black solid' >
						<th style='text-align: center;font-size: 16pt;color: black'>No. Clase</th>
						<th style='text-align: center;font-size: 16pt;color: black;vertical-align: middle;border: 3px black solid'>Tema</th>
						<th  style=' text-align: center;font-size: 16pt;color: black;vertical-align: middle;border: 3px black solid'>Fecha Reunión</th>
						<th style='text-align: center;font-size: 16pt;color: black;vertical-align: middle;border: 3px black solid'>Hora Local</th>
						<th style='text-align: center;font-size: 16pt;color: black;vertical-align: middle;border: 3px black solid'>Hora País</th>
						<!--<th style='text-align: center;font-size: 16pt;color: black;vertical-align: middle;border: 3px black solid'>País</th>
						<th style='text-align: center;font-size: 16pt;color: black;vertical-align: middle;border: 3px black solid'>Nombre</th>-->
						<th style='text-align: center;font-size: 16pt;color: black;vertical-align: middle;border: 3px black solid'>Nivel</th>
						<th style='text-align: center;font-size: 16pt;color: black;vertical-align: middle;border: 3px black solid'>ID ZOOM</th>
						<!--<th style='text-align: center;font-size: 16pt;color: black;vertical-align: middle;border: 3px black solid'>Contraseña</th>-->
						<th style='text-align: center;font-size: 14pt;color: black;vertical-align: middle;border: 3px black solid'>Duración</th>
						<!--<th style='text-align: center;font-size: 16pt;color: black;vertical-align: middle;border: 3px black solid'>Fecha de Creación</th>-->
						<th style='text-align: center;font-size: 14pt;color: black;vertical-align: middle;border: 3px black solid;width:200px'>Estado</th>
						<th style='text-align: center;font-size: 14pt;color: black;vertical-align: middle;border: 3px black solid;width:300px'>Observaciones</th>
						</thead>
						<tbody >";
						while ($row=mysqli_fetch_array($consulta_reuniones))
						{
							$contador++;
							$id_reunion=$row['id_reunion'];
							$tema=$row['tema'];
							$fecha_reunion=$row['fecha_reunion'];
							$fecha_creacion=$row['fecha_creacion'];
							$id_zoom=$row['id_zoom'];
							$pass=$row['pass'];
							$duracion=$row['duracion'];
							$observaciones=$row['observaciones'];
							$diferencia_horario=$row['diferencia_horario'];
							$join_url=$row['join_url'];
							$id_estudiante=$row['id_estudiante'];
							$nombres=$row['nombres'];
							$pais=$row['pais'];
							$nivel=$row['nivel'];
							$estatus=$row['estatus'];
							$fecha_objeto = date_create($fecha_reunion);
							$fecha_objeto2 = date_create($fecha_creacion);
							$fecha_reunion=date_format($fecha_objeto, "d-m-Y");
							$fecha_creacion=date_format($fecha_objeto2, "d-m-Y");
							$hora_reunion=date_format($fecha_objeto, "H:i");
							$hora_pais="-";
					        if ($diferencia_horario!=0 && $diferencia_horario>0) {
					            $sumar_hora=date("H:i",strtotime($hora_reunion."+".$diferencia_horario." hour"));
					            $hora_pais=$sumar_hora." ".$pais."";
					        }
					        else if($diferencia_horario!=0 && $diferencia_horario<0)
					        {
					            $restar_hora=date("H:i",strtotime($hora_reunion.$diferencia_horario." hour"));
					            $hora_pais=$restar_hora." ".$pais."";
					        }		
							echo "<tr>
								<td style='font-size: 15pt;color:red;font-weight: bold;text-align: center;vertical-align: middle;border: 2px black solid;background-color: #D4EFDF'><form  method='post' action='consulta-reunion.php'><input  type='hidden' name='id_reunion' value='".$id_reunion."'><input  type='hidden' name='id_estudiante' value='".$id_estudiante."'><center><input align='center' class='form-control' type='submit' name='nombre' value='".$contador."' style='width:100px; height:40px; color: red; background-color:transparent; border: 5px;font-size:17pt; margin: 0 auto;float: center'/></form></td>
								<td style='font-size: 14pt;color:black;font-weight: bold;text-align: center;vertical-align: middle;border: 2px black solid;background-color: #ABEBC6'>$tema</td>
								<td style='font-size: 13pt;color:black;font-weight: bold;text-align: center;vertical-align: middle;border: 2px black solid;background-color: #ABEBC6'>$fecha_reunion</td>
								<td style='font-size: 14pt;color:black;font-weight: bold;text-align: center;vertical-align: middle;border: 2px black solid;background-color: #ABEBC6'>$hora_reunion Guatemala</td>
								<td style='font-size: 14pt;color:black;font-weight: bold;text-align: center;vertical-align: middle;border: 2px black solid;background-color: #ABEBC6'>$hora_pais</td>
								<!--<td style='font-size: 0pt;color:black;font-weight: bold;text-align: center;vertical-align: middle;border: 2px black solid;background-color: #ABEBC6'><img width='70' style='float:center;' alt='Bandera de ".$pais."' height='40'src='banderas/".$pais.".jpg'></td>
								<td style='font-size: 15pt;color:black;font-weight: bold;text-align: center;vertical-align: middle;border: 2px black solid;background-color: #ABEBC6'>$nombres</td>-->
								<td style='font-size: 14pt;color:black;font-weight: bold;text-align: center;vertical-align: middle;border: 2px black solid;background-color: #ABEBC6'>$nivel</td>
								<td style='font-size: 13pt;color:black;font-weight: bold;text-align: center;vertical-align: middle;border: 2px black solid;background-color: #ABEBC6'>$id_zoom</td>
							<!--	<td style='font-size: 13pt;color:black;font-weight: bold;text-align: center;vertical-align: middle;border: 2px black solid;background-color: #ABEBC6'>$pass</td>-->
								<td style='font-size: 11pt;color:black;font-weight: bold;text-align: center;vertical-align: middle;border: 2px black solid;background-color: #ABEBC6'>$duracion Min.</td>
							<!--	<td style='font-size: 13pt;color:black;font-weight: bold;text-align: center;vertical-align: middle;border: 2px black solid;background-color: #ABEBC6'>$fecha_creacion</td>-->
							";
							if ($estatus=="NO ASISTIO") {
								echo "<td style='font-size: 13pt;color:red;font-weight: bold;text-align: center;vertical-align: middle;border: 2px black solid;background-color: #ABEBC6'>$estatus</td>";
							}
							else
							{
								echo "<td style='font-size: 13pt;color:black;font-weight: bold;text-align: center;vertical-align: middle;border: 2px black solid;background-color: #ABEBC6'>$estatus</td>";
							}
							echo "
								<td style='font-size: 13pt;color:black;font-weight: bold;text-align: center;vertical-align: middle;border: 2px black solid;background-color: #ABEBC6'>$observaciones</td>
								</tr>";

						}
						?>
								
								</table>
								</div>
								<a href="lista-reuniones.php"><input class="main-button icon-button pull-right" type="submit" name="boton" value="IR A AGENDA"></a>  
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
