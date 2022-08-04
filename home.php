<?php
    include ('layouts/navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/css/home.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script type="text/javascript">
            function preback(){
                window.history.forward();
            }
            setTimeout("preback()",0);
            window.onunload = function(){null};
    </script>
</head>
<body>
    <section class="header">
        <div class="text">
            <h1>VISIONARY</h1>
            <p>Connect with us to arrange your own meeting.Already have an account login to our site.Otherwise join with us via clicking sign up.</p>
            <a href="signin.php" class="signin-btn">sign in</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="signup.php" class="signup-btn">sign up</a>
        </div>        
    </section>
    <section class="details">
        <h1>Why Visionary ?</h1>
        <p style="font-size: 20px;">what is the need of visionary.watch below notices</p>
        <div class="row">
            <div class="col">
                <h3>FACILITIES</h3>
                <p>multiple meeting rooms awailable and multiple payment methods available.also have parking facility.</p>
            </div>
            <div class="col">
                <h3>OBJECTIVES</h3>
                <p>be a completely good and perfect meeting supplires with online booking systems and further technology users to handle meetings.</p>
            </div>
            <div class="col">
                <h3>TEAM</h3>
                <p>we have world best team members under our compny.they are honest and kind everytime.if yo have any questions can contact our team everytime.</p>
            </div>
        </div>
    </section>
    <section class="payment">
        <h1 style="color: #fff;">PAYMENT METHODS</h1>
        <div class="row-2">
            <div class="col-2"><img src="styles/css/images/visa-logo.jpg" width="70%" height="200px" style="object-fit: cover; border-radius: 10px; box-shadow: 0 0 4px #fff;"></div>
            <div class="col-2"><img src="styles/css/images/Discover-Logo.jpg" width="70%" height="200px" style="object-fit: cover; border-radius: 10px; box-shadow: 0 0 4px #fff;"></div>
            <div class="col-2"><img src="styles/css/images/mastercard.webp" width="70%" height="200px" style="object-fit: cover; border-radius: 10px; box-shadow: 0 0 4px #fff;"></div>
        </div>
    </section>
</body>
</html>
<?php
    include ('layouts/footer.php');
?>