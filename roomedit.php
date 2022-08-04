<?php
    include ('database/databaseCon.php');

    if(isset($_GET['roomId']))
    {
        $roomid = $_GET['roomId'];
        $flag = 0;

        $sql = "SELECT * FROM room WHERE roomid=$roomid";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $row = mysqli_fetch_assoc($result);
            $name = $row['roomname'];
            $size = $row['size'];
            $price = $row['price'];
            $discount = $row['discount'];
        }

        if(isset($_POST['submit']))
        {
            $size = $_POST['space'];
            $price = $_POST['price'];
            $discount = $_POST['discount'];

            $sql = "SELECT * FROM room WHERE roomname='$name'";
            $result = mysqli_query($con,$sql);
            if($result)
            {
                $sql = "UPDATE room SET size=$size,price=$price,discount=$discount WHERE roomid=$roomid";
                $result = mysqli_query($con,$sql);
                if($result)
                {
                    header('location: adminroom.php');
                }
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
    <title>Edit rooms</title>
</head>
<body>
    <div class="container">
        <div class="title">
            Edit and Update Room <?php echo $name; ?>
        </div>
        <a href="adminroom.php"><ion-icon name="arrow-back-outline"></ion-icon></a>
        <form method="post" autocomplete="off">
            <div class="user-details">
                <div class="input-box">
                    <span>Space Accommodation</span>
                    <input type="number" name="space" value="<?php echo $size; ?>" required>
                </div>
                <div class="input-box">
                    <span>Price (Rs.)</span>
                    <input type="number" name="price" value="<?php echo $price; ?>" required>
                </div>
                <div class="input-box">
                    <span>Discount (Rs.)</span>
                    <input type="number" name="discount" value="<?php echo $discount; ?>" required>
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