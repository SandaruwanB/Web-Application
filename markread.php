<?php
    include 'database/databaseCon.php';

    if(isset($_GET['comid']))
    {
        $comID = $_GET['comid'];

        $sql = "UPDATE complains SET readflag='yes' WHERE complainid=$comID";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            header('location: admincomplains.php');
        }
    }
?>