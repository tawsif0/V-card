<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Redirecting</title>
    <link rel="shortcut icon" href="./assets/images/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <style>
        body {
            background: #212529;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        Swal.fire({
            title: 'Logging Out...',
            html: 'Please wait...',
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            }
        });
        setTimeout(function() {
            Swal.fire({
                title: 'Logged Out!',
                icon: 'success',
                timer: 2500,
                timerProgressBar: true,
                showConfirmButton: false
            }).then(function() {

                window.location = "../index.php";
            });
        }, 1500);
    </script>
</body>

</html>