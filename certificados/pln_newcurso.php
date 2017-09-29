<STYLE type=text/css>
@import url( ../css/main.css );
</STYLE>

<?
	session_start();
	include "../include/function1.php";
	include "../include/function2.php";
	include "../include/funcsql1.php";
	if(fsafetylogin())
	{
		$vCod_cur = "";
		$vNom_cur = "";
		$vCrd_cur = 0.00;
		$vAccion = $_POST['rAccion'];
		$_SESSION['sAccion'] = $vAccion;
		
		if($vAccion == "New")
		{
			$vCod_cur2 = '000';
			$vQuery = "Select max(cod_cur) as cod_cur from unapnet.curso where cod_car = '{$_SESSION['sCod_car']}' and ";
			$vQuery .= "pln_est = '{$_SESSION['sPln_est']}' ";		
			$cCurso = fQuery($vQuery);
			if($aCurso = $cCurso->fetch_array())
			{
				$vCod_cur2 = $aCurso['cod_cur'];
			}	
			$cCurso->close();
			$vCod_cur2++;
			if(strlen($vCod_cur2) == 1) $vCod_cur = '00'.$vCod_cur2;
			if(strlen($vCod_cur2) == 2) $vCod_cur = '0'.$vCod_cur2;
		}
		elseif($vAccion == "Edit")
		{
			$vCod_cur = $_POST['rCod_cur'];
			$vQuery = "Select cod_cur, nom_ofi, crd_cur, niv_est, sem_anu from unapnet.curso ";
			$vQuery .= "where cod_car = '{$_SESSION['sCod_car']}' and pln_est = '{$_SESSION['sPln_est']}' and ";
			$vQuery .= "cod_cur = '$vCod_cur' and con_cur = '1'";
			$cCurso = fQuery($vQuery);
			if($aCurso = $cCurso->fetch_array())
			{
				$vNom_cur = $aCurso['nom_ofi'];
				$vCrd_cur = $aCurso['crd_cur'];
				$_SESSION["sNiv_est"] = $aCurso['niv_est'];
				$_SESSION["sSem_anu"] = $aCurso['sem_anu'];
			}	
			$cCurso->close();
		}
		
?>
<form action="#" method="post" enctype="multipart/form-data" name="fData" id="fData">	
	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Nuevo Curso </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			<tr>
			  <td width="110" class="wordder">Escuela profesional : </td>
			  <td width="300" class="tdcampo">&nbsp;<?=$_SESSION["sCarrera".$_SESSION["sCod_car"]]?></td>
		    </tr>
			<tr>
			  <td class="wordder">Plan de estudios : </td>
			  <td class="tdcampo">&nbsp;<?=$_SESSION["sPln_est"]?></td>
		    </tr>
			<tr>
			  <td class="wordder">C&oacute;digo : </td>
			  <td class="tdcampo">&nbsp;<?=$vCod_cur?></td>
		    </tr>
			<tr>
			  <td class="wordder">Nombre de curso : </td>
			  <td class="wordizqb">&nbsp;<textarea name="rNom_cur" cols="65" rows="2" id="rNom_cur" onBlur="fupper(this)"><?=$vNom_cur?></textarea></td>
		    </tr>
			<tr>
			  <td class="wordder">Cr&eacute;dito : </td>
			  <td class="wordizqb">&nbsp;<input name="rCrd_cur" type="text" id="rCrd_cur" value="<?=$vCrd_cur?>" size="5" maxlength="5" /></td>
		    </tr>
			<tr>
              <td class="wordder">Nivel : </td>
              <td class="wordizqb">&nbsp;<select name="rNiv_est" id="rNiv_est" >
					<? fviewnivel($_SESSION["sNiv_est"]) ?>
                </select></td>
            </tr>
			<tr>
			  <td class="wordder">Semestre : </td>
			  <td class="wordizqb">&nbsp;<select name="rSem_anu" id="rSem_anu" >
					<? fviewsemestre($_SESSION["sSem_anu"]) ?>
                </select></td>
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
	  <a href="" title="Continuar" class="linkboton" onClick = "pln_savecurso('<?=$vCod_cur?>', document.fData.rNom_cur.value, document.fData.rCrd_cur.value, document.fData.rNiv_est.value, document.fData.rSem_anu.value); return false"><img src="../images/bsave.png" width="100" height="24"></a>
	  <a href="" title="Continuar" class="linkboton" onClick = "pln_viewplan('<?=$_SESSION["sPln_est"]?>'); return false"><img src="../images/bundo.png" width="100" height="24"></a>
</form>

<?
	}
	else
	{
		header("Location:../index.php");
	}
?>
		
