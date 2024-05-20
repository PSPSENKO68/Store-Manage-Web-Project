<?php
include './view/header.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: "Rubik", sans-serif;
      background-color: #f8f9fa;
    }

    .about-section {
      padding: 50px;
      text-align: center;
      color: #fff;
    }

    .team-member img {
      max-width: 100%;
      height: auto;
    }

    .card {
      background-color: #6d52b1;
      /* Purple */
      border: none;
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }

    .card-title,
    .title {
      color: #fff;
      /* White */
    }

    .card-text,
    .card-link {
      color: #f0f0f0;
      /* Light gray */
    }

    .button {
      display: inline-block;
      padding: 8px;
      color: #fff;
      /* White */
      background-color: #a47ef7;
      /* Dark purple */
      text-align: center;
      cursor: pointer;
      width: 100%;
      text-decoration: none;
      border: none;
      transition: background-color 0.3s ease;
    }

    .button:hover {
      background-color: #7d5fc1;
      /* Lighter purple */
    }
  </style>
</head>

<body>
  <div class="about-section">
    <h1>About Us</h1>
    <p class="text-dark pt-3">Once upon a time, when developers were struggling with a stubborn bug on their website, they decided to call upon the Web God for assistance. <br>The Web God appeared and with just a click of a mouse, the bug vanished into thin air. <br>From then on, everyone knew that the Web God was always ready to help - just a little cookie was enough!</p>
  </div>

  <div class="container">
    <h2 class="text-center mb-4"><b>Web God Team</b></h2>
    <div class="row">
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card team-member">
          <img src="images/member/0250.jpg" alt="Khanh" class="card-img-top" />
          <div class="card-body">
            <h5 class="card-title">Lê Đình Khánh</h5>
            <p class="card-text title">CEO & Founder</p>
            <p class="card-text">
              Đình Khánh tôi xưa nay chưa khác bố con thằng nào, đến là trốn, đụng là chạy.
            </p>
            <a class="card-text">52200250@student.tdtu.edu.vn</a>
            <a href="https://www.facebook.com/ledinhkhanh.ldk" class="button">Contact</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card team-member">
          <img src="images/member/0270.jpg" alt="Binh" class="card-img-top" />
          <div class="card-body">
            <h5 class="card-title">Ngô Xuân Bình</h5>
            <p class="card-text title">Project Manager</p>
            <p class="card-text">
              Chụp đến ch*t, chụp đến ch*t, chụp đến ch*t, chụp đến ch*t.
            </p>
            <p class="card-text">52200270@student.tdtu.edu.vn</p>
            <a href="https://www.facebook.com/nxbinh504" class="button">Contact</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card team-member">
          <img src="images/member/0275.jpg" alt="Duy" class="card-img-top" />
          <div class="card-body">
            <h5 class="card-title">Nguyễn H.Khánh Duy</h5>
            <p class="card-text title">Designer & F.Dev</p>
            <p class="card-text">
              Tôi muốn ngủ, tôi muốn ngủ, tôi muốn ngủ, tôi muốn ngủ, tôi muốn ngủ.
            </p>
            <p class="card-text">52200275@student.tdtu.edu.vn</p>
            <a href="#" class="button">Contact</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card team-member">
          <img src="images/member/0289.jpg" alt="Vinh" class="card-img-top" />
          <div class="card-body">
            <h5 class="card-title">Nguyễn Thế Vinh</h5>
            <p class="card-text title">B.Dev & Food Provider</p>
            <p class="card-text">
              Ăn, ngủ, chơi, rồi lại ăn, ngủ, chơi, rồi lại ăn, ngủ, chơi, rồi lại ăn, ngủ, chơi.
            </p>
            <p class="card-text">52200289@student.tdtu.edu.vn</p>
            <a href="#" class="button">Contact</a>
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