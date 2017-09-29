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
		$bData = FALSE;
		
		if($_SESSION["sEstucan_esp"] > 0)
		{
			$bData = TRUE;
			
			$_SESSION["sEstunum_rec"] = "";
			$_SESSION["sEstutip_cer"] = "";
			$_SESSION["sEstunum_rec"] = $_POST["rNum_rec"];
			$_SESSION["sEstutip_cer"] = $_POST["rTip_cer"];
			
			$_SESSION["sEstutip_sist"] = $_SESSION["sPlan".$_SESSION["sEstucod_car"].$_SESSION["sEstupln_est"]];
			$vEspecial = "";
			
			$vQuery = "Select cod_esp, esp_nom from unapnet.especial ";
			$vQuery .= "where cod_car = '{$_SESSION['sEstucod_car']}' and pln_est = '{$_SESSION['sEstupln_est']}' and (";
			if(!empty($_SESSION["sEstucod_esp"]))
				$vQuery .= "cod_esp = '{$_SESSION['sEstucod_esp']}' ";
			if(!empty($_SESSION["sEstucod_esp2"]))
			{
				if(!empty($_SESSION["sEstucod_esp"]))
					$vQuery .= "or ";	
				$vQuery .= "cod_esp = '{$_SESSION['sEstucod_esp2']}' ";				
			}
			$vQuery .= ") order by cod_esp";
			
			$cEspecial = fQuery($vQuery);
			while($aEspecial = $cEspecial->fetch_array())
			{
				if(!empty($vEspecial))
					$vEspecial .= '<br>&nbsp;';
				$vEspecial .= $aEspecial['cod_esp'].' - '.$aEspecial['esp_nom'];
			}
			$cEspecial->close();
		}		
	}
	else
	{
		header("Location:../index.php");
	}
	
	//---------------------------------------------------------------------
	if($bData)	
	{
?>
	<table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >[<?=$_SESSION["sEstunum_mat"]?>] - [<?=$_SESSION["sEstupaterno"]?> <?=$_SESSION["sEstumaterno"]?>, <?=$_SESSION["sEstunombres"]?>] - [<?=$_SESSION["sCarrera".$_SESSION["sEstucod_car"]]?>]</th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			
			<tr>
			  <td class="wordder">Tipo de certificado : </td>
			  <td class="tdcampo">&nbsp;<?=($_SESSION["sEstutip_cer"] == '1'?"CERTIFICADO DE EGRESAGO":"CERTIFICADO DE ESTUDIANTE")?></td>
		    </tr>
			<tr>
              <td width="100" class="wordder">Plan de Estudios : </td>
              <td width="450" class="tdcampo">&nbsp;<?=$_SESSION["sEstupln_est"]?> - <?=$_SESSION["sTiposist".$_SESSION["sEstutip_sist"]]?></td>
            </tr>
			<tr>
			  <td class="wordder">Menci&oacute;n / Espec. : </td>
			  <td class="tdcampo" id="xEspecial">&nbsp;<?=$vEspecial?></td>
		    </tr>
			<tr>
			  <td class="wordder">Semestre / Nivel : </td>
			  <td class="tdcamposb" id="xEspecial"><?=($_SESSION["sEstutip_sist"] == '1'?fviewnivelplancarcheck($_SESSION["sEstucod_car"], $_SESSION["sEstupln_est"]):fviewsemestreplancarcheck($_SESSION["sEstucod_car"], $_SESSION["sEstupln_est"]))?></td>
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
	  <a href="" title="Retroceder" class="linkboton" onClick = "nct_selectplan('<?=$_SESSION["sEstunum_mat"]?>', '<?=$_SESSION["sEstucod_car"]?>'); return false"><img src="../images/bback.png" width="100" height="24"></a>
	  <a href="" title="Continuar" class="linkboton" onClick = "nct_viewnotacerti(); return false"><img src="../images/bcontinue.png" width="100" height="24"></a>
<?
	}
?>