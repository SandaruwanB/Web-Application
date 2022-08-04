<?php
    include 'database/databaseCon.php';
    $flag=0;
    $success=0;

    session_start();
    $email = $_SESSION['email'];

    $sql = "SELECT * FROM new_users WHERE email='$email'";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $contact = $row['contact'];
        $password = $row['password'];
    }

    if(isset($_POST['submit']))
    {
        $flag = 0;
        $success = 0;
        $old = $_POST['old'];
        $new = $_POST['new'];

        if($old != $password)
        {
            $flag = 1;
        }
        else
        {
            $sql = "UPDATE new_users SET password='$new' WHERE id=$id";
            $result = mysqli_query($con,$sql);
            if($result)
            {
                $success = 1;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="styles/css/usersettings.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Meetings</title>
        <script type="text/javascript">
            function preback(){
                window.history.forward();
            }
            setTimeout("preback()",0);
            window.onunload = function(){null};
        </script>
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
                    <li style="background: linear-gradient(to right top,#65dfc9,#6cdbeb);">
                        <a href="usersettings.php"  style="color: #fff;">
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
                </div>
                <div class="column">
                    <div class="alart">
                        <?php 
                            if($flag)
                            {
                                echo '<p class="danger">old password is wrong please try again.</p>';
                            }
                            else if($success)
                            {
                                echo '<p class="success">Password changed successfully</p>';
                            }
                        ?>
                    </div>
                    <div class="settings">
                        <div class="details">
                            <span class="name">User Name</span>
                            <span class="data"><?php echo $firstname.'&nbsp'.$lastname; ?></span>
                        </div>
                        <div class="details">
                            <span class="name">Email</span>
                            <span class="data"><?php echo $email;?></span>
                        </div>
                        <div class="details">
                            <span class="name">Account Type</span>
                            <span class="data">Premium Account</span>
                        </div>
                        <div class="details">
                            <span class="name">Contact Number</span>
                            <span class="data"><?php echo $contact; ?></span>
                        </div>
                    </div>
                    <div class="btn-password"><button id="user">Change Password</button></div>
                    <div class="btn-logout"><a href="home.php"><button>Log Out</button></a></div>
                </div>
            </div>
        </section>
    </main>
    <div class="bg-modal">
            <div class="content">
                <div class="close-btn">+</div>
                <div class="background">
                    <h3>reset password</h3>
                    <div class="all">
                        <form method="post">
                            <div class="input">
                                <span>Old Password</span>
                                <input type="text" name="old" required>
                            </div>
                            <div class="input">
                                <span>New Password</span>
                                <input type="password" name="new" required>
                            </div>
                            <div class="submit-btn">
                                <button type="submit" name="submit">ok</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('user').addEventListener('click',
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