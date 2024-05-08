<?php 
   session_start();
?>
<!DOCTYPE html>
<head>
    <meta charset=" UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>

<style>
.btnClose-popup {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin: 0 10px;
    background-color: #699ecf;
    color: #fff;
}
.btnClose-popup:hover {
    background-color: #0056b3;
}
</style>

<body>    
    <header> 
        <h2 class="logo">Hospital</h2>
        <nav class="navigation">
            <a href="#home">Ana Sayfa</a>
            <a href="#services">Hizmetlerimiz</a>
            <a href="#doctors">Doktorlarımız</a>
            <a href="#about">Hakkımızda</a>
            <a href="#contact">İletişim</a>
            <!-- <button class="btnLogin-popup">Giriş Yap/Kaydol</button> -->
            <?php
                if($_SESSION['valid'] != "1"){
                    ?>
                    <!-- <button class="btnLogin-popup"><?php //echo "Giriş Yap/Kaydol"; ?></button>-->
                    <button class="btnLogin-popup" onclick="goToTopOfPage()">Giriş Yap/Kaydol</button>
                <script>
                    function goToTopOfPage() {
                        window.scrollTo(0, 0);
                    }
                </script>
                    <?php
                }else{
                    if($_SESSION['usertype'] == "doktor"){
                        ?>  
                            <a href="doktorrandevularim.php">Randevularım</a>
                        <?php
                    }else{
                        ?>
                            <a href="randevularim.php">Randevularım</a>
                        <?php
                    }
                        ?>
            <button class="btnClose-popup" type="submit" name="logoutsubmit" onclick="window.location.href='logout.php'" ><?php echo "Çıkış Yap"; ?></button>
            <?php } ?>
        </nav>
    </header>
    <section id="home" class="login-frame">
        <h1>Hoşgeldiniz</h1>
        <div class="wrapper" object-visible>
            <div class="icon-close">
                <ion-icon name="close-outline"></ion-icon>
            </div>
            <div class="form-box login">
                <h2>Giriş</h2>
                <?php 
                    include("includes/baglan.php");
                    //$_SESSION['valid'] = "0";
                    $user_type = $_POST['user_type'];
                    $isim = $_POST['isim'];
                    $soyisim = $_POST['soyisim'];
                    $tc = $_POST['tc'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $clinic = $_POST['clinic'];
                    if(isset($_POST['registersubmit'])) {
                        if ($user_type == "doktor") {
                            $query = "INSERT INTO doktorlar (doktortc, doktorisim, doktorsoyisim, email, password, clinic) VALUES ('$tc', '$isim', '$soyisim', '$email', '$password', '$clinic')";
                            $post = $baglan->prepare($query);
                            $statement = $post->execute();
                            if($statement){
                                //header("Location: deneme.php");
                                $query = "SELECT * FROM doktorlar WHERE doktortc='$tc' AND password='$password'";
                                $post = $baglan->prepare($query);
                                $statement = $post->execute();  
                                $row = $post->fetch(PDO::FETCH_ASSOC);
                                if($row){
                                    $girisYapildi = 1;
                                    $_SESSION['valid'] = "1";
                                    $_SESSION['tc'] = $row['doktortc'];
                                    $_SESSION['isim'] =$row['doktorisim'];
                                    $_SESSION['soyisim'] = $row['doktorsoyisim'];
                                    $_SESSION['email'] = $row['email'];
                                    $_SESSION['password'] = $row['password'];
                                    $_SESSION['clinic'] = $row['clinic'];
                                    $_SESSION['usertype'] = "doktor";
                                    header("Location: doktor.php");
                                }
                                //echo "BAŞARIYLA KAYIT OLDUNUZ";
                                //echo "<a href='index.php'><button class='btn'>Ana Sayfaya Dön</button>";
                            }else{     
                                echo "<div class='message'>
                                         <p>KAYIT BAŞARILI OLAMADI</p>
                                      </div> <br>";
                            }
                        }elseif($user_type == "hasta"){  // hasta register
                            $query = "INSERT INTO hastalar (hastatc, hastaisim, hastasoyisim, email, password) VALUES ('$tc', '$isim', '$soyisim', '$email', '$password')";
                            $post = $baglan->prepare($query);
                            $statement = $post->execute();
                            if($statement){
                                $query = "SELECT * FROM doktorlar WHERE doktortc='$tc' AND password='$password'";
                                $post = $baglan->prepare($query);
                                $statement = $post->execute();  
                                $row = $post->fetch(PDO::FETCH_ASSOC);
                                if($row){
                                    $girisYapildi = 1;
                                    $_SESSION['valid'] = "1";
                                    $_SESSION['tc'] = $row['doktortc'];
                                    $_SESSION['isim'] =$row['doktorisim'];
                                    $_SESSION['soyisim'] = $row['doktorsoyisim'];
                                    $_SESSION['email'] = $row['email'];
                                    $_SESSION['password'] = $row['password'];
                                    $_SESSION['clinic'] = $row['clinic'];
                                    $_SESSION['usertype'] = "doktor";
                                    header("Location: doktor.php");
                                }
                            }else{     
                                echo "<div class='message'>
                                     <p>KAYIT BAŞARILI OLAMADI</p>
                                </div> <br>";
                            }
                        }
                    }elseif(isset($_POST['loginsubmit'])) {
                        if($user_type == "hasta"){
                            $query = "SELECT * FROM hastalar WHERE hastatc='$tc' AND password='$password'";
                            $post = $baglan->prepare($query);
                            $statement = $post->execute();  
                            $row = $post->fetch(PDO::FETCH_ASSOC);
                            if($row){
                                $girisYapildi = 1;
                                $_SESSION['valid'] = "1";
                                $_SESSION['tc'] = $row['hastatc'];
                                $_SESSION['isim'] =$row['hastaisim'];
                                $_SESSION['soyisim'] = $row['hastasoyisim'];
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['password'] = $row['password'];
                                $_SESSION['usertype'] = $user_type;
                                header("Location: user.php");
                            }else{
                                echo "SİSTEM HATASI";
                            }
                        }else{
                            $query = "SELECT * FROM doktorlar WHERE doktortc='$tc' AND password='$password'";
                            $post = $baglan->prepare($query);
                            $statement = $post->execute();  
                            $row = $post->fetch(PDO::FETCH_ASSOC);
                            if($row){
                                $girisYapildi = 1;
                                $_SESSION['valid'] = "1";
                                $_SESSION['tc'] = $row['doktortc'];
                                $_SESSION['isim'] =$row['doktorisim'];
                                $_SESSION['soyisim'] = $row['doktorsoyisim'];
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['password'] = $row['password'];
                                $_SESSION['clinic'] = $row['clinic'];
                                $_SESSION['usertype'] = $user_type;
                                header("Location: doktor.php");
                            }else{
                                header("Location: index.php");
                            }
                        }

                    }elseif(isset($_POST['logoutsubmit'])) {
                        session_unset(); // Oturumdaki tüm değişkenleri temizler
                        session_destroy(); // Oturumu sonlandırır
                        header("Location: index.php");
                    }else{
                        $_SESSION['usertype'] = $user_type;
                       /*
                    }
                        if(isset($_SESSION['giris'])) {
                        ?>  
                            <button class="btnLogin-popup"><?php echo "Çıkış Yap"; ?></button>

                        <?php
                        }else{
                        */
                ?>

                <form action="" method="post">
                <label for="user_type">Kullanıcı türü:</label>
                    <select name="user_type" id="user_type">
                        <option value="doktor">Doktor</option>
                        <option value="hasta">Hasta</option>
                    </select>
                    <div class="input-box">
                        <span class="icon"></span>
                        <input type="number" name="tc" required>
                        <label class="login">TC Kimlik No</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"></span>
                        <input type="password" name="password" required>
                        <label class="login">Şifre</label>
                    </div>
                    <div class="remember-forgot">
                            <a href=""></a>
                    <!--<label><input type="checkbox">Beni Hatırla</label> -->
                            <a href="#">Şifremi Unuttum</a>
                    </div>
                    <button type="submit" name="loginsubmit" class="btn">Giriş yap</button>
                    <div class="login-register">
                        <p>Hesabınız mı yok?<a href="#" class="register-link"> Kayıt Ol </a></p>
                    </div>
                </form>
            </div>

            <div class="form-box register">
                <h2>Kayıt</h2>
                <form action="" method="post">
                    <label for="user_type">Kullanıcı türü:</label>
                    <select name="user_type" id="user_type">
                        <option value="doktor">Doktor</option>
                        <option value="hasta">Hasta</option>
                    </select>
                    <div class="form-group">
                        <label for="clinic">Doktorsanız ÖNCE POLİKLİNİK SEÇİNİZ:</label>
                        <select id="clinic" name="clinic">
                        <option value="">Poliklinik Seçiniz</option>
                        <option value="kardiyoloji">Kardiyoloji</option>
                        <option value="nöroloji">Nöroloji</option>
                        <option value="kbb">KBB</option>
                        <option value="diyetisyenlik">Diyetisyenlik</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <input type="text" name="isim" required>
                        <label>İsim</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="soyisim" required>
                        <label>Soyisim</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"></span>
                        <input type="number" name="tc" required>
                        <label>TC Kimlik No</label>
                    </div>
                    <div class="input-box">
                        <input type="email" name ="email" required>
                        <label>E-mail</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"></span>
                        <input type="password" name = "password"required>
                        <label>Şifre</label>
                    </div>
                    <button type="submit" name="registersubmit" class="btn">Kaydol</button>
                    <div class="login-register">
                        <p>Zaten bir hesabınız var mı?<a href="#" class="login-link"> Giriş Yap </a></p>
                    </div>
                </form>
            </div>

        </div>
    </section>

    <section class="page" id="services">
        <div class="services">
            <div class="container">
                <div class="image"><img src="media/services/md_2.jpg"></div>
                <div class="image"><img src="media/services/md_3.jpg"></div>
                <div class="image"><img src="media/services/Diger-Saglik-Personeli-1024x682.jpg"></div>
                <div class="image"><img src="media/services/MR.jpg"></div>
                <div class="image"><img src="media/services/hastane-iç-ahsap-dizayn18.jpg"></div>
                <div class="image"><img src="media/services/download.jpeg"></div>
                <div class="image"><img src="media/services/400px-Guven_hastanesi_resimleri_3.jpg"></div>
                <div class="image"><img src="media/services/istockphoto-1298375809-612x612.jpg"></div>

            </div>
        </div>
            <div class="popup-image">
                <span>&times;</span>
                <img src="media/services/md_2.jpg">
            </div>
    </section>
    <section class="page" id="doctors">
    <section class="card-container">
        <?php
        $query = "SELECT * FROM doktorlar";
        $post = $baglan->prepare($query);
        $statement = $post->execute();  
        //$row = $post->fetch(PDO::FETCH_ASSOC);
        while ($row = $post->fetch(PDO::FETCH_ASSOC)) {
            $isim = $row['doktorisim'];
            $kucukisim = strtolower(str_replace(' ', '', $isim));
            $soyisim = $row['doktorsoyisim'];
            $kucuksoyisim = strtolower(str_replace(' ', '', $soyisim));
            $doktorisim = $isim . " " . $soyisim;
            $doktorclinic = $row['clinic'];
            echo '<div class="card">';
            echo '<div class="cardimg">';
            //echo '<img src="' . "media/doctors/" . $doktorisim . $doktorsoyisim . ".jpg" . '" alt="">';
            //echo '<img src="media/doctors/' . $doktorisim . $doktorsoyisim . '.jpg" alt="">';
            echo '<img src="media/Doctors/' . strtolower($kucukisim) . strtolower($kucuksoyisim) . '.jpg" alt="">';
            echo '</div>';
            echo '<h2>' . $doktorisim . '</h2>';
            echo '<p>' . strtoupper($doktorclinic) . '</p>';
            echo '</div>';
        }
        ?>
    </section>
</section>
<!-- 
-->
    <section class="page" id="about">
        <div class="about-section">
            <div class="about-container">
                <div class="content-section">
                    <div class="title">
                        <h1> Hakkımızda </h1>
                    </div>
                    <div class="content">
                        <h3>Türkiye'nin Sağlık Gücüne Güç Katan Hastane</h3>
                        <p> 
                            Türkiye’nin en köklü ve deneyimli sağlık 
                            gruplarından olan MLP Care Grubu’nun amiral 
                            gemisi konumundaki XXXXXX Hastaneleri 
                            olarak, 1993 yılından bu yana ülkemizin 12
                            ilinde 21 hastanemiz ile hizmet veriyoruz. 
                            "Sağlıklı yaşamak, sağlık hizmetlerinden 
                            eşit derecede faydalanmak herkesin en temel
                            hakkıdır" ilkesiyle zincirin halkalarını 
                            çoğaltmaya devam ederken, Türkiye'nin her 
                            yerine yayılarak, tıbbi etik ilkelerden ödün
                            vermeden, gelişmiş teknolojimizle sağlık 
                            standartlarını yükseltmek konusunda emin 
                            adımlarla ilerliyoruz. 
                        </p>
                        <div class="read-button">
                            <a href=""> Daha fazlası için</a>
                        </div>
                    </div>
                    <div class="social">
                            
                    </div>
                </div>
                <div class="image-section">
                    <img src="media/aboutus/depositphotos_28608447-stock-photo-male-doctor-in-front-of.jpg">
                </div>
            </div>
        </div>
    </section>


    <section class="page" id="contact">
        <div class="contact">
            <div class="contact-content">
                <h2> Bizimle iletişime geçin.</h2>
                <p>Görüşleriniz bizim için değerlidir.</p>
            </div>
            <div class="contact-container">
                <div class="contactInfo">
                    <div class="contact-box">
                        <div class="co7ntact-icon"><ion-icon name="map-outline"></ion-icon></div>
                        <div class="contact-text">
                            <h3>Adres:</h3>
                            <p> Ali Osman Caddesi 300.Sokak Sarıçam/Adana</p>
                        </div>
                    </div>
                    <div class="contact-box">
                        <div class="contact-icon"><ion-icon name="call-outline"></ion-icon></div>
                        <div class="contact-text">
                            <h3>İletişim</h3>
                            <p>+338 (212) 39 42</p>
                        </div>
                    </div>
                    <div class="contact-box">
                        <div class="contact-icon"><ion-icon name="mail-outline"></ion-icon></div>
                        <div class="contact-text">
                            <h3>E-mail:</h3>
                            <p>adanaaliyye@hastane.com</p>
                        </div>
                    </div>
                </div>
                <div class="contactForm">
                    <form>
                        <h2> İletişim Formu</h2>
                        <div class="contact-input-box">
                            <input type="text" name="" required="required">
                            <span>İsim Soyisim</span>
                        </div>
                        <div class="contact-input-box">
                            <input type="email" name="" required="required">
                            <span>E-mail</span>
                        </div>
                        <div class="contact-input-box">
                            <textarea  required="required"></textarea>
                            <span>Mesajınızı yazın...</span>
                        </div>
                        <div class="contact-input-box">
                            <input type="submit" name="emailsubmit" name="" value="Gönder">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  <?php } ?> 
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="script.js"></script>

</body>

