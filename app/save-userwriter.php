<?php
$_POST["ID"];
$_POST["user_login"];
$_POST["user_pass"];
$_POST["user_nicename"];
$_POST["user_email"];
$_POST["user_registered"];
$_POST["user_activation_key"];
$_POST["user_status"];
$_POST["display_name"];
$_POST["parent"];
$_POST["phone"];

$ID=$_POST["ID"];
$user_login=$_POST["user_login"];
$user_pass=$_POST["user_pass"];
$user_nicename=$_POST["user_nicename"];
$user_email=$_POST["user_email"];
$user_registered=date("Y-m-d H:i:s");
$user_activation_key=$_POST["user_activation_key"];
$user_status="0";
$display_name=$_POST["display_name"];
$parent=$_POST["parent"];
$phone=$_POST["phone"];;



require ('phpass-0.5/PasswordHash.php');
$hash_cost_log2 = 8;
$hash_portable = FALSE;
$pass = $_POST["user_pass"];
$hasher = new PasswordHash($hash_cost_log2, $hash_portable);
$hash = $hasher->HashPassword($pass);

$usrio="dbu48877";
$contraseña="Manager&01";
//esto escribe wp_users

try {
    $mdb = new PDO('mysql:host=db5000134437.hosting-data.io;dbname=dbs129470', $usrio, $contraseña);
    //set the PDO error mode to exception
    $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM wp_hierarchy WHERE user_id = '$ID' LIMIT 1";
    $stmt = $mdb->query($sql);
    $user = $stmt->fetch();

    if(!empty($user['id'])){
        header('location: userwriter.php?user=exists');
    }

    $sql = "INSERT INTO wp_hierarchy (parent, child, user_id, phone)
VALUES ('$parent', '$user_nicename', '$ID', '$phone')";
    //use exec() because no results are returned
    $mdb->exec($sql);
    //echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$mdb = null;



try {
    $mdb = new PDO('mysql:host=db5000134437.hosting-data.io;dbname=dbs129470', $usrio, $contraseña);
    //set the PDO error mode to exception
    $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO  wp_users 
            VALUES (
            NULL,
            '$user_login', 
            '$hash', 
            '$user_nicename', 
            '$user_email', 
            '$user_url', 
            '$user_registered', 
            '$user_activation_key', 
            '$user_status', 
            '$display_name')";
    //use exec() because no results are returned
    $mdb->exec($sql);
    //echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$mdb = null;
//esto escribe wp_hierarchy



header('Location: home.php');


?>