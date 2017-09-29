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
		if(!empty($_SESSION["sEstunum_mat"]) and !empty($_SESSION["sEstucod_car"]) and !empty($_SESSION["sEstupln_est"]) and 
			(!empty($_SESSION["sEstucod_esp"]) or !empty($_SESSION["sEstucod_esp2"])))
		{
			$vNiv_sem = $_POST["rNiv_sem"];
			$vType = $_POST["rType"];

			if($vType == "Add")
			{
				$_SESSION["sEstuniv_sem".$vNiv_sem] = $vNiv_sem;
			}
			elseif($vType == "Drop")
			{
				$_SESSION["sEstuniv_sem".$vNiv_sem] = "";
			}
		}
	}
?>