<?php
    include 'database/databaseCon.php';

    if(isset($_GET['meetid']))
    {
        $meetingid = $_GET['meetid'];
    }

    $sql = "SELECT * FROM meetings,payment,new_users WHERE meetings.meetingid = payment.meetid AND meetings.userid = new_users.id AND meetid=$meetingid";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $row = mysqli_fetch_assoc($result);

        $userfirst = $row['firstname'];
        $userlast = $row['lastname'];
        $bank = $row['bank'];
        $accounttype = $row['account'];
        $cardnumber = $row['cardnumber'];
        $cardtype = $row['cardtype'];
        $price = $row['paidprice'];
        $paidtime = $row['paidtime'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/css/paydetails.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
</head>
<body>
    <div class="container">
        <div class="title">
            Payment Details 
        </div>
        <a class="back" href="adminmeetings.php"><ion-icon name="arrow-back-outline"></ion-icon></a>
        <div class="user-details">
            <div class="details">
                <span class="name">Customer Name</span>
                <span class="data"><?php echo $userfirst.'&nbsp;'.$userlast; ?></span>
            </div>
            <div class="details">
                <span class="name">Bank Name</span>
                <span class="data"><?php echo $bank.'&nbsp;bank'; ?></span>
            </div>
            <div class="details">
                <span class="name">Account Type</span>
                <span class="data"><?php echo $accounttype.'&nbsp;account'; ?></span>
            </div>
            <div class="details">
                <span class="name">Card Type</span>
                <span class="data"><?php echo $cardtype.'&nbsp;card'; ?></span>
            </div>
            <div class="details">
                <span class="name">Paid Time</span>
                <span class="data"><?php echo $paidtime; ?></span>
            </div>
            <div class="details">
                <span class="name">Paid Amount</span>
                <span class="data"><?php echo 'Rs.'.$price.'.00'; ?></span>
            </div>
        </div>
        <div class="btn">
            <a href="adminmeetings.php"><button>OK</button></a>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>