<?php
if(!empty($_POST)){
	if(isset($_POST["username"]) &&isset($_POST["password"])){
		if($_POST["username"]!=""&&$_POST["password"]!=""){
			include "../conex.php";
			
			$user_id=null;
			$user=$_POST["username"];
			$pass=$_POST["password"];
			//echo $user;
			//echo $pass;
require ('../phpass-0.5/PasswordHash.php');
$hash_cost_log2 = 8;
$hash_portable = FALSE;
$user = $_POST["username"];
$pass = $_POST["password"];
$hasher = new PasswordHash($hash_cost_log2, $hash_portable);
$hash = $hasher->HashPassword($pass);

//echo $user;
//echo $pass;
//echo $hash;
//if ($hasher->CheckPassword($pass, $hash)) { //$hash is the hash retrieved from the DB 
//    $what = 'Authentication succeeded';
//} else {
//    $what = 'Authentication failed';
//}
//echo $what;

$consulta= $conex->query("SELECT * FROM wp_users where user_login='$user' or user_email='$user' and user_pass='$pass'");
	foreach($consulta as $dato)
	{
	    $dato["user_pass"];
	    $dato["user_login"];
	    $dato["user_email"];
	    $dato["display_name"];
	    $dato["user_nicename"];
}
$user_id=$dato["ID"];
$user_name=$dato["display_name"];
$dbpass=$dato["user_pass"];

// Check that the password is correct, returns a boolean
$check = $hasher->CheckPassword($pass, $dbpass);
if ($check) { //$hash is the hash retrieved from the DB 
    $what1 = 'Authentication succeeded';
} else {
    $what1 = 'Authentication failed';
}
//echo $what1;

			if($user_id==null){
				print "<script>alert(\"Acceso invalido.\");window.location='../login.php';</script>";
			}else{
				session_start();
				$_SESSION["user_id"]=$user_id;
				$_SESSION["user_name"]=$user_name;

				print "<script>window.location='../home.php';</script>";				
			}
		}
	}
}
?>