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

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_size = $_FILES['image']['size'];

    $allowed = array("image/jpeg", "image/jpg", "image/png");

    if (in_array($file_type, $allowed)) {

      $originalImage = imagecreatefromstring(file_get_contents($file_tmp));


      $width = 200;
      $height = 200;
      $resizedImage = imagecreatetruecolor($width, $height);
      imagecopyresampled($resizedImage, $originalImage, 0, 0, 0, 0, $width, $height, imagesx($originalImage), imagesy($originalImage));

      ob_start();
      imagejpeg($resizedImage);
      $resizedImageData = ob_get_clean(); // Get the buffered image data
      $imageData = base64_encode($resizedImageData);

      // Free up memory
      imagedestroy($originalImage);
      imagedestroy($resizedImage);

      // Retrieve user ID from the session
      $userId = $_SESSION['id'];

      // Update the image in the database using the ID
      $sql = "UPDATE usertable SET image=? WHERE id=?";
      $stmt = mysqli_prepare($con, $sql);

      mysqli_stmt_bind_param($stmt, "si", $imageData, $userId);
      $edited = mysqli_stmt_execute($stmt);

      if ($edited) {
        echo "<script>
                    Swal.fire('Updated', 'Image successfully updated!', 'success')
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
            Swal.fire('Invalid Format', 'Invalid file format. Please upload an image.', 'error')
            .then(() => window.location = 'index.php');
        </script>";
    }
  } else {
    echo "<script>
        Swal.fire('No Image', 'No image uploaded', 'error')
        .then(() => window.location = 'index.php');
    </script>";
  }
  ?>



</body>

</html>