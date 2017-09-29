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
		$vPlan = "";
		
		$vQuery = "Select pln_est from unapnet.plan where cod_car = '{$_SESSION['sCod_car']}' order by pln_est desc";
		$cPlan = fQuery($vQuery);
		while($aPlan = $cPlan->fetch_array())
		{
			if($aPlan['pln_est'] == '99')
			{
				$vPlan = '98';
			}
			if($aPlan['pln_est'] == '98')
			{
				$vPlan = '97';
			}
			if($aPlan['pln_est'] == '97')
			{
				$vPlan = '96';
			}
			if($aPlan['pln_est'] == '96')
			{
				$vPlan = '95';
			}
			if($aPlan['pln_est'] < '96')
			{			
				if(empty($vPlan))
					$vPlan = '99';
				break;
			}				
		}
		$cPlan->close();
		$_SESSION['sPln_estn'] = $vPlan;
		
		
?>
<form action="#" method="post" enctype="multipart/form-data" name="fData" id="fData">	  
	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Planes de Estudio </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			<tr>
			  <td width="110" class="wordder">Escuela profesional : </td>
			  <td width="250" class="tdcampo">&nbsp;<?=$_SESSION["sCarrera".$_SESSION["sCod_car"]]?></td>
		    </tr>
			<tr>
			  <td class="wordder">Plan de estudios : </td>
			  <td class="tdcampo">&nbsp;<?=$vPlan?></td>
		    </tr>
			<tr>
              <td class="wordder">Tipo de Sistema  : </td>
              <td class="tdcampo">&nbsp;<select name="rTip_sist" id="rTip_sist" >
					<option value='1'>RIGIDO</option>
					<option value='2'>FLEXIBLE</option>
                </select>&nbsp;</td>
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
	  <a href="" title="Continuar" class="linkboton" onClick = "pln_saveplan(document.fData.rTip_sist.value); return false"><img src="../images/bsave.png" width="100" height="24"></a>
	  <a href="" title="Continuar" class="linkboton" onClick = "pln_selectplan('<?=$_SESSION["sCod_car"]?>'); return false"><img src="../images/bundo.png" width="100" height="24"></a>
	  <div id="dresult"></div>
</form>
<?
	}
	else
	{
		header("Location:../index.php");
	}
?>
		
