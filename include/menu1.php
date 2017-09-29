<STYLE type=text/css>
@import url( ../css/main.css );
</STYLE>
<div id="dmenu">
  <a href="../administracion/" <?=($id_menu == 1?"class=\"mselect\"":"")?>>Administraci&oacute;n</a> 
  <a href="../maestros/" <?=($id_menu == 2?"class=\"mselect\"":"")?>>Maestros</a>
<?	if($_SESSION['sUsercod_mod']=='02')
	{	?>
  <a href="../notas/" <?=($id_menu == 3?"class=\"mselect\"":"")?>>Notas</a>
<?	}	
	if($_SESSION['sUsercod_mod']=='01')
	{	?>
  <a href="../certificados/" <?=($id_menu == 4?"class=\"mselect\"":"")?>>Certificados</a>
<?	}	
	if($_SESSION['sUsercod_mod']=='02')
	{	?>
  <a href="../grados/" <?=($id_menu == 5?"class=\"mselect\"":"")?>>Grados</a>
  <a href="../actas/" <?=($id_menu == 6?"class=\"mselect\"":"")?>>Actas</a>
 <?	}	
	if($_SESSION['sUsercod_mod']=='03')
	{	?>
  <a href="../reportes/" <?=($id_menu == 7?"class=\"mselect\"":"")?>>Reportes</a>
 <?	}	?>
  <a href="../ayuda/" <?=($id_menu == 8?"class=\"mselect\"":"")?>>Ayuda</a></div>