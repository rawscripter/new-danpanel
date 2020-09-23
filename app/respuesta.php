<?php //conexion al servidor
$pAZ = $_POST['seldist'];
include('conex.php');
$consulta= $conex->query("SELECT * FROM wp_hierarchy where id='$pAZ' LIMIT 1");
foreach($consulta as $dato69)
{
    //echo $dato69["parent"];
    //echo $dato69["child"];
    $parentA=$dato69["child"];
};

//quien es gen1
$consulta= $conex->query("SELECT * FROM wp_hierarchy where parent='$parentA' LIMIT 1");
foreach($consulta as $dato70)
{
    //echo $dato70["parent"];
    //echo $dato70["child"];
    $parentB=$dato70["child"];
};
// quien es gen2
$consulta= $conex->query("SELECT * FROM wp_hierarchy where parent='$parentB' LIMIT 1");
foreach($consulta as $dato71)
{
    //echo $dato71["parent"];
    //echo $dato71["child"];
    $parentC=$dato71["child"];
};
// quien es gen3
$consulta= $conex->query("SELECT * FROM wp_hierarchy where parent='$parentC' LIMIT 1");
foreach($consulta as $dato72)
{
    //echo $dato72["parent"];
    //echo $dato72["child"];
    $parentD=$dato72["child"];
    //echo $parentD;
};
// quien es gen4
$consulta= $conex->query("SELECT * FROM wp_hierarchy where parent='$parentD' LIMIT 1");
foreach($consulta as $dato73)
{
    //echo $dato73["parent"];
    //echo $dato73["child"];
    $parentE=$dato73["child"];
    //echo $parentE;

};
//----------------------------------------------------------------------CALCULO DE VENTAS TOTALES
// calculo ventas totales de la generacion 1
$pE = $dato70["id"];
//echo $pE;
$consulta= $conex->query("SELECT * FROM wp_wc_customer_lookup WHERE user_id='$pE'");
foreach ($consulta as $dato751) {
    $datopE=$dato751["customer_id"];
    //echo $datopE;
}
$consulta= $conex->query("SELECT SUM(net_total) AS tmonto  FROM wp_wc_order_stats WHERE customer_id='$datopE'");
foreach($consulta as $dato75)
{
    //echo $dato75["tmonto"];
};
$consulta= $conex->query("SELECT * FROM wp_wc_order_stats WHERE customer_id='$datopE'");
foreach($consulta as $dato752)
{
    //echo $dato752["date_created"];
    $dato83=$dato752["date_created"];
};

// calculo ventas totales de la generacion 2
$pF = $dato71["id"];
//echo $pF;
$consulta= $conex->query("SELECT * FROM wp_wc_customer_lookup WHERE user_id='$pF'");
foreach ($consulta as $dato761) {
    $datopF=$dato761["customer_id"];
    //echo $datopF;
}
$consulta= $conex->query("SELECT SUM(net_total) AS tmonto  FROM wp_wc_order_stats WHERE customer_id='$datopF'");
foreach($consulta as $dato76)
{
    //echo $dato76["tmonto"];
};
$consulta= $conex->query("SELECT * FROM wp_wc_order_stats WHERE customer_id='$datopF'");
foreach($consulta as $dato762)
{
    //echo $dato762["date_created"];
    $dato84=$dato762["date_created"];
};
// calculo ventas totales de la generacion 3
$pG = $dato72["id"];
//echo $pG;
$consulta= $conex->query("SELECT * FROM wp_wc_customer_lookup WHERE user_id='$pG'");
foreach ($consulta as $dato771) {
    $datopG=$dato771["customer_id"];
    //echo $datopG;
}
$consulta= $conex->query("SELECT SUM(net_total) AS tmonto  FROM wp_wc_order_stats WHERE customer_id='$datopG'");
foreach($consulta as $dato77)
{
    //echo $dato77["tmonto"];
};
$consulta= $conex->query("SELECT * FROM wp_wc_order_stats WHERE customer_id='$datopG'");
foreach($consulta as $dato772)
{
    //echo $dato772["date_created"];
    $dato85=$dato772["date_created"];
};
// calculo ventas totales de la generacion 4
$pH ="$parentD";
//echo $pH;
$consulta= $conex->query("SELECT * FROM wp_users WHERE display_name='$pH'");
foreach ($consulta as $dato782) {
    $pH1=$dato782["ID"];
}
$consulta= $conex->query("SELECT * FROM wp_wc_customer_lookup WHERE user_id='$pH1'");
foreach ($consulta as $dato781) {
    $datopH=$dato781["customer_id"];
//    echo $datopH;
}
$consulta= $conex->query("SELECT SUM(net_total) AS tmonto  FROM wp_wc_order_stats WHERE customer_id='$datopH'");
foreach($consulta as $dato78)
{
  //  echo $dato78["tmonto"];
};
$consulta= $conex->query("SELECT * FROM wp_wc_order_stats WHERE customer_id='$datopH'");
foreach($consulta as $dato782)
{
    //echo $dato782["date_created"];
    $dato86=$dato782["date_created"];
};
//------------------------------------------------------------------FIN CALCULO DE VENTAS TOTALES

//------------------------------------------------------------------CALCULO DE COMISIONES TOTALES
// calculo comisiones totales de la generacion 1
$dato791=$dato75["tmonto"];
$dato79=(($dato791)/20);
//echo $dato79;    
// calculo comisiones totales de la generacion 2
$dato801=$dato76["tmonto"];
$dato80=(($dato801)/20);
//echo $dato80;
// calculo comisiones totales de la generacion 3
$dato811=$dato77["tmonto"];
$dato81=(($dato811)/20);
//echo $dato81;
// calculo comisiones totales de la generacion 4
$dato821=$dato78["tmonto"];
$dato82=(($dato821)/20);
//echo $dato82;
//--------------------------------------------------------------FIN CALCULO DE COMISIONES TOTALES

//------------------------------------------------------------------------CALCULO TOTAL VENTAS
$pQ = $dato["iduniq"];
$consulta= $conex->query("SELECT COUNT(*) numfact FROM facturas");
foreach($consulta as $dato87)
//------------------------------------------------------------------------CALCULO TOTAL VENTAS

//------------------------------------------------------------------------CALCULO TOTAl DISTRIBUIDORES
$pR = $dato["iduniq"];
$consulta= $conex->query("SELECT COUNT(*) usuario FROM usuarios");
foreach($consulta as $dato88)
//------------------------------------------------------------------------CALCULO TOTAL DISTRIBUIDORES

//------------------------------------------------------------------------CALCULO MONTO TOTAL VENTAS
$pS = $dato["iduniq"];
$consulta= $conex->query("SELECT SUM(monto) as tmonto FROM facturas");
foreach($consulta as $dato89)
//------------------------------------------------------------------------CALCULO MONTO TOTAL VENTAS

//------------------------------------------------------------------------CALCULO MONTO TOTAL VENTAS
$pT = $dato["iduniq"];
$consulta= $conex->query("SELECT (SUM(monto)/20) as tmonto FROM facturas");
foreach($consulta as $dato90)
//------------------------------------------------------------------------CALCULO MONTO TOTAL VENTAS

include('conex.php');
?>
<table width="750" border="1">
  <tr>
    <th width="50" scope="col">&nbsp;</th>
    <th width="250" scope="col"><div align="center">NOMBRE DISTRIBUIDOR</div></th>
    <th width="100" scope="col"><div align="center">ID</div></th>
    <th width="100" scope="col"><div align="center">VENTA</div></th>
    <th width="100" scope="col"><div align="center">COMISION</div></th>
    <th width="150" scope="col"><div align="center">ULTIMA VENTA</div></th>
  </tr>
  <tr>
    <th scope="row"><div align="center">GEN1</div></th>
    <td align="center"><?php echo $dato69["child"];?></td>
    <td align="center"><?php echo $dato69["user_id"];?></td>
    <td align="center"><?php echo "$ ".$dato75["tmonto"];?></td>
    <td align="center"><?php echo "$ ".$dato79;?></td>
    <td align="center"><?php echo $dato83;?></td>
  </tr>
  <tr>
    <th scope="row"><div align="center">GEN2</div></th>
    <td align="center"><?php echo $dato70["child"];?></td>
    <td align="center"><?php echo $dato70["user_id"];?></td>
    <td align="center"><?php echo "$ ".$dato76["tmonto"];?></td>
    <td align="center"><?php echo "$ ".$dato80;?></td>
    <td align="center"><?php echo $dato84;?></td>
  </tr>
  <tr>
    <th scope="row"><div align="center">GEN3</div></th>
    <td align="center"><?php echo $dato71["child"];?></td>
    <td align="center"><?php echo $dato71["user_id"];?></td>
    <td align="center"><?php echo "$ ".$dato77["tmonto"];?></td>
    <td align="center"><?php echo "$ ".$dato81;?></td>
    <td align="center"><?php echo $dato85;?></td>
  </tr>
  <tr>
    <th scope="row"><div align="center">GEN4</div></th>
    <td align="center"><?php echo $dato72["child"];?></td>
    <td align="center"><?php echo $dato72["user_id"];?></td>
    <td align="center"><?php echo "$ ".$dato78["tmonto"];?></td>
    <td align="center"><?php echo "$ ".$dato82;?></td>
    <td align="center"><?php echo $dato86;?></td>   
  </tr>
</table>
<table width="750" border="1">
  <tr>
    <th width="247" scope="col">Ventas Totales</th>
    <th width="140" scope="col"><?php $sumtotal = $dato75["tmonto"]+$dato76["tmonto"]+$dato77["tmonto"]+$dato78["tmonto"]; echo "$ ".$sumtotal;?></th>
    <th width="263" scope="col">Comsiones Totales</th>
    <th width="122" scope="col"><?php
$sumcomi = $dato79+$dato80+$dato81+$dato82;
echo "$ ".$sumcomi;?></th>
<tr>
    <th width="263" scope="col">Donacion a la Iglesia</th>
    <th width="122" scope="col"><?php
$sumcomiten = ($sumcomi)/10;
echo "$ ".$sumcomiten;?></th>
  </tr>
  </tr>
</table>
