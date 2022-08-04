<?php
    include 'database/databaseCon.php';

    $flag = 0;
    $done = 0;

    if(isset($_POST['submit']))
    {
        $slotname = $_POST['name'];
        $location = $_POST['location'];

        $sql = "SELECT * FROM parking WHERE location_code = '$location'";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $value = mysqli_num_rows($result);
            if($value > 0)
            {
                $flag = 1;
            }
            else
            {
                $sql = "INSERT INTO parking(parkname,location_code) VALUE('$slotname','$location')";
                $result = mysqli_query($con,$sql);
                $done = 1;
            }
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
    <title>Edit user data</title>
</head>
<body>
    <div class="container">
        <div class="title">
            Add new parking slot
        </div>
        <a href="adminparking.php"><ion-icon name="arrow-back-outline"></ion-icon></a>
        <div class="alart">
            <?php
                if($flag)
                {
                    echo "<p class='danger'>Slot alredy exists</p>";
                }
                if($done)
                {
                    echo "<p class='success'>Successfully added</p>";
                }
            ?>
        </div>
        <form method="post" autocomplete="off">
            <div class="user-details">
                <div class="input-box">
                    <span>Slot Name</span>
                    <input type="text" name="name" required>
                </div>
                <div class="input-box">
                    <span>Slot location code</span>
                    <input type="text" name="location" required>
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