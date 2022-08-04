<?php
    include ('layouts/navbar.php');
    include ('database/databaseCon.php');
    $userflag=0;
    $passwordCeck=0;

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $userflag = 0;
        $passwordCeck = 0;

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];

        if($repassword == $password)
        {
            $sql = "SELECT * FROM new_users WHERE email='$email'";
            $result = mysqli_query($con,$sql);
            if($result)
            {
                $num = mysqli_num_rows($result);
                if($num>0)
                {
                    $userflag = 1;
                }
                else
                {
                    $sql = "INSERT INTO new_users(firstname,lastname,contact,email,password) VALUES ('$firstname','$lastname','$contact','$email','$password')";
                    if($con->query($sql) == true)
                    {
                        header('location:userdashboard.php');
                    }
                }
            }
        }
        else
        {
            $passwordCeck = 1;
        }
        session_start();
        $_SESSION['firstname'] = $firstname;
        $_SESSION['email'] = $email;
        $_SESSION['contact'] = $contact;
        $_SESSION['lastname'] = $lastname;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/css/signup.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        span{
            color: red;
        }
    </style>
    <script type="text/javascript">
        function preback(){
            window.history.forward();
        }
        setTimeout("preback()",0);
        window.onunload = function(){null};
    </script>
</head>
<body>
    <div class="container">
        <div></div>
        <div class="container-inside">
            <h1>www.<span>vision</span>ary.org</h1>
            <h3>sign up</h3>
            <div class="container2">
                <div></div>
                <div>
                    <?php 
                        if($userflag)
                        {
                            echo '<p class="login-case">User alredy exists.please login</p>';
                        }
                        if($passwordCeck)
                        {
                            echo '<p class="login-case">passwords does not match</p>';
                        }                            
                    ?>
                    <form action="" method="POST" autocomplete="off">                        
                        <input type="text" class="firstname" name="firstname" required>
                        <label for="firstname">First name</label>                        
                        <input type="text" name="lastname" required>
                        <label for="lastname">last name</label>                        
                        <input type="email" name="email" required>
                        <label for="email">email</label>                        
                        <input type="tel" name="contact" required>
                        <label for="contact">contact</label>                        
                        <input type="password" name="password" required>
                        <label for="password">password</label>                        
                        <input type="password" name="repassword" required>
                        <label for="repassword">confirm password</label>   
                        <button type="submit" class="signup-btn" name="submit">Sign Up</button>
                    </form>
                    <a href="signin.php" style="text-align: center; margin-top: 30px;">Already have an account?</a>
                </div>
                <div></div>
            </div>
        </div>
        <div></div>
    </div>
</body>
</html>
<?php
    include ('layouts/footer.php')
?>