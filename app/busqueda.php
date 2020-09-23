<?php //conexion al servidor
$servername = "db5000134437.hosting-data.io";
$username = "dbu48877";
$password = "Manager&01";
$pxz = $_POST['busqueda'];
try {
    $conn = new PDO("mysql:host=$servername;dbname=dbs129470", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully".", user is ".$username."; el iduniq de usuario es ".$_SESSION["user_iduniq"]; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


$conex= new PDO("mysql:host=$servername;dbname=dbs129470", $username, $password);

if($conex->connect_errno){
    return $conex->connect_error;
}
else{
    //echo "Conectado";
// fin conexion al servidor
//echo $pxz;
}?>
<table border="1" width="750">
        <tr>
                <th width="225" scope="col"><div align="center">DISTRIBUIDOR</div></th>
                <th width="225" scope="col"><div align="center">REFERIDO POR</div></th>
                <th width="150" scope="col"><div align="center">Telefono</div></th>
                <th width="150" scope="col"><div align="center">ID</div></th>
        </tr>
    </table>

<?php
if (empty($pxz)) {
    echo "<td>Ingrese Busqueda</td>";
}else {
$consulta= $conex->query("SELECT * FROM wp_hierarchy where (child LIKE '%{$pxz}%') OR (user_id LIKE '%{$pxz}%') order by user_id ASC");
foreach($consulta as $dato21)
{?>
    <table border="1" width="750">
        <tr>
            <td width="230" align="center"><?php echo $dato21["child"];?></td>
            <td width="230" align="center"><?php echo $dato21["parent"];?></td>
            <td width="150" align="center"><?php echo $dato21["phone"];?></td>
            <td width="150" align="center"><?php echo $dato21["user_id"];?></td>
        </tr>
    </table>

<?php 
//aqui termina la tabla de los asociados
}}?>