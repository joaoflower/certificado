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
		$_SESSION["sCod_car"] = "";
		$_SESSION["sPln_est"] = "";
		$_SESSION["sAno_aca"] = "";	
		$_SESSION["sPer_aca"] = "";		
		$vCod_car = $_POST['rCod_car'];
		$_SESSION["sCod_car"] = $vCod_car;
?>
<form action="#" method="post" enctype="multipart/form-data" name="fData" id="fData">	  
	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" ><?=($_SESSION["sPor"]=='emt'?"ACTAS EMITIDAS":($_SESSION["sPor"]=='reg'?"ACTAS EN REGISTRO ACADÉMICO":($_SESSION["sPor"]=='coo'?"ACTAS EN COORDINACIÓN ACADÉMICA":"RECEPCIONAR ACTAS")))?></th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			<tr>
			  <td width="110" class="wordder">Escuela profesional : </td>
			  <td width="250" class="tdcampo">&nbsp;<?=$_SESSION["sCarrera".$_SESSION["sCod_car"]]?></td>
		    </tr>
			<?	if($_SESSION["sPor"]=='rcp')
				{
			?>
			<tr>
			  <td class="wordder">Fecha de recepci&oacute;n : </td>
			  <td class="tdcampo">&nbsp;<input name="rFch_rec" type="text" id="rFch_rec" size="10" maxlength="10" > 
			  (dd/mm/aaaa) </td>
		    </tr>
			<?
				}
			?>
			<tr>
              <td class="wordder">A&ntilde;o acad&eacute;mico : </td>
              <td class="tdcampo">&nbsp;<select name="rAno_aca" id="rAno_aca"  onChange="act_<?=($_SESSION["sPor"]=='rcp'?"get":"view")?>actaano(this.value)" >
					<option value=''>Seleccione ...</option>
        			<? fviewano_aca($_SESSION["sAno_aca"]); 	?>
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
	  <div id="dresult"></div>
</form>
<?
	}
	else
	{
		header("Location:../index.php");
	}
?>
		
