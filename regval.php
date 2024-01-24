
<?php
session_start();
require 'connect.php';

$maxFileSize = 100 * 1024; // 100 KB in bytes

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phno = $_POST["phno"];
    $password = $_POST["password"];
    $id = uniqid();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the file input is set and not empty
    if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
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

                // Base64 encode the resized image data directly
                $imageBase64 = base64_encode($imageData);

                // Insert data into the database
                $query = "INSERT INTO usertable (id, name, email, phno, password, image) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "ssssss", $id, $name, $email, $phno, $hashedPassword, $imageBase64);
                mysqli_stmt_execute($stmt);

                $_SESSION['status'] = "Registered!";
                $_SESSION['status_code'] = "success";
                header('Location: join.php');
                exit();
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
?>