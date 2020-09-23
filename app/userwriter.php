<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Distribuidores</title>
<link rel="apple-touch-icon" sizes="60x60" href="https://www.neopil-caps.com/wp-content/uploads/2019/02/favicon.png">
	<link rel="icon" type="image/png" href="https://www.neopil-caps.com/wp-content/uploads/2019/02/favicon.png" sizes="32x32">
	<link rel="icon" type="image/png" href="https://www.neopil-caps.com/wp-content/uploads/2019/02/favicon.png" sizes="16x16">
	<link rel="shortcut icon" href="https://www.neopil-caps.com/wp-content/uploads/2019/02/favicon.png">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script>
function funcionAsociadaBoton(){
/*otraFuncionJavascript();*/
history.go(-1);
} 

</script>
</head>
<style>
input[type="text"] {
    width: 100%;
}
#container{
	margin-top: 60px;
}
</style>
<body>
<!-- contenedor imagen neopil-->
<div class="container" id="container">
<div class="row">
<div class="col-md-6 col-md-offset-2">
		<div class="container">
			<div class="text-cneter" align="center">
<img src="neopil.png" width="90" height="81" align="center" /></div></div><br /><br />
<div class="container">
<!-- contenedor general para el formulario-->



<?php


require ('phpass-0.5/PasswordHash.php');
$hash_cost_log2 = 8;
$hash_portable = FALSE;
$pass = $_POST["user_pass"];
$hasher = new PasswordHash($hash_cost_log2, $hash_portable);
$hash = $hasher->HashPassword($pass);

$usrio="dbu48877";
$contraseña="Manager&01";


$mdb = new PDO('mysql:host=db5000134437.hosting-data.io;dbname=dbs129470', $usrio, $contraseña);
//set the PDO error mode to exception
$mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM wp_hierarchy ORDER BY user_id";
$stmt = $mdb->query($sql);
$usersData = $stmt->fetchAll();


?>


<?php

if(isset($_GET['user'])){
	if($_GET['user'] == 'exists'){
		echo '<h5 style="text-align:center;color:red">El Usuario Ya Existe</h5>';
	}
}

?>


<p class="text-center">Por favor ingrese los siguientes datos del Nuevo Distribuidor:</p>
<form name="userwriter" method="POST" action="save-userwriter.php">
<table border="0" style="margin-left: 5%;">
	<tr>
	<td align="right">Cedula / RUC:</td>
	<td><input type="text" name="ID"></td>
	</tr>
	<tr>
	<td align="right">Nombre de Usuario:</td>
	<td><input type="text" name="user_login"  ></td>
	</tr>
	<tr>
	<td align="right">Contraseña:</td>
	<td><input type="text" name="user_pass"  ></td>
	</tr>
	<tr>
	<td align="right">Nombre y Apellido:</td>
	<td><input type="text" name="user_nicename"  ></td>
	</tr>
	<tr>
	<td align="right">Correo Electronico:</td>
	<td><input type="text" name="user_email"  ></td>
	</tr>
	<tr>
	<td align="right">Telefono:</td>
	<td><input type="text" name="phone"  ></td>
	</tr>
	<tr>
	<td align="right">Nombre para Mostrar:</td>
	<td><input type="text" name="display_name"  ></td>
	</tr>
	<tr>
	<tr style="margin: 5px 0;">
	<td align="right">Referido Por:</td>
	<td>
		
	<!-- <input type="text" name="parent"  > -->

	<select name="parent" id="parent" style="margin:5px 0;">
		<option value="" selected disabled>Seleccionar</option>
		<?php foreach($usersData as $data): ?>
			<option value="<?= $data['child']?>"><?= $data['user_id']?> - <?= $data['child']?></option>
		<?php endforeach; ?>
	</select>

<br>
		</td>
	</tr>

	<br>

	<tr>
	<br>	
	<td><input type="button" onclick="history.back()" name="Volver Atras" value="Volver Atras"></td>
	<td align="right"><input type="submit" name="enviar" value="Enviar"></td>
	
	</tr>
</table>
</form>
</div>
</body>
</html>