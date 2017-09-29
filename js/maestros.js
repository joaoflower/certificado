function clickestudiante()
{
	var vlink = "est_getestu.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "rNum_mat");
//	fchangeobject("rNum_mat");
}
function clickplan()
{
	var vlink = "pln_getcar.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}

//-------	Inicio Estudiante	---------------------------------
function est_versearch(pobject)
{
	if(pobject.value.length > 1)
		est_searchest();
}
function est_searchest()
{
	var vNum_mat = document.fData.rNum_mat.value;
	var vPaterno = document.fData.rPaterno.value;
	var vMaterno = document.fData.rMaterno.value;
	var vNombres = document.fData.rNombres.value;
	
	var vlink = "est_viewestu.php";
	var vparam = "rNum_mat=" + vNum_mat + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	var vlayer = "dresult";

	clearlayer("ddatos");
	openpagepost(vlink, vparam, vlayer, true, "");
}

function est_viewdataest(pnum_mat, pcod_car)
{
	var vlink = "est_viewdata.php";
	var vparam = "rNum_mat=" + pnum_mat + "&rCod_car=" + pcod_car;
	var vlayer = "ddatos";

	openpagepost(vlink, vparam, vlayer, true, "");
}
//-------------- Fin Estudiante ------------

//-------------- Inicia Plan ---------------
function pln_selectplan(pcod_car)
{
	var vlink = "pln_getplan.php";
	var vparam = "rCod_car=" + pcod_car;
	var vlayer = "dsubcontent";
	openpagepost(vlink, vparam, vlayer, true, "");
}

function pln_viewplan(ppln_est)
{
	var vlink = "pln_viewplan.php";
	var vparam = "rPln_est=" + ppln_est;
	var vlayer = "dresult";
	openpagepost(vlink, vparam, vlayer, true, "");
}
//--------------- Fin Plan ----------------
