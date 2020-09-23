<?php
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
}
