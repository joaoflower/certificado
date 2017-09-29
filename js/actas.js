function clickemitidas()
{
	var vlink = "act_getcar.php";
	var vparam = "rPor=Emitidas";
	var vlayer = "dsubcontent";
	openpagepost(vlink, vparam, vlayer, true, "");
}
function clickenregistro()
{
	var vlink = "act_getcar.php";
	var vparam = "rPor=Registro";
	var vlayer = "dsubcontent";
	openpagepost(vlink, vparam, vlayer, true, "");
}
function clickencoordinacion()
{
	var vlink = "act_getcar.php";
	var vparam = "rPor=Coordinacion";
	var vlayer = "dsubcontent";
	openpagepost(vlink, vparam, vlayer, true, "");
}
function clickrecepcionar()
{
	var vlink = "act_getcar.php";
	var vparam = "rPor=Recepcionar";
	var vlayer = "dsubcontent";
	openpagepost(vlink, vparam, vlayer, true, "");
}

//--------------------Actas----------------
function act_getano(pcod_car)
{
	var vlink = "act_getano.php";
	var vparam = "rCod_car=" + pcod_car;
	var vlayer = "dsubcontent";
	openpagepost(vlink, vparam, vlayer, true, "");
}
function act_viewactaano(pano_per)
{
	var vlink = "act_viewactaano.php";
	var vparam = "rAno_per=" + pano_per;
	var vlayer = "dresult";
	openpagepost(vlink, vparam, vlayer, true, "");
}
function act_getactaano(pano_per)
{
	var vlink = "act_getactaano.php";
	var vparam = "rAno_per=" + pano_per;
	var vlayer = "dresult";
	openpagepost(vlink, vparam, vlayer, true, "");
}
function act_saveactaano()
{
	var i = 0;
	var vCod_act = "";
	for (i=0;i<document.fData.elements.length;i++) 
	{
      	if(document.fData.elements[i].type == "checkbox") 
		{
	        if(document.fData.elements[i].checked == true)
			{
				vCod_act = vCod_act + document.fData.elements[i].value;
			}
		}
	}
	
	var vFch_rec = document.fData.rFch_rec.value;
	var vlink = "act_saveactaano.php";
	var vparam = "rFch_rec=" + vFch_rec + "&rCod_act=" + vCod_act;
	var vlayer = "dresult";

	openpagepost(vlink, vparam, vlayer, true, "");
}



//-----------------------------------------
