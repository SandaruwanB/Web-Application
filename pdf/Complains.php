<?php
    require('fpdf.php');
    $con = mysqli_connect('localhost','root','','visionary');

    class pdf extends FPDF
    {
        function Header()
        {
            $this->SetFont('Arial','B',15);
            $this->Cell(12);
            $this->Image('logo.png',10,10,10);
            $this->Cell(100,10,'VISIONARY Complain Report',0,1);
            $this->Ln(5);


            $this->SetFont('Arial','B',11);
            $this->SetFillColor(180,180,255);
            $this->SetDrawColor(50,50,100);
            $this->Cell(30,5,'Customer',1,0,'',true);
            $this->Cell(45,5,'Email',1,0,'',true);
            $this->Cell(50,5,'Subject',1,0,'',true);
            $this->Cell(65,5,'Message',1,1,'',true);
        }
        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
        }
    }
    $PDF = new pdf();
    $PDF->AddPage();
    $PDF->SetAutoPageBreak(true,15);

    $PDF->SetFont('Arial','',8);
    $PDF->SetDrawColor(50,50,100);

    $sql = "SELECT * FROM new_users,complains WHERE new_users.id = complains.userid";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($result))
    {
        $PDF->Cell(30,5,$row['firstname'],1,0);
        $PDF->Cell(45,5,$row['email'],1,0);
        $PDF->Cell(50,5,$row['subject'],1,0);
        $PDF->MultiCell(65,5,$row['body'],1,1);
    }
    $PDF->Output();
?>