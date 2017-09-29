var vCan_esp = 1;
function clickhistoacad()
{
	var vlink = "grd_getestu.php";
	var vparam = "rPor=Historial";
	var vlayer = "dsubcontent";	
	openpagepost(vlink, vparam, vlayer, true, "rNum_mat");
}

function clickcerplan()
{
	var vlink = "grd_getestu.php";
	var vparam = "rPor=Cerplan";
	var vlayer = "dsubcontent";	
	openpagepost(vlink, vparam, vlayer, true, "rNum_mat");
}

//-------	Inicio historial	---------------------------------
function grd_versearch(pobject)
{
	if(pobject.value.length > 3)
		grd_searchest();
}
function grd_searchest()
{
	var vNum_mat = document.fData.rNum_mat.value;
	var vPaterno = document.fData.rPaterno.value;
	var vMaterno = document.fData.rMaterno.value;
	var vNombres = document.fData.rNombres.value;
	
	var vlink = "grd_viewestu.php";
	var vparam = "rNum_mat=" + vNum_mat + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	var vlayer = "dresult";

	clearlayer("ddatos");
	openpagepost(vlink, vparam, vlayer, true, "");
}
function grd_selectplan(pnum_mat, pcod_car)
{
	vCan_esp = 1;
	var vlink = "grd_selectplan.php";
	var vparam = "rNum_mat=" + pnum_mat + "&rCod_car=" + pcod_car;
	var vlayer = "ddatos";
	
	openpagepost(vlink, vparam, vlayer, true, "");
}
function grd_viewespecial(ppln_est)
{
	vCan_esp = 1;
	var vlink = "grd_viewespecial.php";
	var vparam = "rPln_est=" + ppln_est;
	var vlayer = "xEspecial";

	openpagepost(vlink, vparam, vlayer, true, "");
}

function grd_checkespecial(pobject)
{
	if(pobject.checked)
	{
		if(vCan_esp < 2)
		{
			vCan_esp = vCan_esp + 1;
			var vlink = "grd_setespecial.php";
			var vparam = "rCod_esp=" + pobject.value + "&rType=Add"; 
			updatepagepost(vlink, vparam);
		}
		else
			pobject.checked = false;
	}
	else
	{
		vCan_esp = vCan_esp - 1;
		var vlink = "grd_setespecial.php";
		var vparam = "rCod_esp=" + pobject.value + "&rType=Drop"; 
		updatepagepost(vlink, vparam);
	}
}
function grd_checkniv_sem(pobject)
{
	if(pobject.checked)
	{
		var vlink = "grd_setniv_sem.php";
		var vparam = "rNiv_sem=" + pobject.value + "&rType=Add"; 
		updatepagepost(vlink, vparam);
	}
	else
	{
		var vlink = "grd_setniv_sem.php";
		var vparam = "rNiv_sem=" + pobject.value + "&rType=Drop"; 
		updatepagepost(vlink, vparam);
	}
}

function grd_selectnivsem()
{
	var vlink = "grd_selectnivsem.php";
	var vlayer = "ddatos";

	openpageget(vlink, vlayer, true, "");
}

function grd_viewnotahisto()
{
	var vlink = "grd_viewnotahisto.php";
	var vlayer = "ddatos";

	openpageget(vlink, vlayer, true, "");
}
function grd_viewnotacerplan()
{
	var vlink = "grd_viewnotacerplan.php";
	var vlayer = "ddatos";

	openpageget(vlink, vlayer, true, "");
}