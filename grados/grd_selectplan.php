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

		$sEspecial = "";
		
		$_SESSION["sEstunum_mat"] = "";
		$_SESSION["sEstucod_car"] = "";
		$_SESSION["sEstupln_est"] = "";	
		$_SESSION["sEstupaterno"] = "";
		$_SESSION["sEstumaterno"] = "";
		$_SESSION["sEstunombres"] = "";
		$_SESSION["sEstucod_esp"] = "";
		$_SESSION["sEstucod_esp2"] = "";
		$_SESSION["sEstucan_esp"] = 0;
		$_SESSION["sEstutip_sist"] = "";
		$_SESSION["sEstumax_nsm"] = "";
		
		$vNum_mat = $_POST['rNum_mat'];
		$vCod_car = $_POST['rCod_car'];		
		$_SESSION["sEstunum_mat"] = $vNum_mat;
		$_SESSION["sEstucod_car"] = $vCod_car;
		
		$vQuery = "select paterno, materno, nombres from unapnet.estudiante ";
		$vQuery .= "where num_mat = '$vNum_mat' and cod_car = '$vCod_car'";
		$cEstudia = fQuery($vQuery);
		if($aEstudia = $cEstudia->fetch_array())
		{
			$bData = TRUE;
			$_SESSION["sEstupaterno"] = $aEstudia['paterno'];
			$_SESSION["sEstumaterno"] = $aEstudia['materno'];
			$_SESSION["sEstunombres"] = $aEstudia['nombres'];
		}
		$cEstudia->close();
	}
	else
	{
		header("Location:../index.php");
	}
	
	//---------------------------------------------------------------------
	if($bData)	
	{
		$bUltmat = FALSE;
		$bCod_car = FALSE;
		
		if(($vCod_car >= '01' and $vCod_car != '19' and $vCod_car <= '36') or 
			$vCod_car == '56' or $vCod_car == '65' or $vCod_car == '66')
		{
			$bCod_car = TRUE;
			$vAno_ini = substr($vNum_mat, 0, 2);
			if($vAno_ini < '50') 
				$vAno_ini = "20$vAno_ini";
			else
				$vAno_ini = "1999";
				
			for($vAno_aca = '2006'; $vAno_aca >= $vAno_ini and !$bUltmat; $vAno_aca--)
			{
				$tEstumat = "unapnet.estumat{$vCod_car}{$vAno_aca}";
				$vQuery = "Select per_aca, pln_est, cod_esp from $tEstumat where num_mat = '$vNum_mat' and ";
				$vQuery .= "(per_aca = '00' or per_aca = '01' or per_aca = '02') order by per_aca desc";
				
				$cEstumat = fQuery($vQuery);
				while($aEstumat = $cEstumat->fetch_array())
				{
					$_SESSION["sEstupln_est"] = $aEstumat['pln_est'];
					$_SESSION["sEstucod_esp"] = $aEstumat['cod_esp'];	
					$_SESSION["sEstucod_esp2"] = "";
					$_SESSION["sEstucan_esp"] = 1;				
					$bUltmat = TRUE;
					break;
				}		
				$cEstumat->close();		
			}
			
			//---------------------------------------------------------------------
			if(!$bUltmat)
			{
				$tNota = "unapnet.nota{$vCod_car}";
				$vQuery = "Select distinct pln_est from $tNota where num_mat = '$vNum_mat' order by pln_est desc";
				
				$cNota = fQuery($vQuery);
				if($aNota = $cNota->fetch_array())
				{
					$_SESSION["sEstupln_est"] = $aNota['pln_est'];
					$_SESSION["sEstucod_esp"] = "00";
					$_SESSION["sEstucod_esp2"] = "";
					$_SESSION["sEstucan_esp"] = 1;
					$bUltmat = TRUE;
				}		
				$cNota->close();	
			}
			
			//---------------------------------------------------------------------
		}

?>
	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >[<?=$vNum_mat?>] - [<?=$_SESSION["sEstupaterno"]?> <?=$_SESSION["sEstumaterno"]?>, <?=$_SESSION["sEstunombres"]?>] - [<?=$_SESSION["sCarrera{$vCod_car}"]?>]</th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			
			<tr>
              <td width="100" class="wordder">Plan de Estudios : </td>
              <td width="450" class="tdcampo">&nbsp;<select name="rPln_est" id="rPln_est" onChange="grd_viewespecial(this.value)">
					<option value=''>Seleccione ...</option>
					<? fviewplancar($vCod_car, $_SESSION["sEstupln_est"]); 	?>
              </select>&nbsp;</td>
            </tr>
			<tr>
			  <td class="wordder">Menci&oacute;n / Espec. : </td>
			  <td class="tdcamposb" id="xEspecial"><?=((empty($_SESSION["sEstupln_est"]) and empty($_SESSION["sEstucod_esp"]))?"&nbsp;Seleccione el Plan de Estudios":fviewespecialplancarcheck($vCod_car, $_SESSION["sEstupln_est"], $_SESSION["sEstucod_esp"]))?>			  </td>
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
		<?
		if($bCod_car)
		{
		?>
	  <a href="" title="Continuar" class="linkboton" onClick = "grd_selectnivsem(); return false"><img src="../images/bcontinue.png" width="100" height="24"></a> 
<?
		}
	}
	/*
	<select name="rCod_esp" id="rCod_esp" onChange="getnotacon(this.value)" onFocus="getnotacon(this.value)" <?=(empty($_SESSION["sEstucod_esp"])?"disabled=\"disabled\"":"")?>>
			    <?
					if(empty($_SESSION["sEstucod_esp"]))
					{
				?>
				<option value="99">Seleccione Plan de Estudios ...</option>                  
				<?
					}
					else
					{
						fviewespecialplancar($vCod_car, $_SESSION["sEstupln_est"], $_SESSION["sEstucod_esp"]);
					}
				?>
                </select>*/
?>
		
