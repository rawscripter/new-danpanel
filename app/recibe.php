<?php //conexion al servidor
$pAZ = $_POST['dist'];
//echo $pAZ;
require_once('conex.php');
// fin conexion al servidor

$consulta= $conex->query("SELECT * FROM wp_users where user_url='$pAZ' LIMIT 1");
foreach($consulta as $dato691)
{
    //echo $dato691["ID"];
    $dato691=$dato691["ID"];
};

$consulta= $conex->query("SELECT * FROM wp_usermeta where (meta_key='first_name') AND user_id='$dato691' LIMIT 1");
foreach($consulta as $dato70)   
{
    //echo $dato70["meta_value"];
    $meta_value70=$dato70["meta_value"];
};
$consulta= $conex->query("SELECT * FROM wp_usermeta where (meta_key='last_name') AND user_id='$dato691' LIMIT 1");
foreach($consulta as $dato701)   
{
    //echo $dato701["meta_value"];
    $meta_value701=$dato701["meta_value"];
};
//este calculo me trae el iduniq de quien refirio
$consulta= $conex->query("SELECT * FROM wp_usermeta where (meta_key='billing_company') AND user_id='$dato691' LIMIT 1");
foreach($consulta as $dato702)   
{
    //echo $dato70["meta_value"];
    $gen1ID=$dato702["meta_value"];
};
$gen1names=$meta_value70." ".$meta_value701;
//echo $gen1ID;
//--------------------------------------------------------------------------------------------------FIN CALCULO GEN1

$consulta= $conex->query("SELECT * FROM wp_usermeta where (meta_key='billing_address_2') AND (meta_value='$gen1ID')");
foreach($consulta as $dato801)
{
    //echo $dato801["user_id"];
    $gen2ID=$dato801["user_id"];
};

$consulta= $conex->query("SELECT * FROM wp_usermeta where (meta_key='first_name') AND user_id='$gen2ID' LIMIT 1");
foreach($consulta as $dato802)   
{
    //echo $dato802["meta_value"];
    $meta_value802=$dato802["meta_value"];

};
$consulta= $conex->query("SELECT * FROM wp_usermeta where (meta_key='last_name') AND user_id='$gen2ID' LIMIT 1");
foreach($consulta as $dato803)   
{
    //echo $dato803["meta_value"];
    $meta_value803=$dato803["meta_value"];

};
 $gen2names=$meta_value802." ".$meta_value803;
 $consulta= $conex->query("SELECT * FROM wp_usermeta where (meta_key='billing_company') AND user_id='$gen2ID' LIMIT 1");
foreach($consulta as $dato804)   
{
    //echo $dato804["meta_value"];
    $gen2IDUNIQ=$dato804["meta_value"];
};
//--------------------------------------------------------------------------------------------------FIN CALCULO GEN2
$consulta= $conex->query("SELECT * FROM wp_usermeta where (meta_key='billing_address_2') AND (meta_value='$gen2IDUNIQ')");
foreach($consulta as $dato901)
{
    //echo $dato901["user_id"];
    $gen3ID=$dato901["user_id"];
    
};

$consulta= $conex->query("SELECT * FROM wp_usermeta where (meta_key='first_name') AND user_id='$gen3ID' LIMIT 1");
foreach($consulta as $dato902)   
{
    //echo $dato902["meta_value"];
    $meta_value902=$dato902["meta_value"];

};
$consulta= $conex->query("SELECT * FROM wp_usermeta where (meta_key='last_name') AND user_id='$gen3ID' LIMIT 1");
foreach($consulta as $dato903)   
{
    //echo $dato903["meta_value"];
    $meta_value903=$dato903["meta_value"];

};
 $gen3names=$meta_value902." ".$meta_value903;
 $consulta= $conex->query("SELECT * FROM wp_usermeta where (meta_key='billing_company') AND user_id='$gen3ID' LIMIT 1");
foreach($consulta as $dato904)   
{
    //echo $dato904["meta_value"];
    $gen3IDUNIQ=$dato904["meta_value"];
};
//--------------------------------------------------------------------------------------------------FIN CALCULO GEN3

$consulta= $conex->query("SELECT * FROM wp_usermeta where (meta_key='billing_address_2') AND (meta_value='$gen3IDUNIQ')");
foreach($consulta as $dato911)
{
    //echo $dato911["user_id"];
    $gen4ID=$dato911["user_id"];
    
};

$consulta= $conex->query("SELECT * FROM wp_usermeta where (meta_key='first_name') AND user_id='$gen4ID' LIMIT 1");
foreach($consulta as $dato912)   
{
    //echo $dato912["meta_value"];
    $meta_value912=$dato912["meta_value"];

};
$consulta= $conex->query("SELECT * FROM wp_usermeta where (meta_key='last_name') AND user_id='$gen4ID' LIMIT 1");
foreach($consulta as $dato913)   
{
    //echo $dato913["meta_value"];
    $meta_value913=$dato913["meta_value"];

};
 $gen4names=$meta_value912." ".$meta_value913;
 $consulta= $conex->query("SELECT * FROM wp_usermeta where (meta_key='billing_company') AND user_id='$gen4ID' LIMIT 1");
foreach($consulta as $dato914)   
{
    //echo $dato914["meta_value"];
    $gen4IDUNIQ=$dato914["meta_value"];
};
//--------------------------------------------------------------------------------------------------FIN CALCULO GEN4

// calculo ventas totales de la generacion 1
$pF = $dato691;
$consulta= $conex->query("SELECT SUM(net_total) AS tmonto  FROM wp_wc_order_stats WHERE customer_id='$pF'");
foreach($consulta as $dato76)
{
    //echo $dato76["iduniq1"];
    //echo $dato76["fecha"];
    //echo $dato76["numfact"];
    //echo $dato76["cantitem"];
    //echo $dato76["monto"];
    //echo $pF;
    //echo $dato76["tmonto"];
    
};

// calculo ventas totales de la generacion 2
$pG = $gen2ID;
$consulta= $conex->query("SELECT SUM(net_total) AS tmonto  FROM wp_wc_order_stats WHERE customer_id='$pG'");
foreach($consulta as $dato77)
{
    //echo $dato76["iduniq1"];
    //echo $dato76["fecha"];
    //echo $dato76["numfact"];
    //echo $dato76["cantitem"];
    //echo $dato76["monto"];
    //echo $pF;
    //echo $dato76["tmonto"];
    
};
// calculo ventas totales de la generacion 3
$pH = $ge3ID;
$consulta= $conex->query("SELECT SUM(net_total) AS tmonto  FROM wp_wc_order_stats WHERE customer_id='$pH'");
foreach($consulta as $dato78)
{
    //echo $dato76["iduniq1"];
    //echo $dato76["fecha"];
    //echo $dato76["numfact"];
    //echo $dato76["cantitem"];
    //echo $dato76["monto"];
    //echo $pF;
    //echo $dato76["tmonto"];
    
};
// calculo ventas totales de la generacion 4
$pI = $g4ID;
$consulta= $conex->query("SELECT SUM(net_total) AS tmonto  FROM wp_wc_order_stats WHERE customer_id='$pI'");
foreach($consulta as $dato79)
{
    //echo $dato76["iduniq1"];
    //echo $dato76["fecha"];
    //echo $dato76["numfact"];
    //echo $dato76["cantitem"];
    //echo $dato76["monto"];
    //echo $pF;
    //echo $dato76["tmonto"];
    
};



//------------------------------------------------------------------FIN CALCULO DE VENTAS TOTALES

//------------------------------------------------------------------CALCULO DE COMISIONES TOTALES
// calculo comisiones totales de la generacion 1
$pJ = $dato691;
$consulta= $conex->query("SELECT (SUM(net_total)/20) AS tmonto1  FROM wp_wc_order_stats WHERE customer_id='$pJ'");
foreach($consulta as $dato80)
{

    //echo $dato80["tmonto1"];
    
};
$pK = $gen2ID;
$consulta= $conex->query("SELECT (SUM(net_total)/20) AS tmonto1  FROM wp_wc_order_stats WHERE customer_id='$pK'");
foreach($consulta as $dato81)
{

    //echo $dato81["tmonto1"];
    
};
$pL = $gen3ID;
$consulta= $conex->query("SELECT (SUM(net_total)/20) AS tmonto1  FROM wp_wc_order_stats WHERE customer_id='$pL'");
foreach($consulta as $dato82)
{

    //echo $dato82["tmonto1"];
    
};
$pM = $gen4ID;
$consulta= $conex->query("SELECT (SUM(net_total)/20) AS tmonto1  FROM wp_wc_order_stats WHERE customer_id='$pM'");
foreach($consulta as $dato83)
{

    //echo $dato83["tmonto1"];
    
};

//--------------------------------------------------------------FIN CALCULO DE COMISIONES TOTALES

//------------------------------------------------------------------------CALCULO DE ULTIMA FECHA
// calculo fecha ultima compra de la generacion 1
$pN = $dato691;
$consulta= $conex->query("SELECT date_created FROM wp_wc_order_stats WHERE customer_id='$pN' ORDER BY date_created DESC");
foreach($consulta as $dato84)
{
    //echo $dato84["date_created"];
};
$pO = $gen2ID;
$consulta= $conex->query("SELECT date_created FROM wp_wc_order_stats WHERE customer_id='$pO' ORDER BY date_created DESC");
foreach($consulta as $dato85)
{
    //echo $dato85["date_created"];
};
$pR = $gen3ID;
$consulta= $conex->query("SELECT date_created FROM wp_wc_order_stats WHERE customer_id='$pR' ORDER BY date_created DESC");
foreach($consulta as $dato86)
{
    //echo $dato86["date_created"];
};
$pS = $gen4ID;
$consulta= $conex->query("SELECT date_created FROM wp_wc_order_stats WHERE customer_id='$pS' ORDER BY date_created DESC");
foreach($consulta as $dato87)
{
    //echo $dato87["date_created"];
};
//---------------------------------------------------------------------FIN CALCULO DE ULTIMA FECHA
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


?>
<table width="750" border="1">
  <tr>
    <th width="50" scope="col">&nbsp;</th>
    <th width="250" scope="col"><div align="center">NOMBRE Y APELLIDO</div></th>
    <th width="100" scope="col"><div align="center">ID</div></th>
    <th width="100" scope="col"><div align="center">VENTA</div></th>
    <th width="100" scope="col"><div align="center">COMISION</div></th>
    <th width="150" scope="col"><div align="center">ULTIMA VENTA</div></th>
  </tr>
  <tr>
    <th scope="row"><div align="center">GEN1</div></th>
    <td align="center"><?php echo $gen1names;?></td>
    <td align="center"><?php echo $gen1ID;?></td>
    <td align="center"><?php echo "$ ".$dato76["tmonto"];?></td>
    <td align="center"><?php echo "$ ".$dato80["tmonto1"];?></td>
    <td align="center"><?php echo $dato84["date_created"];?></td>
  </tr>
  <tr>
    <th scope="row"><div align="center">GEN2</div></th>
    <td align="center"><?php echo $gen2names;?></td>
    <td align="center"><?php echo $gen2IDUNIQ;?></td>
    <td align="center"><?php echo "$ ".$dato77["tmonto"];?></td>
    <td align="center"><?php echo "$ ".$dato81["tmonto1"];?></td>
    <td align="center"><?php echo $dato85["date_created"];?></td>
  </tr>
  <tr>
    <th scope="row"><div align="center">GEN3</div></th>
    <td align="center"><?php echo $gen3names;?></td>
    <td align="center"><?php echo $gen3IDUNIQ;?></td>
    <td align="center"><?php echo "$ ".$dato78["tmonto"];?></td>
    <td align="center"><?php echo "$ ".$dato82["tmonto1"];?></td>
    <td align="center"><?php echo $dato86["date_created"];?></td>
  </tr>
  <tr>
    <th scope="row"><div align="center">GEN4</div></th>
    <td align="center"><?php echo $gen4names;?></td>
    <td align="center"><?php echo $gen4IDUNIQ;?></td>
    <td align="center"><?php echo "$ ".$dato79["tmonto"];?></td>
    <td align="center"><?php echo "$ ".$dato83["tmonto1"];;?></td>
    <td align="center"><?php echo $dato87["date_created"];?></td>   
  </tr>
</table>
<table width="750" border="1">
  <tr>
    <th width="247" scope="col">Ventas Totales</th>
    <th width="140" scope="col"><?php $sumtotal = $dato76["tmonto"]+$dato77["tmonto"]+$dato78["tmonto"]+$dato79["tmonto"]; echo "$ ".$sumtotal;?></th>
    <th width="263" scope="col">Comsiones Totales</th>
    <th width="122" scope="col"><?php
$sumcomi = $dato80["tmonto1"]+$dato81["tmonto1"]+$dato82["tmonto1"]+$dato83["tmonto1"];
echo "$ ".$sumcomi;?></th>
  </tr>
</table>