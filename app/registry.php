<?php
$usrio ="dbu48877";
$contraseña="Manager&01";
$iduniq = $_POST['iduniq'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$idrefer = $_POST['idrefer'];


try {
    $mdb = new PDO('mysql:host=db5000134437.hosting-data.io;dbname=myapp2', $usrio, $contraseña);
    //set the PDO error mode to exception
    $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO usuarios (iduniq, nombre, apellido, email, phone, usuario, contrasena, idrefer) VALUES ('$iduniq', '$nombre', '$apellido', '$email', '$phone', '$usuario', '$contrasena', '$idrefer');";
    //use exec() because no results are returned
    $mdb->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$mdb = null;

header('Location: home.php');
?>
