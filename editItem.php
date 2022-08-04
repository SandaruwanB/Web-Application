<?php
    include ('database/databaseCon.php');
    $flag=0;
    $succes=0;
    $name='';
    $qty='';
    

    if(isset($_GET['inId']))
    {
        $id = $_GET['inId'];

        $sql = "SELECT * FROM inventry WHERE itemid=$id";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $row = mysqli_fetch_assoc($result);
            $name = $row['itemname'];
            $qty = $row['size'];
            $exp = $row['expiredate'];
        }
        if(isset($_POST['submit']))
        {
            $itemname = $_POST['itemname'];
            $quantitiy = $_POST['qty'];
            $expire = $_POST['date'];

            $sql = "UPDATE inventry SET itemname='$itemname',size='$quantitiy',expiredate='$expire' WHERE itemid=$id";
            $result = mysqli_query($con,$sql);
            if($result)
            {
                header('location: admininventry.php');
            }
        }
    }    
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $flag = 0;
        $succes = 0;
        $itemname = $_POST['itemname'];
        $quantitiy = $_POST['qty'];
        $expire = $_POST['date'];

        $sql = "SELECT * FROM inventry WHERE itemname='$itemname'";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $count = mysqli_num_rows($result);
            if($count > 0)
            {
                $flag = 1;
            }
            else
            {
                if($expire == "")
                {
                    $sql = "INSERT INTO inventry(itemname,size) VALUES('$itemname','$quantitiy')";
                    $result = mysqli_query($con,$sql);
                    $succes = 1;
                }
                else
                {
                    $sql = "INSERT INTO inventry(itemname,size,expiredate) VALUES('$itemname','$quantitiy','$expire')";
                    $result = mysqli_query($con,$sql);
                    $succes = 1;
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
    <title>Edit user data</title>
</head>
<body>
    <div class="container">
        <div class="title">
            Edit Item
        </div>
        <a href="admininventry.php"><ion-icon name="arrow-back-outline"></ion-icon></a>
        <div class="alart">
            <?php
                if($flag)
                {
                    echo '<p class="danger">Item already exists, please update it.</p>';
                }
                else if($succes)
                {
                    echo '<p class="success">Succesfully Added</p>';
                }
            ?>
        </div>
        <form method="post" autocomplete="off">
            <div class="user-details">
                <div class="input-box">
                    <span>Item Name</span>
                    <input type="text" name="itemname" value="<?php echo $name;  ?>" required>
                </div>
                <div class="input-box">
                    <span>Quantity</span>
                    <input type="text" name="qty" value="<?php echo $qty; ?>" required>
                </div>
                <div class="input-box">
                    <span>expire date</span>
                    <input type="date" name="date" value="<?php echo $exp; ?>">
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