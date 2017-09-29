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
		if($_SESSION["sCod_car"] != $_POST['rCod_car'])
			$_SESSION["sPln_est"] = "";
		$vCod_car = $_POST['rCod_car'];
		$_SESSION["sCod_car"] = $vCod_car;
?>
<form action="#" method="post" enctype="multipart/form-data" name="fData2" id="fData2">	  
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
              <td class="wordder">Plan de Estudios : </td>
              <td class="tdcampo">&nbsp;<select name="rPln_est" id="rPln_est" onChange="pln_viewplan(this.value)" onfocus="pln_viewplan(this.value)">
					<option value=''>Seleccione ...</option>
        			<? fviewplancar($_SESSION["sCod_car"], $_SESSION["sPln_est"]); 	?>
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
	  <a href="" title="Continuar" class="linkboton" onClick = "pln_newplan(); return false"><img src="../images/bnuevoplan.png" width="100" height="24"></a>
	  <a href="" title="Continuar" class="linkboton" onClick = "pln_newcurso(); return false"><img src="../images/bnuevocur.png" width="100" height="24"></a>
</form>
	  <div id="dresult"></div>

<?
	}
	else
	{
		header("Location:../index.php");
	}
?>
		
