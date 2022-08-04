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
            $this->Cell(100,10,'VISIONARY Booked Meetings',0,1);
            $this->Ln(5);


            $this->SetFont('Arial','B',9);
            $this->SetFillColor(180,180,255);
            $this->SetDrawColor(50,50,100);
            $this->Cell(30,5,'Customer',1,0,'',true);
            $this->Cell(30,5,'Meeting Name',1,0,'',true);
            $this->Cell(25,5,'Date Booked',1,0,'',true);
            $this->Cell(20,5,'Participants',1,0,'',true);
            $this->Cell(22,5,'Room Name',1,0,'',true);
            $this->Cell(18,5,'Payment',1,0,'',true);
            $this->Cell(25,5,'Parking',1,0,'',true);
            $this->Cell(22,5,'Parking Slot',1,1,'',true);
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

    $PDF->SetFont('Arial','',7);
    $PDF->SetDrawColor(50,50,100);

    $sql = "SELECT * FROM meetings,room,new_users,parking WHERE room.roomid = meetings.roomid AND new_users.id = meetings.userid AND meetings.parkid = parking.parkid";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($result))
    {
        $PDF->Cell(30,5,$row['firstname']." ".$row['lastname'],1,0);
        $PDF->Cell(30,5,$row['name'],1,0);
        $PDF->Cell(25,5,$row['date'],1,0);
        $PDF->Cell(20,5,$row['participants'],1,0);
        $PDF->Cell(22,5,$row['roomname'],1,0);

        if($row['payment'] == 'no')
        {
            $PDF->Cell(18,5,"Not Paid",1,0);
        }
        else
        {
            $PDF->Cell(18,5,"Paid",1,0);
        }

        if($row['parkid'] == 0)
        {
            $PDF->Cell(25,5,"Not Requested",1,0);
        }
        else
        {
            $PDF->Cell(25,5,"requested",1,0);
        }

        if($row['parkid'] == 0)
        {
            $PDF->Cell(22,5,"  -  ",1,1);
        }
        else
        {
            $PDF->Cell(22,5,$row['location_code'],1,1);
        }
    }
    $PDF->Output();
?>