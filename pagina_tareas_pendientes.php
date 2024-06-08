<!DOCTYPE html>
<html lang="en">
  
	<head>
	      <?php
					
						session_start();
						$_SESSION['id_usuario']=1;
						if (!isset($_SESSION['id_usuario'])) {
    echo "El usuario no ha iniciado sesión.". $_SESSION['usuario'];
} else {
    echo "Usuario: " . $_SESSION['id_usuario'];
}
		echo "				
		<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0' />
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		 <script src='script.js'></script>
		<title>TAREAS</title>

		<!-- Google font -->
		<link href='https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600' rel='stylesheet'>

		<!-- Bootstrap -->
		<link type='text/css' rel='stylesheet' href='boostrap-sitio/css/bootstrap.min.css'/>

		<!-- Font Awesome Icon -->
		<link rel='stylesheet' href='boostrap-sitio/css/font-awesome.min.css'>

		<!-- Custom stlylesheet -->
		<link type='text/css' rel='stylesheet' href='boostrap-sitio/css/style.css'/>
		<!-- ESTILOS ALERT SWEET  -->
		<link rel='stylesheet'  href='alerts/dist/sweetalert2.min.css'>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src='https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'></script>
		  <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
		<![endif]-->

    </head>
	<body>

		<!-- Header -->
		<header id='header'>
			<div class='container'>
				<div  class='navbar-header'>
					<!-- Logo -->
					<div  class='navbar-brand'>
						
					</div>
					<!-- /Logo -->
					<!-- Mobile toggle -->
					<button class='navbar-toggle'>
						<span></span>
					</button>
					<!-- /Mobile toggle -->
				</div>

				<!-- Navigation -->
				<nav id='nav'>
					<ul class='main-menu nav navbar-nav navbar-right '>
						<li><a href='pagina_tareas_pendientes.php'>tareas</a></li>
						<li><a href='pagina_consulta_usuario.php'>Usuario</a></li>
						";
							
						
						include("datos_conexion.php");
						   $conexion_db =  mysqli_connect($db_host, $db_usr,$db_pass,$db_nombre);

						if (!$conexion_db) {
							die('No se ha podido conectar a la base de datos');
						}
						 $consulta_pendientes_fecha= mysqli_query($conexion_db,"select usuario.nombre nombre_usuario, tarea.nombre nombre, tarea.fecha_limite fecha_limite from tarea, usuario where usuario.id_usuario= tarea.id_usuario and tarea.estatus = 'En progreso' and tarea.id_usuario=".$_SESSION['id_usuario'].";");
							    if ((mysqli_num_rows($consulta_pendientes_fecha) == 0)) {
							    	echo "<li><a href='pagina_notificaciones.php'>Notificaciones  </a></li>";
							    }
							    else{
							    	echo "<li><a href='pagina_notificaciones.php'>Notificaciones <img class='icon' width='20' height='20' src='img/signo.png' /> </a></li>";
							    }


							   
						
						echo "
						
						<!--<li><a href='blog-post.php'>Pagos</a></li>
						<li><a href='blog.php'>Perfil</a></li>
						<li><a href='contact.php'>Clases</a></li>-->
					</ul>
				</nav>
				<!-- /Navigation -->

			</div>
		</header>
		<!-- /Header -->
		<!-- Hero-area -->
		<div class='hero-area section'>
			<!-- Backgound Image -->
			<div class='bg-image bg-parallax overlay' style='background-image:url(./img/page-background.jpg);border: 4px solid black'></div>
			<!-- /Backgound Image -->
			<div class='container'>
				<div class='row'>
					<div class='col-md-10 col-md-offset-1 text-center'>
						<ul class='hero-area-tree'>
							<li><a href='index.php'>Home</a></li>
							<li>TAREAS</li>
						</ul>
						<h1 class='white-text'>TAREAS</h1>
					</div>
				</div>
			</div>
		</div>	

						<br>
						";
							      //<!-- /contact form -->
						//echo $_GET['variable1'];
						//$variable1=0;
						
						$id_reunion=0;
						date_default_timezone_set("America/Guatemala");
						$fecha_hoy=date("d-m-Y");
						$fecha_global=$fecha_hoy;
						$contador=1;
						$contador_menos=-1;
						if (isset($_GET['fecha'])) {
							$fecha_global=$_GET['fecha'];
						}
						else
						{
							if (isset($_POST['fecha'])) {
							$fecha_global=$_POST['fecha'];
							}
						}
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
						}
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
							      <table align='center' style='width: 800px'>
						<tr>
						<td style='width: 250px;vertical-align: middle;'><form  action='pagina_crear_tarea.php' method='post'><input type='submit'class='btn btn-primary' value='Crear Tarea' style='width:240px; height:50px;color: white;font-size:14pt;border: 3px solid black;font-weight: bold'/></form> </td>
						<td><form  action='pagina_tareas_totales.php' method='post' style='float: right'><input type='submit' value='Todas Las Tareas' style='width:250px; height:50px;color: white;float: center;font-size:14pt; background-color: #FF6B4C;border: 3px solid black;font-weight: bold'/></form> </td>
						<td><form  action='pagina_tareas_completadas.php' method='post' style='float: right'><input type='submit' value='Tareas Completadas' style='width:230px; height:50px;color: white;float: center;font-size:14pt; background-color: #FF6B4C;border: 3px solid black;font-weight: bold'/></form> </td>


						</tr>
						</table>
						<center><FONT SIZE='8' COLOR='black' face='comic sans'><u>Bienvenido  ".$_SESSION['nombre']."</u></FONT></center>
								<br><font face='Eras Bold ITC'> <h4 style='text-align: center;font-family:Verdana; font-size: 40px'>Tareas En Progreso</h4></font>

										<div class='row'>
										   <div class='col-md-12'>
										   	<div class='post-pagination'>
										   		<a href='pagina_tareas_pendientes.php?contador=-1&f=$fecha_global' class='pagination-back pull-left'>Día Anterior</a>
										   		<ul class='pages' >
										   			<li class='active' align='center' style='height: 50px;width:60px;font-size: 16pt'><a href='pagina_tareas_pendientes.php?fecha=$fecha_hoy'>Hoy</a></li>
										   		</ul>
										   		<a href='pagina_tareas_pendientes.php?contador=1&f=$fecha_global' class='pagination-next pull-right'>Día Siguiente</a>
										   	</div>
										   </div>
										   </div>
										   <br><table border=0 align=right><tr><td><p align='right' style='font-size: 14pt;color: black'><b>Calendario:&nbsp;&nbsp;</b></td><td><form action='pagina_tareas_pendientes.php' method='post'><input style='text-align: center; color:black; border: 2px solid; width: 230px;font-weight: bold;font-size:14pt' name='fecha' type='date' value='".$fecha_conversion."'>&nbsp;&nbsp;<input type='submit' value='Ver'></form></p></td></tr></table>
								<table>
								<tr>
								<td style='font-size: 14pt;color: black'  ><b>Dia: &nbsp;</b></td>
								<td>
							    <input style='text-align: center; color:black; border: 2px solid; width: 150px;font-weight: bold;font-size: 14pt;' type='text' value='".$nombre_dia."'>&nbsp;&nbsp;&nbsp;
							    </td>
								<td style='font-size: 14pt;color: black'  ><b>Fecha: &nbsp;</b></td>
								<td>
							    <input style='text-align: center; color:black; border: 2px solid; width: 150px;font-weight: bold;font-size: 14pt;' type='text' value='".$fecha_global."'>
							    </td>
							    </tr>
							    </table>
							    <br><br><br>
							    
							    ";
							    if ((mysqli_num_rows($consulta_pendientes_fecha) == 0)) {
							    	 echo "<font face='Eras Bold ITC'> <h2 style='text-align: center;font-family:Verdana; font-size: 25px;color:red;'>NO HAY TAREAS PENDIENTES HOY<br></h2></font>";
							    }
							   
							    $usuario_existente_responsable=false;
							    $consulta= mysqli_query($conexion_db,"select id_tarea,nombre, descripcion, estatus, fecha_limite, fecha_creacion,  estatus, observaciones, prioridad from tarea where estatus = 'en progreso' and fecha_limite ='".$fecha_conversion."';");
							    $contador_tareas=0;
							    while ($row=mysqli_fetch_array($consulta))
							    	{
							    		$usuario_existente_responsable=false;
							    		$id_tarea=$row['id_tarea'];
							    		$nombre_tarea=$row['nombre'];
							    		$descripcion_tarea=$row['descripcion'];
							    		$estatus_tarea=$row['estatus'];
							    		$fecha_creacion_tarea=$row['fecha_creacion'];
							    		$fecha_limite_tarea=$row['fecha_limite'];
							    		$fecha_objeto = date_create($fecha_limite_tarea);
							    		$fecha_limite_tarea=date_format($fecha_objeto, "d-m-Y");
							    		$prioridad_tarea=$row['prioridad'];
							    		$observaciones_tarea=$row['observaciones'];
							    		$contador_tareas=$contador_tareas+1;
							    		$concatenacion_usuario_responsable= ""; //string
							    		$consulta_asignacion = mysqli_query($conexion_db,"select usuario.nombre usuario_responsable, tarea.nombre nombre_tarea from usuario, asignacion,tarea where usuario.id_usuario = asignacion.id_usuario and tarea.id_tarea = ".$id_tarea." and tarea.id_tarea = asignacion.id_tarea;");
							    		while ($row=mysqli_fetch_array($consulta_asignacion))
							    			    	{

							    			    		$usuario_responsable=$row['usuario_responsable'];

							    			    		$concatenacion_usuario_responsable=$concatenacion_usuario_responsable . $usuario_responsable . ",";
							    			    		if ($usuario_responsable == $_SESSION['nombre'])
							    			    		{
							    			    			$usuario_existente_responsable=true;
							    			    		}
							    			    	}
							    		if ($usuario_existente_responsable == true)
							    		{

							    		 echo "	
							    		}
							            <div class='table-responsive'>
							        	<table border=5 align='center' style='width: 1200px'>	
							        	<tr>
							        	<td  align=center style='width: 50px;font-size: 17pt;color: black;font-weight: bold;border: 2px solid black;background-color: white'><font color= black> No. </font> </td>
							        	<td  align=center style='width: 250px;font-size: 17pt;color: black;font-weight: bold;border: 2px solid black;background-color: white'><font color= black> Nombre Tarea </font> </td>
							        	<td  align=center style='width: 350px;font-size: 17pt;color: black;font-weight: bold;border: 2px solid black;background-color: white'><font color= black> Descripcion </font> </td>
							        	<td  align=center style='width: 150px;font-size: 17pt;color: black;font-weight: bold;border: 2px solid black;background-color: white'><font color= black> Estatus </font> </td>
							        	<td  align=center style='width: 200px;font-size: 17pt;color: black;font-weight: bold;border: 2px solid black;background-color: white'><font color= black> Fecha Límite </font> </td>
							        	<td  align=center style='width: 200px;font-size: 17pt;color: black;font-weight: bold;border: 2px solid black;background-color: white'><font color= black> Responsables </font> </td>
							        	<td rowspan=2 style='width: 135px' align=center><form  action='pagina_consulta_tarea.php' method='post'style='float: center'><input  class='btn btn-succes' type='hidden' name='id_tarea' value='".$id_tarea."' /><input type='submit'  value='VER' class='btn btn-success' style='width:105px; height:40px;color:black;font-size:14pt;border: 2px solid black;font-weight: bold;'/></form></td>
									</tr>
							    	<tr>
							    	<td  vertical-align='middle' align=center  style='font-size: 18pt;color: red;font-weight: bold;border: 2px solid black'>$contador_tareas</td>
							    	<td  align=center style='width: 50px;font-size: 17pt;color: blue;border: 2px solid black;background-color: white'><font color= blue> $nombre_tarea </font> </td>
							    	<td vertical-align='middle' align=center  style='width: 50px;font-size: 18pt;color: black;border: 2px solid black'> $descripcion_tarea </td>
							    	<td vertical-align='middle' align=center  style='width: 50px;font-size: 18pt;color: RED;border: 2px solid black'> $estatus_tarea </td>
							    	<td vertical-align='middle' align=center  style='width: 50px;font-size: 18pt;color: blue;border: 2px solid black'> $fecha_limite_tarea </td>
							    	<td vertical-align='middle' align=center  style='width: 50px;font-size: 18pt;color: blue;border: 2px solid black'> $concatenacion_usuario_responsable </td>
							    	</tr>
							    	</table>
							    	</div> 
							    	<br>
							    	<br>
							    	<br>
							    	";
							    	}	    
							    	}
							    
					
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

		<hr width=100%  align="center"  size='100' color='#FF0000'>
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

					

				</div>
				<!-- /row -->

				<!-- row -->
				<div id="bottom-footer" class="row">

					
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
