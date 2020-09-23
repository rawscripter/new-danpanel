<?php session_start(); ?>
<html>
	<head>
		<title>Formulario de Registro</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script>
function funcionAsociadaBoton(){
/*otraFuncionJavascript();*/
history.go(-1);
} 
</script>
	</head>
	<body>
<div class="container">
<div class="row">
<div class="col-md-6">
		<h2>Registro</h2>

		<form role="form" name="registro" action="php/registro.php" method="post">
		  <div class="form-group">
		    <label for="username">Nombre de usuario</label>
		    <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario">
		  </div>
		  <div class="form-group">
		    <label for="fullname">Nombre Completo</label>
		    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nombre Completo">
		  </div>
		  <div class="form-group">
		    <label for="email">Correo Electronico</label>
		    <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electronico">
		  </div>
		   <div class="form-group">
		    <label for="iduniq">Id Unico</label>
		    <input type="text" class="form-control" id="iduniq" name="iduniq" placeholder="Id Unico">
		  </div>
		  <div class="form-group">
		    <label for="password">Contrase&ntilde;a</label>
		    <input type="password" class="form-control" id="password" name="password" placeholder="Contrase&ntilde;a">
		  </div>
		  <div class="form-group">
		    <label for="confirm_password">Confirmar Contrase&ntilde;a</label>
		    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirmar Contrase&ntilde;a">
		  </div>
		  <div class="form-group">
		    <label for="ciudad">Ciudad</label>
		    <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad">
		  </div>

		  <button type="submit" class="btn btn-default">Registrar</button><input type="button" value="Volver" onClick="history.go(-1);"></div>
		</form>
		</div>
		</div>
		</div>

		<script src="js/valida_registro.js"></script>
		<?php header('Location: home.php');?>
	</body>
</html>