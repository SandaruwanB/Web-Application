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
            $this->Cell(100,10,'VISIONARY Health Screening',0,1);
            $this->Ln(5);


            $this->SetFont('Arial','B',11);
            $this->SetFillColor(180,180,255);
            $this->SetDrawColor(50,50,100);
            $this->Cell(18,5,'Name',1,0,'',true);
            $this->Cell(30,5,'Email',1,0,'',true);
            $this->Cell(25,5,'NIC',1,0,'',true);
            $this->Cell(35,5,'Address',1,0,'',true);
            $this->Cell(20,5,'Date',1,0,'',true);
            $this->Cell(20,5,'Time In',1,0,'',true);
            $this->Cell(20,5,'Time Out',1,0,'',true);
            $this->Cell(25,5,'Temperature',1,1,'',true);
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

    $sql = "SELECT * FROM health";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($result))
    {
        $PDF->Cell(18,5,$row['name'],1,0);
        $PDF->Cell(30,5,$row['email'],1,0);
        $PDF->Cell(25,5,$row['nic'],1,0);
        $PDF->Cell(35,5,$row['address'],1,0);
        $PDF->Cell(20,5,$row['date'],1,0);
        $PDF->Cell(20,5,$row['timein'],1,0);
        $PDF->Cell(20,5,$row['timeout'],1,0);
        $PDF->Cell(25,5,$row['temperature']." Celcius",1,1);
    }
    $PDF->Output();
?>