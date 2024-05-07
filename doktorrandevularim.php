<?php 
   session_start();

   require_once("includes/baglan.php");
   if($_SESSION['valid'] != "1"){
    header("Location: index.php");
   }
?>
<!DOCTYPE html>

<head>
  <meta charset=" UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width-device-width, initial-scale=1.0" />
  <title>Randevularım</title>
  <link rel="stylesheet" href="user.css" />

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: none;
      text-align: center;
      color: #fff;
    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      background-color: none;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 10px;
      padding-top: 20px;
    }

    button {
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin: 0 10px;
      background-color: #699ecf;
      color: #fff;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>
  <header>
    <h2 class="logo">Hospital</h2>
    <nav class="navigation">
      <a href="index.php">Ana Sayfa</a>
      <button class="btnClose-popup" onclick="window.location.href='logout.php'">Çıkış Yap</button>
    </nav>
  </header>
  
  <section class="login-frame">
    <div class="wrapper" object-visible>
      <div class="container">
      <h1>Randevularım</h1>
        <?php

            $isim = $_SESSION['isim'];
            $soyisim = $_SESSION['soyisim'];
            $doktor = $isim . " " . $soyisim;
            $query = "SELECT date, time, clinic FROM randevular WHERE doktor = '$doktor'";
            $post = $baglan->prepare($query);
            $statement = $post->execute();  
            //$row = $post->fetch(PDO::FETCH_ASSOC);
            $randevusayisi = $post->rowCount();
            while ($row = $post->fetch(PDO::FETCH_ASSOC)) {
              $doktor = $row['doktor'];
              $date = $row['date'];
              $time = $row['time'];
              $clinic = $row['clinic'];
              echo '<label for="patientName"> Klinik: ' . $clinic . ', Tarih: ' . $date . ', Saat: ' . $time . '</label><br>';
            }
            
        ?>
      </div>
    </div>
  </section>
  <script src="script.js"></script>
  <script
    type="module"
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
  ></script>
  <script
    nomodule
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
  ></script>
</body>
