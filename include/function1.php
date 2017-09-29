<?php
	function finit()
	{
		session_start();		
		$_SESSION["sHost"] = '10.1.1.134';
		$_SESSION["sUser"] = 'coordinador';
		$_SESSION["sPasswd"] = '1433b02926dfe56b';
	}
	function fpassword($pPasswd)
	{
		$vQuery = "Select password('$pPasswd') as passwd";
		$cPasswd = fQuery($vQuery);
		if($aPasswd = $cPasswd->fetch_array())
		{
			$cPasswd->close();
			return $aPasswd['passwd'];
		}
	}
	function fold_password($pPasswd)
	{
		$vQuery = "Select old_password('$pPasswd') as passwd";
		$cPasswd = fQuery($vQuery);
		if($aPasswd = $cPasswd->fetch_array())
		{
			$cPasswd->close();
			return $aPasswd['passwd'];
		}
	}
	function fsafetylogin()
	{
		session_start();
		if($_SESSION['sSafetylogin'] == '*25740E18E08CC91F492F1B38E5413E1B85E32A01')
			return TRUE;
		else
			return FALSE;
	}
	
	//-----------------------------------------------------
	function fFecha()
	{
		$vQuery = "Select now() as fch_mat";
		$cFecha = fQuery($vQuery);
		if($aFecha = $cFecha->fetch_array() )
			return $aFecha['fch_mat'];
	}
	function fFechastd($pFecha)
	{
		$vFecha = $pFecha;
		$vAmpm = "";
		$vReturn = substr($vFecha, 8, 2)."/".substr($vFecha, 5, 2)."/".substr($vFecha, 0, 4)." ";
		if(substr($vFecha, 11, 2) == '00')
		{
			$vHora = '12';	$vAmpm = 'AM';
		}
		if(substr($vFecha, 11, 2) >= '01' and substr($vFecha, 11, 2) <= '11')
		{
			$vHora = substr($vFecha, 11, 2);	$vAmpm = 'AM';
		}
		if(substr($vFecha, 11, 2) == '12')
		{
			$vHora = substr($vFecha, 11, 2);	$vAmpm = 'PM';
		}
		if(substr($vFecha, 11, 2) >= '13' and substr($vFecha, 11, 2) <= '23')
		{
			$vHora = substr($vFecha, 11, 2) - 12;
			$vHora = ((strlen((string)$vHora) == 1)?'0':'').(string)$vHora;
			$vAmpm = 'PM';
		}
		
		$vReturn .= $vHora.":".substr($vFecha, 14, 2).":".substr($vFecha, 17, 2)." ".$vAmpm;
		return $vReturn;
	}
	
	function fFechad($pFecha)
	{
		$vFecha = $pFecha;
		$vReturn = substr($vFecha, 8, 2)."/".substr($vFecha, 5, 2)."/".substr($vFecha, 0, 4);
		return $vReturn;
	}
	function fFechamy($pFecha)
	{
		$vFecha = $pFecha;
		$vReturn = substr($vFecha, 6, 4)."-".substr($vFecha, 3, 2)."-".substr($vFecha, 0, 2);
		return $vReturn;
	}
?>