<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assests/css/joinNavbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="navbar">
        <h2>vCa<span>rd.</span></h2>
        <ul>
            <li><a href="index.php">

                    Home
                </a></li>
            <li><a href="index.php#about">

                    About
                </a></li>

        </ul>
        <?php
        session_start();
        if (isset($_SESSION['id'])) {

            echo ' <a class="hire-btn" href="./Profile/index.php" >
            Profile
        </a>';
        } else {

            echo ' <a href="join.php" class="hire-btn">Join/Sign In</a> ';
        }
        ?>

    </div>
</body>

</html>