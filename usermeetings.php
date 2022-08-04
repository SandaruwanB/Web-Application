<?php
    include 'database/databaseCon.php';
    session_start();
    $email = $_SESSION['email'];

    $sql = "SELECT * FROM new_users WHERE email='$email'";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $row = mysqli_fetch_assoc($result);
        $userID = $row['id'];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="styles/css/usermeetings.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Meetings</title>
    </head>
    <body>
        <main>
            <section class="glass">
                <div class="nav">
                    <div class="user">
                        <h3><div class="icon"><ion-icon style="color: darkblue; font-size: 1.8rem;" name="logo-vimeo"></ion-icon></div><div class="text">VISIONARY</div></h3>
                    </div>
                    <ul>
                        <li>
                            <a href="userdashboard.php">
                                <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li style="background: linear-gradient(to right top,#65dfc9,#6cdbeb);">
                            <a href="usermeetings.php" style="color: #fff;">
                                <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                                <span class="title">My Meetings</span>
                            </a>
                        </li>
                    <li>
                        <a href="usercomplains.php">
                            <span class="icon"><ion-icon name="warning-outline"></ion-icon></span>
                            <span class="title">Complains</span>
                        </a>
                    </li>
                    <li>
                        <a href="usersettings.php">
                            <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                            <span class="title">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="help.php">
                            <span class="icon"><ion-icon name="help-outline"></ion-icon></span>
                            <span class="title">Help</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="main">
                <div class="logoutbtn">
                    <a href="home.php"><ion-icon name="log-out-outline"></ion-icon></a>
                </div>
                <div class="body">
                    <div class="btn">
                        <a href="booking.php"><button>Book Meeting</button></a>
                    </div>
                    <div class="bookings">
                        <div class="header">
                            <h3 style="padding-top: 20px;">My Bookings</h3>
                        </div>
                        <div class="table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Meeting Name</th>
                                        <th>Date</th>
                                        <th>Room</th>
                                        <th>Participants</th>
                                        <th>Payment</th>
                                        <th>Parking</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $sql = "SELECT * FROM meetings,room WHERE meetings.roomid=room.roomid AND userid = $userID";
                                    $result = mysqli_query($con,$sql);
                                    if($result)
                                    {
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                            $id = $row['meetingid'];
                                            $date = $row['date'];
                                            $name = $row['name'];
                                            $participants = $row['participants'];
                                            $roomname = $row['roomname'];
                                            $paid = $row['payment'];
                                            $parking = $row['parkid'];

                                            echo '
                                            <tr>
                                                <td data-label="name">'.$name.'</td>
                                                <td data-label="date">'.$date.'</td>
                                                <td data-label="room">'.$roomname.'</td>
                                                <td data-label="participants">'.$participants.'</td>
                                                <td data-label="payment">'.($paid == 'no' ? "<p class='not-paid'>not paid</p>": "<p class='paid'>paid</p>" ).'</td>
                                                <td data-label="Parking">'.($parking == 0 ? "<a href='userparking.php?meetid=".$id."'><button class='parking'>Add Parking</button></a>" : "<a href='showparking.php?meetid=".$id."'><button class='parking'>Show Details</button></a>").'</td>
                                                <td data-label="action"><a href="delete.php?meetId='.$id.'"><button class="delete-btn">cancel</button></a>'.($paid == 'no' ? "<a href='userpay.php?meetId=".$id."'><button class='pay-btn'>Pay Now</button></a>" : "").'</td>
                                            </tr>';
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>