<?php

    $con = new mysqli('localhost','root','','visionary');

    if(!$con)
    {
        die(mysqli_error($con));
    }
?>
