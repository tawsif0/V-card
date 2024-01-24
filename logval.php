<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Redirecting</title>
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
    require 'connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $query = "SELECT id, email, password FROM usertable WHERE email = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];
            if (password_verify($password, $hashedPassword)) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                echo '<script>
                    Swal.fire("Success", "Logged In!", "success")
                    .then(() => window.location.href = "./Profile/index.php");
                  </script>';
            } else {
                echo '<script>
                    Swal.fire("Error", "Invalid password", "error")
                    .then(() => window.location.href = "join.php");
                  </script>';
            }
        } else {
            echo '<script>
                Swal.fire("Error", "User not found", "error")
                .then(() => window.location.href = "join.php");
              </script>';
        }
    }
    ?>

</body>

</html>