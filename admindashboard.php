<?php
    include ('database/databaseCon.php');
    
    session_start();
    $username = $_SESSION['name'];
    $email = $_SESSION['email'];

    $usercount = 0;
    $complaincount = 0;
    $meetingcount = 0;

    $sql = "SELECT * FROM new_users";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $usercount = mysqli_num_rows($result);
    }
    $sql = "SELECT * FROM complains WHERE readflag='no'";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $complaincount = mysqli_num_rows($result);
    }
    $sql = "SELECT * FROM meetings";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $meetingcount = mysqli_num_rows($result);
    }

    $sql = "SELECT * FROM new_users WHERE email='$email'";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $row = mysqli_fetch_assoc($result);
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $role = $row['role'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="styles/css/admindash.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - Dashboard</title>
        <script type="text/javascript">
            function preback(){
                window.history.forward();
            }
            setTimeout("preback()",0);
            window.onunload = function(){null};
        </script>
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
                    <li style="background-color: #fff;">
                        <a href="admindashboard.php" style="color: #2a2185;font-weight: bold;">
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
                <div class="user"><ion-icon name="settings-outline" style="color: red;"></ion-icon></div>
            </div>
            <div class="header">
                Welcome Back <?php echo $username; ?><div style="font-size:30px;">😀</div>
            </div>
            <div class="cardbox">
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $usercount; ?></div>
                        <div class="cardname">Users</div>
                    </div>
                    <div class="iconbox">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $complaincount; ?></div>
                        <div class="cardname">Complains</div>
                    </div>
                    <div class="iconbox">
                        <ion-icon style="color: red;" name="remove-circle-outline"></ion-icon>
                    </div>
                </div>                
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $meetingcount; ?></div>
                        <div class="cardname">Meetings</div>
                    </div>
                    <div class="iconbox">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="text">
                <h4>Quick Shortcuts</h4>
            </div>
            <div class="shortcuts">
                <div class="box">
                    <a href="adminusers.php">
                        <div class="icon"><ion-icon name="person-outline"></ion-icon></div>
                        <div class="box-name">Users</div>                        
                    </a>
                </div>
                <div class="box">
                    <a href="admininventry.php">
                        <div class="icon"><ion-icon name="bag-handle-outline"></ion-icon></div>
                        <div class="box-name">Inventory</div>                        
                    </a>
                </div>
                <div class="box">
                    <a href="admincomplains.php">                        
                        <div class="icon"><ion-icon name="chatbox-ellipses-outline"></ion-icon></div>
                        <div class="box-name">Complains</div>
                    </a>
                </div>
                <div class="box">
                    <a href="adminmeetings.php">                        
                        <div class="icon"><ion-icon name="people-outline"></ion-icon></div>
                        <div class="box-name">Meetings</div>
                    </a>
                </div>
                <div class="box">
                    <a href="">                        
                        <div class="icon"><ion-icon name="car-outline"></ion-icon></div>
                        <div class="box-name">Manage Parking</div>
                    </a>
                </div>
                <div class="box">
                    <a href="adminroom.php">                        
                        <div class="icon"><ion-icon name="library-outline"></ion-icon></div>
                        <div class="box-name">Meeting Rooms</div>
                    </a>
                </div>
                <div class="box">
                    <a href="adminhealth.php">                        
                        <div class="icon"><ion-icon name="medkit-outline"></ion-icon></div>
                        <div class="box-name">Health Screening</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="bg-modal">
            <div class="content">
                <div class="close-btn">+</div>
                <div class="background">
                    <h3>My Account</h3>
                    <div class="all">
                        <div class="details">
                            <span class="name">User Name</span>
                            <span class="data"><?php echo $firstname.'&nbsp;'.$lastname; ?></span>
                        </div>
                        <div class="details">
                            <span class="name">Email Address</span>
                            <span class="data"><?php echo $email; ?></span>
                        </div>
                        <div class="details">
                            <span class="name">Account Type</span>
                            <span class="data"><?php echo $role; ?></span>
                        </div>
                    </div>
                    <div class="logout">
                        <a href="home.php"><button>Log Out</button></a>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.querySelector('.user').addEventListener('click',
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
