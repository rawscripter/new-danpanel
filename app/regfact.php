<?php
$usrio ="dbu48877";
$contraseña="Manager&01";
$numfact = $_POST['numfact'];
$fecha = $_POST['fecha'];
$iduniq1 = $_POST['iduniq1'];
$cantitem = $_POST['cantitem'];
$monto = $_POST['monto'];


try {
    $mdb = new PDO('mysql:host=db5000134437.hosting-data.io;dbname=myapp2', $usrio, $contraseña);
    // set the PDO error mode to exception
    $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO facturas (numfact, fecha, iduniq1, cantitem, monto) VALUES ('$numfact', '$fecha', '$iduniq1', '$cantitem', '$monto')";

    //use exec() because no results are returned
    $mdb->exec($sql);
    //echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$mdb = null;

header('Location: home.php');

?>