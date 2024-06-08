<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		 <script src="script.js"></script>
		<title>TAREA</title>

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
							<li><a href="pagina_tareas_pendientes.php">Home</a></li>
							<li>TAREA</li>
						</ul>
						<h1 class="white-text">CREAR NUEVA TAREA</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->

		<!-- Contact -->
		<div id="contact" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- contact form -->
					<div class="col-md-6">
						<div class="contact-form">
							<h4 style="">Creación De Tarea</h4>
							<?php
							session_start();
							include("datos_conexion.php");
							   $conexion_db =  mysqli_connect($db_host, $db_usr,$db_pass,$db_nombre);

							if (!$conexion_db) {
								die('No se ha podido conectar a la base de datos');
							}
							?>
							  <form id="formulario" name="formulario" action="crear_tarea.php" enctype="multipart/form-data" method="POST">
							      <label for="nombres"><b>Nombre de Tarea:</b></label>
							      <input type="text"  id="txt_nombre_tarea" name="txt_nombre_tarea"  required>
							      <label for="apellidos"><b>Descripción:</b></label>
							      <input type="text"  id="txt_descripcion_tarea" name="txt_descripcion_tarea" >
							  	  <label for="nombres"><b></b>Fecha Límite</label>
							      <input type="date"  id="txt_fecha_limite_tarea" name="txt_fecha_limite_tarea"  required><br><br>
							      
								<?php
								echo "
								<input  class='btn btn-succes' type='hidden' name='id_usuario' value='".$_SESSION['id_usuario']."' />
								 <div id='horario_fijo' >
								<label for='nombres'><b></b>Seleccione los usuarios responsables</label><br>";
								$consulta_usuarios= mysqli_query($conexion_db,"select id_usuario,nombre from usuario;");
							    $contador_tareas=0;
							    while ($row=mysqli_fetch_array($consulta_usuarios))
							    	{
							    		$nombre_usuario=$row['nombre'];
							    		$id_usuario=$row['id_usuario'];
							    echo "<input type='radio' id='radio'  name='".$id_usuario."' value='".$id_usuario."'>
								<label style='color:red' >".$nombre_usuario."</label>";
							    	}
								?>
								</div>
							</br>	
								 <label for=list><b>Prioridad:</b></label>
							      <select name="txt_prioridad_tarea" id="txt_prioridad_tarea" >
							      <option>Baja</option>
							      <option>Media</option>
							      <option>Alta</option>
							  	  </select><br>	
							      	</div>
							      </div>
							      <!-- /contact form -->
							      <div class="col-md-6">
							      	<div class="contact-form">
							      		<h4 style="color:white">Send A Message</h4>
							    <label for="observaciones"><b>Observaciones:</b></label>
							    <textarea  id="txt_observaciones_tarea" name="txt_observaciones_tarea" rows="5" cols="40"></textarea><br>
							      <label for="observaciones"><b>Comentarios:</b></label>
							    <textarea  id="txt_comentarios_tarea" name="txt_comentarios_tarea"  rows="5" cols="40"></textarea><br>

							    <input type="submit" name="subir" class="main-button icon-button pull-right" value="Ingresar">

							  </form>
							  
						</div>

					</div>
					</div>
					<!-- /aside blog -->

				</div>
				<!-- row -->

			</div>
			<!-- container -->

		</div>

		<!-- /Blog -->
		     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
		     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />

		<!-- Footer -->
		<footer id="footer" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					
					

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
		<script type="text/javascript">
			function unselect(){
			  document.querySelectorAll('[id=radio]').forEach((x) => x.checked=false);
			  
			}
			var c = () => Array.from(document.getElementsByTagName("INPUT")).filter(cur => cur.type === 'checkbox' && cur.checked).length > 0;
			function Horario_personalizado(){
				$( document ).ready(function() {

				    
				        $('#horario_personalizado').toggle(1000,function() {

				        });
				        
				    
				});
				$( document ).ready(function() {
					$('#horario_fijo').toggle(1000,function() {

					});
				});
				 document.querySelectorAll('[id=radio]').forEach((x) => x.checked=false);
				if(!c()) { // Si NO hay ningun checkbox chequeado.
				   $("input[name=check_horario_personalizado]").prop("checked",true);
				 } else {
				  $("input[name=check_horario_personalizado]").prop("checked", false);
				 }
				
				
			}

			function pregunta(){  

			swal({
			  title: "Selecciones Los Dias De Clases",
			  text: "Seleccione Al Menos Un Día De Clases De Este Estudiante :) ",
			  type: "error",
			  //timer: 2000,

			  showConfirmButton: true
			});
			     } 
			     function confirmacion(){  

			swal({
			  title: "Esta seguro?",
			  text: "Seleccione Al Menos Un Día De Clases De Este Estudiante :) ",
			  type: "error",
			  //timer: 2000,

			  showConfirmButton: true
			});
			     } 
			
		</script>
		<script type="text/javascript">
			document.getElementById("formulario").addEventListener("submit", function(event){
					let hasError = false;
				     if(!document.querySelector('input[id="radio"]:checked')) {
				          //alert('Error, rellena el campo horario');
				          hasError = true;
				          pregunta();
				          }

				             if(hasError) event.preventDefault();
				});
		</script>
		<script type="text/javascript" src="http://ajax.googleapis.com/
		ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="jquery.wallform.js"></script>
		<script type="text/javascript">
		$(document).ready(function() 
		{ 

		$('#photoimg').on('change', function() 
		 {
		var A=$("#imageloadstatus");
		var B=$("#imageloadbutton");

		$("#imageform").ajaxForm({target: '#preview', 
		beforeSubmit:function(){
		A.show();
		B.hide();
		}, 
		success:function(){
		A.hide();
		B.show();
		}, 
		error:function(){
		A.hide();
		B.show();
		} }).submit();
		});

		}); 
		</script>

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
