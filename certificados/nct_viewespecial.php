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
		if(!empty($_SESSION["sEstunum_mat"]) and !empty($_SESSION["sEstucod_car"]))
		{
			$vPln_est = $_POST["rPln_est"];
			$_SESSION["sEstupln_est"] = $vPln_est;
			$_SESSION["sEstucod_esp"] = "00";	
			$_SESSION["sEstucod_esp2"] = "";	
			$_SESSION["sEstucan_esp"] = 1;
			fviewespecialplancarcheck($_SESSION["sEstucod_car"], $vPln_est, $_SESSION["sEstucod_esp"]);
		}
	}
?>