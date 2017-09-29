<?php

	session_start();
	include "../include/function1.php";
	include "../include/funcsql1.php";
	require "../include/fpdf.php";

	if(fsafetylogin())
	{
		class PDF extends FPDF
		{
			function SubHeader()
			{					
				$this->SetFont('arialn','B',8);
				$this->Cell(10,4,'', 'LRT', 0, 'C');
				
				if($_SESSION["sEstutip_sist"] == '1')
					$this->Cell(120,4,'ASIGNATURAS', 'LRT', 0, 'C');
				elseif($_SESSION["sEstutip_sist"] == '2')
					$this->Cell(110,4,'ASIGNATURAS', 'LRT', 0, 'C');
				
				$this->Cell(30,4,'CALIFICACIONES', 1, 0, 'C');
				
				if($_SESSION["sEstutip_sist"] == '2')
					$this->Cell(10,4,'CRE-', 'LRT', 0, 'C');
				
				$this->Cell(15,4,'FECHA', 'LRT', 0, 'C');
				$this->Cell(15,4,'TOMO', 'LRT', 0, 'C');
				$this->Ln();
				
				
				$this->Cell(10,4,'', 'LR', 0, 'C');

				if($_SESSION["sEstutip_sist"] == '1')
					$this->Cell(120,4,'', 'LRB', 0, 'C');
				elseif($_SESSION["sEstutip_sist"] == '2')
					$this->Cell(110,4,'', 'LRB', 0, 'C');

				$this->Cell(20,4,'LETRAS', 1, 0, 'C');
				$this->Cell(10,4,'N°', 1, 0, 'C');
				
				if($_SESSION["sEstutip_sist"] == '2')
					$this->Cell(10,4,'DITOS','LRB', 0, 'C');
					
				$this->Cell(15,4,'','LRB', 0, 'C');
				$this->Cell(15,4,'FOLIO','LRB', 0, 'C');
				$this->Ln();			
			}
			function Titulo()
			{
				$this->Ln(25);
				
				$this->SetFont('arial','B',10);

				$this->Cell(180,4,"La que suscribe, Jefa de la Unidad de Registro Académico de la Universidad Nacional ", 0);
				$this->Ln();
				$this->Cell(180,4,"del Altiplano - Puno ", 0);
				$this->Ln();
				
				//$this->Ln(1);
				
				$this->SetFont('arialn','B',10);
				$this->Cell(5);
				$this->Cell(40,4, "Certifica que don(ña) ", 0);
				$this->Cell(140,4, ": {$_SESSION['sEstunombres']} {$_SESSION['sEstupaterno']} {$_SESSION['sEstumaterno']} ", 0);
				$this->Ln();
				
				$vQuery = "select cod_fac from unapnet.carrera ";
				$vQuery .= "where cod_car = '{$_SESSION['sEstucod_car']}'";
				$cFacultad = fQuery($vQuery);
				if($aFacultad = $cFacultad->fetch_array())
				{
					$vCod_fac = $aFacultad['cod_fac'];
				}
				$cFacultad->close();
				
				$this->Cell(5);
				$this->Cell(40,4, "Facultad ", 0);
				$this->Cell(140,4, ": ".$_SESSION["sFacultad".$vCod_fac], 0);
				$this->Ln();
				
				$this->Cell(5);
				$this->Cell(40,4, "Escuela Profesional ", 0);
				$this->Cell(140,4, ": ".$_SESSION["sCarrera{$_SESSION['sEstucod_car']}"], 0);
				$this->Ln();
				
				$vQuery = "select esp_nom from unapnet.especial ";
				$vQuery .= "where cod_car = '{$_SESSION['sEstucod_car']}' and pln_est = '{$_SESSION['sEstupln_est']}' and ";
				$vQuery .= "cod_esp = '{$_SESSION['sEstucod_esp']}' ";
				$cEspecial = fQuery($vQuery);
				if($aEspecial = $cEspecial->fetch_array())
				{
					$vEsp_nom = $aEspecial['esp_nom'];
				}
				$cEspecial->close();
				
				//----------------
				$i = 0;
				$vEsp_nom2 = "";
				$this->Cell(5);
				if($_SESSION["sEstutip_sist"] == '1')
					$this->Cell(40,4, "Especialidad", 0);
				elseif($_SESSION["sEstutip_sist"] == '2')
					$this->Cell(40,4, "Mención", 0);
				
				$this->Cell(140,4, ": $vEsp_nom", 0);
				$this->Ln();
				//-----------------
				
				
				$this->Cell(5);
				$this->Cell(40,4, "N° de matrícula ", 0);
				$this->Cell(140,4, ": {$_SESSION['sEstunum_mat']}", 0);
				$this->Ln();
				
				//$this->Ln(1);
				
				$this->Cell(180,5,"HA OBTENIDO LOS SIGUIENTES CALIFICATIVOS FINALES:", 0);
				$this->Ln();
				
				$this->Rect(165, 34, 28, 33);
			}
			function SubFooter()
			{
				$this->Image("../images/baner.jpg",10,30);
				$this->SetFont('arialn','B',10);
				$this->Cell(180,4,"La  presente certificación no acredita la culminación de los estudios ni la obtención de grado académico o título profesional.", 0);
				$this->Ln();
				$this->Cell(180,4,"Cualquier enmendadura o anotación de la línea de cierre de la relación invalida la presente certificación.", 0);
				$this->Ln();
				
				$this->Line(20, 260, 70, 260);
				$this->Line(80, 280, 130, 280);
				$this->Line(140, 260, 190, 260);
			}
			function SubFooter2()
			{
				$this->SetFont('arialn','B',10);
				$this->Cell(180,4,"La  presente certificación no acredita la culminación de los estudios ni la obtención de grado académico o título profesional.", 0);
				$this->Ln();
				$this->Cell(180,4,"Cualquier enmendadura o anotación de la línea de cierre de la relación invalida la presente certificación.", 0);
				$this->Ln();
				
				$this->Line(20, 260, 70, 260);
				$this->Line(80, 280, 130, 280);
				$this->Line(140, 260, 190, 260);
			}
			function NuevaHoja()
			{
				$this->SubFooter();
				$this->AddPage();
				$this->Titulo();
				$this->Image("../images/baner.jpg",10,90);
				$this->SubHeader();
				$this->SetFont('arialn','',9);
			}
			function Body()
			{			
				$sNotas = "";
				
				$this->Titulo();
				//$this->Image("../images/baner.jpg",10,90);
				
				//-----------------------------------
				$vQuery = $_SESSION["sEstusqlnota"];
				$cNotas = fQuery($vQuery);
				while($aNotas = $cNotas->fetch_array())
				{ 
					$sNotas[$aNotas['cod_cur']]['not_cur'] = $aNotas['not_cur'];
					$sNotas[$aNotas['cod_cur']]['ano_aca'] = $aNotas['ano_aca'];
					$sNotas[$aNotas['cod_cur']]['per_aca'] = $aNotas['per_aca'];
					$sNotas[$aNotas['cod_cur']]['fch_reg'] = $aNotas['fch_reg'];
					$sNotas[$aNotas['cod_cur']]['mod_not'] = $aNotas['mod_not'];
					$sNotas[$aNotas['cod_cur']]['cur_con'] = $aNotas['cur_con'];
				}
				$cNotas->close();
				//-----------------------------------
			
				$this->SubHeader();
				$this->SetFont('arialn','',9);
				//-----------------------------------
				
				$vFilas = 1;
				$vCont = 1;
				$vNiv_est = "";
				$vSem_anu = "";
				$vLado = "RL";
				$vNom_cur2 = "";
				$vNom_cur = "";
				
				$vQuery = $_SESSION["sEstusqlcurso"];
				$cCurso = fQuery($vQuery);
				while($sPlan = $cCurso->fetch_array())
				{ 
					$vNom_cur = $sPlan['nom_ofi'];
					if($sNotas[$sPlan['cod_cur']]['mod_not'] == '04')
						$vNom_cur .= " (POR: ".$sNotas[$sPlan['cod_cur']]['cur_con'].")";
					//----------------- cursos (cursos aprobados) ----------------
					if(!empty($_SESSION["sNum".$sNotas[$sPlan['cod_cur']]['not_cur']]) and ($sNotas[$sPlan['cod_cur']]['not_cur'] > 10 or $_SESSION["sEstutip_cer"] == '2'))
					{
						//-----------Para la segunda hoja------------------------
						$vNom_cur2 = "";
						//----- Segunda página ---------
						if($vFilas == 41)
							$this->SubHeader();
	
						//----- Tercera página ------------
						if($vFilas == 84)
							$this->NuevaHoja();

						//--------- Nivel y/o semestre --------------
						$this->SetFont('arialn','',9);
						if($sPlan['niv_est'] != $vNiv_est or $sPlan['sem_anu'] != $vSem_anu)
						{
							$vNiv_est = $sPlan['niv_est'];
							$vSem_anu = $sPlan['sem_anu'];
							
							//--------- Ultima fila de pagina ------------
							if($vFilas == 40 or $vFilas == 83)
							{
								if($vFilas == 40)
								{
									$this->Image("../images/baner.jpg",10,90);
								}
								$vLado = "RLB";
							}
								
							$this->Cell(10,5,'', $vLado, 0, 'C');
							$this->SetFont('arialn','B',9);
							if($_SESSION["sEstutip_sist"] == '1')
								$this->Cell(180,5, "NIVEL: ".$_SESSION["sNivel".$sPlan['niv_est']]." - SEMESTRE: ".$_SESSION["sSemestre".$sPlan['sem_anu']] , 1);
							elseif($_SESSION["sEstutip_sist"] == '2')
								$this->Cell(180,5, "SEMESTRE: ".$_SESSION["sSemestre".$sPlan['sem_anu']] , 1);
							$this->Ln();
							
							$vFilas++;
							
							//----- Segunda página ---------
							if($vFilas == 41)
								$this->SubHeader();
		
							//----- Tercera página ------------
							if($vFilas == 84)
								$this->NuevaHoja();

							$vLado = "RL";					
						}

						//--------------- impresion de cursos  ---------------------------------------
						
						//--------- Ultima fila de pagina ------------
						if($vFilas == 40 or $vFilas == 83)
						{
							if($vFilas == 40)
							{
								$this->Image("../images/baner.jpg",10,90);
							}
							$vLado = "RLB";
						}

						$vNom_cur2 = "";
						$i = 0;
						
						$this->Cell(10,5,'', $vLado, 0, 'C');
						//------El nombre del curso es menor a 84----------------
						if(strlen($vNom_cur) <= 78)
						{
							if(strlen($vNom_cur) >= 71)
								$this->SetFont('arialn','',8);
							else
								$this->SetFont('arialn','',9);
							if($_SESSION["sEstutip_sist"] == '1')
								$this->Cell(120,5,$vNom_cur, $vLado);
							elseif($_SESSION["sEstutip_sist"] == '2')
								$this->Cell(110,5,$vNom_cur, $vLado);
						}
						//------En caso contrario se recorta el nombre-------------
						else
						{
							for($i = 78; $i > 0; $i--)
							{
								if(substr($vNom_cur, $i, 1) == ' ')
								{										
									break;
								}
							}		
							$this->SetFont('arialn','',8);	
							if($_SESSION["sEstutip_sist"] == '1')
								$this->Cell(120,5,substr($vNom_cur, 0, $i+1), $vLado);
							elseif($_SESSION["sEstutip_sist"] == '2')
								$this->Cell(110,5,substr($vNom_cur, 0, $i+1), $vLado);
																					
//							$this->Cell(93,4, substr($sPlan['nom_cur'], 0, $i+1), 0, 0, 'L');
							$vNom_cur2 = "  ".substr($vNom_cur, $i, strlen($vNom_cur) - ($i));
						}
						//------------Impresion de nota, credito, fecha ----
						$this->SetFont('arialn','',9);
						$this->Cell(20,5,$_SESSION["sNum".$sNotas[$sPlan['cod_cur']]['not_cur']], $vLado);
						$this->SetFont('arialn','B',10);
						$this->Cell(10,5,$sNotas[$sPlan['cod_cur']]['not_cur'], $vLado, 0, 'C');
						$this->SetFont('arialn','',9);
						
						if($_SESSION["sEstutip_sist"] == '2')
							$this->Cell(10,5, $sPlan['crd_cur'], $vLado, 0, 'C');
						
						if($sNotas[$sPlan['cod_cur']]['per_aca'] == '00')
							$this->Cell(15,5, "{$sNotas[$sPlan['cod_cur']]['ano_aca']}", $vLado, 0, 'C');	
						else
							$this->Cell(15,5, "{$sNotas[$sPlan['cod_cur']]['ano_aca']}-".$_SESSION["sPeriodo".$sNotas[$sPlan['cod_cur']]['per_aca']."abr_per"], $vLado, 0, 'C');	
						
						$this->Cell(15,5, '', $vLado, 0, 'L');
						$this->Ln();
						
						//------------- La segunda fila del nombre largo --------------
						if($i > 0)
						{
							$vLado = 'RL';
							$vFilas++;
							
							//----- Segunda página ---------
							if($vFilas == 41)
								$this->SubHeader();
		
							//----- Tercera página ------------
							if($vFilas == 84)
								$this->NuevaHoja();
								
							//--------- Ultima fila de pagina ------------
							if($vFilas == 40 or $vFilas == 83)
							{
								if($vFilas == 40)
								{
									$this->Image("../images/baner.jpg",10,90);
								}
								$vLado = "RLB";
							}
								
							$this->SetFont('arialn','',8);

							$this->Cell(10,5,'', $vLado, 0, 'C');
							if($_SESSION["sEstutip_sist"] == '1')
								$this->Cell(120,5,$vNom_cur2, $vLado);
							elseif($_SESSION["sEstutip_sist"] == '2')
								$this->Cell(110,5,$vNom_cur2, $vLado);

							$this->SetFont('arialn','',9);
							$this->Cell(20,5,'==========', $vLado, 0, 'C');
							$this->Cell(10,5,'=====', $vLado, 0, 'C');
							if($_SESSION["sEstutip_sist"] == '2')
								$this->Cell(10,5,'=====',$vLado, 0, 'C');
							$this->Cell(15,5,'========',$vLado, 0, 'C');
							$this->Cell(15,5,'',$vLado, 0, 'C');
							$this->Ln();
						}
						//-------------------------------------------
						$vFilas++;
						$vLado = 'RL';
					}
				}
				$cCurso->close();
				//--------------------------------------------------------------------
				if($vFilas <= 30)
				{
					$this->Image("../images/baner.jpg",10,70);
				}
				elseif($vFilas > 30 and $vFilas < 40)
				{
					$this->Image("../images/baner.jpg",10,90);
				}
				
				//---------------------- Para lo faltante del formato -------------
				if($vFilas < 84 or $vFilas > 84)
				{
					//------------ Cierre con "====="
					$vLimite = 83;
					if($vFilas == 40 or $vFilas == 83 or $vFilas == 122 or $vFilas == 164 or $vFilas == 30) // add 30
						$vLado = 'LRB';
					else
						$vLado = 'LR';
					$this->Cell(10,5,'', $vLado, 0, 'C');
					if($_SESSION["sEstutip_sist"] == '1')
						$this->Cell(120,5,'======================================================================', $vLado, 0, 'C');
					elseif($_SESSION["sEstutip_sist"] == '2')
						$this->Cell(110,5,'======================================================================', $vLado, 0, 'C');
					$this->Cell(20,5,'==========', $vLado, 0, 'C');
					$this->Cell(10,5,'=====', $vLado, 0, 'C');
					if($_SESSION["sEstutip_sist"] == '2')
						$this->Cell(10,5,'=====',$vLado, 0, 'C');
					$this->Cell(15,5,'========',$vLado, 0, 'C');
					$this->Cell(15,5,'========',$vLado, 0, 'C');
					$this->Ln();
					$vFilas++;
					
					//----------Linea de cierre (Cara 1)---------------
					if($vFilas < 31)	// Add 31
						$this->Line(22, 70 + ($vFilas * 5), 198, 225);
					elseif($vFilas < 41)
						$this->Line(22, 70 + ($vFilas * 5), 198, 270);
					if($vFilas > 84 and $vFilas < 123)
						$this->Line(22, 70 + (($vFilas - 82) * 5), 198, 270);
					//----------Linea de cierre (Cara 2)-------------------
					if($vFilas > 41 and $vFilas < 84)
						$this->Line(22, 20 + (($vFilas - 41) * 5), 198, 225);
					if($vFilas > 123 and $vFilas < 165)
						$this->Line(22, 20 + (($vFilas - 123) * 5), 198, 225);
					
					//--------Limite de Filas------------------------------
					if($vFilas <= 30)
						$vLimite = 31;
					elseif($vFilas <= 84)
						$vLimite = 83;
					elseif($vFilas > 82)
						$vLimite = 164;
					//--------------------------------------
					
					$vLado = 'LR';
					for($ii = $vFilas; $ii < $vLimite; $ii++)
					{						
						if($ii == 41 or $ii == 123)
							$this->SubHeader();

						
						if($ii == 40 or $ii == 122)
							$vLado = 'LRB';
						$this->Cell(10,5,'',$vLado, 0, 'C');
						if($_SESSION["sEstutip_sist"] == '1')
							$this->Cell(120,5,'',$vLado, 0, 'C');
						elseif($_SESSION["sEstutip_sist"] == '2')
							$this->Cell(110,5,'',$vLado, 0, 'C');
						$this->Cell(20,5,'',$vLado, 0, 'C');
						$this->Cell(10,5,'',$vLado, 0, 'C');
						if($_SESSION["sEstutip_sist"] == '2')
							$this->Cell(10,5,'',$vLado, 0, 'C');
						$this->Cell(15,5,'',$vLado, 0, 'C');
						$this->Cell(15,5,'',$vLado, 0, 'C');
						$this->Ln();
						$vLado = 'LR';
					}
					
					//----------------------------------------
					if($vFilas == 31 or $ii == 31 or $vFilas == 83 or $ii == 83 or $vFilas == 164 or $ii == 164)
					{
						$vLado = 'LRB';
						$this->Cell(10,5,'', $vLado, 0, 'C');
						if($_SESSION["sEstutip_sist"] == '1')
							$this->Cell(120,5,'', $vLado, 0, 'C');
						elseif($_SESSION["sEstutip_sist"] == '2')
							$this->Cell(110,5,'', $vLado, 0, 'C');
						$this->Cell(20,5,'', $vLado, 0, 'C');
						$this->Cell(10,5,'', $vLado, 0, 'C');
						if($_SESSION["sEstutip_sist"] == '2')
							$this->Cell(10,5,'',$vLado, 0, 'C');
						$this->Cell(15,5,'',$vLado, 0, 'C');
						$this->Cell(15,5,'',$vLado, 0, 'C');
						$this->Ln();
					}	
					//----------Linea de cierre (Cara 2)---------------
					if($vFilas > 31)
					{						
						if(($vFilas <= 41) or ($vFilas > 84 and $vFilas <= 123))
							$this->Line(22, 20, 198, 225);
					}
		
				}
				if($vFilas <= 31)
					$this->SubFooter2();
				else
					$this->SubFooter();
			}
			function Footer()
			{
				$sMes['1'] = "Enero";
				$sMes['2'] = "Febrero";
				$sMes['3'] = "Marzo";
				$sMes['4'] = "Abril";
				$sMes['5'] = "Mayo";
				$sMes['6'] = "Junio";
				$sMes['7'] = "Julio";
				$sMes['8'] = "Agosto";
				$sMes['9'] = "Setiembre";
				$sMes['10'] = "Octubre";
				$sMes['11'] = "Noviembre";
				$sMes['12'] = "Diciembre";
				
				$vFecha = getdate(time());
				$vFechan = "Puno, C.U. {$sMes[$vFecha['mon']]} {$vFecha['mday']}, {$vFecha['year']}";
				$this->SetFont('arialn','',9);
				//$this->Line(10, 277, 200, 277);
				$this->SetY(-15);			
				$this->Cell(95, 4,"Recibo N° {$_SESSION['sEstunum_rec']}", 0);
				$this->Cell(95, 4,"$vFechan   ", 0, 0, 'R');
				$this->ln();
				$this->Cell(95, 4,"Elaborado por: ", 0);
				$this->Cell(95, 4,'Pag: '.$this->PageNo().' / {nb}',0,0,'R');
			}
		}
	
		$pdf=new PDF('P', 'mm', 'A4');
		$pdf->AliasNbPages();
		$pdf->AddFont('arialn','','arialn.php');
		$pdf->AddFont('arialn','B','arialnb.php');
		$pdf->AddPage();
		$pdf->Body();
		$pdf->Output();
	}
	else
	{		
		header("Location:index.php");
	}
?> 