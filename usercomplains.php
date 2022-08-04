<?php
    include 'database/databaseCon.php';
    
    $flag = 0;
    session_start();
    $email = $_SESSION['email'];

    $sql = "SELECT * FROM new_users WHERE email='$email'";
    $result = mysqli_query($con,$sql);

    if($result)
    {
        if($row = mysqli_fetch_assoc($result))
        {
            $id = $row['id'];
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $sql = "INSERT INTO complains(subject,body,userid) VALUES('$subject','$message',$id)";
        $result = mysqli_query($con,$sql);

        if($result)
        {
            $flag = 1;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="styles/css/usercomplains.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Complains</title>
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
                    <li style="background: linear-gradient(to right top,#65dfc9,#6cdbeb);">
                        <a href="usercomplains.php" style="color: #fff;">
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
                <div class="complain">
                    <form action="" autocomplete="off" method="POST">
                        <div class="input-box">
                            <span class="done">
                                <?php
                                    if($flag)
                                    {
                                        echo "<p>Successfully Sent</p>";
                                    }       
                                ?>  
                            </span>
                        </div>
                        <div class="input-box">
                            <span>Subject</span>
                            <input class="input" type="text" name="subject" required>
                        </div>
                        <div class="input-box">
                            <span>Message</span>
                            <textarea class="input" id="" cols="30" rows="10" style="padding-top: 10px;" name="message" required></textarea>
                        </div>
                        <div class="btn">
                            <button type="submit" class="submit" name="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>