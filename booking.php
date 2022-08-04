<?php
    include ('database/databaseCon.php');

    $flag = 0;
    $nameSelect = 0;
    $maxusers = 0;
    session_start();
    $email = $_SESSION['email'];

    $sql = "SELECT * FROM new_users WHERE email='$email'";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
    }
    if(isset($_POST['paynow']))
    {
        $name = $_POST['name'];
        $participants = $_POST['participants'];
        $date = $_POST['date'];
        $room = $_POST['room'];
        preg_match('/\b\w+\b/i',$room,$result);
        $room = $result[0];

        session_start();
        $_SESSION['meetingname'] = $name;

        $sql = "SELECT * FROM room WHERE roomname='$room'";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $row = mysqli_fetch_assoc($result);
            $roomId = $row['roomid'];
            $size = $row['size'];
        }

        if($size >= $participants)
        {
            $sql = "SELECT * FROM meetings WHERE date='$date' AND roomid='$roomId'";
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
                    $sql = "SELECT * FROM meetings WHERE name='$name'";
                    $result = mysqli_query($con,$sql);
                    if($result)
                    {
                        $value = mysqli_num_rows($result);
                        if($value > 0)
                        {
                            $nameSelect = 1;
                        }
                        else 
                        {
                            $sql = "INSERT INTO meetings(name,date,participants,userid,roomid) VALUES('$name','$date',$participants,$id,$roomId)";
                            $result = mysqli_query($con,$sql);
                            if($result)
                            {
                                header('location: usermeetings.php');
                            }
                        }    
                    }
                }
            }
        }
        {
            $maxusers = 1;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/css/booking.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
</head>
<body>
    <div class="main">
        <div class="mid">
            <div class="cancel">
                <a href="usermeetings.php"><ion-icon style="color: #f00;" name="close-outline"></ion-icon></a>
            </div>
            <h3>book my meeting</h3>
            <form action="" method="post" autocomplete="off">
                <?php
                    if($flag)
                    {
                        echo 
                        '<div class="details">
                            <span style="color: red;text-align: center;padding-bottom: 40px;">These day alredy booked,&nbsp;&nbsp;Try another room</span>
                        </div>';
                    }
                    elseif($nameSelect)
                    {
                        echo 
                        '<div class="details">
                            <span style="color: red;text-align: center;padding-bottom: 40px;">Name already exists,&nbsp;&nbsp;Try another name</span>
                        </div>';
                    } 
                    elseif($maxusers)
                    {
                        echo 
                        '<div class="details">
                            <span style="color: red;text-align: center;padding-bottom: 40px;">Cannot allocate Users to the room,&nbsp;&nbsp;Max users in this room&nbsp;&nbsp;'.$size.'</span>
                        </div>';
                    }
                ?>
                <div class="details">
                    <div class="input">
                        <span>Name your meeting</span>
                        <input type="text" required placeholder="Name your own meeting here" name="name"> 
                    </div>
                    <div class="input">
                        <span>Participants</span>
                        <input type="text" required placeholder="Specify how many participants will join" name="participants">
                    </div>
                    <div class="input">
                        <span>Date</span>
                        <input type="date" required name="date">
                    </div>
                    <div class="input">
                        <span>Room Name</span>
                        <select name="room">
                            <?php
                                $sql = "SELECT * FROM room";
                                $final = mysqli_query($con,$sql);
                                if($final)
                                {
                                    while($row = mysqli_fetch_assoc($final))
                                    {
                                        echo "<option>".$row['roomname']."&nbsp;&nbsp;&nbsp;&nbsp;MAXIMUM USERS : ".$row['size']."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="btn">
                        <a href=""><button class="one" name="paynow">Done</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>