function clickpormatri()
{
	var vlink = "not_getestu.php";
	var vparam = "rPor=Matricula";
	var vlayer = "dsubcontent";	
	openpagepost(vlink, vparam, vlayer, true, "rNum_mat");
}
function clickporplan()
{
	var vlink = "not_getestu.php";
	var vparam = "rPor=Plan";
	var vlayer = "dsubcontent";	
	openpagepost(vlink, vparam, vlayer, true, "rNum_mat");
}


//-------	Inicio Notas	---------------------------------
function not_versearch(pobject)
{
	if(pobject.value.length > 3)
		not_searchest();
}
function not_searchest()
{
	var vNum_mat = document.fData.rNum_mat.value;
	var vPaterno = document.fData.rPaterno.value;
	var vMaterno = document.fData.rMaterno.value;
	var vNombres = document.fData.rNombres.value;
	
	var vlink = "not_viewestu.php";
	var vparam = "rNum_mat=" + vNum_mat + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	var vlayer = "dresult";

	clearlayer("ddatos");
	openpagepost(vlink, vparam, vlayer, true, "");
}
function not_viewnotamatri(pnum_mat, pcod_car)
{
	var vlink = "not_viewnotamatri.php";
	var vparam = "rNum_mat=" + pnum_mat + "&rCod_car=" + pcod_car;
	var vlayer = "ddatos";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function not_viewnotaplan(pnum_mat, pcod_car)
{
	var vlink = "not_viewnotaplan.php";
	var vparam = "rNum_mat=" + pnum_mat + "&rCod_car=" + pcod_car;
	var vlayer = "ddatos";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function not_viewactaesc(pcod_act, pano_aca)
{
	var vAtributo;
	vAtributo = "center=yes; dialogHeight=550px; dialogWidth=800px; dialogLeft=px; dialogTop=px; ";
	vAtributo += "help=no; status=no; scroll=yes; resizable=no; font-family=Arial; font-size=11px";
	
	vReturn = window.showModalDialog("not_viewactaesc.php?rCod_act=" + pcod_act + "&rAno_aca=" + pano_aca, "mensaje", vAtributo);
}
//-------- Fin Estudiante ----------------------------

/*	alert(vlink);
	alert(vparam);
	alert(vlayer);*/