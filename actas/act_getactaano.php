<STYLE type=text/css>
@import url( ../css/main.css );
</STYLE>
<?php
	session_start();
	include "../include/function1.php";
	include "../include/funcsql1.php";
	if(fsafetylogin())
	{
		$bDatos = FALSE;
		$vAno_per = $_POST["rAno_per"];
		$_SESSION["sAno_aca"] = substr($_POST["rAno_per"], 0, 4);
		$_SESSION["sPer_aca"] = substr($_POST["rAno_per"], 4, 2);
		$tActa = "unapnet.acta{$_SESSION['sAno_aca']}";
		
		$sDocente = "";
		$sEspecial = "";
		
		if(!empty($_SESSION["sCod_car"]) and !empty($_SESSION["sAno_aca"]) and !empty($_SESSION["sPer_aca"]))
		{
			//------------------------Nombre de Especialidad-------------------------------------------------				
			$vQuery = "Select distinct ac.pln_est, es.cod_esp, es.esp_nom ";
			$vQuery .= "from $tActa ac left join unapnet.especial es on ac.cod_car = es.cod_car and ac.pln_est = es.pln_est ";
			$vQuery .= "where ac.cod_car = '{$_SESSION['sCod_car']}' and ac.per_aca = '{$_SESSION['sPer_aca']}' ";
			
			$cEspecial = fQuery($vQuery);
			while($aEspecial = $cEspecial->fetch_array())
				$sEspecial[$aEspecial['pln_est'].$aEspecial['cod_esp']] = $aEspecial['esp_nom'];
			$cEspecial->close();
			$_SESSION["sActasqlespecial"] = $vQuery;
						
			//------------------------Nombre de Docentes-------------------------------------------------				
			$vQuery = "select distinct do.cod_prf, concat(do.paterno, ' ', do.materno, ', ', do.nombres) as nombre ";
			$vQuery .= "from $tActa ac left join unapnet.docente do on ac.cod_prf = do.cod_prf ";
			$vQuery .= "where ac.cod_car = '{$_SESSION['sCod_car']}' and ac.per_aca = '{$_SESSION['sPer_aca']}' order by cod_prf ";
			
			$cDocente = fQuery($vQuery);
			while($aDocente = $cDocente->fetch_array())
				$sDocente[$aDocente['cod_prf']] = ucwords(strtolower($aDocente['nombre']));
			$cDocente->close();
			$_SESSION["sActasqldocente"] = $vQuery;
			
			$bDatos = TRUE;
			//---------------------------------------------------------------------
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
		<th align="center" background="../images/ventana_r1_c2.jpg" >Listado de Actas emitidas </th>
		<th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
	  </tr>
	  <tr>
		<td background="../images/ventana_r2_c1.jpg"></td>
		<td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
			<tr>
			  <th width="25" scope="col">C&oacute;d.</th>
			  <th width="200" scope="col">Curso</th>			  
			  <th width="180" scope="col">Docente</th>
			  <th width="70" scope="col">Modalidad</th>
			  <th width="50" scope="col">Acta</th>
		      <th width="20" scope="col">&nbsp;</th>
			</tr>
	<? 	
		$vPln_est = "";
		$vCod_esp = "";
		$vNiv_est = "";
		$vSem_anu = "";
		$vSec_gru = "";
		
		//---------------------------------------------
		$vQuery = "select ac.pln_est, ac.cod_cur, cu.nom_ofi, ac.cod_prf, ac.mod_mat, ac.cod_act, ac.sec_gru, ";
		$vQuery .= "if(ac.ubi_act = '01', 'COORD', 'REGIS') as ubi_act2, cu.niv_est, cu.sem_anu, cu.cod_esp, pl.tip_sist ";
		$vQuery .= "from $tActa ac left join unapnet.curso cu on ac.cod_car = cu.cod_car and ac.pln_est = cu.pln_est and ";
		$vQuery .= "ac.cod_cur = cu.cod_cur ";
		$vQuery .= "left join unapnet.plan pl on ac.cod_car = pl.cod_car and ac.pln_est = pl.pln_est ";
		$vQuery .= "where ac.cod_car = '{$_SESSION['sCod_car']}' and ac.per_aca = '{$_SESSION['sPer_aca']}' ";
		$vQuery .= "and ac.ubi_act = '01' ";
		$vQuery .= "order by cu.pln_est, cu.niv_est, cu.sem_anu, ac.sec_gru, cu.cod_esp, cu.cod_cur";
		$_SESSION["sActasqlacta"] = $vQuery;
		//---------------------------------------------
				
		$cActa = fQuery($vQuery);
		while($aActa = $cActa->fetch_array())
		{ 
			if($aActa['pln_est'] != $vPln_est)
			{
				$vPln_est = $aActa['pln_est'];
				$vCod_esp = "";
				$vNiv_est = "";
				$vSem_anu = "";
				$vSec_gru = "";
		?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
			  <td class="wordcen">&nbsp;</td>
			  <td colspan="5" class="wordizqb">PLAN: <?=$aActa['pln_est']?> - <?=$_SESSION["sTiposist".$aActa['tip_sist']]?></td>
		  </tr>
		<?
			}
			if($aActa['niv_est'] != $vNiv_est or $aActa['sem_anu'] != $vSem_anu)
			{
				$vNiv_est = $aActa['niv_est'];
				$vSem_anu = $aActa['sem_anu'];
				
				$vCod_esp = "";
				$vSec_gru = "";
		?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
			  <td class="wordcen">&nbsp;</td>
			  <td colspan="5" class="wordizqb">Nivel: <?=$_SESSION["sNivel{$vNiv_est}"]?> -Semestre: <?=$_SESSION["sSemestre{$vSem_anu}"]?></td>
		  </tr>
		  <?
			}
			if($aActa['sec_gru'] != $vSec_gru)
			{
				$vSec_gru = $aActa['sec_gru'];
		?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
			  <td class="wordcen">&nbsp;</td>
			  <td colspan="5" class="wordizqb">Grupo: <?=$_SESSION["sGrupo{$vSec_gru}"]?></td>
		  </tr>
		  <?
			}
			if($aActa['cod_esp'] != $vCod_esp)
			{
				$vCod_esp = $aActa['cod_esp'];
				if($aActa['cod_esp'] != '00')
				{	
			?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
			  <td class="wordcen">&nbsp;</td>
			  <td colspan="5" class="wordizqb">&nbsp;Menci&oacute;n: <?=ucwords(strtolower($sEspecial[$aActa['pln_est'].$aActa['cod_esp']]))?></td>
		  </tr>
		  	<?
				}
			}
			?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
			  <td class="wordcen"><?=$aActa['cod_cur']?></td>
			  <td width="200" class="wordizq">&nbsp;<?=ucwords(strtolower($aActa['nom_ofi']))?>&nbsp;</td>
			  <td width="180" class="wordizq">&nbsp;<?=$sDocente[trim($aActa['cod_prf'])]?></td>
			  <td class="wordizq">&nbsp;<?=ucwords(strtolower($_SESSION["sModnot{$aActa['mod_mat']}"]))?></td>
			  <td class="wordizq">&nbsp;<?=$aActa['cod_act']?></td>
		      <td class="wordcen"><input name="rCod_act[]" type="checkbox" class="check" value="<?=$aActa['cod_act']?>" onclick="pintar(this)" ></td>
			</tr>
		<? 		
			$vCont++; 	
		} 
		$cActa->close();
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
	<a href="" title="Guardar" class="linkboton" onClick = "act_saveactaano(); return false"><img src="../images/bsave.png" width="100" height="24"></a>
    <a href="" onClick = "clickrecepcionar(); return false" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a>
	
<?
	}
?>
<div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>