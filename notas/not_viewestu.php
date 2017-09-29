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
		$vPaterno = $_POST['rPaterno'];
		$vMaterno = $_POST['rMaterno'];
		$vNombres = $_POST['rNombres'];
		
		$vPor = $_SESSION["sPor"];
				
		$bDatos = FALSE;
		
		$vQuery = "Select num_mat, cod_car, paterno, materno, nombres from unapnet.estudiante ";
		$vQuery .= "where cod_car != '' ";
		
		if((!empty($vNum_mat) or !empty($vPaterno) or !empty($vMaterno) or !empty($vNombres)))
		{
			if(!empty($vNum_mat))
				$vQuery .= "and num_mat like '$vNum_mat%'";			
			if(!empty($vPaterno))
				$vQuery .= "and paterno like '$vPaterno%'";		
			if(!empty($vMaterno))
				$vQuery .= "and materno like '$vMaterno%'";			
			if(!empty($vNombres))
				$vQuery .= "and nombres like '$vNombres%'";			
				
			$vQuery .= " order by paterno, materno, nombres limit 2 ";
			$bDatos = TRUE;
		}
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

<table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
  
  	<? 	
  	$vCont = 1;
	if($bDatos == TRUE)
	{
		$cEstudia = fQuery($vQuery);
						
		while($aEstudia = $cEstudia->fetch_array())
		{
  	?>
  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
    <td width="15" class="wordder"><?=$vCont?></td>
    <td width="60"><a href="" onClick="not_viewnota<?=$vPor?>('<?=$aEstudia['num_mat']?>', '<?=$aEstudia['cod_car']?>'); return false;" class="linktext">
      <?=$aEstudia['num_mat']?>
    </a></td>
    <td width="140" class="wordizq">&nbsp;<?=$aEstudia['paterno']?>&nbsp;</td>
    <td width="140" class="wordizq">&nbsp;<?=$aEstudia['materno']?>&nbsp;</td>
    <td width="170" class="wordizq">&nbsp;<?=$aEstudia['nombres']?>&nbsp;</td>
    <td width="16" class="wordizq"><a href="" onClick="not_viewnota<?=$vPor?>('<?=$aEstudia['num_mat']?>', '<?=$aEstudia['cod_car']?>'); return false;" class="linkicon"><img src="../images/browse.png" alt="Mostrar informaci&oacute;n" width="16" height="16" /></a></td>
  </tr>
  	<? 
			$vCont++; 	
		} 
		$cEstudia->close();
	}
	?>
</table>

