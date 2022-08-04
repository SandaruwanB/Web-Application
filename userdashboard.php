<?php
    include 'database/databaseCon.php';

    session_start();
    $email = $_SESSION['email'];
   
    $name = $_SESSION['name'];

    $meetingcount = 0;
    $paidcount = 0;
    $notpaidcount = 0;

    $sql = "SELECT * FROM new_users WHERE email='$email'";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
    }
    $sql = "SELECT * FROM meetings WHERE userid=$id";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $meetingcount = mysqli_num_rows($result);
    }

    $sql = "SELECT * FROM meetings WHERE payment='yes' AND userid=$id";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $paidcount = mysqli_num_rows($result);
    }

    $sql = "SELECT * FROM meetings WHERE payment='no' AND userid=$id";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $notpaidcount = mysqli_num_rows($result);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="styles/css/userdashboard.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
    </head>
    <body>
        <main>
            <section class="glass">
                <div class="nav">
                    <div class="user">
                        <h3><div class="icon"><ion-icon style="color: darkblue; font-size: 1.8rem;" name="logo-vimeo"></ion-icon></div><div class="text">VISIONARY</div></h3>
                    </div>
                    <ul>
                        <li style="background: linear-gradient(to right top,#65dfc9,#6cdbeb);">
                            <a href="userdashboard.php" style="color: #fff;">
                                <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="usermeetings.php">
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
                    <div class="userwelcome">
                        welcome back <?php echo $name; ?>
                    </div>
                    <div class="clock">
                        <div id="time">
                            <div class="abs">
                                <div id="hours" style="color: darkblue; font-weight: bold;">00</div>
                            </div>
                            <div class="abs">
                                <div id="minutes" style="color: gray; font-weight: bold;">00</div>
                            </div>
                            <div class="abs">
                                <div id="seconds" style="color: green; font-weight: bold;">00</div>
                            </div>
                            <div class="abs">
                                <div class ="ap">
                                    <div id="ampm" style="color: red; font-weight: bold;">AM</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="grid1">
                            <span class="value"><?php echo $meetingcount; ?></span>
                            <span>Total Meetings</span>
                        </div>
                        <div class="grid1">
                            <span class="value"><?php echo $paidcount; ?></span>
                            <span>Paid Meetings</span>
                        </div>
                        <div class="grid1">
                            <span class="value"><?php echo $notpaidcount; ?></span>
                            <span>Not Paid Meetings</span>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <script>
            setInterval(() => {
                let hours = document.getElementById('hours');
                let minutes = document.getElementById('minutes');
                let seconds = document.getElementById('seconds');   
                let ampm = document.getElementById('ampm');

                let hh = document.getElementById('hh');
                let mm = document.getElementById('mm');
                let ss = document.getElementById('ss');
                
                let h = new Date().getHours();
                let m = new Date().getMinutes();
                let s = new Date().getSeconds();
                let am = h >= 12 ? "PM" : "AM";

                if(h > 12){
                    h = h - 12;
                }
                h = (h < 10) ? "0" + h : h;
                m = (m < 10) ? "0" + m : m;
                s = (s < 10) ? "0" + s : s;

                hours.innerHTML = h + "<br><span>Hours</span>";
                minutes.innerHTML = m + "<br><span>Mins</span>";
                seconds.innerHTML = s + "<br><span>Secs</span>";
                ampm.innerHTML = am;

            })
        </script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>