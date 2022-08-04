<?php
    include 'database/databaseCon.php';
    $flag=0;
    $success=0;

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $success = 0;
        $flag = 0;
        $name = $_POST['name'];
        $size = $_POST['space'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];

        $sql = "SELECT * FROM room WHERE roomname='$name'";
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
                $sql = "INSERT INTO room(roomname,size,price,discount) VALUES('$name',$size,$price,$discount)";
                $result = mysqli_query($con,$sql);
                if($result)
                {
                    $success = 1;
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
    <title>Add rooms</title>
</head>
<body>
    <div class="container">
        <div class="title">
            Add new Room
        </div>
        <a href="adminroom.php"><ion-icon name="arrow-back-outline"></ion-icon></a>
        <div class="alart">
            <?php
                if($flag)
                {
                    echo '<p class="danger">Name allready exists</p>';
                }
                else if($success)
                {
                    echo '<p class="success">Success</p>';
                }
            ?>
        </div>
        <form method="post" autocomplete="off">
            <div class="user-details">
                <div class="input-box">
                    <span>Room Name</span>
                    <input type="text" name="name" required>
                </div>
                <div class="input-box">
                    <span>Space Accommodation</span>
                    <input type="number" name="space" required>
                </div>
                <div class="input-box">
                    <span>Room Price</span>
                    <input type="number" name="price" required>
                </div>
                <div class="input-box">
                    <span>Discount</span>
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