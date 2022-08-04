<?php
    include ('layouts/navbar.php');
    include ('database/databaseCon.php');
    $flag=0;

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        

        
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = 'admin';

        $sql = "SELECT * FROM new_users WHERE email='$email'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($result);
        $username = $row['firstname'];

        $sql = "SELECT * FROM new_users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $num = mysqli_num_rows($result);
            if($num>0)
            {
                $qry = "SELECT * FROM new_users WHERE email='$email' AND role='$role'";
                $final = mysqli_query($con,$qry);
                if($final)
                {
                    $val = mysqli_num_rows($final);
                    if($val>0)
                    {
                        session_start();
                        $_SESSION['email'] = $email;
                        $_SESSION['role'] = $role;
                        $_SESSION['name'] = $username;
                        header('location:admindashboard.php');
                    }
                    else
                    {
                        session_start();
                        $_SESSION['name'] = $username;
                        $_SESSION['email'] = $email;
                        header('location:userdashboard.php');
                    }   
                }
            }
            else
            {
                $flag = 1;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/css/signin.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
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
        window.onunload = function(){null;}
    </script>
</head>
<body>
    <div class="container">
        <div></div>
        <div class="container-inside">
            <h1>www.<span>vision</span>ary.org</h1>
            <h3>sign in</h3>
            <div class="container2">
                <div></div>
                <div>
                    <?php
                        if($flag)
                        {
                            echo '<p class="login-case">wrong data.please check password or email.</p>';
                        }
                    ?>
                    <form action="" method="POST" autocomplete="off">                                             
                        <input type="email" name="email" required>
                        <label for="email">email</label>                                               
                        <input type="password" name="password" required>
                        <label for="password">password</label>                        
                        <button type="submit" class="signup-btn" name="submit">Sign In</button>
                    </form>
                    <a href="signup.php" style="text-align: center; margin-top: 30px;">Click here to Sign up</a>
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