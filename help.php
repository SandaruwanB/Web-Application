<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="styles/css/userdashboard.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Help</title>
        <style>
            .main .container{
                width: 70%;
                height: 60vh;
                background: rgba(255, 255, 255, 0.4);
                position: absolute;
                top: 12%;
                left: 12%;
                border-radius: 1.5rem;
                transition: 0.5;
            }
            .main .container p{
                margin-top: 30px;
                margin-left: 25px;
                margin-right: 10px;
            }
        </style>
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
                        <li style="background: linear-gradient(to right top,#65dfc9,#6cdbeb);">
                            <a href="help.php"  style="color: #fff;">
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
                    <div class="container">
                        <div class="details">
                            <p>1. Press <ion-icon name="log-out-outline"></ion-icon> button to sign out.</p>
                            <p>2. To book meeting, click my meetings and new meeting button and fill the form and submit.If you want to cancel booked meeting, press cancel button.</p>
                            <p>3. To post any requests to admin (complains etc.) click on my complains and fill the form and send it.</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>