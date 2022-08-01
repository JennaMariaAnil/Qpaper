<?php
session_start();
require('fdpf/fpdf.php');
            $pdf=new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,10,'AMAL JYOTHI COLLEGE OF ENGINEERING',0,1,'C',false);
            $pdf->Cell(0,0,'KANJIRAPPALLY',0,1,'C',false);
            $pdf->Cell(0,10,$_SESSION['btech'],0,1,'C',false);
            $pdf->Cell(0,10,$_SESSION['name'],0,1,'C',false);
            $pdf->Cell(0,10,$_SESSION['qpcode'],0,1,'L',false);
            $pdf->Cell(0,0,$_SESSION['max'],0,1,'R',false);
            $pdf->Cell(0,8,$_SESSION['time'],0,1,'R',false);
            $pdf->Cell(0,10,$_SESSION['T1'],0,1,'C',false);
            $pdf->Cell(0,10,$_SESSION['T11'],0,1,'C',false);
            $pdf->Cell(10,10,$_SESSION['qt1'],0,1,'L',false);
            $pdf->Cell(10,10,$_SESSION['qt2'],0,1,'L',false);
            $pdf->Cell(10,10,$_SESSION['qt3'],0,1,'L',false);
            $pdf->Cell(10,10,$_SESSION['qt4'],0,1,'L',false);
            $pdf->Cell(10,10,$_SESSION['qt5'],0,1,'L',false);
            $pdf->Cell(0,10,$_SESSION['T2'],0,1,'C',false);
            $pdf->Cell(0,10,$_SESSION['T22'],0,1,'C',false);
            $pdf->Cell(10,10,$_SESSION['qt6'],0,1,'L',false);
            $pdf->Cell(10,10,$_SESSION['qt7'],0,1,'L',false);
            $pdf->Cell(10,10,$_SESSION['qt8'],0,1,'L',false);
            $pdf->Cell(10,10,$_SESSION['qt9'],0,1,'L',false);
            $pdf->Cell(10,10,$_SESSION['qt10'],0,1,'L',false);
            $pdf->Output();


?>