<?php
	session_start();	
	session_unset();

	session_start();
	
	include "include/function1.php";

/*	session_register("sUsercoo");
	session_register("sConedb");*/
		
	finit();

	$_SESSION["sError"] = FALSE;
	$_SESSION["sMessage"] = "";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Un@p.Net2</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
<!--

	function cerrar()
	{
		window.open('index2.php','unapnet2certi', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=640,height=480'); 
		var ventana = window.self;
		ventana.opener = window.self;
		parent.close();
	}
//-->
</script>
</head>
<body onLoad="cerrar();">
</body>
</html>
