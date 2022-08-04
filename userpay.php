<?php
    include ('database/databaseCon.php');
    $flag=0;

    if(isset($_GET['meetId']))
    {
        $meetId = $_GET['meetId'];
        $sql = "SELECT * FROM meetings WHERE meetingid=$meetId";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $row = mysqli_fetch_assoc($result);
            $meetingname = $row['name'];
        }
    }
    else
    {
        return;
    }

    $sql = "SELECT * FROM meetings,room WHERE meetings.roomid = room.roomid AND meetingid=$meetId";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $row = mysqli_fetch_assoc($result);
        $roomname = $row['roomname'];
        $price = $row['price'];
        $discount = $row['discount'];
    }
    if(isset($_POST['submit']))
    {
        $flag = 0;
        $bank = $_POST['bank'];
        $accounttype = $_POST['accounttype'];
        $accountnumber = $_POST['accountnumber'];
        $cardtype = $_POST['cardtype'];

        $sql = "SELECT * FROM payment WHERE meetid=$meetId";
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
                $sql = "INSERT INTO payment(bank,account,cardnumber,cardtype,paidprice,meetid) VALUES('$bank','$accounttype',$accountnumber,'$cardtype',($price-$discount),$meetId)";
                $result = mysqli_query($con,$sql);
                if($result)
                {
                    $sql = "UPDATE meetings SET payment='yes' WHERE name='$meetingname'";
                    $result = mysqli_query($con,$sql);
                    if($result)
                    {
                        header('location: usermeetings.php');
                    }
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/css/userpay.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <div class="container">
        <div class="title">
            <?php echo 'Payment for '.$roomname.' Room'; ?>
        </div>
        <div class="highlight">
            <?php
                if($flag)
                {
                    echo '<p class="success">Already paid for this meeting</p>';
                }
            ?>
        </div>
        <a href="usermeetings.php"><ion-icon name="arrow-back-outline"></ion-icon></a>
        <div class="details">
            <div class="inside">
                <span class="name">Room Name : </span>
                <?php echo '<span class="data">'.$roomname.'</span>'; ?>
            </div>
            <div class="inside">
                <span class="name">Price : </span>
                <?php echo '<span class="data">Rs.'.$price.'.00</span>'; ?>
            </div>
            <div class="inside">
                <span class="name">Discount : </span>
                <?php echo '<span class="data">Rs.'.$discount.'.00</span>'; ?>
            </div>
            <div class="inside">
                <span class="name">Total : </span>
                <?php echo '<span class="data">Rs.'.($price - $discount).'.00</span>'; ?>
            </div>
        </div>
        <form method="post" autocomplete="off">
            <div class="user-details">
                <div class="input-box">
                    <span>Bank with Branch</span>
                    <input type="text" name="bank" required>
                </div>
                <div class="input-box">
                    <span>Account Type</span>
                    <input type="text" name="accounttype" required>
                </div>
                <div class="input-box">
                    <span>Card Type</span>
                    <select name="cardtype">
                        <option value="Visa">Visa</option>
                        <option value="Master">Master</option>
                        <option value="AmericanExpress">American Express</option>
                    </select>
                </div>
                <div class="input-box">
                    <span>Card Number</span>
                    <input type="number" name="accountnumber" max="9999999999999999" required>
                </div>
                <div class="input-box">
                    <span>CVC</span>
                    <input type="number" max="999" name="cvc" required>
                </div>
                <div class="button">
                    <input type="submit" value="Pay" name="submit">
                </div>
            </div>
        </form>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>