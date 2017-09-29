<STYLE type=text/css>
@import url( ../css/main.css );
</STYLE>

<?
	session_start();
	include "../include/function1.php";
	include "../include/funcsql1.php";

	if(fsafetylogin())
	{
		$bData = FALSE;
		$vPln_est = $_POST['rPln_est'];
		$_SESSION["sPln_est"] = $vPln_est;
		$sEspecial = "";
		
		if(!empty($_SESSION["sPln_est"]))
		{
			$sNiv_sem = "";
			$sRequ = "";
			
			$vQuery = "Select distinct pln_est from unapnet.curso where cod_car = '{$_SESSION['sCod_car']}' and ";
			$vQuery .= "pln_est = '{$_SESSION['sPln_est']}' ";
			$cPlan = fQuery($vQuery);
			while($aPlan = $cPlan->fetch_array())
			{
				$bData = TRUE;
				
				//-------------------------------------------------------------------------
				$vQuery = "Select cod_esp, pln_est, esp_nom from unapnet.especial ";
				$vQuery .= "where cod_car = '{$_SESSION['sCod_car']}' and pln_est = '{$_SESSION['sPln_est']}' and ";
				$vQuery .= "cod_esp <> '' order by pln_est, cod_esp";
				$cEspecial = fQuery($vQuery);
				while($aEspecial = $cEspecial->fetch_array())
				{
					$sEspecial[$aEspecial['cod_esp']]['cod_esp'] = $aEspecial['cod_esp'];
					$sEspecial[$aEspecial['cod_esp']]['pln_est'] = $aEspecial['pln_est'];
					$sEspecial[$aEspecial['cod_esp']]['esp_nom'] = $aEspecial['esp_nom'];
				}
				$cEspecial->close();
				
				//-------------------------------------------------------------------------
			}
			$cPlan->close();

			
		}
	}
	else
	{
		header("Location:../index.php");
	}		
?>

<?	
	if($bData)	
	{
		$vQuery = "Select pln_est, cod_cur, cur_pre from unapnet.requ where cod_car = '{$_SESSION['sCod_car']}' and ";
		$vQuery .= "pln_est = '{$_SESSION['sPln_est']}' order by cod_cur";
		$cRequ = fQuery($vQuery);
		while($aRequ = $cRequ->fetch_array())
		{
			if(!empty($sRequ[$aRequ['cod_cur']]))
				$sRequ[$aRequ['cod_cur']] .= "<br>&nbsp;{$aRequ['pln_est']}-{$aRequ['cur_pre']} ";
			else
				$sRequ[$aRequ['cod_cur']] = "{$aRequ['pln_est']}-{$aRequ['cur_pre']}";
		}
		$cRequ->close();
		
?>

	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
		<tr>
		  <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
		  <th align="center" background="../images/ventana_r1_c2.jpg" >PLAN: <?=$_SESSION['sPln_est']?> - <?=$_SESSION["sTiposist".$_SESSION["sPlan".$_SESSION["sCod_car"].$_SESSION["sPln_est"]]]?></th>
		  <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
		</tr>
		<tr>
		  <td background="../images/ventana_r2_c1.jpg"></td>
		  <td background="../images/ventana_r2_c2.jpg" class="wordcen">
		  <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
			  <tr>
				<th width="25" scope="col">C&oacute;d</th>
				<th width="350" scope="col">Curso</th>
				<th width="20" scope="col">HT</th>
				<th width="20" scope="col">HP</th>
				<th width="20" scope="col">TH</th>
				<th width="30" scope="col">Crd</th>
				<th width="50" scope="col">Requ</th>
			    <th width="16" scope="col">&nbsp;</th>
			  </tr>

<?		
		$vTip_cur = "";	
		$vCod_esp = "";
		$vNiv_est = "";
		$vSem_anu = "";
		
		$vCont = 1;	
		$vSub_tit = "";
		
		$vQuery = "Select cu.pln_est, cu.cod_cur, cu.cod_cat, cu.nom_ofi, cu.cod_esp, cu.hrs_teo, cu.hrs_pra, cu.hrs_tot, ";
		$vQuery .= "cu.crd_cur, cu.tip_cur, cu.crd_prq, cu.niv_est, cu.sem_anu from unapnet.curso cu ";
		$vQuery .= "left join unapnet.tipcur tc on cu.tip_cur = tc.tip_cur ";
		$vQuery .= "where cu.cod_car = '{$_SESSION['sCod_car']}' and cu.pln_est = '{$_SESSION['sPln_est']}' and ";
		$vQuery .= "cu.con_cur = '1' ";
		$vQuery .= "order by niv_est, sem_anu, ord_tip, cod_esp, cod_cur ";
		$cCurso = fQuery($vQuery);
		while($aCurso = $cCurso->fetch_array())
		{ 
			if($aCurso['crd_prq'] > 0)
			{
				if(!empty($sRequ[$aCurso['cod_cur']])) 
					$sRequ[$aCurso['cod_cur']] .= ",<BR>&nbsp;" .$aCurso['crd_prq']. " crd. ";
				else
					$sRequ[$aCurso['cod_cur']] = $aCurso['crd_prq']. " crd. ";
			}
			
			if($aCurso['niv_est'] != $vNiv_est or $aCurso['sem_anu'] != $vSem_anu)
			{
				$vNiv_est = $aCurso['niv_est'];
				$vSem_anu = $aCurso['sem_anu'];
				
				$vTip_cur = "";	
				$vCod_esp = "";
				?>
				<tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\""; $vCont++;	?>>
				   <td class="wordcen">&nbsp;</td>
				   <td colspan="7" class="wordizqb">&nbsp;Nivel: <?=$_SESSION["sNivel{$aCurso['niv_est']}"]?> - Semestre: <?=$_SESSION["sSemestre{$aCurso['sem_anu']}"]?></td>
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
				<tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\""; $vCont++;	?>>
					<td class="wordcen">&nbsp;</td>
					<td colspan="7" class="wordizqb">&nbsp;<?=$vSub_tit?></td>
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
				  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\""; $vCont++;	?>>
					<td class="wordcen">&nbsp;</td>
					<td colspan="7" class="wordizqb">&nbsp;Menci&oacute;n: <?=ucwords(strtolower($sEspecial[$aCurso['cod_esp']]['esp_nom']))?></td>
				  </tr>
			<?								
				}
			}
		?>                  
			  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
				<td class="wordcen"><a href="pln_viewcurso.php?rCod_cur=<?=$aCurso['cod_cur']?>" class="linktext"><?=$aCurso['cod_cur']?></a></td>
				<td class="wordizq">&nbsp;<?=ucwords(strtolower($aCurso['nom_ofi']))?></td>
				<td class="wordcen"><?=$aCurso['hrs_teo']?></td>
				<td class="wordcen"><?=$aCurso['hrs_pra']?></td>
				<td class="wordcen"><?=$aCurso['hrs_tot']?></td>
				<td class="wordcen"><?=$aCurso['crd_cur']?></td>
				<td class="wordizq">&nbsp;<?=(!empty($sRequ[$aCurso['cod_cur']]))?$sRequ[$aCurso['cod_cur']]:"Ninguno"?></td>
			    <td class="wordizq"><a href="" onclick="pln_editcurso('<?=$aCurso['cod_cur']?>'); return false" class="enlaceb"><img src="../images/browse.png" alt="Editar información de curso" width="16" height="16" /></a></td>
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
<?	
	}	
?>