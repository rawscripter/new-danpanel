<?php //conexion al servidor
$servername = "db5000134437.hosting-data.io";
$username = "dbu48877";
$password = "Manager&01";

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
$consulta= $conex->query("SELECT * FROM wp_hierarchy order by id asc ");
foreach($consulta as $dato30)
{?>
    <table border="1" width="750">

        <tr>
            <td width="230" align="center"><?php echo $dato30["child"];?></td>
            <td width="230" align="center"><?php echo $dato30["parent"];?></td>
            <td width="150" align="center"><?php echo $dato30["phone"];?></td>
            <td width="150" align="center"><?php echo $dato30["user_id"];?></td>
        </tr>
    </table>

<?php 
//aqui termina la tabla de los asociados
}?>