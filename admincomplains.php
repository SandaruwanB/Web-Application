<?php
    include ('database/databaseCon.php');

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="styles/css/admincomplains.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - Complains</title>
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
                    <li style="background-color: #fff;">
                        <a href="admincomplains.php" style="color: #2a2185;font-weight: bold;">
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
        <div class="pdf">
            <a href="pdf/Complains.php"  target="blank"><button>Export as PDF</button></a>
        </div>
        <div class="table">
            <table>
                <?php
                    $sql = "SELECT * FROM new_users,complains WHERE new_users.id = complains.userid";
                    $final = mysqli_query($con,$sql);
                    if($final)
                    {
                        $count = mysqli_num_rows($final);
                        if($count>0)
                        {
                            while($row = mysqli_fetch_assoc($final))
                            {
                                echo
                                '<tr>
                                    <td>
                                        <h3>'.$row['firstname'].'&nbsp;'.$row['lastname'].'</h3>
                                        <p style="color: #666;">'.$row['email'].'</p>
                                        <p style="color: #444;margin-top: 0px;font-size: 12px;">'.$row['date'].'</p>
                                        <h4>'.$row['subject'].'</h4>
                                        <p>'.$row['body'].'</p>
                                        <a style="color:#333;" href="markread.php?comid='.$row['complainid'].'"><ion-icon name="checkmark-done-outline"></ion-icon></a>
                                        <a style="color:#f02;"href="delete.php?comid='.$row['complainid'].'"><ion-icon name="trash-outline"></ion-icon></a>
                                    </td>
                                </tr>';
                            }
                        }
                        else
                        {
                            echo "<tr><td>Wow no complains yet</td></tr>";
                        }
                    }
                ?>
            </table>
        </div>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>