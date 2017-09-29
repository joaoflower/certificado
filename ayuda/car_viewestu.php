<STYLE type=text/css>
@import url( ../css/main.css );
</STYLE>

<?
	session_start();
	include "../include/function1.php";
	include "../include/function2.php";
	include "../include/funcsql1.php";
	
	$vQuery = "Select num_mat, cod_car from unapnet.carne2006 order by cod_car, ap, am, no ";
?>

<form action="#" method="post" enctype="multipart/form-data" name="fData" id="fData">	  

<table border="0" cellpadding="0" cellspacing="0" id="ventana">
  <tr>
    <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
    <th align="center" background="../images/ventana_r1_c2.jpg" >Nuevo Certificado de Estudios</th>
    <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
  </tr>
  <tr>
    <td background="../images/ventana_r2_c1.jpg"></td>
    <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="0" class="tabled">
      <tr>
        <td width="100" class="wordizq"><select name="rNum_mat" size="20" id="rNum_mat" onchange="car_viewfoto(this.value)">
          <?
		  	
			$cCarne = fQuery($vQuery);
			while($aCarne = $cCarne->fetch_array())
			{
		  ?>
		  <option value="<?=$aCarne['num_mat']?>" ><?=$aCarne['num_mat']?>-<?=$aCarne['cod_car']?></option>
		  <?
		  	}
			$cCarne->close();
		  ?>
                </select></td>
        <td width="300" class="wordizq"><div id="dresult"></div></td>
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

<div id="ddatos"></div>
<div id="ddatos2"></div>


</form>


		
