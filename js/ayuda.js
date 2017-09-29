function clickcarne()
{
	var vlink = "car_viewestu.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}

function car_viewfoto(pnum_mat)
{
	var vlink = "car_viewfoto.php";
	var vparam = "rNum_mat=" + pnum_mat;
	var vlayer = "dresult";
	openpagepost(vlink, vparam, vlayer, true, "");
}
