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
  <title>Randevu Al</title>
  <link rel="stylesheet" href="user.css" />

  <style>
    .wrapper.appointment {
      position: relative;
      width: 400px;
      height: fit-content;
      background-color: transparent;
      border: 5px solid #699ecf;
      border-radius: 20px;
      backdrop-filter: blur(45px);
      box-shadow: 0 0 30px #000000;
      display: flex;
      justify-content: center;
      align-items: center;
      transition: transform 0.5s ease, height 0.5s ease;
      overflow: hidden;
      padding: 20px;
      color: #333;
    }

    .modal {
      width: 100%;
      height: auto;
      padding-top: 40px;
    }
    .appointment-form h2 {
      margin-bottom: 20px;
      text-align: center;
    }

    .appointment-form {
      display: flex;
      flex-direction: column;
      width: 100%;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .form-group select,
    .form-group input {
      width: 100%;
      padding: 15px;
      border: 2px solid #ccc;
      border-radius: 4px;
      color: #fff;
      background: transparent;
    }

    button {
      background-color: #007bff;
      color: white;
      padding: 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
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
        <button class="btnClose-popup"  onclick="window.location.href='logout.php'" >Çıkış Yap</button>
    </nav>
  </header>
  <section class="login-frame">
    <div class="wrapper appointment" object-visible>
      <div class="icon-close">
        <ion-icon
          onclick="window.location.href='user.php'"
          name="close-outline"
        ></ion-icon>
      </div>

      <div class="modal">
        <!-- <form class="appointment-form"> -->
          <h2>Randevu Al</h2>
          <?php

           $isim = $_SESSION['isim'];
           $soyisim = $_SESSION['soyisim'];
           $hasta = $isim . " " . $soyisim;
           if(isset($_POST['submit'])) {
              $clinic = $_POST['clinic'];
              $doctor = $_POST['doctor'];
              $date = $_POST['date'];
              $time = $_POST['time'];
              //     ÇALIŞAN KISIM
              //$query = "INSERT INTO randevular (doktor, hasta, clinic, date, time) VALUES ('$doctor', '$hasta', '$clinic', '$date', '$time')";
              //$post = $baglan->prepare($query);
              //$statement = $post->execute();
              //$query_check_clinic = "SELECT * FROM doktorlar WHERE clinic='$clinic' AND doktorisim='$doctor'";
              $query_check_clinic = "SELECT * FROM doktorlar WHERE clinic='$clinic' AND CONCAT(doktorisim, ' ', doktorsoyisim) = '$doctor'";
              $post = $baglan->prepare($query_check_clinic);
              $statement = $post->execute();
              if ($post->rowCount() > 0) {

                  $query_check = "SELECT * FROM randevular WHERE clinic='$clinic' AND doktor='$doctor' AND date='$date' AND time='$time' ";
                  $post = $baglan->prepare($query_check);
                  $statement = $post->execute();
                  if ($post->rowCount() > 0) {
                    echo "Bu randevu zaten mevcut!";
                  } else {
                    $query = "INSERT INTO randevular (doktor, hasta, clinic, date, time) VALUES ('$doctor', '$hasta', '$clinic', '$date', '$time')";
                    $post = $baglan->prepare($query);
                    $statement = $post->execute();
                  }

              }else{
                echo ' <label for="errorver"> KLİNİK HATASI </label>';
              }
           }else{

           }
           ?>

<form action="" method="post">
<div class="form-group">
                <label for="clinic">Poliklinik Seçimi:</label>
                <select id="clinic" name="clinic">
                <option value="">Poliklinik Seçiniz</option>
                <option value="Kardiyoloji">Kardiyoloji</option>
                <option value="Nöroloji">Nöroloji</option>
                <option value="KBB">KBB</option>
                <option value="Diyetisyenlik">Diyetisyenlik</option>
                </select>
</div>
<div class="form-group">
            <label for="doctor">Doktor Seçimi:</label>
              <select id="doctor" name="doctor">
              <option value="">Doktor Seçiniz</option>
              <option value="Ali Osman ALAT">Dr. Ali Osman ALAT</option>
              <option value="Orhan BALAK">Dr. Orhan BALAK</option>
              <option value="İhsan SOLAK">Dr. İhsan SOLAK</option>
              <option value="Aliye Karaman">Dr. Aliye KARAMAN</option>
              </select>
</div>

          
<form method="post" action="">
    <div class="form-group">
        <label for="date">Tarih:</label>
        <input type="date" id="date" name="date" />
    </div>

    <div class="form-group">
        <label for="time">Saat:</label>
        <input type="time" id="time" name="time" />
    </div>
    <div class="field">    
        <input type="submit" class="btn" name="submit" value="RANDEVU AL" required>
    </div>
</form>

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
