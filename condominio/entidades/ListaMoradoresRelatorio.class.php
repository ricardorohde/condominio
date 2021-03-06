<?php
session_name("Condominio");
session_start();

require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/fpdf/fpdf.php');
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/toolBox.class.php');


class ListaMoradoresRelatorio extends FPDF{
	

	function Header(){
	    // Logo
	    $this->Image('../../img/logo.png',10,6,30);
	    // Courier bold 15
	    $this->SetFont('Courier','B',15);
	    // Move to the right
	    $this->Cell(80);
	    // Title
	    $this->Cell(30,5,utf8_decode('Condomínio San Raphael'),0,1,'C');
	    $this->SetFont('Courier','',10);
	    $this->Cell(190,5,utf8_decode('Relação de moradores por Torre'),0,0,'C');
	    // Line break
	    $this->Ln(15);	    
	}
	
	
	function Footer(){
	    // Position at 1.6 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Courier','I',8);
	    // Page number
	    $this->Cell(100,5,utf8_decode(toolBox::retornaData()),0,0,'L');
	    $this->Cell(188,5,utf8_decode('Página ').$this->PageNo().' de {nb}',0,1,'R');
	    $this->Cell(100,2,utf8_decode('Impresso por: '.$_SESSION['credencial']['Nome'] . ' (' . $_SESSION['credencial']['no_tipo_usuario'].')'),0,0,'L');
	}
	
	function montarTabela($header, $data){
		// Colors, line width and bold font
		$this->SetFont('','B',10);
		//Header
		$width = array(18, 10, 80, 30, 35, 27, 27, 56);
		for($i=0;$i<count($header);$i++)
			$this->Cell($width[$i],7,utf8_decode($header[$i]),0,0,'C',false);
			$this->Ln();
			// Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
			// Data
			$fill = false;
			foreach($data as $row)
			{
				$this->SetFont('','',8);
				$this->Cell($width[0],6,$row['torre'],'LR',0,'L',$fill);
				$this->Cell($width[1],6,$row['unidade'],'LR',0,'L',$fill);
				$this->Cell($width[2],6,utf8_decode(strtoupper($row['no_pessoa'])),'LR',0,'L',$fill);
				$this->Cell($width[3],6,utf8_decode(strtoupper($row['no_tipo_morador'])),'LR',0,'L',$fill);
				$this->Cell($width[4],6,($row['nu_cpf']!='' ? $row['nu_cpf'] : '---'),'LR',0,'L',$fill);
				$this->Cell($width[5],6,($row['dt_nascimento']!='' ? $row['dt_nascimento'] : '---'),'LR',0,'L',$fill);
				$this->Cell($width[6],6,$row['dt_inicio'],'LR',0,'L',$fill);
				$this->Cell($width[7],6,($row['no_profissao']!='' ? utf8_decode(strtoupper($row['no_profissao'])) : '---'),'LR',0,'L',$fill);

				$this->Ln();
				$fill = !$fill;
			}
			// Closing line
			$this->Cell(array_sum($width),0,'','T');
	}
	
}