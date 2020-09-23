<?php
require_once('conex.php');
//------------------------------------------------------------------------CALCULO TOTAL VENTAS
$consulta= $conex->query("SELECT COUNT(*) as tmonto FROM wp_woocommerce_order_items
");
foreach($consulta as $dato17)
//------------------------------------------------------------------------CALCULO TOTAL VENTAS

//------------------------------------------------------------------------CALCULO TOTAl DISTRIBUIDORES
$consulta= $conex->query("SELECT COUNT(id) as tmonto FROM wp_users");
foreach($consulta as $dato18){};
//------------------------------------------------------------------------CALCULO TOTAL DISTRIBUIDORES

//------------------------------------------------------------------------CALCULO MONTO TOTAL VENTAS

$consulta= $conex->query("SELECT SUM(meta_value) as tmonto FROM wp_woocommerce_order_itemmeta WHERE (meta_key='_line_total')");
foreach($consulta as $dato19)
//------------------------------------------------------------------------CALCULO MONTO TOTAL VENTAS

//------------------------------------------------------------------------CALCULO MONTO TOTAL VENTAS
$consulta= $conex->query("SELECT (SUM(meta_value)/20) as tmonto FROM wp_woocommerce_order_itemmeta WHERE (meta_key='_line_total')");
foreach($consulta as $dato20)
//------------------------------------------------------------------------CALCULO MONTO TOTAL VENTAS
?>
<table width="750" border="1">
      <tr>
    <th width="247" scope="col"><p align="center">Cantidad Total de Ventas</p></th>
    <th width="140" scope="col"><p align="center"><?php echo $dato17["tmonto"];?></p></th>
    <th width="263" scope="col"><p align="center">Cantidad de Distribuidores Total</p></th>
    <th width="122" scope="col"><p align="center"><?php echo $dato18["tmonto"];?></p></th>
  </tr>
  <tr>
    <th width="247" scope="col"><p align="center">Total de Ventas</p></th>
    <th width="140" scope="col"><p align="center">$ <?php echo number_format($dato19["tmonto"], 2, ',', ' ');?></p></th>
    <th width="263" scope="col"><p align="center">Cantidad General de Comisiones</p></th>
    <th width="122" scope="col"><p align="center">$ <?php echo number_format($dato20["tmonto"], 2, ',', ' ');?></p></th>
  </tr>
  <tr>
</table>