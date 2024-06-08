<!DOCTYPE html>
<head>
  <title>Registro de usuarios </title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <link href="bootstrap-4/css/bootstrap.css" rel="stylesheet" type="text/css"/>
 <script src="bootstrap-4/js/jquery.js" type="text/javascript"></script>
 <script src="bootstrap-4/js/bootstrap.js" type="text/javascript"></script>
</head>
<body>

<div class="container">
  <h2>Registro Usuario</h2>
  <form class="form-group" action="registro_usuario.php"  method="POST">
    <label for="nombres"><b>Nombres:</b></label>
      <input type="text" class="form-control" id="txt_nombres" name="txt_nombres" placeholder="Nombre" required>
      <label for="apellidos"><b>Apellidos:</b></label>
      <input type="text" class="form-control" id="txt_apellidos" name="txt_apellidos" placeholder="Apellido" required>
      <label for="usuario"><b>Edad:</b></label>
      <input type="number" class="form-control" id="txt_edad" name="txt_edad" placeholder="edad" required>
      <label for="correo"><b>Correo Electronico:</b></label>
      <input type="email" class="form-control" id="txt_correo" name="txt_correo" placeholder="Ejemplo: correo@dominio.com" required>
      <label for="contra"><b>Contraseña:</b></label>
      <input type="password" class="form-control" id="txt_contra" name="txt_contra" placeholder="Contraseña" required>
    </p>
    
    <input type="submit" class="btn btn-primary" value="Registrar">
  </form>
</div>
</body>
</html>