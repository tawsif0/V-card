<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Redirecting</title>
    <link rel="shortcut icon" href="./assets/images/logo.ico" type="image/x-icon" />
    <style>
        body {
            background: #212529;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

    <?php
    session_start();
    require_once '../connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $password = $_POST['password'];
        $con_pass = $_POST['con_pass'];
        $s = $_SESSION['id'];

        if (empty($password)) {
            echo "<script> 
            Swal.fire('Error', 'Old password cannot be empty', 'error')
            .then(() => window.location = 'index.php');
        </script>";
        } elseif (empty($con_pass)) {
            echo "<script> 
            Swal.fire('Error', 'New password cannot be empty', 'error')
            .then(() => window.location = 'index.php');
        </script>";
        } else {
            // Check if the new and old passwords are different before updating
            $checkQuery = "SELECT password FROM usertable WHERE id = '$s'";
            $checkResult = mysqli_query($con, $checkQuery);
            $row = mysqli_fetch_assoc($checkResult);
            $oldHashedPassword = $row['password'];

            if (password_verify($password, $oldHashedPassword)) {
                // Old password matches, proceed with the update
                $hashedPassword = password_hash($con_pass, PASSWORD_DEFAULT);
                $updateQuery = "UPDATE usertable SET password ='$hashedPassword' WHERE id ='$s'";
                $changed = mysqli_query($con, $updateQuery);

                if ($changed) {
                    echo "<script> 
                    Swal.fire('Success', 'Password Changed', 'success')
                    .then(() => window.location = 'logout.php');
                </script>";
                } else {
                    echo "<script> 
                    Swal.fire('Error', 'Error in changing password', 'error')
                    .then(() => window.location = 'index.php');
                </script>";
                }
            } else {
                echo "<script> 
                Swal.fire('Error', 'Old password is incorrect', 'error')
                .then(() => window.location = 'index.php');
            </script>";
            }
        }
    }
    ?>


</body>

</html>