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
		if(!empty($_SESSION["sEstunum_mat"]) and !empty($_SESSION["sEstucod_car"]) and !empty($_SESSION["sEstupln_est"]))
		{
			$vCod_esp = $_POST["rCod_esp"];
			$vType = $_POST["rType"];

			if($vType == "Add")
			{
				if($_SESSION["sEstucan_esp"] < 2)
				{
					$_SESSION["sEstucan_esp"]++;
					if(empty($_SESSION["sEstucod_esp"]))
						$_SESSION["sEstucod_esp"] = $vCod_esp;
					elseif(empty($_SESSION["sEstucod_esp2"]))
						$_SESSION["sEstucod_esp2"] = $vCod_esp;						
				}
			}
			elseif($vType == "Drop")
			{
				if($_SESSION["sEstucan_esp"] > 0)
				{
					$_SESSION["sEstucan_esp"]--;
					if($_SESSION["sEstucod_esp"] == $vCod_esp)
						$_SESSION["sEstucod_esp"] = "";
					elseif($_SESSION["sEstucod_esp2"] == $vCod_esp)
						$_SESSION["sEstucod_esp2"] = "";
				}
			}
		}
	}
?>