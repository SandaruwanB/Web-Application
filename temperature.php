<?php
    include 'database/databaseCon.php';

    $success = 0;

    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $nic = $_POST['nic'];
        $address = $_POST['address'];
        $date = $_POST['date'];
        $email = $_POST['email'];
        $timein = $_POST['timein'];
        $timeout = $_POST['timeout'];
        $temp = $_POST['temp'];

        $sql = "INSERT INTO health(name,date,nic,address,email,timein,temperature) VALUES('$name','$date','$nic','$address','$email','$timein',$temp)"; 
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $success = 1;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/css/edit.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temperature</title>
</head>
<body>
    <div class="container">
        <div class="title">
            Add Temperature Details
        </div>
        <div class="alart">
            <?php
                if($success)
                {
                    echo '<p class="success">Success</p>';
                }
            ?>
        </div>
        <a href="adminhealth.php"><ion-icon name="arrow-back-outline"></ion-icon></a>
        <form method="post" autocomplete="off">
            <div class="user-details">
                <div class="input-box">
                    <span>Name</span>
                    <input type="text" name="name" required>
                </div>
                <div class="input-box">
                    <span>NIC</span>
                    <input type="text" name="nic" required>
                </div>
                <div class="input-box">
                    <span>Email</span>
                    <input type="email" name="email">
                </div>
                <div class="input-box">
                    <span>Address</span>
                    <input type="text" name="address">
                </div>
                <div class="input-box">
                    <span>Date</span>
                    <input type="date" name="date" required>
                </div>
                <div class="input-box">
                    <span>Time In</span>
                    <input type="time" name="timein" required>
                </div>
                <div class="input-box" style="position: relative;">
                    <span>Body Temperature</span>
                    <input type="number" name="temp" max="99" min="10" required><span style="position: absolute; right: 30%; top: 35px;">&#8451;</span>
                </div>
                <div class="button">
                    <input type="submit" value="Done" name="submit">
                </div>
            </div>
        </form>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>