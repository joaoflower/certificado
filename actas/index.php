<?php
	session_start();
	include "../include/function1.php";
	
	if(fsafetylogin())
	{
		$id_menu = 6;
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
<script language="JavaScript" src="../js/ggw3.js"></script>
<script language="JavaScript" src="../js/function.js"></script>
<script language="JavaScript" src="../js/actas.js"></script>
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
	  	<div class="dcelmenu"><a href="" onClick="clickemitidas(); return false;">Emitidas</a></div>				
		<div class="dcelmenu"><a href="" onClick="clickenregistro(); return false;">En Registro</a></div>
		<div class="dcelmenu"><a href="" onClick="clickencoordinacion(); return false;">En Coordinac.</a></div>
		<div class="dcelmenu"><a href="" onClick="clickrecepcionar(); return false;">Recepcionar</a></div>
	  </div>	
	  <div id="dsubmessage">Bienvenidos</div>
	</td>
    <td valign="top" id="tdsubcontent">
	  <div id="dsubcontent">Un@p.Net2</div>	</td>
  </tr>
</table>    
</div>

	<? include "../include/foot1.php"; ?>
</body>
</html>