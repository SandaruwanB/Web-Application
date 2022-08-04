<?php
    include ('database/databaseCon.php');
    $flag=0;
    $done=0;
    $first='';
    $last='';
    $passw='';
    $mail="";
    $phone='';
    
    

    if(isset($_GET['upid']))
    {
        $upId = $_GET['upid'];
        $sql = "SELECT * FROM new_users WHERE id=$upId";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $row = mysqli_fetch_assoc($result);
            $first = $row['firstname'];
            $last = $row['lastname'];
            $passw = $row['password'];
            $mail = $row['email'];
            $phone = $row['contact'];
        }
        else
        {
            header('location: adminusers.php');
        }
        if(isset($_POST['submit']))
        {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $contact = $_POST['contact'];

            $sql = "UPDATE new_users SET firstname='$firstname',lastname='$lastname',email='$email',password='$password',role='$role',contact=$contact WHERE id=$upId";
            $result = mysqli_query($con,$sql);
            if($result)
            {
                header('location: adminusers.php');
            }
            else
            {
                die(mysqli_error($con));
            }
        }
    }
    else if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $flag = 0;
        $done = 0;

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $role = $_POST['role'];
        $password = $_POST['password'];

        if(isset($_POST['submit']))
        {
            $sql = "SELECT * FROM new_users WHERE email='$email'";
            $result = mysqli_query($con,$sql);
            if($result)
            {
                $value = mysqli_num_rows($result);
                if($value>0)
                {
                    $flag = 1;
                }
                else
                {
                    $sql = "INSERT INTO new_users(firstname,lastname,email,contact,role,password) VALUES('$firstname','$lastname','$email',$contact,'$role','$password')";
                    $result = mysqli_query($con,$sql);
                    if($result)
                    {
                        $done = 1;
                    }
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
            Edit and Update
        </div>
        <a href="adminusers.php"><ion-icon name="arrow-back-outline"></ion-icon></a>
        <div class="alart">
            <?php
                if($flag)
                {
                    echo "<p class='danger'>User alredy exists</p>";
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
                    <span>First Name</span>
                    <input type="text" name="firstname" value="<?php echo $first; ?>" required>
                </div>
                <div class="input-box">
                    <span>Last Name</span>
                    <input type="text" name="lastname" value="<?php echo $last; ?>" required>
                </div>
                <div class="input-box">
                    <span>Email</span>
                    <input type="email" name="email" value="<?php echo $mail; ?>" required>
                </div>
                <div class="input-box">
                    <span>Contact</span>
                    <input type="tel" name="contact" value="<?php echo $phone; ?>" required>
                </div>
                <div class="input-box">
                    <span>Role</span>
                    <select name="role">
                       
                        <option value="admin">Admin</option>
                        <option value="director">Director</option>
                        <option value="supervisor">Supervisor</option>
                        <option value="data entry operator">Data Entry Operator</option>
                        <option value="security">Security</option>
                        <option value="cashier">Cashier</option>
                        <option value="receptionist">Receptionist</option>
                        <option value="operational staff">Operational Staff</option>
                        
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="input-box">
                    <span>Password</span>
                    <input type="text" name="password" value="<?php echo $passw; ?>" required>
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