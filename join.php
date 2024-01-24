<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./assests/image/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="./assests/css/loginCcc.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />


    <title>vCard-Join/Sign in </title>
</head>
<?php
include("heading.php");
?>

<body>

    <div class="wrapper">
        <div class="container" id="container">
            <div class="form-container sign-up">
                <form action="regval.php" method="post" enctype="multipart/form-data">
                    <h2>Create Account</h2>

                    <input id="name" name="name" type="text" placeholder="Username" required pattern="[a-zA-Z .]+" />
                    <input id="email" name="email" type="email" placeholder="Email" required />
                    <input id="phno" name="phno" type="text" placeholder="Phone Number" required pattern="\+?(88)?0?1[3456789][0-9]{8}\b" />
                    <input id="password" name="password" type="password" placeholder="password" required />
                    <label for="image" class="custom-file-upload">
                        <span><i class="fas fa-cloud-upload-alt"></i> Upload Image <span id="image-name"></span>
                    </label>
                    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" required style="display: none;" onchange="showImageName()" />

                    <button type="submit" name="submit">Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in">
                <form action="logval.php" method="post">
                    <h2>Sign In</h2>
                    <span>Use your email password</span>
                    <input id="email" name="email" type="email" placeholder="Email" required />
                    <input id="password" name="password" type="password" placeholder="password" required />
                    <button>Sign In</button>
                </form>
            </div>
            <div class="toggle-container">
                <div class="toggle">
                    <div class="toggle-panel toggle-left">
                        <h1>Welcome!</h1>
                        <p>Enter your personal details to use vCard</p>
                        <button class="hidden" id="login">Sign In</button>
                    </div>
                    <div class="toggle-panel toggle-right">
                        <h1>Hello!</h1>
                        <p>
                            Register with your details to
                            use vCard
                        </p>
                        <button class="hidden" id="register">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id='login-form' class='login-page'>
        <div class="form-box">
            <div class='button-box'>
                <div id='btnn'></div>
                <button type='button' onclick='loginn()' class='toggle-btn'>Log In</button>
                <button type='button' onclick='registerr()' class='toggle-btn'>Register</button>
            </div>
            <div id='loginn' class='input-group-login'>
                <form action="logval.php" method="post">
                    <input id="email" name="email" type="email" class='input-field' placeholder="Email" required />
                    <input id="password" name="password" type="password" class='input-field' placeholder="password" required />

                    <button type='submit' name="submit" class='submit-btn'>Log in</button>
                </form>
            </div>
            <div id='registerr' class='input-group-register'>
                <form id="registrationForm" action="regval.php" method="post" enctype="multipart/form-data">
                    <input id="name" name="name" type="text" class='input-field' placeholder="Username" required pattern="[a-zA-Z .]+" />
                    <input id="email" name="email" type="email" class='input-field' placeholder="Email" required />
                    <input id="phno" name="phno" type="text" placeholder="Phone Number" class='input-field' required pattern="\+?(88)?0?1[3456789][0-9]{8}\b" />
                    <input id="password" name="password" type="password" class='input-field' placeholder="password" required />

                    <input type="file" name="image" id="image" class='input-field' accept=".jpg, .jpeg, .png" required />


                    <button type='submit' name="submit" class='submit-btn'>Register</button>
                </form>
            </div>
        </div>
    </div>

    <script src="./assests/js/indexPage.js"></script>
    <footer>
        <div class="cols">
            <div class="about-col">
                <img src="./assests/image/vcard.png" alt="">
            </div>
            <div class="links-col">
                <h4>Dev Social links</h4>

                <a href="https://www.facebook.com/tausif.rahnan.07"><i class="fa-brands fa-facebook-f"></i> Facebook</a>
                <a href="https://github.com/tawsif0"><i class="fa-brands fa-github"></i> Github</a>
                <a href="https://www.linkedin.com/in/tausif-rahman02/"><i class="fa-brands fa-linkedin-in"></i> Linkedin</a>

            </div>

            <div class="news-col">
                <h4>Contact Dev</h4>
                <p title="Tawsif">Tausifur Rahman</p>
                <a href="tel:+8801646962631" class="contact-link"> +8801646962631</a><br>
                <a href="mailto:tausifurrahman0164@gmail.com"> tausifurrahman0164@gmail.com</a>

            </div>

        </div>
    </footer>


</body>

</html>
<?php include 'footer.php'; ?>