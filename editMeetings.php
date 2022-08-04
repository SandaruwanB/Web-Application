<?php
    include 'database/databaseCon.php';

    $flag = 0;
    $have = 0;
    if(isset($_GET['meetid']))
    {
        $meetid = $_GET['meetid'];

        $sql = "SELECT * FROM meetings,parking,room WHERE meetings.roomid = room.roomid AND meetings.parkid = parking.parkid AND meetingid = $meetid";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $row = mysqli_fetch_assoc($result);
            $date = $row['date'];
            $participants = $row['participants'];
        }
    }
    if(isset($_POST['submit']))
    {
        $date = $_POST['date'];
        $participants = $_POST['participants'];
        $room = $_POST['room'];
        $parking = $_POST['parking'];

        preg_match('/\b\w+\b/i',$room,$result);
        $room = $result[0];

        $sql = "SELECT * FROM room WHERE roomname='$room'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($result);
        $size = $row['size'];
        $roomid = $row['roomid'];

        $sql = "SELECT * FROM parking WHERE location_code='$parking'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($result);
        $parkid = $row['parkid'];

        if($participants <= $size)
        {
            $sql = "SELECT * FROM meetings WHERE date='$date' AND roomid=$roomid AND meetingid != $meetid";
            $result = mysqli_query($con,$sql);
            $count = mysqli_num_rows($result);
            if($count>0)
            {
                $have = 1;
            }
            else
            {
                $sql = "UPDATE meetings SET date='$date',participants=$participants,roomid=$roomid,parkid=$parkid WHERE meetingid=$meetid";
                $result = mysqli_query($con,$sql);
                if($result)
                {
                    header('location: adminmeetings.php');
                }
            }
        }
        else
        {
            $flag = 1;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/css/edit.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Meetings</title>
</head>
<body>
    <div class="container">
        <div class="title">
            Edit and Update Meeting
        </div>
        <a href="adminmeetings.php"><ion-icon name="arrow-back-outline"></ion-icon></a>
        <div class="alart">
            <?php
                if($flag)
                {
                    echo "<p class='danger' style='margin-top: 20px;'>Room Size Allocated. Maximum Size is ".$size."</p>";
                }
                else if($have)
                {
                    echo "<p class='danger' style='margin-top: 20px;'>This Room Alredy Booked for ".$date." By Another Customer</p>";
                }
            ?>
        </div>
        <form method="post" autocomplete="off">
            <div class="user-details">
                <div class="input-box">
                    <span>Date</span>
                    <input type="date" name="date" value="<?php echo $date; ?>" required>
                </div>
                <div class="input-box">
                    <span>Participants</span>
                    <input type="number" name="participants" value="<?php echo $participants; ?>" required>
                </div>
                <div class="input-box">
                    <span>Room</span>
                    <select name="room">
                        <?php
                            $sql = "SELECT * FROM room";
                            $result = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo '<option>'.$row['roomname'].'&nbsp;&nbsp;&nbsp;MAXIMUM USERS '.$row['size'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="input-box">
                    <span>Parking</span>
                    <select name="parking">
                        <?php
                            $sql = "SELECT * FROM parking";
                            $result = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo '<option>'.$row['location_code'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="button">
                    <input type="submit" value="Done" name="submit">
                </div>
            </div>
        </form>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>