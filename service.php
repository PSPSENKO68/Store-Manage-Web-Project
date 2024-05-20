<?php
include './view/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Our Services</title>
  <link
    rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
  />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
    rel="stylesheet"
  />
  <style>
    body {
      font-family: "Rubik", sans-serif;
      background-color: #f8f9fa; /* Light gray */
    }

    .services-section {
      padding: 50px;
      text-align: center;
      color: #fff;
    }

    .service-card {
      background-color: #6d52b1; /* Purple */
      border: none;
      transition: transform 0.3s ease;
      margin-bottom: 30px;
    }

    .service-card:hover {
      transform: translateY(-5px);
    }

    .service-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
      color: #fff; /* White */
    }

    .service-description {
      font-size: 18px;
      color: #f0f0f0; /* Light gray */
    }
  </style>
</head>
<body>
  <div class="services-section mt-5 ">
    <h1 class="text-dark mt-3"><b>Our Services</b></h1>
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="card service-card">
            <div class="card-body">
              <h2 class="service-title">Website Design</h2>
              <p class="service-description">We offer professional website design services tailored to your needs, ensuring a visually appealing and user-friendly online presence for your business or project.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card service-card">
            <div class="card-body">
              <h2 class="service-title">Security Solutions</h2>
              <p class="service-description">Our security experts provide robust solutions to safeguard your digital assets and protect against cyber threats, ensuring the confidentiality, integrity, and availability of your data.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card service-card">
            <div class="card-body">
              <h2 class="service-title">Network System Design</h2>
              <p class="service-description">We specialize in designing scalable and efficient network systems tailored to your organization's requirements, ensuring seamless connectivity and optimal performance.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card service-card">
            <div class="card-body">
              <h2 class="service-title">Database Design</h2>
              <p class="service-description">Our database experts design and optimize databases to efficiently store and manage your data, ensuring reliability, scalability, and high performance for your applications.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include './view/footer.php';

  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
