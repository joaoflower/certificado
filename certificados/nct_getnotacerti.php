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
		$sEstudia = "";
		$sEstudia['pln_est'] = $_POST['rPln_est'];		
		$sEstudia['cod_cur'] = $_POST['rCod_cur'];
		$sEstudia['mod_not'] = $_POST['rMod_not'];
		$sEstudia['ano_aca'] = $_POST['rAno_aca'];
		$sEstudia['per_aca'] = $_POST['rPer_aca'];
				
		$_SESSION['sCursocod_cur'] = $_POST['rCod_cur'];
		$_SESSION['sCursomod_not'] = $_POST['rMod_not'];
		$_SESSION['sCursoano_aca'] = $_POST['rAno_aca'];
		$_SESSION['sCursoper_aca'] = $_POST['rPer_aca'];
		$_SESSION['sEstutype'] 	 = $_POST['rType'];

		$tNota = "unapnet.nota{$_SESSION['sEstucod_car']}";
		if($_SESSION['sEstutype'] == 'Update')
		{
			$vQuery = "Select cu.nom_cur, cu.niv_est, cu.sem_anu, cu.cod_esp, no.not_cur, no.cod_act, ";
			$vQuery .= "no.obs_not, no.cur_con, no.fch_reg, es.esp_nom ";
			$vQuery .= "from unapnet.curso cu left join $tNota no on cu.cod_car = no.cod_car and ";
			$vQuery .= "cu.pln_est = no.pln_est and cu.cod_cur = no.cod_cur ";
			$vQuery .= "left join unapnet.especial es on cu.cod_car = es.cod_car and cu.pln_est = es.pln_est and ";
			$vQuery .= "cu.cod_esp = es.cod_esp ";
			$vQuery .= "where cu.cod_car = '{$_SESSION['sEstucod_car']}' and cu.pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "cu.cod_cur = '{$sEstudia['cod_cur']}' and no.mod_not = '{$sEstudia['mod_not']}' and ";
			$vQuery .= "no.ano_aca = '{$sEstudia['ano_aca']}' and no.per_aca = '{$sEstudia['per_aca']}' and ";
			$vQuery .= "no.num_mat = '{$_SESSION['sEstunum_mat']}' ";
	
			$cNota = fQuery($vQuery);
			if($aNota = $cNota->fetch_array())
			{			
				$sEstudia['nom_cur'] = $aNota['nom_cur'];
				$sEstudia['niv_est'] = $aNota['niv_est'];
				$sEstudia['sem_anu'] = $aNota['sem_anu'];
				$sEstudia['cod_esp'] = $aNota['cod_esp'];
				$sEstudia['not_cur'] = $aNota['not_cur'];
				$sEstudia['cod_act'] = $aNota['cod_act'];
				$sEstudia['obs_not'] = $aNota['obs_not'];
				$sEstudia['cur_con'] = $aNota['cur_con'];
				$sEstudia['fch_reg'] = $aNota['fch_reg'];
				$sEstudia['esp_nom'] = $aNota['esp_nom'];
			}	
			else
			{
				header("Location:../index.php");
			}
		}
		elseif($_SESSION['sEstutype'] == 'Insert')
		{
			$vQuery = "Select cu.nom_cur, cu.niv_est, cu.sem_anu, cu.cod_esp, es.esp_nom ";
			$vQuery .= "from unapnet.curso cu left join unapnet.especial es on cu.cod_car = es.cod_car and ";
			$vQuery .= "cu.pln_est = es.pln_est and cu.cod_esp = es.cod_esp ";
			$vQuery .= "where cu.cod_car = '{$_SESSION['sEstucod_car']}' and cu.pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "cu.cod_cur = '{$sEstudia['cod_cur']}' ";
	
			$cNota = fQuery($vQuery);
			if($aNota = $cNota->fetch_array())
			{			
				$sEstudia['nom_cur'] = $aNota['nom_cur'];
				$sEstudia['niv_est'] = $aNota['niv_est'];
				$sEstudia['sem_anu'] = $aNota['sem_anu'];
				$sEstudia['cod_esp'] = $aNota['cod_esp'];
				$sEstudia['esp_nom'] = $aNota['esp_nom'];
			}	
			else
			{
				header("Location:../index.php");
			}
		}
			
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Modificar Nota</th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="1" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			<tr>
              <td width="130" class="wordder">C&oacute;digo:</td>
              <td width="110" class="tdcampo">&nbsp;<?=$sEstudia['cod_cur']?></td>
              <td width="120" class="wordder">Plan:</td>
              <td width="110" class="tdcampo">&nbsp;<?=$sEstudia['pln_est']?></td>
			</tr>
			<tr>
			  <td class="wordder">Nombre de Curso:</td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['nom_cur']?></td>
	        </tr>
			<tr>
			  <td class="wordder">Nivel:</td>
			  <td class="tdcampo">&nbsp;<?=$_SESSION["sNivel".$sEstudia['niv_est']]?></td>
			  <td class="wordder">Semestre:</td>
			  <td class="tdcampo">&nbsp;<?=$_SESSION["sSemestre".$sEstudia['sem_anu']]?></td>
			</tr>
			<tr>
			  <td class="wordder">Especialidad:</td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['esp_nom']?></td>
	        </tr>
			<tr>
              <td class="wordder">A&ntilde;o: </td>
			  <td class="wordizq"><input name="rAno_aca" type="text" id="rAno_aca" value="<?=$sEstudia['ano_aca']?>" size="4" maxlength="4"></td>
			  <td class="wordder">Periodo:</td>
			  <td class="wordizq"><select name="rPer_aca" id="rPer_aca">
				<?=fviewperiodo($sEstudia['per_aca'])?>
            </select></td>
		    </tr>
			<tr>
			  <td class="wordder">Modalidad:</td>
			  <td class="wordizq"><select name="rMod_not" id="rMod_not">
				<?=fviewmodnot($sEstudia['mod_not'])?>
            </select></td>
		      <td class="wordder">Nota: </td>
		      <td class="wordizq"><input name="rNot_cur" type="text" class="<?=($sEstudia['not_cur']>10?'textnotaap':'textnotade')?>" id="rNot_cur" value="<?=$sEstudia['not_cur']?>" size="2" maxlength="2" onKeyUp="checknota(this)"></td>
			</tr>
			<tr>
			  <td class="wordder">Convalidado por: </td>
			  <td colspan="3" class="wordizq"><input name="rCur_con" type="text" id="rCur_con" value="<?=$sEstudia['cur_con']?>" size="70" maxlength="70" onBlur="fupper(this);"></td>
		    </tr>
			<tr>
			  <td colspan="4" class="wordcen"></td>
		    </tr>					
          </table></td>
          <td background="../images/ventana_r2_c4.jpg"></td>
        </tr>
        <tr>
          <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
          <td background="../images/ventana_r4_c2.jpg"></td>
          <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
        </tr>
      </table>
	  <a href="" title="Guardar" class="linkboton" onClick = "nct_savenotacerti(); return false"><img src="../images/bsave.png" width="100" height="24"></a>
    <a href="" onClick = "nct_viewnotacerti(); return false" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a>
