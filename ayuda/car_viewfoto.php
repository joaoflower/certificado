<STYLE type=text/css>
@import url( ../css/main.css );
</STYLE>

<?
	session_start();
	include "../include/function1.php";
	include "../include/function2.php";
	include "../include/funcsql1.php";

	$vNum_mat = $_POST["rNum_mat"];
	
?>

<table border="0" cellpadding="1" cellspacing="0" class="tabled">
  <tr>
    <td><img src="<?="../carne/0120000".$vNum_mat.".jpg"?>" / border="0" height="288" width="240"></td>
    <td><img src="<?="../../unapnet2c/imgsingr/2006/".$vNum_mat.".jpg"?>" / border="0"  height="288" width="240"></td>
  </tr>
</table>
