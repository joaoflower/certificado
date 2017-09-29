<STYLE type=text/css>
@import url( ../css/main.css );
</STYLE>

<?
	session_start();
	$_SESSION["sPor"] = "";
	include "../include/function1.php";
	include "../include/funcsql1.php";
	if(fsafetylogin())
	{
		$vPor = $_POST['rPor'];
		if($vPor == 'Emitidas')
			$_SESSION["sPor"] = 'emt';
		elseif($vPor == 'Registro')
			$_SESSION["sPor"] = 'reg';
		elseif($vPor == 'Coordinacion')
			$_SESSION["sPor"] = 'coo';	
		elseif($vPor == 'Recepcionar')
			$_SESSION["sPor"] = 'rcp';
?>
<form action="#" method="post" enctype="multipart/form-data" name="fData" id="fData">	  

<table border="0" cellpadding="0" cellspacing="0" id="ventana">
  <tr>
    <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
    <th align="center" background="../images/ventana_r1_c2.jpg" >Seleccione la Escuela Profesional  </th>
    <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
  </tr>
  <tr>
    <td background="../images/ventana_r2_c1.jpg"></td>
    <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
      <tr>
        <th width="15" class="wordizq">&nbsp;</th>
        <th width="30" class="wordizq">&nbsp;Cod.</th>
        <th width="300" class="wordizq">&nbsp;Nombre de Escuela Profesional </th>
        <th width="16" class="wordizq">&nbsp;</th>
      </tr>
      <?
	  	$vCont = 1;
		
		$vQuery = "Select cod_car, car_des from unapnet.carrera where (cod_car >= '01' and cod_car <= '36' and ";
		$vQuery .= "cod_car != 19) or cod_car = '56' or cod_car = '65' or cod_car = '66' order by cod_car ";
		$cCarrera = fQuery($vQuery);
		while($aCarrera = $cCarrera->fetch_array())
		{
	  ?>
	  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
        <td class="wordizq">&nbsp;</td>
        <td class="wordcen"><?=$aCarrera['cod_car']?></td>
        <td class="wordizq">&nbsp;<?=$aCarrera['car_des']?></td>
        <td class="wordizq"><a href="" onClick="act_getano('<?=$aCarrera['cod_car']?>'); return false;" class="linkicon"><img src="../images/browse.png" alt="Mostrar informaci&oacute;n" width="16" height="16" /></a></td>
      </tr>
      <?
	  		$vCont++;
		}
		$cCarrera->close();
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
</form>
<?
	}
	else
	{
		header("Location:../index.php");
	}
?>
		
