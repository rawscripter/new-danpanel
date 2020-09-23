<form method="post" action="testhoy.php">
<input type="text" name="user">	
<input type="text" name="pass">
<input type="submit" name="">
</form>

<?php 
$user= $_POST["user"];
$pass= $_POST["pass"];
require ('/Users/jeyse/Sites/NeopilMLM/App/phpass-0.5/PasswordHash.php');
// Base-2 logarithm of the iteration count used for password stretching
$hash_cost_log2 = 8;
// Do we require the hashes to be portable to older systems (less secure)?
$hash_portable = FALSE;
$user = $_POST['user'];
// Should validate the username length and syntax here
$pass = $_POST['pass'];
$hasher = new PasswordHash($hash_cost_log2, $hash_portable);
$hash = $hasher->HashPassword($pass);

//echo $user;
echo $hash;

if ($hasher->CheckPassword($pass, $hash)) { //$hash is the hash retrieved from the DB 
    $what = 'Authentication succeeded';
} else {
    $what = 'Authentication failed';
}
echo $what;


require('conex.php');
$consulta= $conex->query("SELECT * FROM wp_users where user_login='$user'");
foreach($consulta as $datoa)
{

};
$dblogin=$datoa["user_login"];
$dbpass=$datoa["user_pass"];


// Check that the password is correct, returns a boolean
$check = $hasher->CheckPassword($pass, $dbpass);
if ($check) { //$hash is the hash retrieved from the DB 
    $what1 = 'Authentication succeeded';
} else {
    $what1 = 'Authentication failed';
}
echo $what1;
?>