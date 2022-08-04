<?php
    include ('database/databaseCon.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="styles/css/adminusers.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - Users</title>
    </head>
    <body>
        <div class="container">
            <div class="nav">
                <ul>
                    <li>
                        <a href="#">
                            <span class="icon"></span>
                            <span class="title">VISIONARY</span>
                        </a>
                    </li>
                    <li>
                        <a href="admindashboard.php">
                            <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li style="background-color: #fff;">
                        <a href="adminusers.php" style="color: #2a2185;font-weight: bold;">
                            <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                            <span class="title">Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="adminmeetings.php">
                            <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                            <span class="title">Meetings</span>
                        </a>
                    </li>
                    <li>
                        <a href="admincomplains.php">
                            <span class="icon"><ion-icon name="chatbox-ellipses-outline"></ion-icon></span>
                            <span class="title">Complains</span>
                        </a>
                    </li>
                    <li>
                        <a href="admininventry.php">
                            <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                            <span class="title">Inventory</span>
                        </a>
                    </li>
                    <li>
                        <a href="adminroom.php">
                            <span class="icon"><ion-icon name="library-outline"></ion-icon></span>
                            <span class="title">Meeting Rooms</span>
                        </a>
                    </li>   
                    <li>
                        <a href="adminparking.php">
                            <span class="icon"><ion-icon name="car-outline"></ion-icon></span>
                            <span class="title">Manage Parking</span>
                        </a>
                    </li>
                    <li> 
                        <a href="adminhealth.php">
                            <span class="icon"><ion-icon name="medkit-outline"></ion-icon></span>
                            <span class="title">Health Screening</span>
                        </a>
                    </li>       
                </ul>
            </div>
        </div>
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="logo-vimeo" style="color: #2a2185;"></ion-icon>
                </div>
                <div class="search"></div>
                <div class="user"><a href="admindashboard.php"><ion-icon name="home-outline" style="color: green;"></ion-icon></a></div>
            </div>
            <div class="add">
                <a href="addNewUser.php"><button>Add User</button></a>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Role</th>
                        <th>Password</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php

                            $sql = "SELECT * FROM new_users";
                            $result = mysqli_query($con,$sql);
                            if($result)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    $id = $row['id'];
                                    $firstname = $row['firstname'];
                                    $lastname = $row['lastname'];
                                    $email = $row['email'];
                                    $contact = $row['contact'];
                                    $password = $row['password'];
                                    $role = $row['role'];

                                    echo '<tr>
                                        <td data-label="ID">'.$id.'</td>
                                        <td data-label="First Name">'.$firstname.'</td>
                                        <td data-label="Last Name">'.$lastname.'</td>
                                        <td data-label="Email">'.$email.'</td>
                                        <td data-label="Contact">'.$contact.'</td>
                                        <td data-label="Role">'.$role.'</td>
                                        <td data-label="Password">'.$password.'</td>
                                        <td data-label="Action"><a href="edit.php?upid='.$id.'"><button class="edit">Edit</button></a>&nbsp;&nbsp; <a href="delete.php?delID='.$id.'"><button class="delete">Delete</button></a></td>
                                    </tr>';
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            
        </script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>