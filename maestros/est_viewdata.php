<STYLE type=text/css>
@import url( ../css/main.css );
</STYLE>
<?php
	session_start();
	include "../include/function1.php";
	include "../include/funcsql1.php";
	if(fsafetylogin())
	{
		$vNum_mat = $_POST['rNum_mat'];
		$vCod_car = $_POST['rCod_car'];
		
		$sEstudia = "";
		$bDatos = FALSE;
		
		$vQuery = "Select num_mat, cod_car, paterno, materno, nombres, con_est, direc, fono, celular ";
		$vQuery .= "from unapnet.estudiante where num_mat = '{$vNum_mat}' and cod_car = '$vCod_car' ";
		
		$cEstudia = fQuery($vQuery);
		if($aEstudia = $cEstudia->fetch_array())
		{			
			$sEstudia['num_mat'] = $aEstudia['num_mat'];
			$sEstudia['cod_car'] = $aEstudia['cod_car'];
			$sEstudia['paterno'] = $aEstudia['paterno'];			
			$sEstudia['materno'] = $aEstudia['materno'];
			$sEstudia['nombres'] = $aEstudia['nombres'];
			$sEstudia['con_est'] = $aEstudia['con_est'];
			$sEstudia['direc'] = $aEstudia['direc'];
			$sEstudia['fono'] = $aEstudia['fono'];
			$sEstudia['celular'] = $aEstudia['celular'];
			
			$cEstudia->close();
			$bDatos = TRUE;			
		}
		else
		{
			$cEstudia->close();
		}		
		
			
	}
	else
	{
		header("Location:../index.php");
	}	
	
	if($bDatos)
	{
?>

	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
    <tr>
      <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
      <th align="center" background="../images/ventana_r1_c2.jpg" >Datos Personales del estudiante </th>
      <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
    </tr>
    <tr>
      <td background="../images/ventana_r2_c1.jpg"></td>
      <td background="../images/ventana_r2_c2.jpg"><table width="550" border="0" cellpadding="1" cellspacing="1" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
        <tr>
          <td width="70" class="wordder">Estudiante :</td>
          <td width="460" class="tdcampo">&nbsp;<?=$sEstudia['num_mat']?> - <?=$sEstudia['paterno']?> <?=$sEstudia['materno']?>, <?=$sEstudia['nombres']?></td>
        </tr>
        <tr>
          <td class="wordder">Escuela Prof.: </td>
          <td class="tdcampo">&nbsp;<?=$_SESSION["sCarrera{$sEstudia['cod_car']}"]?></td>
        </tr>
        <tr>
          <td class="wordder">Condici&oacute;n :</td>
          <td class="tdcampo">&nbsp;ESTUDIANTE <?=$_SESSION["sCondestu{$sEstudia['con_est']}"]?></td>
        </tr>
        <tr>
          <td class="wordder">Direccion : </td>
          <td class="tdcampo">&nbsp;<?=$sEstudia['direc']?></td>
        </tr>
        <tr>
          <td class="wordder">Tel&eacute;fono : </td>
          <td class="tdcampo">&nbsp;<?=$sEstudia['fono']?> - <?=$sEstudia['celular']?></td>
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

    <table border="0" cellpadding="0" cellspacing="0" id="ventana2">
      <tr>
        <th><img src="../images/ventana_r1_c1.jpg" alt="" name="ventana_r1_c1" width="12" height="29" border="0" id="ventana_r1_c1" /></th>
        <th align="center" background="../images/ventana_r1_c2.jpg" >Datos de matr&iacute;cula</th>
        <th><img src="../images/ventana_r1_c4.jpg" alt="" name="ventana_r1_c4" width="11" height="29" border="0" id="ventana_r1_c4" /></th>
      </tr>
      <tr>
        <td background="../images/ventana_r2_c1.jpg"></td>
        <td background="../images/ventana_r2_c2.jpg"><table width="550" border="0" cellpadding="1" cellspacing="1" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <td width="70" class="wordder">Plan :</td>
              <td width="200" class="tdcampo">&nbsp;</td>
              <td width="70" class="wordder">Semestre :</td>
              <td width="200" class="tdcampo">&nbsp;</td>
          </tr>
            <tr>
              <td class="wordder">Especialidad :</td>
              <td colspan="3" class="tdcampo">&nbsp;</td>
            </tr>
            <tr>
              <td class="wordder">Modalidad :</td>
              <td class="tdcampo">&nbsp;</td>
              <td class="wordder">Total Cred.:</td>
              <td class="tdcampo">&nbsp;</td>
            </tr>
            <tr>
              <td class="wordder">Grupo :</td>
              <td class="tdcampo">&nbsp;</td>
              <td class="wordder">Fecha Mat. :</td>
              <td class="tdcampo">&nbsp;</td>
            </tr>
        </table></td>
        <td background="../images/ventana_r2_c4.jpg"></td>
      </tr>
      <tr>
        <td><img src="../images/ventana_r4_c1.jpg" alt="" name="ventana_r4_c1" width="12" height="10" border="0" id="ventana_r4_c1" /></td>
        <td background="../images/ventana_r4_c2.jpg"></td>
        <td><img src="../images/ventana_r4_c4.jpg" alt="" name="ventana_r4_c4" width="11" height="10" border="0" id="ventana_r4_c4" /></td>
      </tr>
    </table>
    <?
	}
?>