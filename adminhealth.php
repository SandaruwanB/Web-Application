<?php
    include ('database/databaseCon.php');

    if(isset($_POST['submit']))
    {
        $timeout = $_POST['timeout'];

        $sql = "UPDATE health SET timeout='$timeout'";
        $result = mysqli_query($con,$sql);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="styles/css/admintemp.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - Parkings</title>
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
                    <li>
                        <a href="adminmeetings.php">
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
                    <li style="background-color: #fff;"> 
                        <a href="adminhealth.php" style="color: #2a2185;font-weight: bold;">
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
                <a href="pdf/HealthScreening.php" target="blank"><button class="add-btn" style="margin-right: 80px;">Export as PDF</button></a>
                <a href="temperature.php"><button class="add-btn">Add</button></a>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <th>Name</th>
                        <th>NIC</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Email</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Body Temperature</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php

                            $sql = "SELECT * FROM health";
                            $result = mysqli_query($con,$sql);
                            if($result)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    $id = $row['personid'];
                                    $name = $row['name'];
                                    $address = $row['address'];
                                    $nic = $row['nic'];
                                    $date = $row['date'];
                                    $email = $row['email'];
                                    $timein = $row['timein'];
                                    $timeout = $row['timeout'];
                                    $temparature = $row['temperature'];

                                    echo '<tr>
                                            <td data-label="Name">'.$name.'</td>
                                            <td data-label="NIC">'.$nic.'</td>
                                            <td data-label="Address">'.$address.'</td>
                                            <td data-label="Date">'.$date.'</td>
                                            <td data-label="Email">'.$email.'</td>
                                            <td data-label="Time in">'.$timein.'</td>
                                            <td data-label="Time Out">'.($timeout == null ? "<button class='timeout'>Set Time Out</button>": $timeout).'</td>
                                            <td data-label="Body Temperature">'.$temparature.'&#8451;</td>
                                            <td data-label="Action"><a href="delete.php?healthid='.$id.'"><button class="delete">Delete</button></a></td>
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
                <div class="background">
                    <h3>Set Time Out</h3>
                    <form method="post">
                        <div class="all">
                            <div class="details">
                                <span class="name">Time Out</span>
                                <input type="time" name="timeout">
                            </div>
                            <div class="btn">
                                <button name="submit">Done</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            document.querySelector('.timeout').addEventListener('click',
            function(){
                document.querySelector('.bg-modal').style.display = "flex";
            });
            document.querySelector('.close-btn').addEventListener('click',
            function(){
                document.querySelector('.bg-modal').style.display = "none";
            });
        </script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>