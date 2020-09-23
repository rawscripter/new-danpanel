<?php
session_start();
if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"]==null){
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
</style>
	</head>
<body><div class="container">
<img src="neopil.png" width="90" height="81"/><br><br><br>
<table width="750" border="0">
  <tr>
    <td width="350" align="center" ><p align="left">Bienvenido Sr. (a) <?php echo " ".$_SESSION["user_name"];?></p></td>
    <td width="150" align="center"><a href="home.php">Inicio</a></td>
    <td width="150" align="center"><a href="php/logout.php">Salir</a></td>
  </tr>
</table><br>
<p>Ultimos Pedidos</p>
<table border="1" width="750">
	<tr>
		<td align="center">Vendedor</td>
		<td align="center">Numero de Pedido</td>
		<td align="center">Items Vendidos</td>
		<td align="center">Total Venta</td>
	</tr>
	<?php

include_once('conex.php');
$consulta= $conex->query("SELECT * FROM wp_wc_order_stats");
foreach($consulta as $dato150)
{ $dat=$dato150["customer_id"];
	?>
	<tr>
		<td align="center">
<?php $consulta= $conex->query("SELECT * FROM wp_wc_customer_lookup WHERE customer_id= '$dat'");
foreach($consulta as $dato151){ echo $dato151["first_name"]." ".$dato151["last_name"];}?></td>
		<td align="center"><?php echo $dato150["order_id"];?></td>
		<td align="center">“Neopilcaps 30 Caps” X <?php echo $dato150["num_items_sold"];?></td>
		<td align="center"><?php echo "$ ".$dato150["net_total"];?></td>
	</tr>
<?php }?>
</table>
</div>



</body>
</html>