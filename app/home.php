<?php
session_start();
if(!isset($_SESSION["user_id"]) || $_SESSION["user_name"]==null){
	print "<script>alert(\"Acceso invalido!\");window.location='login.php';</script>";
}
?>
<html>
	<head>
		<title>Distribuidores</title>
<link rel="apple-touch-icon" sizes="60x60" href="https://www.neopil-caps.com/wp-content/uploads/2019/02/favicon.png">
	<link rel="icon" type="image/png" href="https://www.neopil-caps.com/wp-content/uploads/2019/02/favicon.png" sizes="32x32">
	<link rel="icon" type="image/png" href="https://www.neopil-caps.com/wp-content/uploads/2019/02/favicon.png" sizes="16x16">
	<link rel="shortcut icon" href="https://www.neopil-caps.com/wp-content/uploads/2019/02/favicon.png">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <style>
a:link, a:visited {
  color: #FFA500;
  padding: 1px 1px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

a:hover, a:active {
  color: RED;
}

#hoverMe {
    padding: 30px;
    border: 2px solid black;
}
#tooltip {
    border: 2px solid red;
    display: none;
}
#pup {
  position:absolute;
  z-index:200; /* aaaalways on top*/
  padding: 3px;
  margin-left: 10px;
  margin-top: 5px;
  width: 250px;
  border: 1px solid black;
  background-color: #777;
  color: white;
  font-size: 0.95em;
}
</style>
<script type="text/javascript" src="/nhpup_1.1.js"></script>
<script>
	$('#hoverMe').hover(function () {
    $('#tooltip').stop().fadeIn();
}, function () {
    $('#tooltip').stop().fadeOut();
});
</script>
	</head>
<!-- fin header-->
	<body>
<div class="container">
<div class="row">
<div class="col-md-6">
		<div class="container"><div class="col-md-6" align="center">
<img src="neopil.png" width="90" height="81" align="center" /></div></div><br /><br />
<!-- navbar!-->
<table width="750" border="0">
  <tr>
    <td width="350" align="center" ><p align="left">Bienvenido Sr. (a) <?php echo " ".$_SESSION["user_name"];?> </p></td>
    <td width="150" align="center" ><a href="http://vip.neopil-caps.com/tienda/">Tienda</a></td> 
    <td width="150" align="center" ><a href="userwriter.php">Nuevo Distribuidor</a></td>   
    <td width="150" align="center"><a href="viewfact.php">Ver Pedidos</a></td>
    <td width="150" align="center"><a href="php/logout.php">Salir</a></td>
  </tr>
</table>
<!-- fin navbar!-->
<?php
$snombre=$_SESSION["user_name"];
include('conex.php');
?>
<!-- selector de distribuidor-->
<p>Seleccione un Distribuidor</p>
<form method="post" action="respuesta.php" target="respuesta">
<select name="seldist">
<?php
// este es el selector de asociados horizontales, 
$consulta= $conex->query("SELECT * FROM wp_hierarchy WHERE parent ='$snombre' ORDER BY child ASC");
foreach($consulta as $dato100)
{?>
    <option value="<?php echo $dato100["id"];?>"><?php echo $dato100["child"];?></option>
<?php 
//aqui termina el selector de asociados horizontales
}?>
</select><input type="submit" value="Consultar"></form>
<!-- fin selector de distribuidor-->
<iframe name="respuesta" src="respuesta.php" width="755px" height="250px" frameborder="0" marginwidth="0px">
    <!-- carga inicialmente el arbol en vertical de la persona seleccionada en el selector de distribuidor-->
</iframe>
<!-- diferentes controles para ver el arbol general y los datos particulares de algun distribuidor-->
<P><a href="envia.php" target="busq">Todos en mi Red</a></P>
<form method="post" action="busqueda.php" target="busq">
<p>Busqueda por Nombre <input type="text" name="busqueda" placeholder="Ingrese Nombre">
<input type="submit" value="Consultar">
</form>
<iframe name="busq" src="envia.php" width="770px" height="200px" frameborder="0" marginwidth="0px">
    <!-- aqui se muestra el resultado de los controles--></iframe>

<?php //solo ve el administrador
  require('conex.php');
  $uid=$_SESSION["user_id"];
    $consulta= $conex->query("SELECT * FROM wp_usermeta where (user_id='$uid') AND (meta_key='wp_capabilities')");
  foreach($consulta as $dato101){
    $a=$dato101["meta_value"];
    //echo $a;
}
$b="administrator";
if (strpos($a, $b) === FALSE){
  echo "";
    } else { ?>

<iframe src="totalgeneral.php" name="totalgeneral" width="750px" height="100px" frameborder="0" marginwidth="0px">
    <!-- este es el cuadro general de ventas de toda la red-->
</iframe>

<?php };?>
</body>
</html>