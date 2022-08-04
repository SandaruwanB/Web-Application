<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=The+Nautigal:wght@700&display=swap" rel="stylesheet">
    <style>
        *{
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
        nav{
            z-index: 1;
            display: flex;
            justify-content: space-around;
            align-items: center;
            min-height: 8vh;
            background-color: rgba(0,0,0,0.6);
            top: 0;
            width: 100%;
            position: fixed;
        }
        .logo{
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 5px;
            font-size: 30px;
            font-family: 'The Nautigal', cursive;
        }
        .nav-links{
            display: flex;
            justify-content: space-around;
            width: 30%;
        }
        .nav-links li{
            list-style: none;
        }
        .nav-links li a{
            color: white;
            text-transform: uppercase;
            text-decoration: none;
            letter-spacing: 2px;
            font-size: 14px;
            font-weight: bold;
            transition: color 0.3s;
            font-family: arial;
        }
        .nav-links li a:hover{
            color: #6BC8FA;
            font-size:16px;
        }
        .burger-btn{
            display: none;
            cursor: pointer;
        }
        .burger-btn div{
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 5px;
        }
        @media screen and (max-width: 900px) {
            body{
                overflow-x: hidden;
            }
            .burger-btn{
                display: block;
            }
            .nav-links{
                position: absolute;
                right: 0px;
                height: 92vh;
                top: 8vh;
                background-color: #343a40;
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 50%;
                transform: translateX(100%);
                transition: transform 0.5s ease-in;
            }
        }
        .nav-active{
            transform: translateX(0%);
        }
        .bur .ln1{
            transform: rotate(-45deg) translate(-5px,6px);
            background-color: red;
        }
        .bur .ln2{
            opacity: 0;
        }
        .bur .ln3{
            transform: rotate(45deg) translate(-5px,-6px);
            background-color: red;
        }

    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <h4>Visionary</h4>
        </div>
        <ul class="nav-links">
            <li>
                <a href="home.php">Home</a>
            </li>
            <li>
                <a href="contact.php">Contact</a>
            </li>
            <li>
                <a href="about.php">About</a>
            </li>
        </ul>
        <div class="burger-btn">
            <div class="ln1"></div>
            <div class="ln2"></div>
            <div class="ln3"></div>
        </div>
    </nav>
    <script>
            const burgerBtn = document.querySelector('.burger-btn');
            const navBar = document.querySelector('.nav-links');

            burgerBtn.addEventListener('click',
            function(){
                navBar.classList.toggle('nav-active');
                burgerBtn.classList.toggle('bur');
            });
    </script>
</body>
</html>
   