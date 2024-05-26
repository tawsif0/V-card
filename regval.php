
<?php
session_start();
require 'connect.php';

$maxFileSize = 1000 * 1024; // 100 KB in bytes

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phno = $_POST["phno"];
    $password = $_POST["password"];
    $id = uniqid();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the file input is set and not empty
    if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
        if ($_FILES["image"]["size"] > $maxFileSize) {
            $_SESSION['status'] = "Image exceeds maximum file size.";
            $_SESSION['status_code'] = "error";
            header('Location: join.php');
            exit();
        }

        $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
        if ($imageData !== false) {
            $image = imagecreatefromstring($imageData);
            if ($image !== false) {
                $width = imagesx($image);
                $height = imagesy($image);
                $newWidth = 200;
                $newHeight = 200;
                $imageResized = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($imageResized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                // Capture the resized image data
                ob_start();
                imagejpeg($imageResized);
                $imageDataResized = ob_get_clean();

                // Base64 encode the resized image data
                $imageBase64 = base64_encode($imageDataResized);

                // Insert data into the database with retry logic
                try {
                    $query = "INSERT INTO usertable (id, name, email, phno, password, image) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($con, $query);
                    mysqli_stmt_bind_param($stmt, "ssssss", $id, $name, $email, $phno, $hashedPassword, $imageBase64);
                    if (!mysqli_stmt_execute($stmt)) {
                        throw new mysqli_sql_exception(mysqli_stmt_error($stmt));
                    }

                    $_SESSION['status'] = "Registered!";
                    $_SESSION['status_code'] = "success";
                    header('Location: join.php');
                    exit();
                } catch (mysqli_sql_exception $e) {
                    if ($e->getCode() == 2006) { // MySQL server has gone away
                        $con = reconnectDatabase(); // Function to reconnect to the database
                        $stmt = mysqli_prepare($con, $query);
                        mysqli_stmt_bind_param($stmt, "ssssss", $id, $name, $email, $phno, $hashedPassword, $imageBase64);
                        if (!mysqli_stmt_execute($stmt)) {
                            $_SESSION['status'] = "Database error: " . mysqli_stmt_error($stmt);
                            $_SESSION['status_code'] = "error";
                            header('Location: join.php');
                            exit();
                        }
                    } else {
                        $_SESSION['status'] = "Database error: " . $e->getMessage();
                        $_SESSION['status_code'] = "error";
                        header('Location: join.php');
                        exit();
                    }
                }
            } else {
                $_SESSION['status'] = "Invalid image file.";
                $_SESSION['status_code'] = "error";
                header('Location: join.php');
                exit();
            }
        } else {
            $_SESSION['status'] = "Sorry, there was an error reading the image file.";
            $_SESSION['status_code'] = "error";
            header('Location: join.php');
            exit();
        }
    } else {
        $_SESSION['status'] = "Image not uploaded.";
        $_SESSION['status_code'] = "error";
        header('Location: join.php');
        exit();
    }
}

// Function to reconnect to the database
function reconnectDatabase()
{
    global $con;
    $con = new mysqli('localhost', 'username', 'password', 'database');
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    return $con;
}
