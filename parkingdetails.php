<?php
    include 'database/databaseCon.php';

    if(isset($_GET['meetid']))
    {
        $meetid = $_GET['meetid'];

        $sql = "SELECT * FROM meetings,parking WHERE meetings.parkid = parking.parkid AND meetingid=$meetid";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $row = mysqli_fetch_assoc($result);
            $date = $row['date'];
            $name = $row['parkname'];
            $location = $row['location_code'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/css/parkingdetails.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>parking details</title>
</head>
<body>
    <div class="container">
        <div class="title">
            Parking Details
        </div>
        <a href="adminmeetings.php" class="back"><ion-icon name="arrow-back-outline"></ion-icon></a>
        <div class="user-details">
            <div class="input-box">
                <span class="name">Date</span>
                <span class="data"><?php echo $date; ?></span>
            </div>
            <div class="input-box">
                <span class="name">Parking Slot Name</span>
                <span class="data"><?php echo $name; ?></span>
            </div>
            <div class="input-box">
                <span class="name">Location Code</span>
                <span class="data"><?php echo $location; ?></span>
            </div>
        </div>
        <div class="ok-btn">
            <a href="adminmeetings.php"><button class="done">Done</button></a>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>