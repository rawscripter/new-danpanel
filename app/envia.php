<?php
session_start();
if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"]==null){
    print "<script>alert(\"Acceso invalido!\");window.location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Todos Mi Red</title>
</head>
<body>
<?php
include('conex.php');
$ui= $_SESSION["user_id"];
//echo $ui;
$consulta= $conex->query("SELECT * FROM wp_hierarchy where id='$ui'");
foreach($consulta as $datoa)
{
    //echo $datoa["child"];
};
$name=$datoa["parent"];
//echo $name;
?>

<br>
<table border="1" width="750">
        <tr>
            <th width="150" align="center">CABEZA</th>
            <th width="150" align="center">GEN1</th>
            <th width="150" align="center">GEN2</th>
            <th width="150" align="center">GEN3</th>
            <th width="150" align="center">GEN4</th>
        </tr>
<?php 
$consulta= $conex->query("SELECT t1.child AS CABEZA, t2.child as GEN1, t3.child as GEN2, t4.child as GEN3, t5.child as GEN4
FROM wp_hierarchy AS t1
LEFT JOIN wp_hierarchy AS t2 ON t2.parent = t1.child
LEFT JOIN wp_hierarchy AS t3 ON t3.parent = t2.child
LEFT JOIN wp_hierarchy AS t4 ON t4.parent = t3.child
LEFT JOIN wp_hierarchy AS t5 ON t5.parent = t4.child
WHERE t1.child ='$name'");
    foreach ($consulta as $dato22)
{?>
        <tr>
            <td width="150" align="center"><?php echo $dato22["CABEZA"];?></td>
            <td width="150" align="center"><?php echo $dato22["GEN1"];?></td>
            <td width="150" align="center"><?php echo $dato22["GEN2"];?></td>
            <td width="150" align="center"><?php echo $dato22["GEN3"];?></td>
            <td width="150" align="center"><?php echo $dato22["GEN4"];?></td>
        </tr>
<?php 
//aqui termina la tabla de los asociados
}?>
</table>
</body>
</html>