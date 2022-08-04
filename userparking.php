<?php
    include 'database/databaseCon.php';

    $flag = 0;
    if(isset($_GET['meetid']))
    {
        $meetid = $_GET['meetid'];

        $sql = "SELECT * FROM meetings WHERE meetingid=$meetid";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $row = mysqli_fetch_assoc($result);
            $date = $row['date'];
            $name = $row['name'];
        }
    }
    if(isset($_POST['submit']))
    {
        $place = $_POST['place'];

        $sql = "SELECT * FROM parking WHERE location_code='$place'";
        $result = mysqli_query($con,$sql);
        
        $row = mysqli_fetch_assoc($result);
        $id = $row['parkid'];

        if($result)
        {
            $sql = "SELECT * FROM meetings WHERE date='$date' AND parkid=$id";
            $result = mysqli_query($con,$sql);
            if($result)
            {
                $value = mysqli_num_rows($result);
                if($value > 0)
                {
                    $flag = 1;
                }
                else
                {
                    $sql = "UPDATE meetings SET parkid=$id WHERE meetingid='$meetid'";
                    $result = mysqli_query($con,$sql);
                    header('location: usermeetings.php');
                }
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/css/userparking.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add parking</title>
</head>
<body>
    <div class="container">
        <div class="title">
            Add Parking Details
        </div>
        <a href="usermeetings.php" class="back"><ion-icon name="arrow-back-outline"></ion-icon></a>
        <div class="alart">
            <?php
                if($flag)
                {
                    echo "<p class='danger'>Parking slot alredy exists</p>";
                }
            ?>
        </div>
        <form method="post" autocomplete="off">
            <div class="user-details">
                <div class="input-box">
                    <span>Meeting Name</span>
                    <span class="data"><?php echo $name; ?></span>
                </div>
                <div class="input-box">
                    <span>Date</span>
                    <span class="data"><?php echo $date; ?></span>
                </div>
                <div class="input-box">
                    <span>Location Id</span>
                    <select name="place">
                        <?php
                            $sql = "SELECT * FROM parking";
                            $result = mysqli_query($con,$sql);
                            if($result)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    if($row['parkid'] == 0)
                                    {
                                        continue;
                                    }
                                    else
                                    {
                                        echo '<option>'.$row['location_code'].'</option>';
                                    }
                                }
                            }
                                   
                        ?>
                    </select>
                </div>
                <div class="button">
                    <input class="done" type="submit" value="Done" name="submit">
                </div>
            </div>
        </form>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>