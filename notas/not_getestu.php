<STYLE type=text/css>
@import url( ../css/main.css );
</STYLE>

<?
	session_start();
	$_SESSION["sPor"] = "";
	$vPor = $_POST['rPor'];
	if($vPor == 'Matricula')
		$_SESSION["sPor"] = 'matri';
	elseif($vPor == 'Plan')
		$_SESSION["sPor"] = 'plan';	
?>

<form action="#" method="post" enctype="multipart/form-data" name="fData" id="fData">	  

<table border="0" cellpadding="0" cellspacing="0" id="ventana">
  <tr>
    <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
    <th align="center" background="../images/ventana_r1_c2.jpg" >Notas de Estudiantes por <?=$vPor?></th>
    <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
  </tr>
  <tr>
    <td background="../images/ventana_r2_c1.jpg"></td>
    <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="0" class="tabled">
      <tr>
        <th width="15" class="wordizq">&nbsp;</th>
        <th width="60" class="wordizq">N&deg; Mat. </th>
        <th width="140" class="wordizq">Paterno</th>
        <th width="140" class="wordizq">Materno</th>
        <th width="170" class="wordizq">Nombres</th>
        <th width="16" class="wordizq">&nbsp;</th>
      </tr>
      <tr>
        <th class="wordizq	">&nbsp;</th>
        <th class="wordizq	"><input name="rNum_mat" type="text" id="rNum_mat" size="6" maxlength="6"  onBlur="not_versearch(this);" >
              </span></th>
        <th class="wordizq"><input name="rPaterno" type="text" id="rPaterno" onBlur="not_versearch(this);" size="20" maxlength="20" ></th>
        <th class="wordizq"><input name="rMaterno" type="text" id="rMaterno" size="20" maxlength="20" onBlur="not_versearch(this);" ></th>
        <th class="wordizq"><input name="rNombres" type="text" class="texto" id="rNombres" size="25" maxlength="30" onBlur="not_versearch(this);" ></th>
        <th class="wordizq">&nbsp;</th>
      </tr>
      <tr>
        <td colspan="6" class="wordder"><div id="dresult"></div></td>
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


</form>


		
