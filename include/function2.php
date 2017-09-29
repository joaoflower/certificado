<?php
	function fviewplancar($pCod_car, $pPln_est)
	{
		session_start();
		$vQuery = "Select pln_est, tip_sist from unapnet.plan ";
		$vQuery .= "where cod_car = '$pCod_car' and pln_est != ''";
		$cPlan = fQuery($vQuery);
		while($aPlan = $cPlan->fetch_array())
		{
		?>
			<option value='<?=$aPlan['pln_est']?>' <?=($aPlan['pln_est'] == $pPln_est?"Selected":"")?>><?=$aPlan['pln_est']?>-<?=$_SESSION["sTiposist{$aPlan['tip_sist']}"]?></option>			
		<?
		}
		$cPlan->close();
	}
	function fviewespecialplancar($pCod_car, $pPln_est, $pCod_esp)
	{
		session_start();
		$vQuery = "Select cod_esp, esp_nom from unapnet.especial ";
		$vQuery .= "where cod_car = '{$pCod_car}' and pln_est = '{$pPln_est}' and cod_esp != '' ";
		$vQuery .= "order by cod_esp";
		$cEspecial = fQuery($vQuery);
		while($aEspecial = $cEspecial->fetch_array())
		{
		?>
			<option value='<?=$aEspecial['cod_esp']?>' <?=($aEspecial['cod_esp'] == $pCod_esp?"Selected":"")?>><?=$aEspecial['cod_esp']?>-<?=$aEspecial['esp_nom']?></option>
		<?
		}
		$cEspecial->close();
	}
	
	function fviewespecialplancarcheck($pCod_car, $pPln_est, $pCod_esp)
	{
		session_start();
		$vQuery = "Select cod_esp, esp_nom from unapnet.especial ";
		$vQuery .= "where cod_car = '{$pCod_car}' and pln_est = '{$pPln_est}' and cod_esp != '' ";
		$vQuery .= "order by cod_esp";
		$cEspecial = fQuery($vQuery);
		while($aEspecial = $cEspecial->fetch_array())
		{
		?>
			<input name="rCod_esp<?=$aEspecial['cod_esp']?>" type="checkbox" class="check" value="<?=$aEspecial['cod_esp']?>" <?=($aEspecial['cod_esp'] == $pCod_esp?"checked":"")?> onclick="grd_checkespecial(this);"> <?=$aEspecial['cod_esp']?> - <?=$aEspecial['esp_nom']?> <br>
		<?
		}
		$cEspecial->close();
	}
	function fviewnivelplancarcheck($pCod_car, $pPln_est)
	{
		session_start();
		$vQuery = "Select distinct niv_est from unapnet.curso ";
		$vQuery .= "where cod_car = '{$pCod_car}' and pln_est = '{$pPln_est}' and niv_est != '' ";
		$vQuery .= "order by niv_est";
		$cNivel = fQuery($vQuery);
		while($aNivel = $cNivel->fetch_array())
		{
			$_SESSION["sEstumax_nsm"] = $aNivel['niv_est'];
			$_SESSION["sEstuniv_sem".$aNivel['niv_est']] = $aNivel['niv_est'];
		?>
			<input name="rNiv_sem<?=$aNivel['niv_est']?>" type="checkbox" class="check" value="<?=$aNivel['niv_est']?>" checked onclick="grd_checkniv_sem(this);"> <?=$aNivel['niv_est']?> - <?=$_SESSION["sNivel".$aNivel['niv_est']]?> <br>
		<?
		}
		$cNivel->close();
	}
	function fviewsemestreplancarcheck($pCod_car, $pPln_est)
	{
		session_start();
		$vQuery = "Select distinct sem_anu from unapnet.curso ";
		$vQuery .= "where cod_car = '{$pCod_car}' and pln_est = '{$pPln_est}' and sem_anu != '' ";
		$vQuery .= "order by sem_anu";
		$cSemestre = fQuery($vQuery);
		while($aSemestre = $cSemestre->fetch_array())
		{
			$_SESSION["sEstumax_nsm"] = $aSemestre['sem_anu'];
			$_SESSION["sEstuniv_sem".$aSemestre['sem_anu']] = $aSemestre['sem_anu'];
		?>
			<input name="rNiv_sem<?=$aSemestre['sem_anu']?>" type="checkbox" class="check" value="<?=$aSemestre['sem_anu']?>" checked onclick="grd_checkniv_sem(this);"> <?=$aSemestre['sem_anu']?> - <?=$_SESSION["sSemestre".$aSemestre['sem_anu']]?> <br>
		<?
		}
		$cSemestre->close();
	}
	function fviewnivel($pNiv_est)
	{
		session_start();
		?>
		<option value='' <?=($pNiv_est == ''?"Selected":"")?>>SIN NIVEL</option>
		<?
		$vQuery = "Select niv_est, niv_des from unapnet.nivel ";
		$vQuery .= "where niv_est != '' ";
		$cNivel = fQuery($vQuery);
		while($aNivel = $cNivel->fetch_array())
		{
		?>
			<option value='<?=$aNivel['niv_est']?>' <?=($aNivel['niv_est'] == $pNiv_est?"Selected":"")?>><?=$aNivel['niv_des']?></option>			
		<?
		}
		$cNivel->close();
	}
	function fviewsemestre($pSem_anu)
	{
		session_start();
		?>
		<option value='' <?=($pSem_anu == ''?"Selected":"")?>>SIN SEMESTRE</option>
		<?
		$vQuery = "Select sem_anu, sem_des from unapnet.semestre ";
		$vQuery .= "where sem_anu != '' ";
		$cSemestre = fQuery($vQuery);
		while($aSemestre = $cSemestre->fetch_array())
		{
		?>
			<option value='<?=$aSemestre['sem_anu']?>' <?=($aSemestre['sem_anu'] == $pSem_anu?"Selected":"")?>><?=$aSemestre['sem_des']?></option>			
		<?
		}
		$cSemestre->close();
	}
	function fviewperiodo($pPer_aca)
	{
		session_start();
		$vQuery = "Select per_aca, per_des from unapnet.periodo ";
		$vQuery .= "where per_aca != '' ";
		$cPeriodo = fQuery($vQuery);
		while($aPeriodo = $cPeriodo->fetch_array())
		{
		?>
			<option value='<?=$aPeriodo['per_aca']?>' <?=($aPeriodo['per_aca'] == $pPer_aca?"Selected":"")?>><?=$aPeriodo['per_des']?></option>			
		<?
		}
		$cPeriodo->close();
	}
	function fviewmodnot($pMod_not)
	{
		session_start();
		$vQuery = "Select mod_not, not_des from unapnet.modnot ";
		$vQuery .= "where mod_not != '' ";
		$cModnot = fQuery($vQuery);
		while($aModnot = $cModnot->fetch_array())
		{
		?>
			<option value='<?=$aModnot['mod_not']?>' <?=($aModnot['mod_not'] == $pMod_not?"Selected":"")?>><?=$aModnot['not_des']?></option>			
		<?
		}
		$cModnot->close();
	}
	function fviewano_aca($pAno_aca)
	{
		for($ii = '2008'; $ii >= '1999'; $ii--)
		{
		?>
			<option value='<?=$ii?>00' <?=($ii == $pAno_aca?"Selected":"")?>><?=$ii?>-UNICO</option>
			<option value='<?=$ii?>01' <?=($ii == $pAno_aca?"Selected":"")?>><?=$ii?>-SEMESTRE I</option>
			<option value='<?=$ii?>02' <?=($ii == $pAno_aca?"Selected":"")?>><?=$ii?>-SEMESTRE II</option>
			<option value='<?=$ii?>03' <?=($ii == $pAno_aca?"Selected":"")?>><?=$ii?>-VACACIONAL</option>			
			<option value='<?=$ii?>04' <?=($ii == $pAno_aca?"Selected":"")?>><?=$ii?>-ADICIONAL</option>
			<option value='<?=$ii?>06' <?=($ii == $pAno_aca?"Selected":"")?>><?=$ii?>-PROVICIONAL</option>
			<option value='<?=$ii?>07' <?=($ii == $pAno_aca?"Selected":"")?>><?=$ii?>-EXTENSION</option>
		<?
		}
	}
?>