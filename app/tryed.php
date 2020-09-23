<?php
	require('conex.php');
	$uid=1;
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