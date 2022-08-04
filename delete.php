<?php
    include ('database/databaseCon.php');

    if(isset($_GET['delID'])){
        $delID = $_GET['delID'];

        $sql = "delete from new_users where id=$delID";
        $result = mysqli_query($con,$sql);
        if(!$result)
        {
            return;
        }
        header('location: adminusers.php');
    }
    
    else if(isset($_GET['inId']))
    {
        $delID = $_GET['inId'];

        $sql = "DELETE FROM inventry WHERE itemid=$delID";
        $result = mysqli_query($con,$sql);
        if(!$result)
        {
            return;
        }
        header('location: admininventry.php');
    }
    else if(isset($_GET['comid']))
    {
        $comID = $_GET['comid'];
    
        $sql = "DELETE FROM complains WHERE complainid=$comID;";
        $result = mysqli_query($con,$sql);
        if(!$result)
        {
            return;
        }
        header('location: admincomplains.php');
    }
    else if(isset($_GET['roomId']))
    {
        $roomId = $_GET['roomId'];

        $sql = "DELETE FROM room WHERE roomid=$roomId";
        $result = mysqli_query($con,$sql);
        if(!$result)
        {
            return;
        }
        header('location: adminroom.php');
    }
    else if(isset($_GET['meetId']))
    {
        $meetId = $_GET['meetId'];

        $sql = "DELETE FROM meetings WHERE meetingid=$meetId";
        $result = mysqli_query($con,$sql);
        if(!$result)
        {
            return;
        }
        header('location: usermeetings.php');
    }
    else if(isset($_GET['meetid']))
    {
        $meetid = $_GET['meetid'];

        $sql = "DELETE FROM meetings WHERE meetingid=$meetid";
        $result = mysqli_query($con,$sql);
        if(!$result)
        {
            return;
        }
        header('location: adminmeetings.php');
    }
    else if(isset($_GET['parkid']))
    {
        $parkid = $_GET['parkid'];

        $sql = "DELETE FROM parking WHERE parkid=$parkid";
        $result = mysqli_query($con,$sql);
        if(!$result)
        {
            return;
        }
        header('location: adminparking.php');
    }
    else if(isset($_GET['healthid']))
    {
        $healthid = $_GET['healthid'];
        
        $sql = "DELETE FROM health WHERE personid=$healthid";
        $result = mysqli_query($con,$sql);
        if(!$result)
        {
            return;
        }
        header('location: adminhealth.php');
    }
?>