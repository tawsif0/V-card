<?php
session_start();

include '../connect.php';

$uid = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  // Check if UID is given in the URL
  if (isset($_GET['uid'])) {
    // Get and decode the UID
    $uid = $_GET['uid'];
    $query = "SELECT * FROM usertable WHERE id = '$uid'";

    $selected = mysqli_query($con, $query);
    $num = mysqli_num_rows($selected);

    while ($row = mysqli_fetch_assoc($selected)) {
      $name = $row['name'];
      $email = $row['email'];
      $phno = $row['phno'];
      $imageBase64 = $row['image'];
      $image = base64_decode($imageBase64);
    }
  } else {
    // UID is not provided in the request
    echo 'UID is not provided in the URL.';
  }
} else {
  // This is not a GET request
  echo 'This is not a GET request.';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>vCard -User Profile</title>

  <link rel="shortcut icon" href="./assets/images/logo.ico" type="image/x-icon" />

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/profiles.css" />
  <!--
    - custom image link
  -->
  <link rel="stylesheet" href="./assets/css/image.css">
  <!--
    - custom Social icons link
  -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<body>

  <main>
    <div class="sidebar">
      <figure class="">
        <div class="upload">
          <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>" width="125" height="125" class="my-3 rounded-circle">
        </div>

      </figure>
      <div class="info-content">
        <h3 class="name" title="<?php echo $name; ?>"><?php echo $name; ?></h3>
      </div>

      <div class="separator"></div>

      <ul class="contacts-list">
        <li class="contact-item">
          <div class="icon-box">
            <ion-icon name="mail-outline"></ion-icon>
          </div>
          <div class="contact-info">
            <p class="contact-title">Email</p>
            <a href="mailto:<?php echo $email; ?>" class="contact-link"><?php echo $email; ?></a>
          </div>
        </li>

        <li class="contact-item">
          <div class="icon-box">
            <ion-icon name="phone-portrait-outline"></ion-icon>
          </div>
          <div class="contact-info">
            <p class="contact-title">Phone</p>
            <a href="tel:<?php echo $phno; ?>" class="contact-link"><?php echo $phno; ?></a>
          </div>
        </li>
        <div class="wrapper">
          <li class="contact-item">
            <?php
            $a = $_GET['uid'];
            $sql = "SELECT * FROM usertable WHERE id = '$a'";
            $result = mysqli_query($con, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
              $retrievedFacebook = $row['facebook'];
              $retrievedGitHub = $row['github'];
              $retrievedLinkedIn = $row['linkedin'];
              $retrievedlink = $row['link'];
              // Check if any social link is available, if not set as empty strings
              if (empty($retrievedFacebook) && empty($retrievedGitHub) && empty($retrievedLinkedIn) && empty($retrievedlink)) {
                $retrievedFacebook = "";
                $retrievedGitHub = "";
                $retrievedLinkedIn = "";
                $retrievedlink = "";
              }
            } else {
              // Set as empty strings if no data found
              $retrievedFacebook = "";
              $retrievedGitHub = "";
              $retrievedLinkedIn = "";
              $retrievedlink = "";
            }
            $fetchAdditionalLinksSql = "SELECT * FROM additional_links WHERE user_id = '$a'";
            $fetchAdditionalLinksResult = mysqli_query($con, $fetchAdditionalLinksSql);

            $additionalLinks = [];
            if ($fetchAdditionalLinksResult && mysqli_num_rows($fetchAdditionalLinksResult) > 0) {
              while ($row = mysqli_fetch_assoc($fetchAdditionalLinksResult)) {
                $additionalLinks[] = $row['link'];
              }
            }
            ?>

            <div class="social-icons">
              <?php if (!empty($retrievedFacebook)) : ?>
                <a href="<?php echo $retrievedFacebook; ?>" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
              <?php endif; ?>
              <?php if (!empty($retrievedGitHub)) : ?>
                <a href="<?php echo $retrievedGitHub; ?>" class="icon"><i class="fa-brands fa-github"></i></a>
              <?php endif; ?>
              <?php if (!empty($retrievedLinkedIn)) : ?>
                <a href="<?php echo $retrievedLinkedIn; ?>" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
              <?php endif; ?>
              <?php if (!empty($retrievedlink)) : ?>
                <a href="<?php echo $retrievedlink; ?>" class="icon"><i class="fa fa-paperclip"></i></a>
              <?php endif; ?>
              <?php foreach ($additionalLinks as $additionalLink) : ?>
                <?php if (!empty($additionalLink)) : ?>
                  <a href="<?php echo $additionalLink; ?>" class="icon"><i class="fa fa-link"></i></a>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </li>
        </div>
      </ul>

      <div class="separator"></div>

    </div>


  </main>

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>


</body>

</html>