<STYLE type=text/css>
@import url( ../css/main.css );
</STYLE>
<?php
	session_start();
	include "../include/function1.php";
	include "../include/function2.php";
	include "../include/funcsql1.php";
	if(fsafetylogin())
	{	
		$vAno_aca = $_POST['rAno_aca'];
		$vPer_aca = $_POST['rPer_aca'];
		$vMod_not = $_POST['rMod_not'];
		$vNot_cur = $_POST['rNot_cur'];
		$vCur_con = $_POST['rCur_con'];

		$tNota = "unapnet.nota{$_SESSION['sEstucod_car']}";
		
		if($_SESSION['sEstutype'] == 'Update')
		{		
			//-------------LOG----------------------
/*			$tLognota = "unapnet.lognota{$sUsercoo['ano_aca']}";
			$vQuery = "Insert into $tLognota (num_mat, cod_car, ano_aca, per_aca, pln_est, cod_cur, ";
			$vQuery .= "mod_not, not_cur, cod_usu, cod_log, fch_log, dir_ip) values " ;
			$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '{$sEstudia['ano_aca']}', ";
			$vQuery .= "'{$sEstudia['per_aca']}', '{$sEstudia['pln_est']}', '{$sEstudia['cod_cur']}', ";
			$vQuery .= "'{$sEstudia['mod_not']}', '{$sEstudia['not_cur']}',  ";
			$vQuery .= "'{$sUsercoo['cod_usu']}', '02', now(), '{$sUsercoo['ip']}' ) ";
			$bResult = fInupde($vQuery);*/
			//--------------------------------------
			
			$vQuery = "Update $tNota set ano_aca = '$vAno_aca', per_aca = '$vPer_aca', mod_not = '$vMod_not', ";
			$vQuery .= "not_cur = '$vNot_cur', cur_con = '$vCur_con' ";
			$vQuery .= "where num_mat = '{$_SESSION['sEstunum_mat']}' and ";
			$vQuery .= "cod_car = '{$_SESSION['sEstucod_car']}' and pln_est = '{$_SESSION['sEstupln_est']}' and ";
			$vQuery .= "cod_cur = '{$_SESSION['sCursocod_cur']}' and mod_not = '{$_SESSION['sCursomod_not']}' and ";
			$vQuery .= "ano_aca = '{$_SESSION['sCursoano_aca']}' and per_aca = '{$_SESSION['sCursoper_aca']}' ";			
		}
		elseif($_SESSION['sEstutype'] == 'Insert') 
		{
			//-------------LOG----------------------
/*			$tLognota = "unapnet.lognota{$sUsercoo['ano_aca']}";
			$vQuery = "Insert into $tLognota (num_mat, cod_car, ano_aca, per_aca, pln_est, cod_cur, ";
			$vQuery .= "mod_not, not_cur, cod_usu, cod_log, fch_log, dir_ip) values " ;
			$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '$vAno_aca', ";
			$vQuery .= "'$vPer_aca', '{$sEstudia['pln_est']}', '{$sEstudia['cod_cur']}', ";
			$vQuery .= "'$vMod_not', '$vNot_cur',  ";
			$vQuery .= "'{$sUsercoo['cod_usu']}', '01', now(), '{$sUsercoo['ip']}' ) ";
			$bResult = fInupde($vQuery);*/
			//--------------------------------------
			
			$vQuery = "Insert into $tNota (num_mat, cod_car, pln_est, cod_cur, mod_not, ano_aca, per_aca, ";
			$vQuery .= "not_cur, fch_not, cur_con) ";
			$vQuery .= "values ('{$_SESSION['sEstunum_mat']}', '{$_SESSION['sEstucod_car']}', ";
			$vQuery .= "'{$_SESSION['sEstupln_est']}', '{$_SESSION['sCursocod_cur']}', '$vMod_not', ";
			$vQuery .= "'$vAno_aca', '$vPer_aca', '$vNot_cur', now(), '$vCur_con')";
		}

		$cResult = fInupde($vQuery);
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

<?
	if(fsafetylogin())
	{
		$bDatos = FALSE;
		$tNota = "unapnet.nota{$_SESSION['sEstucod_car']}";
		$sNotas = "";
		$sEspecial = "";
		$vEspecial = "";
		
		if(($_SESSION["sEstucod_car"] >= '01' and $_SESSION["sEstucod_car"] != '19' and $_SESSION["sEstucod_car"] <= '36') or 
			$_SESSION["sEstucod_car"] == '56' or $_SESSION["sEstucod_car"] == '65' or $_SESSION["sEstucod_car"] == '66')
		{		
			if(!empty($_SESSION["sEstunum_mat"]) and !empty($_SESSION["sEstucod_car"]) and !empty($_SESSION["sEstupln_est"]) and 
				(!empty($_SESSION["sEstucod_esp"]) or !empty($_SESSION["sEstucod_esp2"])))
			{
				//---------- NOmbre de especialidad ---------------------------------------------------------------
				$vQuery = "Select cod_esp, esp_nom from unapnet.especial ";
				$vQuery .= "where cod_car = '{$_SESSION['sEstucod_car']}' and pln_est = '{$_SESSION['sEstupln_est']}' and ";
				 $vQuery .= "cod_esp <> '' order by cod_esp";
				$cEspecial = fQuery($vQuery);
				while($aEspecial = $cEspecial->fetch_array())
				{
					$sEspecial[$aEspecial['cod_esp']] = $aEspecial['esp_nom'];
	
					if($_SESSION["sEstucod_esp"] == $aEspecial['cod_esp'])
					{
						if(!empty($vEspecial))
							$vEspecial .= '<br>&nbsp;';
						$vEspecial .= $aEspecial['cod_esp'].' - '.$aEspecial['esp_nom'];
						$_SESSION["sEstunom_esp"] = $aEspecial['esp_nom'];
					}
					if($_SESSION["sEstucod_esp2"] == $aEspecial['cod_esp'])
					{
						if(!empty($vEspecial))
							$vEspecial .= '<br>&nbsp;';
						$vEspecial .= $aEspecial['cod_esp'].' - '.$aEspecial['esp_nom'];
					}	
				}
				$cEspecial->close();
								
				//------------------------Notas aprobadas-------------------------------------------------				
				$vQuery = "Select no.cod_cur, no.not_cur, no.mod_not, no.cod_act, no.ano_aca, no.per_aca, no.fch_reg, no.cur_con ";
				$vQuery .= "from $tNota no ";
				$vQuery .= "where no.num_mat = '{$_SESSION['sEstunum_mat']}' and no.pln_est = '{$_SESSION['sEstupln_est']}' and ";
				$vQuery .= "no.not_cur > 10 order by cod_cur ";
				$cNotas = fQuery($vQuery);
				while($aNotas = $cNotas->fetch_array())
				{ 
					$sNotas[$aNotas['cod_cur']]['not_cur'] = $aNotas['not_cur'];
					$sNotas[$aNotas['cod_cur']]['mod_not'] = $aNotas['mod_not'];
					$sNotas[$aNotas['cod_cur']]['cod_act'] = $aNotas['cod_act'];
					$sNotas[$aNotas['cod_cur']]['ano_aca'] = $aNotas['ano_aca'];
					$sNotas[$aNotas['cod_cur']]['per_aca'] = $aNotas['per_aca'];
					$sNotas[$aNotas['cod_cur']]['fch_reg'] = $aNotas['fch_reg'];
					$sNotas[$aNotas['cod_cur']]['cur_con'] = $aNotas['cur_con'];
				}
				$cNotas->close();
				$_SESSION["sEstusqlnota"] = $vQuery;
				
				$bDatos = TRUE;
				//---------------------------------------------------------------------
			}	
		}
	}
	else
	{
		header("Location:../index.php");
	}	

	$vCont = 1;
	if($bDatos)
	{
?>

	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
	  <tr>
		<th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
		<th align="center" background="../images/ventana_r1_c2.jpg" >[<?=$_SESSION["sEstunum_mat"]?>] - [<?=$_SESSION["sEstupaterno"]?> <?=$_SESSION["sEstumaterno"]?>, <?=$_SESSION["sEstunombres"]?>] - [<?=$_SESSION["sCarrera".$_SESSION["sEstucod_car"]]?>]</th>
		<th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
	  </tr>
	  <tr>
		<td background="../images/ventana_r2_c1.jpg"></td>
		<td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			
			<tr>
              <td width="100" class="wordder">Plan de Estudios : </td>
              <td width="450" class="tdcampo">&nbsp;<?=$_SESSION["sEstupln_est"]?> - <?=$_SESSION["sTiposist".$_SESSION["sEstutip_sist"]]?></td>
            </tr>
			<tr>
			  <td class="wordder">Menci&oacute;n / Espec. : </td>
			  <td class="tdcampo" id="xEspecial">&nbsp;<?=$vEspecial?></td>
		    </tr>
			
								
          </table>		
		<table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
			<tr>
			  <th width="25" scope="col">C&oacute;d.</th>
			  <th width="300" scope="col">Curso</th>			  
			  <th width="30" scope="col">Crd</th>
			  <th width="60" scope="col">A-P</th>
			  <th width="60" scope="col">Fecha</th>
			  <th width="30" scope="col">Nota</th>
		      <th width="16" scope="col">&nbsp;</th>
			</tr>
	<? 	
		$vTip_cur = "";	
		$vCod_esp = "";
		$vNiv_est = "";
		$vSem_anu = "";
		
		$vSub_tit = "";
		$vTemp = "";
		$vNiv_sem = "";
		$vNiv_semt = "";
		
		//-----------------Cusos del plan de estudios-----------------------
/*		$vQuery = "Select cu.cod_cur, cu.nom_ofi, cu.cod_esp, cu.crd_cur, cu.tip_cur, cu.niv_est, cu.sem_anu ";
		$vQuery .= "from unapnet.curso cu left join unapnet.tipcur tc on cu.tip_cur = tc.tip_cur ";
		$vQuery .= "where cu.cod_car = '{$_SESSION['sEstucod_car']}' and cu.pln_est = '{$_SESSION['sEstupln_est']}' and ";
		$vQuery .= "cu.con_cur = '1' and (cod_esp = '00' or ";
		
		if(!empty($_SESSION["sEstucod_esp"]))
			$vQuery .= "cu.cod_esp = '{$_SESSION['sEstucod_esp']}' ";
		if(!empty($_SESSION["sEstucod_esp2"]))
		{
			if(!empty($_SESSION["sEstucod_esp"]))
				$vQuery .= "or ";	
			$vQuery .= "cu.cod_esp = '{$_SESSION['sEstucod_esp2']}' ";				
		}
		$vQuery .= ") and (";		
		for($vNiv_sem = '01'; $vNiv_sem <= $_SESSION["sEstumax_nsm"]; $vNiv_sem++)
		{
			$vNiv_semt = (strlen($vNiv_sem) == 1?"0":"").$vNiv_sem;
			if(!empty($_SESSION["sEstuniv_sem{$vNiv_semt}"]))
			{
				if(!empty($vTemp))
					$vTemp .= "or ";
				if($_SESSION["sEstutip_sist"] == '1')
					$vTemp .= "cu.niv_est = '{$vNiv_semt}' ";
				elseif($_SESSION["sEstutip_sist"] == '2')
					$vTemp .= "cu.sem_anu = '{$vNiv_semt}' ";
			}
		}
		$vQuery .= $vTemp;
		
		$vQuery .= ") order by niv_est, sem_anu, ord_tip, cod_esp, cod_cur ";*/
		
		//---------------------------------------------
		$vQuery = "(Select cu.cod_cur, cu.nom_ofi, cu.cod_esp, cu.crd_cur, cu.tip_cur, cu.niv_est, cu.sem_anu, tc.ord_tip ";
		$vQuery .= "from unapnet.curso cu left join unapnet.tipcur tc on cu.tip_cur = tc.tip_cur ";
		$vQuery .= "where cu.cod_car = '{$_SESSION['sEstucod_car']}' and cu.pln_est = '{$_SESSION['sEstupln_est']}' and ";
		$vQuery .= "cu.con_cur = '1' and (cod_esp = '00' or ";
		
		if(!empty($_SESSION["sEstucod_esp"]))
			$vQuery .= "cu.cod_esp = '{$_SESSION['sEstucod_esp']}' ";
		if(!empty($_SESSION["sEstucod_esp2"]))
		{
			if(!empty($_SESSION["sEstucod_esp"]))
				$vQuery .= "or ";	
			$vQuery .= "cu.cod_esp = '{$_SESSION['sEstucod_esp2']}' ";				
		}
		$vQuery .= ") and (";		
		for($vNiv_sem = '01'; $vNiv_sem <= $_SESSION["sEstumax_nsm"]; $vNiv_sem++)
		{
			$vNiv_semt = (strlen($vNiv_sem) == 1?"0":"").$vNiv_sem;
			if(!empty($_SESSION["sEstuniv_sem{$vNiv_semt}"]))
			{
				if(!empty($vTemp))
					$vTemp .= "or ";
				if($_SESSION["sEstutip_sist"] == '1')
					$vTemp .= "cu.niv_est = '{$vNiv_semt}' ";
				elseif($_SESSION["sEstutip_sist"] == '2')
					$vTemp .= "cu.sem_anu = '{$vNiv_semt}' ";
			}
		}
		$vQuery .= $vTemp;
		
		$vTemp = "";
		$vQuery .= ") ) union ";
		$vQuery .= "(Select distinct cu.cod_cur, cu.nom_ofi, cu.cod_esp, cu.crd_cur, cu.tip_cur, ";
		$vQuery .= "cu.niv_est, cu.sem_anu, tc.ord_tip from $tNota no left join unapnet.curso cu on ";
		$vQuery .= "no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur, unapnet.tipcur tc ";
		$vQuery .= "where no.num_mat = '{$_SESSION['sEstunum_mat']}' and no.pln_est = '{$_SESSION['sEstupln_est']}' and ";
		$vQuery .= "cu.con_cur = '1' and (";
		for($vNiv_sem = '01'; $vNiv_sem <= $_SESSION["sEstumax_nsm"]; $vNiv_sem++)
		{
			$vNiv_semt = (strlen($vNiv_sem) == 1?"0":"").$vNiv_sem;
			if(!empty($_SESSION["sEstuniv_sem{$vNiv_semt}"]))
			{
				if(!empty($vTemp))
					$vTemp .= "or ";
				if($_SESSION["sEstutip_sist"] == '1')
					$vTemp .= "cu.niv_est = '{$vNiv_semt}' ";
				elseif($_SESSION["sEstutip_sist"] == '2')
					$vTemp .= "cu.sem_anu = '{$vNiv_semt}' ";
			}
		}
		$vQuery .= $vTemp;
		$vQuery .= ") and cu.tip_cur = tc.tip_cur ) order by niv_est, sem_anu, ord_tip, cod_esp, cod_cur ";
		$_SESSION["sEstusqlcurso"] = $vQuery;
		//---------------------------------------------
				
		$cCurso = fQuery($vQuery);
		while($aCurso = $cCurso->fetch_array())
		{ 
		
			if($aCurso['niv_est'] != $vNiv_est or $aCurso['sem_anu'] != $vSem_anu)
			{
				$vNiv_est = $aCurso['niv_est'];
				$vSem_anu = $aCurso['sem_anu'];
				
				$vTip_cur = "";	
				$vCod_esp = "";
		?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
			  <td class="wordcen">&nbsp;</td>
			  <td colspan="6" class="wordizqb">NIVEL: <?=$_SESSION["sNivel{$vNiv_est}"]?> -SEMESTRE: <?=$_SESSION["sSemestre{$vSem_anu}"]?></td>
		  </tr>
		  <?
			}
			
			if(!($aCurso['tip_cur'] == $vTip_cur))
			{
				$vSub_tit = "";
				$vTip_cur = $aCurso['tip_cur'];
				switch($vTip_cur)
				{
					case '02': $vSub_tit = "ELECTIVO: ";
						if($aCurso['cod_esp'] == '00')	$vSub_tit .= ucwords(strtolower($sAreaca['02']));
						else $vSub_tit .= ucwords(strtolower($sAreaca['03']));
						break;
					case '03': $vSub_tit = "OPTATIVO: " .ucwords(strtolower($sAreaca['03']));
						break;
					case '04': $vSub_tit = "PRÁCTICAS: " .ucwords(strtolower($sAreaca['03']));
						break;
				}
				if(!empty($vSub_tit))
				{	
				?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
			  <td class="wordcen">&nbsp;</td>
			  <td colspan="6" class="wordizqb">&nbsp;<?=$vSub_tit?></td>
		  </tr>
		  <?	
				}
			}
			if($aCurso['cod_esp'] != $vCod_esp)
			{
				$vSub_tit = "";
				$vCod_esp = $aCurso['cod_esp'];
				if($aCurso['cod_esp'] != '00')
				{	
			?>
		  
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
			  <td class="wordcen">&nbsp;</td>
			  <td colspan="6" class="wordizqb">&nbsp;Menci&oacute;n: <?=ucwords(strtolower($sEspecial[$aCurso['cod_esp']]))?></td>
		  </tr>
		  	<?
				}
			}
			$vNom_cur = ucwords(strtolower($aCurso['nom_ofi']));
			if($sNotas[$aCurso['cod_cur']]['mod_not'] == '04')
				$vNom_cur .= " (Por:".ucwords(strtolower($sNotas[$aCurso['cod_cur']]['cur_con'])).")";
			?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
			  <td class="wordcen"><?=$aCurso['cod_cur']?></td>
			  <td width="250" class="wordizq">&nbsp;<?=$vNom_cur?>&nbsp;</td>
			  <td class="wordder"><?=$aCurso['crd_cur']?>&nbsp;</td>
			  <td class="wordcen">&nbsp;<?=$sNotas[$aCurso['cod_cur']]['ano_aca']?><?=($sNotas[$aCurso['cod_cur']]['per_aca'] != '00'?("-".$_SESSION["sPeriodo".$sNotas[$aCurso['cod_cur']]['per_aca']."abr_per"]):"")?></td>
			  <td class="wordcen"><?=fFechad($sNotas[$aCurso['cod_cur']]['fch_reg'])?></td>
  			  <td class="wordder"><span class ="<?	if($sNotas[$aCurso['cod_cur']]['not_cur'] < 11) echo "notades"; else echo "notapro" ?>"><?=$sNotas[$aCurso['cod_cur']]['not_cur']?></span>&nbsp;</td>
		      <td class="wordder"><a href="" onclick="nct_editnotacerti('<?=$_SESSION['sEstupln_est']?>', '<?=$aCurso['cod_cur']?>', '<?=$sNotas[$aCurso['cod_cur']]['mod_not']?>', '<?=$sNotas[$aCurso['cod_cur']]['ano_aca']?>', '<?=$sNotas[$aCurso['cod_cur']]['per_aca']?>', '<?=(empty($sNotas[$aCurso['cod_cur']]['not_cur'])?'Insert':'Update')?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Modificar datos de la Nota" width="16" height="16" /></a></td>
			</tr>
		<? 		
			$vCont++; 	
		} 
		$cCurso->close();
		?>
		</table></td>
		<td background="../images/ventana_r2_c4.jpg"></td>
	  </tr>
	  <tr>
		<td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
		<td background="../images/ventana_r4_c2.jpg"></td>
		<td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
	  </tr>
	</table>
	<a href="" title="Retroceder" class="linkboton" onClick = "nct_selectnivsem(); return false"><img src="../images/bback.png" width="100" height="24"></a><a href="prncerestufle.php" title="Imprimir Certificado de Estudios" class="linkboton" target="frPdf"><img src="../images/bpcerestu.png" width="100" height="24"></a>	
<?
	}
?>
<div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>