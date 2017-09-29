<STYLE type=text/css>
@import url( ../css/main.css );
</STYLE>
<?php
	session_start();
	include "../include/function1.php";
	include "../include/funcsql1.php";
	if(fsafetylogin())
	{
		$sEstudia = "";
		$_SESSION["sCod_car"] = "";
		$vNum_mat = $_POST['rNum_mat'];
		$vCod_car = $_POST['rCod_car'];
		$_SESSION["sCod_car"] = $_POST['rCod_car'];
		$bDatos = FALSE;
		$tNota = "unapnet.nota";
		
		if(($vCod_car >= '01' and $vCod_car != '19' and $vCod_car <= '36') or 
			$vCod_car == '56' or $vCod_car == '65' or $vCod_car == '66')
		{
			if(!empty($vNum_mat) and !empty($vCod_car))
			{
				$vQuery = "Select num_mat, cod_car, paterno, materno, nombres from unapnet.estudiante ";
				$vQuery .= "where num_mat = '$vNum_mat' and cod_car = '$vCod_car'";
				$cEstudia = fQuery($vQuery);
				if($aEstudia = $cEstudia->fetch_array())
				{
					$sEstudia['num_mat'] = $aEstudia['num_mat'];
					$sEstudia['cod_car'] = $aEstudia['cod_car'];
					$sEstudia['paterno'] = $aEstudia['paterno'];
					$sEstudia['materno'] = $aEstudia['materno'];
					$sEstudia['nombres'] = $aEstudia['nombres'];
					
					$tNota .= $sEstudia['cod_car'];							
					
					$vQuery = "Select distinct pln_est from $tNota ";
					$vQuery .= "where num_mat = '$vNum_mat' and cod_car = '$vCod_car'";
					$cNota = fQuery($vQuery);
					if($aNota = $cNota->fetch_array())
					{
						$bDatos = TRUE;
					}
				}
				$cEstudia->close();
			}	
		}
	}
	else
	{
		header("Location:../index.php");
	}	

	$vCont = 1;
	if($bDatos == TRUE)
	{
?>

	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
	  <tr>
		<th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
		<th align="center" background="../images/ventana_r1_c2.jpg" >[<?=$sEstudia['num_mat']?>] - [<?=$sEstudia['paterno']?> <?=$sEstudia['materno']?>, <?=$sEstudia['nombres']?>] - [<?=$_SESSION["sCarrera{$vCod_car}"]?>]</th>
		<th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
	  </tr>
	  <tr>
		<td background="../images/ventana_r2_c1.jpg"></td>
		<td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
			<tr>
			  <th width="40" scope="col">C&oacute;d.</th>
			  <th width="220" scope="col">Curso</th>
			  <th width="20" scope="col">Not</th>
			  <th width="80" scope="col">Mod.</th>
			  <th width="30" scope="col">Crd</th>
			  <th width="40" scope="col">Acta</th>
			  <th width="40" scope="col">A-P</th>
			  <th width="60" scope="col">Fecha</th>
		      <th width="16" scope="col">&nbsp;</th>
			</tr>
			<? 	
				
/*				$sFechaA = "";
				$tActa = "unapnet.acta{$aAnoper['ano_aca']}";
				
				if($aAnoper['ano_aca'] >= '1999')
				{
					$vQuery = "Select no.cod_act, concat(substr(date(ac.fch_act), 9, 2), '/', ";
					$vQuery .= "substr(date(ac.fch_act), 6, 2), '/', substr(date(ac.fch_act), 1, 4)) as fecha ";
					$vQuery .= "from $tNota no left join $tActa ac on no.cod_act = ac.cod_act ";
					$vQuery .= "where no.num_mat = '{$sEstudia['num_mat']}' and no.ano_aca = '{$aAnoper['ano_aca']}' and ";
					$vQuery .= "no.per_aca = '{$aAnoper['per_aca']}'";
					$cFechaA = fQuery($vQuery);
					while($aFechaA = $cFechaA->fetch_array())
					{
						 $sFechaA[$aFechaA["cod_act"]] = $aFechaA["fecha"];
					}
				}*/
				
				$vCont = 1; 
				$vPln_est = "";
				$vNiv_est = "";
				$vSem_anu = "";
				
				$vQuery = "Select cu.pln_est, cu.cod_cur, cu.nom_ofi, cu.niv_est, cu.sem_anu, ";
				$vQuery .= "no.not_cur, no.mod_not, cu.crd_cur, cu.cod_esp, no.cod_act, no.ano_aca, no.per_aca, mn.ord_not, ";
				$vQuery .= "no.fch_reg, no.cur_con ";
				$vQuery .= "from $tNota no left join unapnet.curso cu on no.pln_est = cu.pln_est and ";
				$vQuery .= "no.cod_cur = cu.cod_cur ";
				$vQuery .= "left join unapnet.modnot mn on no.mod_not = mn.mod_not ";
				$vQuery .= "where no.num_mat = '{$sEstudia['num_mat']}' and cu.cod_car = '{$sEstudia['cod_car']}' ";
				$vQuery .= "order by pln_est, niv_est, sem_anu, cod_esp, cod_cur, ano_aca, per_aca, ord_not ";
				$cNotas = fQuery($vQuery);
				while($aNotas = $cNotas->fetch_array())
				{ 
					if($vPln_est != $aNotas['pln_est'])
					{
						$vPln_est = $aNotas['pln_est'];
						$vNiv_est = "";
						$vSem_anu = "";
			?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
			  <td class="wordcen">&nbsp;</td>
			  <td colspan="8" class="wordizqb">PLAN: <?=$aNotas['pln_est']?> - <?=$_SESSION["sTiposist".$_SESSION["sPlan".$vCod_car.$aNotas['pln_est']]]?></td>
		    </tr>
			<?
					}
					if($vNiv_est != $aNotas['niv_est'] or $vSem_anu != $aNotas['sem_anu'])
					{
						$vNiv_est = $aNotas['niv_est'];
						$vSem_anu = $aNotas['sem_anu'];
						
			?>			
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
			  <td class="wordcen">&nbsp;</td>
			  <td colspan="8" class="wordizqb">NIVEL: <?=$_SESSION["sNivel{$vNiv_est}"]?> -SEMESTRE: <?=$_SESSION["sSemestre{$vSem_anu}"]?></td>
		  </tr>
		  	<?
					}
			?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
			  <td width="40" class="wordcen"><?=$aNotas['pln_est']?>-<?=$aNotas['cod_cur']?></td>
			  <td class="wordizq">&nbsp;<?=ucwords(strtolower($aNotas['nom_ofi']))?>&nbsp;</td>
			  <td class="wordder"><span class ="<?	if($aNotas['not_cur'] < 11) echo "notades"; else echo "notapro" ?>"><?=$aNotas['not_cur']?></span>&nbsp;</td>
			  <td class="wordizq">&nbsp;<?=ucwords(strtolower($_SESSION["sModnot{$aNotas['mod_not']}"]))?>&nbsp;</td>
			  <td class="wordder"><?=$aNotas['crd_cur']?>&nbsp;</td>
			  <td class="wordcen"><?=$aNotas['cod_act']?></td>
			  <td class="wordizq">&nbsp;<?=$aNotas['ano_aca']?><?=($aNotas['per_aca'] != '00'?("-".$_SESSION["sPeriodo{$aNotas['per_aca']}abr_per"]):"")?></td>
			  <td class="wordcen"><?=fFechad($aNotas['fch_reg'])?></td>
		      <td class="wordcen"><a href="" onclick="not_viewactaesc('<?=$aNotas['cod_act']?>', '<?=$aNotas['ano_aca']?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Ver Acta escaneada" width="16" height="16" /></a></td>
			</tr>
			<? 		$vCont++; 	
				} 
				$cNotas->close();
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