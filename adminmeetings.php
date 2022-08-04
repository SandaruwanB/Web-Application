<?php
    include 'database/databaseCon.php';

    $sql = "SELECT * FROM meetings WHERE payment='yes'";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $paid = mysqli_num_rows($result);
    }

    $sql = "SELECT * FROM meetings WHERE payment='no'";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $notpaid =mysqli_num_rows($result);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="styles/css/adminmeeting.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - Meetings</title>
    </head>
    <body>
        <div class="container">
            <div class="nav">
                <ul>
                    <li>
                        <a href="#">
                            <span class="icon"></span>
                            <span class="title">VISIONARY</span>
                        </a>
                    </li>
                    <li>
                        <a href="admindashboard.php">
                            <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="adminusers.php">
                            <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                            <span class="title">Users</span>
                        </a>
                    </li>
                    <li style="background-color: #fff;">
                        <a href="adminmeetings.php" style="color: #2a2185;font-weight: bold;">
                            <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                            <span class="title">Meetings</span>
                        </a>
                    </li>
                    <li>
                        <a href="admincomplains.php">
                            <span class="icon"><ion-icon name="chatbox-ellipses-outline"></ion-icon></span>
                            <span class="title">Complains</span>
                        </a>
                    </li>
                    <li>
                        <a href="admininventry.php">
                            <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                            <span class="title">Inventory</span>
                        </a>
                    </li>
                    <li>
                        <a href="adminroom.php">
                            <span class="icon"><ion-icon name="library-outline"></ion-icon></span>
                            <span class="title">Meeting Rooms</span>
                        </a>
                    </li>  
                    <li>
                        <a href="adminparking.php">
                            <span class="icon"><ion-icon name="car-outline"></ion-icon></span>
                            <span class="title">Manage Parking</span>
                        </a>
                    </li>  
                    <li> 
                        <a href="adminhealth.php">
                            <span class="icon"><ion-icon name="medkit-outline"></ion-icon></span>
                            <span class="title">Health Screening</span>
                        </a>
                    </li>                         
                </ul>
            </div>
        </div>
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="logo-vimeo" style="color: #2a2185;"></ion-icon>
                </div>
                <div class="search"></div>
                <div class="user"><a href="admindashboard.php"><ion-icon name="home-outline" style="color: green;"></ion-icon></a></div>
            </div>
            <div class="add">
                <a href="pdf/Meetings.php" target="blank"><button class="add" style="margin-right: 150px;">Export as PDF</button></a>
                <button class="add" id="click">Display Chart</button>                
            </div>
            <div class="table">
                <table>
                    <thead>
                        <th>User Name</th>
                        <th>Meeting Name</th>
                        <th>Booked Date</th>
                        <th>Participants</th>
                        <th>Room Name</th>
                        <th>Payment</th>
                        <th>Parking</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php

                            $sql = "SELECT * FROM meetings,room,new_users WHERE room.roomid = meetings.roomid AND new_users.id = meetings.userid";
                            $result = mysqli_query($con,$sql);
                            if($result)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    $value = 0;
                                    $meetingid = $row['meetingid'];
                                    $user = $row['firstname'];
                                    $name = $row['name'];
                                    $date = $row['date'];
                                    $room = $row['roomname'];
                                    $payment = $row['payment'];
                                    $parking = $row['parkid'];
                                    $participants = $row['participants'];

                                    echo '<tr>
                                        <td data-label="Item Name">'.$user.'</td>
                                        <td data-label="Quantity">'.$name.'</td>
                                        <td data-label="Expire Date">'.$date.'</td>
                                        <td data-label="Participants">'.$participants.'</td>
                                        <td data-label="Room name">'.$room.'</td>
                                        <td data-label="Payment">'.($payment == 'no' ? "<p style= 'padding: 5px; color: #A90000; font-weight: bold;'>Not Paid</p>": "<p style='padding: 5px; color: #268901; font-weight: bold;'>Paid</p>" ).'</td>
                                        <td data-label="Parking">'.($parking == 0 ? "<p style='padding: 5px; color: green; font-weight: bold;'>Not Requested</p>": "<a href='parkingdetails.php?meetid=".$meetingid."'><button class='view'>View Parking Details</button></a>").'</td>
                                        <td data-label="Action"><a href="delete.php?meetid='.$meetingid.'"><button class="delete">Delete</button></a>'.($payment == 'yes' ? "<a href='paymentdetails.php?meetid=".$meetingid."'><button class='edit' style='background: #268901; margin-left: 10px;'>Show Payment Details</button></a>": "" ).'<a href="editMeetings.php?meetid='.$meetingid.'"><button class="update" style="margin-left: 10px;">Edit</button></a></td>
                                    </tr>';
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-modal">
            <div class="content">
                <div class="close-btn">+</div>
                <div class="header">Paid and Not paid meetings</div>
                <div class="background">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('click').addEventListener('click',
            function(){
                document.querySelector('.bg-modal').style.display = "flex";
            });
            document.querySelector('.close-btn').addEventListener('click',
            function(){
                document.querySelector('.bg-modal').style.display = "none";
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('myChart').getContext('2d');    
            const myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['paid', 'notpaid'],
                    datasets: [{
                        label: '# of Votes',
                        data:
                        <?php
                        echo "[".$paid.",".$notpaid."]";
                        ?>,
                        backgroundColor: [
                            'rgba(0, 255, 0, 0.2)',
                            'rgba(239, 28, 77, 0.2)',
                            ],
                        borderColor: [
                            'rgba(0, 255, 0, 1)',
                            'rgba(239, 28, 77, 1)',
                        ],
                        borderWidth: 2
                    }]
                },
                options: {}
            });
        </script>

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>