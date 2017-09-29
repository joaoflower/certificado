var vCan_esp = 1;
function clickplan()
{
	var vlink = "pln_getcar.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clicknewcerti()
{
	var vlink = "nct_getestu.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
//-------------- Inicia Plan ---------------
function pln_selectplan(pcod_car)
{
	var vlink = "pln_getplan.php";
	var vparam = "rCod_car=" + pcod_car;
	var vlayer = "dsubcontent";
	openpagepost(vlink, vparam, vlayer, true, "rPln_est");
}

function pln_viewplan(ppln_est)
{
	var vlink = "pln_viewplan.php";
	var vparam = "rPln_est=" + ppln_est;
	var vlayer = "dresult";
	openpagepost(vlink, vparam, vlayer, true, "");
}

function pln_newplan()
{
	var vlink = "pln_newplan.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function pln_newcurso()
{
	var vlink = "pln_newcurso.php";
	var vparam = "rAccion=New";
	var vlayer = "dresult";
	openpagepost(vlink, vparam, vlayer, true, "rNom_cur");
}
function pln_editcurso(pcod_cur)
{
	var vlink = "pln_newcurso.php";
	var vparam = "rAccion=Edit&rCod_cur=" + pcod_cur;
	var vlayer = "dresult";
	openpagepost(vlink, vparam, vlayer, true, "rNom_cur");
}
function pln_saveplan(ptip_sist)
{
	var vlink = "pln_saveplan.php";
	var vparam = "rTip_sist=" + ptip_sist;
	var vlayer = "dsubcontent";
	openpagepost(vlink, vparam, vlayer, true, "rPln_est");
}
function pln_savecurso(pcod_cur, pnom_cur, pcrd_cur, pniv_est, psem_anu)
{
	var vlink = "pln_savecurso.php";
	var vparam = "rCod_cur=" + pcod_cur + "&rNom_cur=" +  pnom_cur + "&rCrd_cur=" + pcrd_cur + "&rNiv_est=" + pniv_est + "&rSem_anu=" + psem_anu;
	var vlayer = "dresult";
	openpagepost(vlink, vparam, vlayer, true, "");
}
//--------------- Fin Plan ----------------

//-------	Inicio nuevo certificado	---------------------------------
function nct_versearch(pobject)
{
	if(pobject.value.length > 3)
		nct_searchest();
}
function nct_searchest()
{
	var vNum_mat = document.fData.rNum_mat.value;
	var vPaterno = document.fData.rPaterno.value;
	var vMaterno = document.fData.rMaterno.value;
	var vNombres = document.fData.rNombres.value;
	
	var vlink = "nct_viewestu.php";
	var vparam = "rNum_mat=" + vNum_mat + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	var vlayer = "dresult";

	clearlayer("ddatos");
	openpagepost(vlink, vparam, vlayer, true, "");
}
function nct_selectplan(pnum_mat, pcod_car)
{
	vCan_esp = 1;
	var vlink = "nct_selectplan.php";
	var vparam = "rNum_mat=" + pnum_mat + "&rCod_car=" + pcod_car;
	var vlayer = "ddatos";
	
	openpagepost(vlink, vparam, vlayer, true, "");
}
function nct_viewespecial(ppln_est)
{
	vCan_esp = 1;
	var vlink = "nct_viewespecial.php";
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
			var vlink = "nct_setespecial.php";
			var vparam = "rCod_esp=" + pobject.value + "&rType=Add"; 
			updatepagepost(vlink, vparam);
		}
		else
			pobject.checked = false;
	}
	else
	{
		vCan_esp = vCan_esp - 1;
		var vlink = "nct_setespecial.php";
		var vparam = "rCod_esp=" + pobject.value + "&rType=Drop"; 
		updatepagepost(vlink, vparam);
	}
}
function nct_selectnivsem()
{
	var vNum_rec = document.fData.rNum_rec.value;
	var vTip_cer = "";
	if(document.fData.rTip_cer[0].checked)
		vTip_cer = "1";
	else
		vTip_cer = "2";
		
	var vlink = "nct_selectnivsem.php";
	var vparam = "rNum_rec=" + vNum_rec + "&rTip_cer=" + vTip_cer; 
	var vlayer = "ddatos";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function grd_checkniv_sem(pobject)
{
	if(pobject.checked)
	{
		var vlink = "nct_setniv_sem.php";
		var vparam = "rNiv_sem=" + pobject.value + "&rType=Add"; 
		updatepagepost(vlink, vparam);
	}
	else
	{
		var vlink = "nct_setniv_sem.php";
		var vparam = "rNiv_sem=" + pobject.value + "&rType=Drop"; 
		updatepagepost(vlink, vparam);
	}
}
function nct_viewnotacerti()
{
	var vlink = "nct_viewnotacerti.php";
	var vlayer = "ddatos";

	openpageget(vlink, vlayer, true, "");
}

function nct_editnotacerti(ppln_est, pcod_cur, pmod_not, pano_aca, pper_aca, ptype)
{
	var vlink = "nct_getnotacerti.php";
	var vparam = "rPln_est=" + ppln_est + "&rCod_cur=" + pcod_cur + "&rMod_not=" + pmod_not + "&rAno_aca=" + pano_aca + "&rPer_aca=" + pper_aca + "&rType=" + ptype;
	var vlayer = "ddatos";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function nct_savenotacerti()
{
	var vAno_aca = document.fData.rAno_aca.value;
	var vPer_aca = document.fData.rPer_aca.value;
	var vMod_not = document.fData.rMod_not.value;
	var vNot_cur = document.fData.rNot_cur.value;
	var vCur_con = document.fData.rCur_con.value;
	
	var vlink = "nct_savenotacerti.php";
	var vparam = "rAno_aca=" + vAno_aca + "&rPer_aca=" + vPer_aca + "&rMod_not=" + vMod_not + "&rNot_cur=" + vNot_cur + "&rCur_con=" + vCur_con;
	var vlayer = "ddatos";

	openpagepost(vlink, vparam, vlayer, true, "");
}

//----------------------------------------------------------------