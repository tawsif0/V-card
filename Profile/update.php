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
    require_once "../connect.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $phno = $_POST['phno'];

        // Retrieve user ID from the session
        $userId = $_SESSION['id'];

        // Check if the email already exists for a different user
        $query = "SELECT id FROM usertable WHERE email = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Fetching the row, if any
        $row = mysqli_fetch_assoc($result);

        // If the email exists and is not the user's email, show an error
        if ($row && $row['id'] !== $userId) {
            echo "<script>
            Swal.fire('Error', 'Email already exists for another user!', 'error')
            .then(() => window.location = 'index.php');
          </script>";
            exit();
        }

        // Update the user details in the database
        $sql = "UPDATE usertable SET email=?, name=?, phno=? WHERE id=?";

        // Prepare the statement
        $stmt = mysqli_prepare($con, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $email, $name, $phno, $userId);
            $edited = mysqli_stmt_execute($stmt);

            if ($edited) {
                echo "<script>
                Swal.fire('Success', 'Updated!', 'success')
                .then(() => window.location = 'index.php');
              </script>";
            } else {
                echo "<script>
                Swal.fire('Error', 'Couldn\'t Update', 'error')
                .then(() => window.location = 'index.php');
              </script>";
            }
        } else {
            echo "<script>
            Swal.fire('Error', 'Database error', 'error')
            .then(() => window.location = 'index.php');
          </script>";
        }
    }
    ?>


</body>

</html>