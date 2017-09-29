
<?php
	session_start();
	include "../include/function1.php";
	include "../include/funcsql1.php";
	if(fsafetylogin())
	{
		$tActai = "uaraimgs.img".$_SESSION["sCod_car"].$_GET['rAno_aca'];			
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
<script language="JavaScript" src="../js/notas.js"></script>
<script language="JavaScript">
	<? include "../include/script1.php"; ?>
	function enfocar()
	{
	
	}
</script>

</head>

<body onLoad="enfocar();">
	<? include "../include/header1.php"; ?>
<?
	$vQuery = "select nom_arc from $tActai where cod_act = '{$_GET['rCod_act']}' order by nom_arc";
	$cActai = fQuery($vQuery);
	while($aActai = $cActai->fetch_array())
	{
		$vNom_arc = trim($aActai['nom_arc']);
?>
	<img src ="http://unapvirtual.unap.edu.pe/0bd33c3505aee817/car<?=$_SESSION["sCod_car"]?>/<?=$_GET['rAno_aca']?>/<?=$vNom_arc?>.gif"  border="0" />
<?
	}
	$cActai->close();
?>
	<? include "../include/foot1.php"; ?>
</body>
</html>