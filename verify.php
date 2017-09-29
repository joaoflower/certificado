<?php
	session_start();
	include "include/function1.php";
	include "include/funcsql1.php";	

	$_SESSION['sUserlogin'] = $_POST['rLogin'];
	$vPasswd = $_POST['rPasswd'];
	
	if(!(empty($_SESSION['sUserlogin']) or empty($vPasswd)))
	{
		$bUsucoo = FALSE;
		$bPasswd = FALSE;

		$vQuery = "Select passwd, cod_usu, niv_usu, paterno, materno, nombres ";		
		$vQuery .= "from unapnet.usucoo where login = '{$_SESSION['sUserlogin']}' and niv_usu = '06'";
		$cUsucoo = fQuery($vQuery);
		if($aUsucoo = $cUsucoo->fetch_array())
		{
			$bUsucoo = TRUE;
			if($aUsucoo['passwd'] === fpassword($vPasswd))
			{
				if($aUsucoo['niv_usu'] == '06')
				{
					$bPasswd = TRUE;
					$vPasswd = "";
				}
			}
			
			if($bPasswd)
			{				
				$sUsercoo = "";
				$vPasswd = "";
				$_SESSION['sUsercod_usu'] = $aUsucoo['cod_usu'];
				$_SESSION['sUserniv_usu'] = $aUsucoo['niv_usu'];
				$_SESSION['sUserpaterno'] = $aUsucoo['paterno'];
				$_SESSION['sUsermaterno'] = $aUsucoo['materno'];
				$_SESSION['sUsernombres'] = $aUsucoo['nombres'];
				$_SESSION['sUserip'] = $_SERVER['REMOTE_ADDR'];

				$vQuery = "Select cod_mod from unapnet.accesoreg where cod_usu = '{$_SESSION['sUsercod_usu']}' ";
				$cAcceso = fQuery($vQuery);
				if($aAcceso = $cAcceso->fetch_array())
				{
					//01 - Certificado
					//02 - Grados
					//03 - Jefatura
					$_SESSION['sUsercod_mod'] = $aAcceso['cod_mod'];
				}
			}
		}
		$cUsucoo->close();
		
		if($bUsucoo)
		{
			if($bPasswd)
			{
				$_SESSION['sSafetylogin'] = '*25740E18E08CC91F492F1B38E5413E1B85E32A01';
				
				//---------------------------------------------------
				$vQuery = "Select cod_car, car_des from unapnet.carrera where cod_car <> ''";
				$cCarrera = fQuery($vQuery);
				while($aCarrera = $cCarrera->fetch_array())
					$_SESSION["sCarrera".$aCarrera['cod_car']] = $aCarrera['car_des'];
				$cCarrera->close();
				
				//---------------------------------------------------
				$vQuery = "Select per_aca, per_des, abr_per from unapnet.periodo where per_aca <> ''";
				$cPeriodo = fQuery($vQuery);
				while($aPeriodo = $cPeriodo->fetch_array())
				{
					$_SESSION["sPeriodo".$aPeriodo['per_aca']."per_des"] = $aPeriodo['per_des'];
					$_SESSION["sPeriodo".$aPeriodo['per_aca']."abr_per"] = $aPeriodo['abr_per'];
				}
				$cPeriodo->close();
				
				//---------------------------------------------------
				$vQuery = "Select con_est, con_des from unapnet.condestu where con_est <> ''";
				$cCondestu = fQuery($vQuery);
				while($aCondestu = $cCondestu->fetch_array())
					$_SESSION["sCondestu".$aCondestu['con_est']] = $aCondestu['con_des'];
				$cCondestu->close();
				
				//---------------------------------------------------
				$vQuery = "Select tip_sist, sis_des from unapnet.tiposist where tip_sist <> ''";
				$cTiposist = fQuery($vQuery);
				while($aTiposist = $cTiposist->fetch_array())
					$_SESSION["sTiposist".$aTiposist['tip_sist']] = $aTiposist['sis_des'];
				$cTiposist->close();
				
				//---------------------------------------------------
				$vQuery = "Select cod_fac, fac_des from unapnet.facultad where cod_fac <> ''";
				$cFacultad = fQuery($vQuery);
				while($aFacultad = $cFacultad->fetch_array())
					$_SESSION["sFacultad".$aFacultad['cod_fac']] = $aFacultad['fac_des'];
				$cFacultad->close();
				
				//-------------------------------------------------------------------------
				$vQuery = "Select niv_est, niv_des from unapnet.nivel where niv_est <> ''";
				$cNivel = fQuery($vQuery);
				while($aNivel = $cNivel->fetch_array())
					$_SESSION["sNivel".$aNivel['niv_est']] = $aNivel['niv_des'];
				$cNivel->close();
				
				//-------------------------------------------------------------------------
				$vQuery = "Select sem_anu, sem_des from unapnet.semestre where sem_anu <> ''";
				$cSemestre = fQuery($vQuery);
				while($aSemestre = $cSemestre->fetch_array())
					$_SESSION["sSemestre".$aSemestre['sem_anu']] = $aSemestre['sem_des'];
				$cSemestre->close();
				
				//-------------------------------------------------------------------------
				$vQuery = "Select sec_gru, sec_des from unapnet.grupo where sec_gru <> ''";
				$cGrupo = fQuery($vQuery);
				while($aGrupo = $cGrupo->fetch_array())
					$_SESSION["sGrupo".$aGrupo['sec_gru']] = $aGrupo['sec_des'];
				$cGrupo->close();
				
				//-------------------------------------------------------------------------
				$vQuery = "Select mod_mat, mod_des, mod_not from unapnet.modmat where mod_mat <> ''";
				$cModmat = fQuery($vQuery);
				while($aModmat = $cModmat->fetch_array())
				{
					$_SESSION["sModmat".$aModmat['mod_mat']."mod_des"] = $aModmat['mod_des'];
					$_SESSION["sModmat".$aModmat['mod_mat']."mod_not"] = $aModmat['mod_not'];
				}
				$cModmat->close();
				
				//-------------------------------------------------------------------------
				$vQuery = "Select mod_not, not_des from unapnet.modnot where mod_not <> ''";
				$cModnot = fQuery($vQuery);
				while($aModnot = $cModnot->fetch_array())
					$_SESSION["sModnot".$aModnot['mod_not']] = $aModnot['not_des'];
				$cModnot->close();
				
				//-------------------------------------------------------------------------
				$vQuery = "Select cod_car, pln_est, tip_sist from unapnet.plan where pln_est <> ''";
				$cPlan = fQuery($vQuery);
				while($aPlan = $cPlan->fetch_array())
					$_SESSION["sPlan".$aPlan['cod_car'].$aPlan['pln_est']] = $aPlan['tip_sist'];
				$cPlan->close();
				//---------------------------------------------------
				$_SESSION["sNum0"] = 'CERO';
				$_SESSION["sNum1"] = 'UNO';
				$_SESSION["sNum2"] = 'DOS';
				$_SESSION["sNum3"] = 'TRES';
				$_SESSION["sNum4"] = 'CUATRO';
				$_SESSION["sNum5"] = 'CINCO';
				$_SESSION["sNum6"] = 'SEIS';
				$_SESSION["sNum7"] = 'SIETE';
				$_SESSION["sNum8"] = 'OCHO';
				$_SESSION["sNum9"] = 'NUEVE';
				$_SESSION["sNum10"] = 'DIEZ';
				$_SESSION["sNum11"] = 'ONCE';
				$_SESSION["sNum12"] = 'DOCE';
				$_SESSION["sNum13"] = 'TRECE';
				$_SESSION["sNum14"] = 'CATORCE';
				$_SESSION["sNum15"] = 'QUINCE';
				$_SESSION["sNum16"] = 'DIECISEIS';
				$_SESSION["sNum17"] = 'DIECISIETE';
				$_SESSION["sNum18"] = 'DIECIOCHO';
				$_SESSION["sNum19"] = 'DIECINUEVE';
				$_SESSION["sNum20"] = 'VEINTE';
				
				header("Location:administracion/index.php");
			}
			else
			{
				$_SESSION["sError"] = TRUE;
				$_SESSION["sMessage"] = 'ERROR, EL USUARIO O LA CONTRASEÑA ES INCORRECTA';
				header("Location:index2.php");				
			}		
		}
		else
		{
			$_SESSION["sError"] = TRUE;
			$_SESSION["sMessage"] = 'ERROR, EL USUARIO O LA CONTRASEÑA ES INCORRECTA';
			header("Location:index2.php");
		}
	}
	else
		header("Location:index.php");		
?>