<?php
	session_start();	
	session_unset();

	session_start();
	
	include "../include/function1.php";

	finit();

	$sUsercoo['errorl'] = FALSE;
	$sUsercoo['msnerror'] = '';
	
	header("Location:../index2.php");
?>

