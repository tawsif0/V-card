<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="./assests/images/logo.ico" type="image/x-icon" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="./assests/css/indexPageSsss.css" />
  <link rel="stylesheet" href="./assests/css/card.css">
  <title>vCard - Home</title>
</head>

<body>
  <?php
  include("heading.php");
  ?>
  <div class="main">
    <p class="title">vCard Platform</p>
    <p class="subtitle">Welcome to vCard</p>
    <p class="subtitles">
      Here you can create your own virtual business card
    </p>
  </div>

  <section id="about">
    <div class="about">
      <img src="./assests/image/images.png" />
      <div class="scroll-animation">
        <div class="info">
          <h3>About vCard</h3>
          <p>
            A vCard, short for Virtual Business Card, is a digital alternative to
            traditional business cards. It serves as a compact and versatile way
            to share contact information, making networking and information
            exchange more convenient in the digital era. Essentially, a vCard
            contains vital contact details such as name, phone number, email
            address, website, physical address, and more. It's commonly stored in
            a standard format (VCF - Virtual Contact File) that enables easy
            sharing across various platforms, devices, and applications.
          </p>
        </div>
      </div>
    </div>
  </section>
  <?php
  $loggedIn = isset($_SESSION['id']);
  ?>
  <div class="card-nft" <?php if ($loggedIn) echo 'style="display: none;"'; ?>>
    <div class="scroll-animation">
      <div class="card">
        <div class="nft">
          <div class="main-nft">
            <img class="tokenImage" src="./assests/image/card.png" alt="NFT" />
            <h2 class="h2-nft">Digital Business Card</h2>
            <p class="description-nft">
              Unlock Your Digital Identity,Buy Your vCard Today!
            </p>
            <hr />
            <button class="btn-nft" onclick="location.replace('join.php')">Create vCard</button>
          </div>
        </div>
      </div>
    </div>
  </div>


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