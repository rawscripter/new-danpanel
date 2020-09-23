<?php
session_start();
if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"]==null){
	print "<script>alert(\"Acceso invalido!\");window.location='login.php';</script>";
}
?>
<html>
	<head>
		<title>.: HOME :.</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <style>
a:link, a:visited {
  color: #FFA500;
  padding: 1px 1px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

a:hover, a:active {
  color: RED;
}

#hoverMe {
    padding: 30px;
    border: 2px solid black;
}
#tooltip {
    border: 2px solid red;
    display: none;
}
#pup {
  position:absolute;
  z-index:200; /* aaaalways on top*/
  padding: 3px;
  margin-left: 10px;
  margin-top: 5px;
  width: 250px;
  border: 1px solid black;
  background-color: #777;
  color: white;
  font-size: 0.95em;
}
</style>
<script type="text/javascript" src="/nhpup_1.1.js"></script>
<script>
	$('#hoverMe').hover(function () {
    $('#tooltip').stop().fadeIn();
}, function () {
    $('#tooltip').stop().fadeOut();
});
</script>
	</head>
	<body>
<div class="container">
<div class="row">
<div class="col-md-6">
		<div class="container"><div class="col-md-6" align="center">

<img src="neopil.png" width="90" height="81" align="center" /></div></div><br /><br />
 <!– tabla de navegacion –>
<table width="750" border="1">
  <tr>
    <td width="350" align="center" ><p align="left">Bienvenido Sr. (a) <?php echo " ".$_SESSION["user_name"];?></p></td>
    <td width="150" align="center"><a href="regfact.html">Registrar Factura</a></td>
    <td width="150" align="center" ><a href="registro.html">Nuevo Distribuidor</a></td>
    <td width="150" align="center"><a href="registro.php">Registrar Nuevo Usuario</a></td>
    <td width="150" align="center"><a href="php/logout.php">Salir</a></td>
  </tr>
</table>

<?php



$servername = "db5000134437.hosting-data.io";
$username = "dbu48877";
$password = "Manager&01";

try {
    $conn = new PDO("mysql:host=$servername;dbname=myapp2", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully".", user is ".$username."; el iduniq de usuario es ".$_SESSION["user_iduniq"]; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


$conex= new PDO("mysql:host=$servername;dbname=myapp2", $username, $password);

if($conex->connect_errno){
    return $conex->connect_error;
}
else{
    //echo "Conectado";
}
?>
<p>Seleccione un Distribuidor</p>
<form method="post" action="home2.php">
<select>
<?php
// este es el selector de asociados horizontales
$consulta= $conex->query("SELECT * FROM usuarios WHERE idrefer='$_SESSION["user_iduniq"]' ORDER BY iduniq ASC");
foreach($consulta as $dato40)
{?>
    <option><?php echo $dato40["nombre"]." ".$dato40["apellido"];?></option>
<?php 
//aqui termina el selector de asociados horizontales
}?>
</select><input type="submit" value="enviar"></form>


<?php
//quien es gen1
$pA = $_SESSION["user_iduniq"];
$consulta= $conex->query("SELECT iduniq, nombre, apellido, email, phone, idrefer FROM usuarios where idrefer='$pA'");
foreach($consulta as $dato)
{
    //echo $dato["iduniq"];
    //echo $dato["nombre"];
    //echo $dato["apellido"];
    //echo $dato["email"];
    //echo $dato["phone"];
    //echo $dato["idrefer"];
};
// quien es gen2
$pB = $dato["iduniq"];
$consulta= $conex->query("SELECT iduniq, nombre, apellido, email, phone, idrefer FROM usuarios where idrefer='$pB'");
foreach($consulta as $dato2)
{
    //echo $dato2["iduniq"];
    //echo $dato2["nombre"];
    //echo $dato2["apellido"];
    //echo $dato2["email"];
    //echo $dato2["phone"];
    //echo $dato2["idrefer"];
};
// quien es gen3
$pC = $dato2["iduniq"];
$consulta= $conex->query("SELECT iduniq, nombre, apellido, email, phone, idrefer FROM usuarios where idrefer='$pC'");
foreach($consulta as $dato3)
{
   // echo $dato3["iduniq"];
    //echo $dato3["nombre"];
    //echo $dato3["apellido"];
    //echo $dato3["email"];
    //echo $dato3["phone"];
    //echo $dato3["idrefer"];
};
// quien es gen4
$pD = $dato3["iduniq"];
$consulta= $conex->query("SELECT iduniq, nombre, apellido, email, phone, idrefer FROM usuarios where idrefer='$pD'");
foreach($consulta as $dato4)
{
    //echo $dato4["iduniq"];
    //echo $dato4["nombre"];
    //echo $dato4["apellido"];
    //echo $dato4["email"];
    //echo $dato4["phone"];
    //echo $dato4["idrefer"];
};
//----------------------------------------------------------------------CALCULO DE VENTAS TOTALES
// calculo ventas totales de la generacion 1
$pE = $dato["iduniq"];
$consulta= $conex->query("SELECT SUM(monto) AS tmonto  FROM facturas WHERE iduniq1='$pE'");
foreach($consulta as $dato5)
{
    //echo $dato5["iduniq1"];
    //echo $dato5["fecha"];
    //echo $dato5["numfact"];
    //echo $dato5["cantitem"];
    //echo $dato5["monto"];
    //echo $pE;
    //echo $dato5["tmonto"];
    
};

// calculo ventas totales de la generacion 2
$pF = $dato2["iduniq"];
$consulta= $conex->query("SELECT SUM(monto) AS tmonto  FROM facturas WHERE iduniq1='$pF'");
foreach($consulta as $dato6)
{
    //echo $dato6["iduniq1"];
    //echo $dato6["fecha"];
    //echo $dato6["numfact"];
    //echo $dato6["cantitem"];
    //echo $dato6["monto"];
    //echo $pF;
    //echo $dato6["tmonto"];
    
};

// calculo ventas totales de la generacion 3
$pG = $dato3["iduniq"];
$consulta= $conex->query("SELECT SUM(monto) AS tmonto  FROM facturas WHERE iduniq1='$pG'");
foreach($consulta as $dato7)
{
    //echo $dato7["iduniq1"];
    //echo $dato7["fecha"];
    //echo $dato7["numfact"];
    //echo $dato7["cantitem"];
    //echo $dato7["monto"];
    //echo $pG;
    //echo $dato7["tmonto"];
    
};

// calculo ventas totales de la generacion 4
$pH = $dato4["iduniq"];
$consulta= $conex->query("SELECT SUM(monto) AS tmonto  FROM facturas WHERE iduniq1='$pH'");
foreach($consulta as $dato8)
{
    //echo $dato8["iduniq1"];
    //echo $dato8["fecha"];
    //echo $dato8["numfact"];
    //echo $dato8["cantitem"];
    //echo $dato8["monto"];
    //echo $pH;
    //echo $dato8["tmonto"];
    
};
//------------------------------------------------------------------FIN CALCULO DE VENTAS TOTALES

//------------------------------------------------------------------CALCULO DE COMISIONES TOTALES
// calculo comisiones totales de la generacion 1
$pI = $dato["iduniq"];
$consulta= $conex->query("SELECT (SUM(monto)/20) AS ttmonto  FROM facturas WHERE iduniq1='$pI'");
foreach($consulta as $dato9)
{
    //echo $dato9["iduniq1"];
    //echo $dato9["fecha"];
    //echo $dato9["numfact"];
    //echo $dato9["cantitem"];
    //echo $dato9["monto"];
    //echo $pI;
    //echo $dato9["ttmonto"];
    
};

// calculo comisiones totales de la generacion 2
$pJ = $dato2["iduniq"];
$consulta= $conex->query("SELECT (SUM(monto)/20) AS ttmonto  FROM facturas WHERE iduniq1='$pJ'");
foreach($consulta as $dato10)
{
    //echo $dato10["iduniq1"];
    //echo $dato10["fecha"];
    //echo $dato10["numfact"];
    //echo $dato10["cantitem"];
    //echo $dato10["monto"];
    //echo $pJ;
    //echo $dato10["tmonto"];
    
};

// calculo comisiones totales de la generacion 3
$pK = $dato3["iduniq"];
$consulta= $conex->query("SELECT (SUM(monto)/20) AS ttmonto  FROM facturas WHERE iduniq1='$pK'");
foreach($consulta as $dato11)
{
    //echo $dato11["iduniq1"];
    //echo $dato11["fecha"];
    //echo $dato11["numfact"];
    //echo $dato11["cantitem"];
    //echo $dato11["monto"];
    //echo $pK;
    //echo $dato11["tmonto"];
    
};

// calculo comisiones totales de la generacion 4
$pL = $dato4["iduniq"];
$consulta= $conex->query("SELECT (SUM(monto)/20) AS ttmonto  FROM facturas WHERE iduniq1='$pL'");
foreach($consulta as $dato12)
{
    //echo $dato12["iduniq1"];
    //echo $dato12["fecha"];
    //echo $dato12["numfact"];
    //echo $dato12["cantitem"];
    //echo $dato12["monto"];
    //echo $pL;
    //echo $dato12["tmonto"];
    
};
//--------------------------------------------------------------FIN CALCULO DE COMISIONES TOTALES

//------------------------------------------------------------------------CALCULO DE ULTIMA FECHA
// calculo fecha ultima compra de la generacion 1
$pM = $dato["iduniq"];
$consulta= $conex->query("SELECT fecha FROM facturas WHERE iduniq1='$pM' ORDER BY fecha ASC");
foreach($consulta as $dato13)
//{
    //echo $dato13["iduniq1"];
    //echo $dato13["fecha"];
    //echo $dato13["numfact"];
    //echo $dato13["cantitem"];
    //echo $dato13["monto"];
    //echo $pM;
    //echo $dato13["tmonto"];
//};
// calculo fecha ultima compra de la generacion 2
$pN = $dato2["iduniq"];
$consulta= $conex->query("SELECT fecha FROM facturas WHERE iduniq1='$pN' ORDER BY fecha ASC");
foreach($consulta as $dato14)
//{
    //echo $dato14["iduniq1"];
    //echo $dato14["fecha"];
    //echo $dato14["numfact"];
    //echo $dato14["cantitem"];
    //echo $dato14["monto"];
    //echo $pN;
    //echo $dato14["tmonto"];
//};
// calculo fecha ultima compra de la generacion 3
$pO = $dato3["iduniq"];
$consulta= $conex->query("SELECT fecha FROM facturas WHERE iduniq1='$pO' ORDER BY fecha ASC");
foreach($consulta as $dato15)
//{
    //echo $dato15["iduniq1"];
    //echo $dato15["fecha"];
    //echo $dato15["numfact"];
    //echo $dato15["cantitem"];
    //echo $dato15["monto"];
    //echo $pO;
    //echo $dato15["tmonto"];
//};
// calculo fecha ultima compra de la generacion 4
$pP = $dato3["iduniq"];
$consulta= $conex->query("SELECT fecha FROM facturas WHERE iduniq1='$pP' ORDER BY fecha ASC");
foreach($consulta as $dato16)
//{
    //echo $dato16["iduniq1"];
    //echo $dato16["fecha"];
    //echo $dato16["numfact"];
    //echo $dato16["cantitem"];
    //echo $dato16["monto"];
    //echo $pP;
    //echo $dato16["tmonto"];
//};
//---------------------------------------------------------------------FIN CALCULO DE ULTIMA FECHA
//------------------------------------------------------------------------CALCULO TOTAL VENTAS
$pQ = $dato["iduniq"];
$consulta= $conex->query("SELECT COUNT(*) numfact FROM facturas");
foreach($consulta as $dato17)
//------------------------------------------------------------------------CALCULO TOTAL VENTAS

//------------------------------------------------------------------------CALCULO TOTAl DISTRIBUIDORES
$pR = $dato["iduniq"];
$consulta= $conex->query("SELECT COUNT(*) usuario FROM usuarios");
foreach($consulta as $dato18)
//------------------------------------------------------------------------CALCULO TOTAL DISTRIBUIDORES

//------------------------------------------------------------------------CALCULO MONTO TOTAL VENTAS
$pS = $dato["iduniq"];
$consulta= $conex->query("SELECT SUM(monto) as tmonto FROM facturas");
foreach($consulta as $dato19)
//------------------------------------------------------------------------CALCULO MONTO TOTAL VENTAS

//------------------------------------------------------------------------CALCULO MONTO TOTAL VENTAS
$pT = $dato["iduniq"];
$consulta= $conex->query("SELECT (SUM(monto)/20) as tmonto FROM facturas");
foreach($consulta as $dato20)
//------------------------------------------------------------------------CALCULO MONTO TOTAL VENTAS

$servername = "db5000134437.hosting-data.io";
$username = "dbu48877";
$password = "Manager&01";

try {
    $conn = new PDO("mysql:host=$servername;dbname=neopil", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully".", user is ".$username."; el iduniq de usuario es ".$_SESSION["user_iduniq"]; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
$conex= new PDO("mysql:host=$servername;dbname=neopil", $username, $password);

if($conex->connect_errno){
    return $conex->connect_error;
}
else{
    //echo "Conectado";
}
?>
</br></br><P>Resumen de mi Red VERTICAL</P>
<table width="750" border="1">
  <tr>
    <th width="50" scope="col">&nbsp;</th>
    <th width="250" scope="col"><div align="center">NOMBRE Y APELLIDO</div></th>
    <th width="100" scope="col"><div align="center">ID</div></th>
    <th width="100" scope="col"><div align="center">VENTA</div></th>
    <th width="100" scope="col"><div align="center">COMISION</div></th>
    <th width="150" scope="col"><div align="center">ULTIMA VENTA</div></th>
  </tr>
  <tr>
    <th scope="row"><div align="center">GEN1</div></th>
    <td align="center"><?php echo $dato["nombre"]." ".$dato["apellido"];?></td>
    <td align="center"><?php echo $dato["iduniq"];?></td>
    <td align="center"><?php echo "$ ".$dato5["tmonto"];?></td>
    <td align="center"><?php echo "$ ".$dato9["ttmonto"];?></td>
    <td align="center"><?php echo $dato13["fecha"];?></td>
  </tr>
  <tr>
    <th scope="row"><div align="center">GEN2</div></th>
    <td align="center"><?php echo $dato2["nombre"]." ".$dato2["apellido"];?></td>
    <td align="center"><?php echo $dato2['iduniq'];?></td>
    <td align="center"><?php echo "$ ".$dato6["tmonto"];?></td>
    <td align="center"><?php echo "$ ".$dato10["ttmonto"];?></td>
    <td align="center"><?php echo $dato14["fecha"];?></td>
  </tr>
  <tr>
    <th scope="row"><div align="center">GEN3</div></th>
    <td align="center"><?php echo $dato3["nombre"]." ".$dato3["apellido"];?></td>
    <td align="center"><?php echo $dato3['iduniq'];?></td>
    <td align="center"><?php echo "$ ".$dato7["tmonto"];?></td>
    <td align="center"><?php echo "$ ".$dato11["ttmonto"];?></td>
    <td align="center"><?php echo $dato15["fecha"];?></td>
  </tr>
  <tr>
    <th scope="row"><div align="center">GEN4</div></th>
    <td align="center"><?php echo $dato4["nombre"]." ".$dato4["apellido"];?></td>
    <td align="center"><?php echo $dato4['iduniq'];?></td>
    <td align="center"><?php echo "$ ".$dato8["tmonto"];?></td>
    <td align="center"><?php echo "$ ".$dato12["ttmonto"];?></td>
    <td align="center"><?php echo $dato16["fecha"];?></td>
    
  </tr>
</table>
<?php 
//este es el calculo general de todo el sistema para el perfil de admin
?>
<?php
$servername = "db5000134437.hosting-data.io";
$username = "dbu48877";
$password = "Manager&01";

try {
    $conn = new PDO("mysql:host=$servername;dbname=myapp2", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully".", user is ".$username."; el iduniq de usuario es ".$_SESSION["user_iduniq"]; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
$conex= new PDO("mysql:host=$servername;dbname=myapp2", $username, $password);

if($conex->connect_errno){
    return $conex->connect_error;
}
else{
    //echo "Conectado";
}
?>
<table width="750" border="1">
  <tr>
    <th width="247" scope="col">Ventas Totales</th>
    <th width="140" scope="col"><?php $sumtotal = $dato5["tmonto"]+$dato6["tmonto"]+$dato7["tmonto"]+$dato8["tmonto"]; echo "$ ".$sumtotal;?></th>
    <th width="263" scope="col">Comsiones Totales</th>
    <th width="122" scope="col"><?php
$sumcomi = $dato9["ttmonto"]+$dato10["ttmonto"]+$dato11["ttmonto"]+$dato12["ttmonto"];
echo "$ ".$sumcomi;?></th>
  </tr>
</table>
<?php
$pA = $_SESSION["user_iduniq"];
$consulta= $conex->query("SELECT iduniq, nombre, apellido, email, phone, idrefer FROM usuarios where idrefer='$pA'");
foreach($consulta as $dato)
{
    //echo $dato["iduniq"];
    //echo $dato["nombre"];
    //echo $dato["apellido"];
    //echo $dato["email"];
    //echo $dato["phone"];
    //echo $dato["idrefer"];
};?>
</br></br><P>Todos en mi Red</P>
<table width="750" border="1">
	  <tr>
    <th width="247" scope="col">NUMERO DE VENTAS TOTALES</th>
    <th width="140" scope="col"><?php echo $dato17["numfact"];?></th>
    <th width="263" scope="col">CANTIDAD DE DISTRIBUIDORES GENERAL</th>
    <th width="122" scope="col"><?php echo $dato18["usuario"];?></th>
  </tr>
  <tr>
    <th width="247" scope="col">MONTO TOTAL DE VENTAS</th>
    <th width="140" scope="col"><?php echo $dato19["tmonto"];?></th>
    <th width="263" scope="col">CANTIDAD DE COMISIONES GENERAL</th>
    <th width="122" scope="col"><?php echo $dato20["tmonto"];?></th>
  </tr>
  <tr>
<?php 
// aqui comienza la tabla de asociados
?>
<table border="1" width="750">
        <tr>
                <th width="600" scope="col"><div align="center">NOMBRE Y APELLIDO</div></th>
    <th width="150" scope="col"><div align="center">ID</div></th>
        </tr>
    </table>
<?php
$consulta= $conex->query("SELECT * FROM usuarios order by iduniq desc");
foreach($consulta as $dato30)
{?>
    <table border="1" width="750">

        <tr>
            <td width="600" align="center"><?php echo $dato30["nombre"];?> <?php echo $dato30["apellido"];?></td><td width="150" align="center"><?php echo $dato30["iduniq"];?> </td>
        </tr>
    </table>
</body>
</html>