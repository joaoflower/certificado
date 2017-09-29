<?php
	function fInupde($pQuery)
	{
		session_start();
		$xSerdata = new mysqli($_SESSION["sHost"], $_SESSION["sUser"], $_SESSION["sPasswd"]);
		$xSerdata->query('BEGIN');
		$cResult = $xSerdata->query($pQuery);
		if ($cResult) $xSerdata->query('COMMIT');
		else $xSerdata->query('ROLLBACK');
		$xSerdata->close();
		return $cResult;
	}
	
	function fQuery($pQuery)
	{
		session_start();
		$xSerdata = new mysqli($_SESSION["sHost"], $_SESSION["sUser"], $_SESSION["sPasswd"]);
		return $xSerdata->query($pQuery);
	}
	function fCountq($pQuery)
	{
		session_start();
		$xSerdata = new mysqli($_SESSION["sHost"], $_SESSION["sUser"], $_SESSION["sPasswd"]);
		$cQuery = $xSerdata->query($pQuery);
		return $cQuery->num_rows;
	}
?>