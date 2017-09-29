<?php
	session_start();
	include "../include/function1.php";
	
	if(fsafetylogin())
	{
		$id_menu = 1;
	}
	else
	{
		header("Location:../index.php");
	}
	
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="../css/main.css">
<title>Un@p.Net2 - Certificados de Estudios</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" src="../js/ajax.js"></script>
<script language="JavaScript">
	<? include "../include/script1.php"; ?>
	function enfocar()
	{
	
	}
</script>

</head>

<body onLoad="enfocar();">
	<? include "../include/header1.php"; ?>
	<? include "../include/menu1.php"; ?>
	
<div id="dcontent">
<table width="770" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" id="tcontent">
  <tr id="trcontent">
    <td width="90" valign="top" id="tdsubmenu">
	  <div id="dsubmenu">
	  	<div class="dcelmenu"><a href="../include/change.php">Cambiar Usua. </a></div>
		<div class="dcelmenu"><a href="#">Contrase&ntilde;a</a></div>
		<div class="dcelmenu"><a href="../include/cerrar.php">Salir</a></div>
	  </div>	
	  <div id="dsubmessage">Bienvenidos</div>
	</td>
    <td valign="top" id="tdsubcontent">
	  <div id="dsubcontent">Bienvenido a Un@p.Net2 <br>
	  <?=$_SESSION["sCarrera23"]?>
	  </div></td>
  </tr>
</table>    
</div>

	<? include "../include/foot1.php"; ?>
</body>
</html>